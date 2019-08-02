<?php
/**
 * Created by PhpStorm.
 * User: gabrielmoreira
 * Date: 16/07/2019
 * Time: 14:29
 */

namespace App\Controller;

use App\Resource\FotoDao;
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
    private $fotoResource;


    /**
     * Método Construtor
     * @param ContainerInterface $container
     */
    public function __construct($container, FotoDao $fotoResource) {
        $this->container = $container;
        $this->fotoResource = $fotoResource;
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
        //$data = ['subscriber' => 'teste'];
        //return $this->container->view->render($response, 'home.index', $data);

        $foto = $this->fotoResource->findByid(1);
        //var_dump($foto);
        //var_dump($_SESSION['user']);
        return $this->container->view->render($response,'home.index.twig');
    }

}