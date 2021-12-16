<?php

namespace App\Controller;

use App\Entity\Link;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends AbstractController
{

    /**
     * @Route("/links", methods={"POST"}, name="links_create")
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    public function create(ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $link = new Link();
        //$link->setKeyword('1');
        $link->setUrl('google.com');
        $link->setClicks(0);
        $link->setDate(new \DateTime());
        $link->setIp('192.168.1.1');
        $link->setTitle('google');
        $link->setTags(['first', 'link']);

        $entityManager->persist($link);
        $entityManager->flush();

        return new Response('Saved new link with keywork ' . $link->getKeyword(), 201);
    }

    /**
     * @Route ("/links/{id}", methods={"PATCH"}, name="links_update")
     * @param string $id
     * @return Response
     */
    public function update(ManagerRegistry $doctrine, string $id): Response
    {
        $entityManager = $doctrine->getManager();
        $link = $entityManager->getRepository(Link::class)->find($id);

        if (!$link) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $link->setTitle('google' . rand(1, 100));
        $entityManager->flush();

        return new Response('Saved new link with keywork ' . $link->getKeyword());
    }

    /**
     * @Route ("/links/{id}", methods={"DELETE"}, name="links_delete")
     * @param string $id
     * @return Response
     */
    public function delete(ManagerRegistry $doctrine, string $id): Response
    {
        $entityManager = $doctrine->getManager();
        $link = $entityManager->getRepository(Link::class)->find($id);

        if (!$link) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        $entityManager->remove($link);
        $entityManager->flush();
        return new Response('', 204);
    }

    /**
     * @Route ("/links/{id}", methods={"GET"}, name="links_show")
     * @param string $id
     * @return Response
     */
    public function show(ManagerRegistry $doctrine, string $id): Response
    {
        $link = $doctrine->getRepository(Link::class)->find($id);

        if (!$link) {
            throw $this->createNotFoundException(
                'No link found for keyword ' . $id
            );
        }
        return new Response('Link with url ' . $link->getUrl());
    }

    /**
     * @Route ("/links", methods={"GET"}, name="links_list")
     * @return Response
     */
    public function list(): Response
    {

    }
}