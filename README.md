LEMP環境構築
===

Docker for Macを使用してLEMP + S3環境を構築する



## 前提

### Docker for Macインストール

```
brew cask install docker
```

※インストール後、Docker.appを起動しましょう


### PHPStormインストール

```
brew cask install phpstorm
```



## 環境構築

Macのターミナルソフトでスクリプトを実行。

```
sh docker-compose.sh
```



## 各コンテナ

| コンテナ名| 概要 |
|:----|:----|
| local_mysql | MySQL 5.6系 |
| local_postgresql | PostgreSQL 9.6系 |
| local_redis | Redis 3.2系 |
| local_s3 | Fake S3 |
| local_application | PHP-FPM 7.1.8 |
| local_web | nginx 1.13系 |

MySQL/PostgreSQLコンテナポートの接続確認のため、上記とは別に[dockerize](https://github.com/jwilder/dockerize)コンテナを使用している。



## volume

mysql/postgresqlはホスト側のディレクトリにマウントし、データを保持している


