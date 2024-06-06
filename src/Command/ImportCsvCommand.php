<?php

namespace App\Command;

use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ImportCsvCommand extends Command
{
    protected static $defaultName = 'app:import-csv';
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Imports data from a CSV file into the database')
            ->addArgument('csvFile', InputArgument::REQUIRED, 'Path to the CSV file');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFile = $input->getArgument('csvFile');

        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            $output->writeln('<error>CSV file not found or is not readable.</error>');
            return Command::FAILURE;
        }

        $data = $this->readCsv($csvFile);

        foreach ($data as $row) {
            $city = new Location();
            $city->setCityName($row[0]);
            $city->setCity($row[1]);
            $city->setZipCode($row[2]);
            $city->setRegion1($row[3]);
            $city->setRegion2($row[4]);
            $city->setRegion3($row[5]);
            $city->setRegion4($row[6]);
            $city->setState($row[7]);
            $city->setAutoid($row[8]);
            $city->setLatitude($row[9]);
            $city->setLongitude($row[10]);

            $this->entityManager->persist($city);
        }

        $this->entityManager->flush();

        $output->writeln('<info>Data imported successfully!</info>');

        return Command::SUCCESS;
    }

    private function readCsv($csvFile)
    {
        $rows = [];
        if (($handle = fopen($csvFile, 'r')) !== false) {
            // Skip the header row
            fgetcsv($handle, 1000, ',');
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }

        return $rows;
    }
}
