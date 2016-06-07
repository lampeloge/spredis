<?php

namespace spredis\console;
use spredis\console\Terminal;

class Pipeline
{
    
    
    private $console = null;
    
    private $queue   = null;
    
    public function __construct()
    {
        $this->queue   = new \SplQueue();
        $this->console = Terminal::getInstance();
    }
    
    public function __call($cmd,$params)
    {
        $this->queue[] = array(
            $cmd => $params,
        );
    }
    
    public function execute()
    {
        if ($this->queue->isEmpty())
        {
            return null;
        }
        
        foreach ($this->queue as $value)
        {
            $cmd = key($value);
            $this->console->request($cmd,$value[$cmd]);
        }
        
        $response = array();
        
        foreach ($this->queue as $value)
        {
            $response[] = $this->console->response(key($value));
            $this->queue->dequeue();
        }
        
        return $response;
    }
    
}
