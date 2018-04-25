<?php
declare(strict_types=1);

namespace Farol360\Ancora\Controller;

use Farol360\Ancora\Controller;
use Farol360\Ancora\Mailer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Flash\Messages as FlashMessages;
use Slim\Views\Twig as View;

use Farol360\Ancora\Model;
use Farol360\Ancora\Model\EntityFactory;

class PageController extends Controller
{
    protected $mailer;


    public function __construct(View $view, FlashMessages $flash, Mailer $mailer, EntityFactory $entityFactory)
    {
        parent::__construct($view, $flash);
        $this->mailer           = $mailer;
        $this->userModel        = $userModel;
        $this->entityFactory    = $entityFactory;
    }

    public function contato(Request $request, Response $response): Response
    {
        if (empty($request)) {
            return $this->view->render($response, 'page/contato.twig');
        } else {
            if (empty($request->getParsedBody())) {
                return $this->view->render($response, 'page/contato.twig');
            } else {
                $texto =
                    "Olá!\n
                    Alguém entrou em contato \n\n
                    -----DADOS----- \n
                    NOME:" . $request->getParsedBody()['nome'] . "\n
                    EMAIL: " . $request->getParsedBody()['email'] . "\n
                    TELEFONE: " . $request->getParsedBody()['telefone'] . "
                    \n\n
                    CORPO DA MENSAGEM: " . $request->getParsedBody()['corpo-email'];


                $this->mailer->send(
                    $request->getParsedBody()['nome'],
                    $request->getParsedBody()['email'],
                    "Contato via Website",
                    $texto
                );

                return $this->httpRedirect($request, $response, '/obrigado');
            }
        }
    }

    public function contatoObrigado(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'page/contato_obrigado.twig');
    }

    public function index(Request $request, Response $response): Response
    {

        $url = "https://api.instagram.com/v1/users/self/?access_token=4571961371.9e192a5.9b61c64ad8d74bb79e5f0f1e7e04ae0a";
        $api_call = file_get_contents($url);

        $instagram_farol = json_decode($api_call);

        return $this->view->render($response, 'page/index.twig', ['instagram_farol' => $instagram_farol] );
    }

}
