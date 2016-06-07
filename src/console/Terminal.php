<?php

namespace spredis\console;
use spredis\connection\Stream;
use spredis\Exception;

class Terminal
{
    
    
    private static $_instance = null;
    
    
    private $config     = null;
    
    private $command    = null;
    
    private $connection = null;
    
    
    
    private function __construct(array $config)
    {
        
        if(empty($config))
        {
            throw Exception('not exist config of spredis');
        }
        
        $this->config     = $config;
        $this->command    = include __DIR__.'/command.php';
        $this->connection = new Stream($config);
    }
    
    
    public static function create(array $config)
    {
        self::$_instance = new self($config);
    }


    public static function getInstance()
    {
        if(is_null(self::$_instance))
        {
            throw Exception('not create the terminal instance');
        }
        
        return self::$_instance;
    }
    
    
    public function request($cmd,$params)
    {
        $cmd = strtoupper($cmd);
        
        if (!isset($this->command[$cmd]))
        {
            throw new Exception("'$cmd' is not a registered redis command");
        }

        if (!$this->connection->isConnect)
        {
            $this->connect();
        }
        
        $filterFunc = strtolower($cmd).'Write';
        $params = Filter::$filterFunc($params);

        $cmdLenth = strlen($cmd);
        $parLenth = count($params) + 1;

        $buffers  = "*{$parLenth}\r\n\${$cmdLenth}\r\n{$cmd}\r\n";

        for($i = 0, $parLenth--; $i < $parLenth; ++$i)
        {
            $param    = $params[$i];
            $argLenth = strlen($param); 
            $buffers .= "\${$argLenth}\r\n{$param}\r\n";
        }

        while(($length = strlen($buffers)) > 0)
        {
            $written = fwrite($this->connection->resource, $buffers);

            if($length === $written)
            {
                return true;
            }

            if ($written === false || $written === 0)
            {
                throw new Exception('error while writing bytes to the server');
            }

            $buffers = substr($buffers, $written);
        }
        return true;
    }
    
    public function response($cmd,$retProto = false)
    {

        $getdata = fgets($this->connection->resource);

        if ($getdata === false || $getdata === '')
        {
            throw new Exception('error while fgets line from the server');
        }

        $symbol   = $getdata[0];
        $response = substr($getdata, 1, -2);
        $result   = null;
        
        switch ($symbol)
        {

            case '$':
                
                $size = intval($response);
                
                if ($size === -1)
                {
                    $result = null;
                    break;
                }
                
                $thenValue = '';
                $bytesLeft = ($size += 2);

                do {
                    
                    $readdata = fread($this->connection->resource,$bytesLeft);
                    
                    if ($readdata === false || $readdata === '')
                    {
                        throw new Exception('error while fread bytes from the server');
                    }
                    
                    $thenValue .= $readdata;
                    $bytesLeft  = $size - strlen($thenValue);
                    
                }while($bytesLeft > 0);

                $result = substr($thenValue, 0, -2);
                break;

            case '*':
                
                $count = intval($response);

                if ($count === -1)
                {
                    return;
                }
                
                $multiThen = array();

                for ($i = 0; $i < $count; ++$i)
                {
                    $multiThen[$i] = $this->response($cmd,true);
                }
                
                $result = $multiThen;
                break;

            case '+':
            case ':':
                
                $result = $response;
                break;

            case '-':
                
                $result = array('error' => $response);
                break;
                
            default:
                
                throw new Exception('unknown response protocol: '.$symbol);
                break;
        }
        
        if ($retProto)
        {
           return $result;
        }
        
        if (isset($result['error']) && is_array($result))
        {
            return array(
                'status' => false,
                'result' => $result['error'],
            );
        }
        else
        {
            $filterFunc = $cmd.'Read';
            return array(
                'status' => true,
                'result' => Filter::$filterFunc($result),
            );
        }
    }
    
    
    public function connect()
    {
        if ($this->connection->isConnect)
        {
            return true;
        }
        
        $this->connection->connect();
        
        if (isset($this->config['password']))
        {
            $this->execute('auth',array($this->config['password']));
        }
        
        if (isset($this->config['database']))
        {
            $this->execute('select',array($this->config['database']));
        }
        
        return true;
    }
    
    
    public function execute($cmd,$params)
    {
        $this->request($cmd,$params);
        return $this->response($cmd);
    }
    
    
    public function disconnect()
    {
        $this->connection->isConnect && $this->connection->disconnect();
    }
    
    public function __destruct()
    {
        $this->connection->isConnect && $this->connection->disconnect();
    }
    
    private function __clone(){}
    
}
