<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinkController extends AbstractController
{
    /**
     * @Route("/link", methods={"POST"}, name="link_create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        new Response('hello world', 200);
    }

    /**
     * @Route ("/link/{id}", methods={"PATCH"}, name="link_update")
     * @param string $id
     * @return Response
     */
    public function update(string $id): Response
    {

    }

    /**
     * @Route ("/link/{id}", methods={"DELETE"}, name="link_delete")
     * @param string $id
     * @return Response
     */
    public function delete(string $id): Response
    {

    }

    /**
     * @Route ("/link/{id}", methods={"GET"}, name="link_show")
     * @param string $id
     * @return Response
     */
    public function show(string $id): Response
    {
       $response = new Response("hello world $id", 200);
       return $response;
    }
}