<?php


namespace bolstad\JsonTools;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

class ParseCliParameters
{
    private $application;
    private $msg;
    private $parameters;
    private $jsonData;

    function __construct()
    {


        $exec = (new SingleCommandApplication())
            ->setName('JsonTools') // Optional
            ->setVersion('1.0.0') // Optional
            ->addOption('fields', 'f', InputOption::VALUE_REQUIRED)
            ->addOption('modifier', 't', InputOption::VALUE_REQUIRED)
            ->setCode(array($this, 'parseCommands'))
            ->setAutoExit(false)
            ->run();

    }

    function parseCommands(InputInterface $input, OutputInterface $output)
    {
#        echo count($input->getArguments());
#        echo $input->getFirstArgument();
#        print_r($input->getArguments());
#        $this->msg = time() . $input->getFirstArgument();
#        $output->writeln("<info>{$this->msg}</info>\n");

        $processed = false;


        if ($input->getOption('modifier') == 'arrayListToObject') {
            $this->parameters['modifier'] = $input->getOption('modifier');
            $this->parameters['fields'] = $input->getOption('fields');
            $this->jsonData = file_get_contents("php://stdin");
            $processed = true;
        }

        if (!$processed) {
            $output->writeln("<info>No valid parameters sent</info>");
        }
    }

    function getJsonData()
    {
        return $this->jsonData;

    }

    function getConfig()
    {
        return $this->parameters;
    }

}