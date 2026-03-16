<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Entity\ProductVariant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import:custom-prices',
    description: 'Import a CSV to manager custom prices for users'
)]
class ImportCustomPricesCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('file', InputArgument::REQUIRED, 'Chemin vers le fichier CSV');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = $input->getArgument('file');

        if (!file_exists($filePath)) {
            $output->writeln("<error>Fichier introuvable : $filePath</error>");
            return Command::FAILURE;
        }

        $file = new \SplFileObject($filePath);
        $file->setFlags(\SplFileObject::READ_CSV);
        $file->setCsvControl(';');

        $i = 0;

        $output->writeln("Début de l'import CSV...");

        foreach ($file as $row) {
            if ($row === null || count($row) < 3) {
                continue;
            }

            // Code goes here... good luck! :)
        }

        $this->em->flush();
        $this->em->clear();
        $output->writeln("Import terminé : $i lignes traitées.");

        return 0;
    }
}