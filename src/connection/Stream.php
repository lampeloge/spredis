<?php

namespace spredis\connection;
use spredis\Exception;

class Stream
{
    
    
    private $isConnect = false;
    
    private $config    = null;
    
    private $resource  = null;
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    
    public function connect()
    {
        if($this->isConnect)
        {
            return true;
        }
        
        $soketUri = filter_var($this->config['hostname'],FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) ? 
                    "tcp://[{$this->config['hostname']}]:{$this->config['hostport']}" : 
                    "tcp://{$this->config['hostname']}:{$this->config['hostport']}";
        
        $timeout  = intval(isset($this->config['timeout']) ? $this->config['timeout'] : ini_get("default_socket_timeout"));
        $resource = stream_socket_client($soketUri,$errno,$errstr,$timeout,STREAM_CLIENT_CONNECT);
        
        if(!$resource)
        {
            throw new Exception("socket connect error : $errno -> $errstr");
        }
        
        if(isset($this->config['rw_timeout']))
        {
            $timeout = intval(isset($this->config['auth']));
            $timeout = $timeout > 0 ? $timeout : -1;
            stream_set_timeout($resource,$timeout);
        }
        $this->resource  = $resource;
        $this->isConnect = true;
        return true;
    }
    
    
    public function disconnect()
    {
        if($this->isConnect)
        {
            fclose($this->resource);
            unset($this->resource);
            $this->isConnect = false;
        }
    }
    
    
    public function __get($name)
    {
        return $this->$name;
    }
    
    
    
}
