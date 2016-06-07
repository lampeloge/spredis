<?php


return array(

    //redis1.2
    //操作命令
    'EXISTS'            => '',
    'DEL'               => '',
    'TYPE'              => '',
    'KEYS'              => '',
    'RANDOMKEY'         => '',
    'RENAME'            => '',
    'RENAMENX'          => '',
    'EXPIRE'            => '',
    'EXPIREAT'          => '',
    'TTL'               => '',
    'MOVE'              => '',
    'SORT'              => '',
    'DUMP'              => '',
    'RESTORE'           => '',

    //string
    'SET'               => '',
    'SETNX'             => '',
    'MSET'              => '',
    'MSETNX'            => '',
    'GET'               => '',
    'MGET'              => '',
    'GETSET'            => '',
    'INCR'              => '',
    'INCRBY'            => '',
    'DECR'              => '',
    'DECRBY'            => '',

    //list
    'RPUSH'             => '',
    'LPUSH'             => '',
    'LLEN'              => '',
    'LRANGE'            => '',
    'LINDEX'            => '',
    'LTRIM'             => '',
    'LSET'              => '',
    'LREM'              => '',
    'LPOP'              => '',
    'RPOP'              => '',
    'RPOPLPUSH'         => '',

    //set命令
    'SADD'              => '',
    'SREM'              => '',
    'SPOP'              => '',
    'SMOVE'             => '',
    'SCARD'             => '',
    'SISMEMBER'         => '',
    'SINTER'            => '',
    'SINTERSTORE'       => '',
    'SUNION'            => '',
    'SUNIONSTORE'       => '',
    'SDIFF'             => '',
    'SDIFFSTORE'        => '',
    'SMEMBERS'          => '',
    'SRANDMEMBER'       => '',

    //set 排序命令
    'ZADD'              => '',
    'ZINCRBY'           => '',
    'ZREM'              => '',
    'ZRANGE'            => '',
    'ZREVRANGE'         => '',
    'ZRANGEBYSCORE'     => '',
    'ZCARD'             => '',
    'ZSCORE'            => '',
    'ZREMRANGEBYSCORE'  => '',

    //connection命令
    'PING'              => '',
    'AUTH'              => '',
    'SELECT'            => '',
    'ECHO'              => '',
    'QUIT'              => '',

    //server控制命令
    'INFO'              => '',
    'SLAVEOF'           => '',
    'MONITOR'           => '',
    'DBSIZE'            => '',
    'FLUSHDB'           => '',
    'FLUSHALL'          => '',
    'SAVE'              => '',
    'BGSAVE'            => '',
    'LASTSAVE'          => '',
    'SHUTDOWN'          => '',
    'BGREWRITEAOF'      => '',

    //redis 2.0
    //string命令
    'SETEX'             => '',
    'APPEND'            => '',
    'SUBSTR'            => '',

    //list命令
    'BLPOP'             => '',
    'BRPOP'             => '',

    //sets排序
    'ZUNIONSTORE'       => '',
    'ZINTERSTORE'       => '',
    'ZCOUNT'            => '',
    'ZRANK'             => '',
    'ZREVRANK'          => '',
    'ZREMRANGEBYRANK'   => '',

    //hash命令
    'HSET'              => '',
    'HSETNX'            => '',
    'HMSET'             => '',
    'HINCRBY'           => '',
    'HGET'              => '',
    'HMGET'             => '',
    'HDEL'              => '',
    'HEXISTS'           => '',
    'HLEN'              => '',
    'HKEYS'             => '',
    'HVALS'             => '',
    'HGETALL'           => '',

    //事务
    'MULTI'             => '',
    'EXEC'              => '',
    'DISCARD'           => '',

    //订阅
    'SUBSCRIBE'         => '',
    'UNSUBSCRIBE'       => '',
    'PSUBSCRIBE'        => '',
    'PUNSUBSCRIBE'      => '',
    'PUBLISH'           => '',

    //server操作命令
    'CONFIG'            => '',

    
    //redis2.2
    //命令操作空间
    'PERSIST'           => '',

    //string命令
    'STRLEN'            => '',
    'SETRANGE'          => '',
    'GETRANGE'          => '',
    'SETBIT'            => '',
    'GETBIT'            => '',

    //lists
    'RPUSHX'            => '',
    'LPUSHX'            => '',
    'LINSERT'           => '',
    'BRPOPLPUSH'        => '',

    //sets排序
    'ZREVRANGEBYSCORE'  => '',

    //事务
    'WATCH'             => '',
    'UNWATCH'           => '',

    //server控制命令
    'OBJECT'            => '',
    'SLOWLOG'           => '',

    //redis2.4
    //server命令
    'CLIENT'            => '',

    //redis2.6
    'PTTL'              => '',
    'PEXPIRE'           => '',
    'PEXPIREAT'         => '',
    'MIGRATE'           => '',

    
    'PSETEX'            => '',
    'INCRBYFLOAT'       => '',
    'BITOP'             => '',
    'BITCOUNT'          => '',

    
    'HINCRBYFLOAT'      => '',

    
    'EVAL'              => '',
    'EVALSHA'           => '',
    'SCRIPT'            => '',

    
    'TIME'              => '',
    'SENTINEL'          => '',


    //redis2.8
    'SCAN'              => '',

    
    'BITPOS'            => '',

    
    'SSCAN'             => '',

    
    'ZSCAN'             => '',
    'ZLEXCOUNT'         => '',
    'ZRANGEBYLEX'       => '',
    'ZREMRANGEBYLEX'    => '',
    'ZREVRANGEBYLEX'    => '',

    
    'HSCAN'             => '',

    
    'PUBSUB'            => '',

    
    'PFADD'             => '',
    'PFCOUNT'           => '',
    'PFMERGE'           => '',

    
    'COMMAND'           => '',

    //redis3x
    
);