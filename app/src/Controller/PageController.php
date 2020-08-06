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
        // $this->userModel        = $userModel;
        $this->entityFactory    = $entityFactory;
    }

    public function ancora(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'page/ancora.twig');
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

        // $url = "https://api.instagram.com/v1/users/self/?access_token=4571961371.9e192a5.c4f149b6b6574927aead18d30ee12698";
        // $api_call = file_get_contents($url);
        // var_dump($api_call); die;

        // if ($api_call != null) {
        //     $instagram_farol = json_decode($api_call);
        //     $instagram_midia_farol = "https://api.instagram.com/v1/users/self/media/recent/?access_token=4571961371.9e192a5.c4f149b6b6574927aead18d30ee12698&count=5";

        //     $instagram_farol_midias = file_get_contents($instagram_midia_farol);
        //     $instagram_farol_midias = json_decode($instagram_farol_midias);
        // }


        return $this->view->render($response, 'page/index.twig', [
            // 'instagram_farol'        => $instagram_farol,
            // 'instagram_farol_midias' => $instagram_farol_midias
            ] );
    }

}
