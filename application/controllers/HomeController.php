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

        try {
            $stmt = $c->get('db')->prepare('SELECT * FROM tree_1');
            $stmt->execute();

            print_r( $stmt->fetchAll() );

        } catch ( PDOException $e ) {
            return $response->withJson($e->getMessage(), 200);
        }

        $response = $c->view->render($response, 'index.twig', [
            'page' => 'homapage'
        ]);

        return $response;
    }
}
