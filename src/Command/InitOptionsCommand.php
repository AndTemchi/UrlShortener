<?php

namespace App\Command;


use App\Entity\Option;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitOptionsCommand extends Command
{
    protected static $defaultName = 'app:init-options';
    protected static $defaultDescription = 'This command insert needed records to options table in db';

    private ManagerRegistry $doctrine;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setHelp('This command insert needed records to options table in db');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Try to create next_id option...');

        $manager = $this->doctrine->getManager();
        $repository = $manager->getRepository(Option::class);
        $result = $repository->findOneBy(['name' => 'next_id']);

        if (!$result) {
            $nextId = new Option();
            $nextId->setName('next_id');
            $nextId->setValue('1');

            $manager->persist($nextId);
            $manager->flush();
            $output->writeln('Done!');

            return Command::SUCCESS;
        } else {
            $output->writeln('Option next_id already exists');

            return Command::FAILURE;
        }
    }
}