<?php

namespace App\Service;

use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class ShuffleKeywordGenerator extends AbstractIdGenerator
{
    private LinkRepository $linkRepository;
    private string $charset;
    private int $keywordLength;

    public function __construct(
        LinkRepository $linkRepository,
        string $charset,
        int $keywordLength
    ) {
        $this->linkRepository = $linkRepository;
        $this->charset = $charset;
        $this->keywordLength = $keywordLength;
    }

    public function generate(EntityManager $em, $entity)
    {
        $ok = false;
        do {
            $keyword = $this->randomString();
            if (!$this->isKeywordExists($keyword)) {
                $ok = true;
            }
        } while (!$ok);

        return $keyword;
    }

    private function randomString(): string
    {
        return substr(str_shuffle($this->charset), 0, $this->keywordLength);
    }

    private function isKeywordExists(string $keyword): bool
    {
        return (bool)$this->linkRepository->findOneBy(['keyword' => $keyword]);
    }
}