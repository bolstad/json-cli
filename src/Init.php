<?php


namespace bolstad\JsonTools;


class Init
{

    private $cliMode;
    private $params;

    public function __construct()
    {
        $this->cliMode = false;
    }


    public function setup()
    {
        if (php_sapi_name() == "cli") {
            $this->setupCli();
        }
    }

    private function setupCli()
    {
        $this->cliMode = true;
        $this->params = new ParseCliParameters();

    }
}