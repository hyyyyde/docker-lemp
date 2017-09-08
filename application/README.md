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



## 残念なこと

PHPStormでPHPUnitテストが行えません。  
MySQLのサーバー名が解決できず、PDO接続できません。  
ただし、コンテナ内でPHPUnitは実行できます。  

```
php vendor/phpunit/phpunit/phpunit --configuration app/phpunit.xml tests
```

コンテナ内で上記コマンドを叩けば、PHPStorm側でブレークポイントにも止まります。  
※[Start Listening for PHP Debug Connections]している必要あり。