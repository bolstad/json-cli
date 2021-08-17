<?php


namespace bolstad\JsonTools;


class Init
{

    private $cliMode;
    private $params;
    private $handlers = array();
    private $handlerFound;
    private $handler;

    public function __construct()
    {
        $this->cliMode = false;
        $this->handlers['arrayListToObject'] = 'bolstad\JsonTools\arrayListToObject';
    }


    public function setup()
    {
        $this->handlerFound = false;
        if (php_sapi_name() == "cli") {
            $this->setupCli();
        }
        if (isset($this->handlers['arrayListToObject'])) {
            $this->handler = new $this->handlers['arrayListToObject']($this->params->getJsonData());
        }

    }

    private function setupCli()
    {
        $this->cliMode = true;
        $this->params = new ParseCliParameters();
        $config = $this->params->getConfig();
        print_r($config);
    }

    public function run()
    {
        $this->handler->process();
    }
}