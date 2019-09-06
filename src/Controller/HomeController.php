<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 16/07/2019
 * Time: 14:29
 */

namespace App\Controller;

use App\Dao\FotoDao;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
/**
 * Controller de Exemplo
 */
final class HomeController {
    /**
     * Container - Ele recebe uma instancia de um
     * container da rota no construtor
     * @var object s
     */
    protected $container;

    /**
     * Método Construtor
     * @param ContainerInterface $container
     */
    public function __construct($container) {
        $this->container = $container;
    }

    /**
     * Método de Exemplo
     *
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return void Response
     */
    public function index($request, $response, $args) {

        return $this->container->view->render($response,'pages/home/index.twig');
    }

}