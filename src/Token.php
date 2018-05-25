<?php
// +----------------------------------------------------------------------
// | 文件描述
// +----------------------------------------------------------------------
// | Copyright (c) 2018
// | Data  2018年5月24日 上午10:56:21
// | Version  1.0.0
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------
// | Author: roy <myd0512@163.com>
// +----------------------------------------------------------------------

namespace royClass;

class Token
{

    public static function a(){
        return 1;
    }

    /**
     * Redis实例
     * @var string
     */
    protected static $rd;

    /**
     * 构造方法，配置应用信息
     * Oauth constructor.
     * @param array $config
     */
    public function __construct(){
        self::$rd = new Redis();
    }

    /**
     * 读取缓存
     * @access public
     * @param string $name 缓存变量名
     * @return mixed
     */
    public static function get($name=false){
        return self::$rd->get($name);
    }

    /**
     * 写入缓存
     * @access public
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @return boolen
     */
    public static function set($name, $value){
        return self::$rd->set($name, $value);
    }

    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolen
     */
    public static function rm($name){
        return self::$rd->rm($name);
    }

    /**
     * 加入
     * @param string $key 表头
     * @param string $value 值
     */
    public static function push($key,$value){
        return self::$rd->push($key,$value);
    }

    /**
     * 出列 堵塞 当没有数据的时候，会一直等待下去
     * @param string $key 表头
     * @param number $timeout 延时   0无限等待
     * @return Ambigous <NULL, mixed>
     */
    public static function pop($key,$timeout=0){
        return self::$rd->pop($key,$timeout);
    }

    /**
     * 删除 key 集合中的子集
     * @param unknown $key
     * @param unknown $son_key
     * @return boolean
     */
    public static function srem($key,$son_key){
        return self::$rd->srem($key,$son_key);
    }

    /**
     * 输出运行日志
     * @param unknown $text
     */
    public static function log($text){
        self::display('['.date('H:i:s').']'.'[taskPHP]:'.$text,false);
    }

    /**
     * 输出指定信息
     * @param string $text 内容
     * @param string $isClose  输出后是否退出
     */
    public static function display($text,$isClose=true){
        echo $text.PHP_EOL;
        $isClose==true && die;
    }



    /**
     * 统一输出
     * @param string $data
     * @param string $code
     * @param string $txt
     */
    private static function out($data,$code='success',$txt=''){
        $arr = [
            'code' => $code,
            'msg' => $txt,
            'data' => $data,
        ];

        return $arr;
    }

}