<?php

namespace spredis;
use spredis\console\Terminal;

class Client
{
    
    
    const VERSION = '1.0.0-beta1';
    
    private $console   = null;
    
    private $config    = null;
    
    private $pipeline  = null;
    
    
    public function __construct(array $config = null)
    {
        
        Terminal::create($config);
        
        $this->console = Terminal::getInstance();
    }

    

    public function pipeline($callback)
    {
        if (is_null($this->pipeline))
        {
            $this->pipeline = new \spredis\console\Pipeline();
        }
        
        call_user_func($callback,$this->pipeline);
        
        return $this->pipeline->execute();
    }


    public function connect()
    {
        return $this->console->connect();
    }
    
    public function disconnect()
    {
        $this->console->disconnect();
    }
    
    public function __call($method,$params)
    {
        return $this->console->execute($method,$params);
    }
    
}
