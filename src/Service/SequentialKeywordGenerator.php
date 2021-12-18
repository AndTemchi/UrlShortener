<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\NextIdNotFound;
use App\Repository\LinkRepository;
use App\Repository\OptionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Id\AbstractIdGenerator;

class SequentialKeywordGenerator extends AbstractIdGenerator
{
    private OptionRepository $optionRepository;
    private LinkRepository $linkRepository;
    private string $charset;
    private int $keywordLength;


    /**
     * @param OptionRepository $optionRepository
     * @param LinkRepository $linkRepository
     * @param string $charset
     * @param int $keywordLength
     */
    public function __construct(
        OptionRepository $optionRepository,
        LinkRepository $linkRepository,
        string $charset,
        int $keywordLength
    ) {
        $this->optionRepository = $optionRepository;
        $this->linkRepository = $linkRepository;
        $this->charset = $charset;
        $this->keywordLength = $keywordLength;


    }

    public function generate(EntityManager $em, $entity)
    {
        $ok = false;
        $nextNumber = $this->getNextNumber();
        do {
            $keyword = $this->intToString($nextNumber);

            if (!$this->isKeywordExists($keyword)) {
                $ok = true;
            }
            $nextNumber++;
        } while (!$ok);
        $this->updateNextNumber();

        return $keyword;
    }

    /**
     * @return int
     * @throws NextIdNotFound
     */
    private function getNextNumber(): int
    {
        $number = $this->optionRepository->findOneBy(['name' => 'next_id']);
        if ($number === null) {
            throw new NextIdNotFound();
        }

        return (int)$number->getValue();
    }

    private function intToString(int $number): string
    {
        $str = '';
        $strLen = 0;
        $charsetLen = strlen($this->charset);
        while ($strLen < $this->keywordLength) {
            while ($number >= $charsetLen) {
                $mod = bcmod($number, (string)$charsetLen);
                $number = bcdiv($number, (string)$charsetLen);
                $str = $this->charset[$mod].$str;
            }
            $str = $this->charset[(int)$number].$str;
            $strLen = strlen($str);
        }
        return $str;
    }

    private function isKeywordExists(string $keyword): bool
    {
        return (bool)$this->linkRepository->findOneBy(['keyword' => $keyword]);
    }

    private function updateNextNumber(): void
    {
        $this->optionRepository->incrementNextId();
    }
}