<?php

namespace App\Generator;

use Doctrine\ORM\Id\AbstractIdGenerator;

class KeywordGenerator extends AbstractIdGenerator
{
    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param object|null $entity
     * @return string
     */
    public function generate(\Doctrine\ORM\EntityManager $em, $entity): string
    {
        return (string)rand(1,65535);
        //return $this->generateTest();
    }

    private function charset(): string
    {
        return "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-_";
    }

    private function randomString(int $length): string
    {
        return substr(str_shuffle($this->charset()), 0, $length);
    }

    private function getDecimal()
    {
        //todo: get it from db options
        return 10;
    }

    private function generateTest(): string
    {
        $ok = false;
        $decimalNumber = $this->getDecimal();
        do {
            $keyword = $this->intToString($decimalNumber);
            if(!$this->isKeywordExists($keyword)) {
                $ok = true;
            }
            $decimalNumber++;
        } while (!$ok);
        $this->updateDecimalNumber();
        return $keyword;
    }

    private function intToString(int $number)
    {
        //todo: need to install bcmath ext
        $charset = $this->charset();
        $str = '';
        $charsetLen = strlen($charset);
        while ($number >= $charsetLen) {
            $mod = bcmod($number, $charsetLen);
            $number = bcdiv($number, $charsetLen);
            $str = $charset[$mod] . $str;
        }
        $str = $charset[(int)$number] . $str;
        return $str;
    }

    private function isKeywordExists(string $keyword)
    {
        //todo: find in db
    }

    private function updateDecimalNumber()
    {
        //todo: update in db in options
    }


}