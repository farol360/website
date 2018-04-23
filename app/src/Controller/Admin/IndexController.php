<?php
declare(strict_types=1);

namespace Farol360\Ancora\Controller\Admin;

use Farol360\Ancora\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController extends Controller
{
    public function index(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'admin/dashboard/index.twig');
    }
}
