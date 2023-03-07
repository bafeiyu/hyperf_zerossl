# ZeroSSL SDK

## 安装


```
composer require  bafeiyu/hyperf_zerossl
```

命令行运行命令生成配置文件
```angular2html
php bin/hyperf.php vendor:publish bafeiyu/hyperf_zerossl
```
## 使用

```php
<?php
use Bafeiyu\HyperfZeroSsl\ZeroSslFactory;
use Hyperf\Utils\ApplicationContext;

$zerossl = ApplicationContext::getContainer()->get(ZeroSslFactory::class);
$cert = $zerossl()->certificate->create(
    'test.com', 'test',75,0
);
$status = $cert->getStatusCode();
$return = json_decode($cert->getBody()->getContents());
```
