<?php

namespace spredis;

class AutoLoad
{
    
    
    const SPACE_PREFIX = 'spredis';
    
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
    

    public static function autoload($class)
    {
        if (0 === strpos($class,self::SPACE_PREFIX))
        {
            $file = substr($class,strlen(self::SPACE_PREFIX));
			$file = str_replace('\\', '/', $file);
            $file = __DIR__.$file.'.php';
            
            is_file($file) && include $file;
        }
    }
    
    
}
