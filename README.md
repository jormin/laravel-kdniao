集成了 [快递鸟](http://www.kdniao.com) 官方的Api，当前包含`订阅物流信息` 和 `查询物流信息` 两个接口。

## 安装

 1. 安装包文件

	``` bash
	$ composer require jormin/laravel-kdniao
	```

## 配置

1. 注册 ServiceProvider:
	
	```php
	Jormin\KDNiao\KDNiaoServiceProvider::class,
	```

2. 创建配置文件：

	```shell
	php artisan vendor:publish
	```
	
	执行命令后会在 `config` 目录下生成本扩展配置文件：`laravel-kdniao.php`。
	
3. 在 `.env` 文件中增加如下两项配置：

	- `KDNIAO_EBUSINESS_ID`：快点鸟用户ID。

	- `KDNIAO_API_KEY`：快点鸟ApiKey。

## 使用

1. 获取快递公司列表

    ```php
       Jormin\KDNiao\KDNiao::expresses();
    ```

2. 根据快递公司编码反查快递公司

    ```php
       $code = 'SF';
       Jormin\KDNiao\KDNiao::getExpressByCode($code);
    ```

3. 订阅物流信息
    
    ```php
       $orderSn = '业务订单号';
       $expressCode = '物流公司编码';
       $orderSn = '物流单号';
       Jormin\KDNiao\KDNiao::subExpressInfo($orderSn, $expressCode, $expressSn);
    ```
    
    订阅结果字段：
    
    | 参数  | 类型  | 说明  | 可为空  |
    | ------------ | ------------ | ------------ | ------------ |
    | EBusinessID | String | 用户ID | N |
    | UpdateTime | String | 时间 | N |
    | Success | Bool | 成功与否：true，false | N |
    | Reason | String | 失败原因Y，Success为false时有值 | Y |
    
4. 查询物流信息
    
    ```php
       $orderSn = '业务订单号';
       $expressCode = '物流公司编码';
       $orderSn = '物流单号';
       Jormin\KDNiao\KDNiao::queryExpressInfo($orderSn, $expressCode, $expressSn);
    ```
    
    查询结果字段：
    
    | 参数  | 类型  | 说明  | 可为空  |
    | ------------ | ------------ | ------------ | ------------ |
    | EBusinessID | String | 用户ID | N |
    | OrderCode | String | 订单编号 | Y |
    | ShipperCode | String | 快递公司编码 | N |
    | LogisticCode | String | 物流运单号 | Y |
    | Success | Bool | 成功与否：true，false | N |
    | Reason | String | 失败原因Y，Success为false时有值 | Y |
    | State | String | 物流状态：2-在途中,3-签收,4-问题件 | N |
    | Traces | JsonArray | 物流信息，详细字段见下表 | Y |

    Traces(物流信息)字段：
    
    | 参数  | 类型  | 说明  | 可为空  |
    | ------------ | ------------ | ------------ | ------------ |
    | AcceptTime | String | 时间 | N |
    | AcceptStation | String | 描述 | N |
    | Remark | String | 备注 | Y |

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
