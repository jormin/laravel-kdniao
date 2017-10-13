<?php

namespace Jormin\KDNiao\Libs;

/**
 * 快递鸟SDK库
 * @package Jormin\KDNiao\Libs
 */
class KDNiaoLib {

    /**
     * 构造函数
     *
     * 调试模式下，快递鸟订阅接口地址：http://testapi.kdniao.cc:8081/api/dist
     * 线上模式下，快递鸟订阅接口地址：http://api.kdniao.cc/api/dist
     *
     * @return array
     */
    public static function loadConfig()
    {
        $config = [
            'businessID'  => config('laravel-kdniao.business_id'),
            'apiKey' => config('laravel-kdniao.api_key'),
            'queryUrl' => 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx',
        ];
        if(config('laravel-kdniao.debug')){
            $config['subUrl'] = 'http://testapi.kdniao.cc:8081/api/dist';
        }else{
            $config['subUrl'] = 'http://api.kdniao.cc/api/dist';
        }
        return $config;
    }

    /**
     * 订阅快递物流信息
     *
     * @param $orderSn
     * @param $expressCode
     * @param $expressSn
     * @return mixed
     */
    public static function subExpressInfo($orderSn, $expressCode, $expressSn){
        $config = self::loadConfig();
        $requestData = [
            'OrderCode' => $orderSn,
            'ShipperCode' => $expressCode,
            'LogisticCode' => $expressSn,
        ];
        $requestData = json_encode($requestData);

        $data = array(
            'EBusinessID' => $config['businessID'],
            'RequestType' => '1008',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
            'DataSign' => self::encrypt($requestData, $config['apiKey'])
        );
        $return = json_decode(self::request($config['subUrl'], $data), true);
        return $return;
    }

    /**
     * 从接口中查询物流信息
     *
     * @param $orderSn
     * @param $expressCode
     * @param $expressSn
     * @return mixed|null
     */
    public static function queryExpressInfo($orderSn, $expressCode, $expressSn){
        $config = self::loadConfig();
        $requestData = [
            'OrderCode' => $orderSn,
            'ShipperCode' => $expressCode,
            'LogisticCode' => $expressSn,
        ];
        $requestData = json_encode($requestData);
        $data = array(
            'EBusinessID' => $config['businessID'],
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
            'DataSign' => self::encrypt($requestData, $config['apiKey'])
        );
        $return = json_decode(self::request($config['queryUrl'], $data), true);
        return $return;
    }

    /**
     * POST提交数据
     */
    public static function request($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);
        return $gets;
    }

    /**
     * 电商Sign签名生成
     *
     * @param $data
     * @param $apiKey
     * @return string
     */
    public static function encrypt($data, $apiKey) {
        return urlencode(base64_encode(md5($data.$apiKey)));
    }
}