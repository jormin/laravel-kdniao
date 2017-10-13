<?php

namespace Jormin\KDNiao;

/**
 * 快递鸟SDK库
 * @package Jormin\KDNiao\Libs
 */
class KDNiao {

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
     * 快递公司列表
     *
     * @return mixed
     */
    public static function expresses(){
        $expresses = '[{"code": "AJ","name": "安捷快递"},{"code": "A`MAZON","name": "亚马逊物流"},{"code": "ANE","name": "安能物流"},{"code": "AXD","name": "安信达快递"},{"code": "AYCA","name": "澳邮专线"},{"code": "BFDF","name": "百福东方"},{"code": "BQXHM","name": "北青小红帽"},{"code": "BTWL","name": "百世快运"},{"code": "CCES","name": "CCES快递"},{"code": "CDSTKY","name": "成都善途速运"},{"code": "CITY100","name": "城市100"},{"code": "CJKD","name": "城际快递"},{"code": "CNPEX","name": "CNPEX中邮快递"},{"code": "COE","name": "COE东方快递"},{"code": "CSCY","name": "长沙创一"},{"code": "DBL","name": "德邦"},{"code": "DSWL","name": "D速物流"},{"code": "DTWL","name": "大田物流"},{"code": "EMS","name": "EMS"},{"code": "FAST","name": "快捷速递"},{"code": "FEDEX","name": "FEDEX联邦(国内件）"},{"code": "FEDEX_GJ","name": "FEDEX联邦(国际件）"},{"code": "FKD","name": "飞康达"},{"code": "GDEMS","name": "广东邮政"},{"code": "GSD","name": "共速达"},{"code": "GTO","name": "国通快递"},{"code": "GTSD","name": "高铁速递"},{"code": "HFWL","name": "汇丰物流"},{"code": "HHTT","name": "天天快递"},{"code": "HLWL","name": "恒路物流"},{"code": "HOAU","name": "天地华宇"},{"code": "HOTSCM","name": "鸿桥供应链"},{"code": "HPTEX","name": "海派通物流公司"},{"code": "hq568","name": "华强物流"},{"code": "HTKY","name": "百世快递"},{"code": "HXLWL","name": "华夏龙物流"},{"code": "HYLSD","name": "好来运快递"},{"code": "JGSD","name": "京广速递"},{"code": "JIUYE","name": "九曳供应链"},{"code": "JJKY","name": "佳吉快运"},{"code": "JLDT","name": "嘉里物流"},{"code": "JTKD","name": "捷特快递"},{"code": "JXD","name": "急先达"},{"code": "JYKD","name": "晋越快递"},{"code": "JYM","name": "加运美"},{"code": "JYWL","name": "佳怡物流"},{"code": "KYWL","name": "跨越物流"},{"code": "LB","name": "龙邦快递"},{"code": "LHT","name": "联昊通速递"},{"code": "MHKD","name": "民航快递"},{"code": "MLWL","name": "明亮物流"},{"code": "NEDA","name": "能达速递"},{"code": "PADTF","name": "平安达腾飞快递"},{"code": "PANEX","name": "泛捷快递"},{"code": "PCA","name": "PCA Express"},{"code": "QCKD","name": "全晨快递"},{"code": "QFKD","name": "全峰快递"},{"code": "QRT","name": "全日通快递"},{"code": "QUICK","name": "快客快递"},{"code": "RFD","name": "如风达"},{"code": "RFEX","name": "瑞丰速递"},{"code": "SAD","name": "赛澳递"},{"code": "SAWL","name": "圣安物流"},{"code": "SBWL","name": "盛邦物流"},{"code": "SDWL","name": "上大物流"},{"code": "SF","name": "顺丰快递"},{"code": "SFWL","name": "盛丰物流"},{"code": "SHWL","name": "盛辉物流"},{"code": "ST","name": "速通物流"},{"code": "STO","name": "申通快递"},{"code": "STWL","name": "速腾快递"},{"code": "SUBIDA","name": "速必达物流"},{"code": "SURE","name": "速尔快递"},{"code": "TSSTO","name": "唐山申通"},{"code": "UAPEX","name": "全一快递"},{"code": "UC","name": "优速快递"},{"code": "UEQ","name": "UEQ Express"},{"code": "WJWL","name": "万家物流"},{"code": "WXWL","name": "万象物流"},{"code": "XBWL","name": "新邦物流"},{"code": "XFEX","name": "信丰快递"},{"code": "XJ","name": "新杰物流"},{"code": "XYT","name": "希优特"},{"code": "YADEX","name": "源安达快递"},{"code": "YCWL","name": "远成物流"},{"code": "YD","name": "韵达快递"},{"code": "YDH","name": "义达国际物流"},{"code": "YFEX","name": "越丰物流"},{"code": "YFHEX","name": "原飞航物流"},{"code": "YFSD","name": "亚风快递"},{"code": "YTKD","name": "运通快递"},{"code": "YTO","name": "圆通速递"},{"code": "YXKD","name": "亿翔快递"},{"code": "YZPY","name": "邮政平邮/小包"},{"code": "ZENY","name": "增益快递"},{"code": "ZHQKD","name": "汇强快递"},{"code": "ZJS","name": "宅急送"},{"code": "ZTE","name": "众通快递"},{"code": "ZTKY","name": "中铁快运"},{"code": "ZTO","name": "中通速递"},{"code": "ZTWL","name": "中铁物流"},{"code": "ZYWL","name": "中邮物流"}]';
        return json_decode($expresses, true);
    }

    /**
     * 根据编码反查快递公司
     *
     * @param $code
     * @return string
     */
    public static function getExpressByCode($code){
        if($code){
            $expresses = self::expresses();
            $express = array_filter($expresses,function ($express) use($code){
                return $express['code'] == $code;
            });
            if($express){
                return current($express);
            }
            return null;
        }
        return null;
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