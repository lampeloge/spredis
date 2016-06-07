<?php

namespace spredis\console;


class Filter
{
    
    
    
    public static function msetWrite($params)
    {
    	return Filter::kv2proto($params[0]);
    }
    
    public static function hmsetWrite($params)
    {
        list($cmd,$array) = $params;
        return array_merge(array($cmd),Filter::kv2proto($array));
    }
    
    public static function hmgetWrite($params)
    {
        list($cmd,$array) = $params;
        return array_merge(array($cmd),Filter::v2proto($array));
    }
    
    public static function hgetallRead($params)
    {
        return Filter::proto2array($params);
    }
    
    public static function sinterstoreWrite($params)
    {
        return array_merge(array($params[0]),Filter::v2proto($params[1]));
    }
    
    public static function mgetWrite($params)
    {
        return Filter::v2proto($params[0]);
    }
    
    public static function kv2proto($array)
    {
        $params = array();
        foreach ($array as $key => $value)
        {
            $params[] = $key;
            $params[] = $value;
        }
        return $params;
    }
    
    
    public static function v2proto($array)
    {
        $params = array();
        foreach ($array as $key => $value)
        {
            $params[] = $value;
        }
        return $params;
    }
    
    
    public static function proto2array($array)
    {
        $array = array_chunk($array, 2);
        $data  = array();
        foreach ($array as $key => $val)
        {
            $data[$val[0]] = $val[1];
        }
        return $data;
    }
    
    
    public static function __callStatic($method,$params)
    {
        return isset($params[0]) ? $params[0] : null;
    }
    
}
