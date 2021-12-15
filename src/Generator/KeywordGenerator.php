<?php

namespace App\Generator;

use Doctrine\ORM\Id\AbstractIdGenerator;

class KeywordGenerator extends AbstractIdGenerator
{

    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        return (string)rand(1,65535);
    }
}