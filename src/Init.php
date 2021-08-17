<?php


namespace bolstad\JsonTools;


class Init
{

    private $cliMode;
    private $params;
    private $handlers = array();
    private $handlerFound;
    private $handler;
    private $config;

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


/**
        echo "here\n";
        print_r($this->config);
        echo "the config is above\n";
**/
        if (isset($this->handlers[$this->config['modifier']])) {
            $this->handler = new $this->handlers[$this->config['modifier']]($this->params->getJsonData());
            $this->handlerFound = true;
        }

    }

    private function setupCli()
    {
        $this->cliMode = true;
        $this->params = new ParseCliParameters();
        $this->config = $this->params->getConfig();
#        print_r($this->config);
    }

    public function run()
    {
        if (!$this->handlerFound) {
            echo "No handlers found";
        }

        if ($this->handlerFound) {
            $returnData =  $this->handler->process();
            $jsonData = json_encode($returnData, JSON_PRETTY_PRINT);
            echo $jsonData;
        }
    }
}