<?php

namespace app\socket\controller;
use think\worker\Server;
use Workerman\Lib\Timer;
class Worker extends Server
{
    protected $socket = 'websocket://www.my.local:2346';

    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data)
    {
        $time_interval = 2.5;
        Timer::add($time_interval, function()use($connection)
        {
            $connection->send('我收到你的信息了'); 
        });
        
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection)
    {
        
    }

    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection)
    {
        
    }

    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }

    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker)
    {

    }
}

