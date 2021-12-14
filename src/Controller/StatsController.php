<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController
{
    /**
     * @Route ("/stats/{id}", methods={"GET"})
     * @param string $id
     * @return Response
     */
    public function aggregate(string $id): Response
    {

    }

    /**
     * @Route ("/stats", methods={"GET"})
     * @return Response
     */
    public function total(): Response
    {

    }
}