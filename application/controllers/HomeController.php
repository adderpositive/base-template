<?php
namespace Controllers;

use Psr\Container\ContainerInterface;
use Models\TestModel;

class HomeController {
    protected $db;
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        $this->db = $container->get('db');
    }

    public function __invoke( $request, $response, $args ) {
        $c = $this->container;

        // for test reason
        if ( $c->has('logger') ) {
            $c->logger->addInfo("Ticket list");
        }

        $items = TestModel::all();

        $response = $c->view->render($response, 'index.twig', [
            'page' => 'homapage',
            'items' => $items
        ]);

        return $response;
    }
}
