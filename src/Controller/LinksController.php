<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinksController
{

    /**
     * @Route("/links", methods={"POST"})
     *
     * @return Response
     * @throws \Exception
     */
    public function create(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Test: '.$number.'</body></html>'
        );
    }

    /**
     * @Route ("/links/{id}", methods={"PATCH"})
     * @param string $id
     * @return Response
     */
    public function update(string $id): Response
    {

    }

    /**
     * @Route ("/links/{id}", methods={"DELETE"})
     * @param string $id
     * @return Response
     */
    public function delete(string $id): Response
    {

    }

    /**
     * @Route ("/links/{id}", methods={"GET"})
     * @param string $id
     * @return Response
     */
    public function show(string $id): Response
    {

    }

    /**
     * @Route ("/links", methods={"GET"})
     * @return Response
     */
    public function list(): Response
    {

    }
}