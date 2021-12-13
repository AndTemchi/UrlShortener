<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinksController
{

    /**
     * @Route("/links", methods={"POST"})
     *
     * @return Response
     * @throws Exception
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
     * @return Response
     */
    public function update(): Response
    {

    }

    /**
     * @Route ("/links/{id}", methods={"DELETE"})
     * @return Response
     */
    public function delete(): Response
    {

    }

    /**
     * @Route ("/links/{id}", methods={"GET"})
     * @return Response
     */
    public function show(): Response
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