<?php

declare(strict_types=1);


namespace App\Controller;

use App\Entity\Link;
use App\Service\UrlTitleService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

class LinksController extends AbstractController
{

    /**
     * @Route("/links", methods={"POST"}, name="links_create")
     *
     * @param ManagerRegistry $doctrine
     * @param UrlTitleService $titleService
     * @return Response
     */
    public function create(Request $request, ManagerRegistry $doctrine, UrlTitleService $titleService): Response
    {
        // code in style of fat controller, because of no time... Need to do validations, some service etc
        if (empty($request->get('long_url'))) {
            throw new BadRequestHttpException('long_url is required');
        }

        $link = new Link();
        $link->setUrl($request->get('long_url')); //todo: need to validate url
        //todo: need to check internal redirection loops
        if (!empty ($request->get('title'))) {
            $link->setTitle($request->get('title'));
        } else {
            $link->setTitle($titleService->getTitle($link->getUrl()));
        }

        $link->setClicks(0);
        $link->setDate(new \DateTime());
        $link->setIp('192.168.1.1');
        if (is_array($request->get('tags'))) {
            $link->setTags($request->get('tags', []));
        }

        $entityManager = $doctrine->getManager();

        $entityManager->persist($link);

        $entityManager->flush();

        $result = $doctrine->getRepository(Link::class)->findOneBy(['url' => $link->getUrl()]);
        return $this->json($result,201);
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
                'No product found for id '.$id
            );
        }

        $link->setTitle('google'.rand(1, 100));
        $entityManager->flush();

        return new Response('Saved new link with keywork '.$link->getKeyword());
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
                'No product found for id '.$id
            );
        }

        $entityManager->remove($link);
        $entityManager->flush();

        return $this->json([], 204);
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
                'No link found for keyword '.$id
            );
        }

        return $this->json($link);
    }

    /**
     * @Route ("/links", methods={"GET"}, name="links_list")
     * @return Response
     */
    public function list(): Response
    {
        
    }
}