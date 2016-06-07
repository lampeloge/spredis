<?php

namespace spredis;
use spredis\console\Terminal;

class Client
{
    
    
    const SPACE_PREFIX = 'spredis';
    
    private $console   = null;
    
    private $config    = null;
    
    private $pipeline  = null;
    
    public function __construct($config = null)
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
        
        Terminal::create($config);
        
        $this->console = Terminal::getInstance();
        
    }

    public function autoload($class)
    {
        if (0 === strpos($class,self::SPACE_PREFIX))
        {
            $file = substr($class,strlen(self::SPACE_PREFIX));
			$file = str_replace('\\', '/', $file);
            $file = __DIR__.$file.'.php';
            
            is_file($file) && include $file;
        }
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
