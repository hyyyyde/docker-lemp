PHPアプリケーション
===

サンプルアプリケーション



## 概要

- PHPStormでの開発前提
- 特にFrameworkは入れてない
- PHPUnitテストとリモートデバッグを「Docker for Mac」 & 「PHPStorm」でしてみたかった



## コンテナ内で `composer install`

```
docker exec -it local_application bash
```

でコンテナに入り、

```
composer install
```

するとPHPUnitが入ります。



## テーブル初期化

コンテナ内で

```
php src/Command/InitialProductTable.php
```

すると、 `product` テーブルを初期化(CREATE/TRUNCATE/INSERT)します。  
http://localhost/products.php にアクセスすると、テーブル内容を表示します。  



## できること

PHPStormでブレークポイントを貼り、URLにアクセスするとブレークポイントに止まります。  
※[Start Listening for PHP Debug Connections]している必要あり。  

PHPStormでPHPUnit実行もできます。  
configurationファイルは `app/phpunit.xml` を参照のこと。  
