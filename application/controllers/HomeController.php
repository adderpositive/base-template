<?php
namespace Controllers;

use Psr\Container\ContainerInterface;

class HomeController {
    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function __invoke( $request, $response, $args ) {
        $c = $this->container;

        // for test reason
        if ( $c->has('logger') ) {
            $c->logger->addInfo("Ticket list");
        }

        $response = $c->view->render($response, 'index.twig', [
            'page' => 'homapage'
        ]);

        return $response;
    }
}
