# AJIWAI - api application
## 環境
* PHP: 7.3系
* Composer: version 1.9.2 

## 初期設定
### PHP 7.3系のインストール

`$ brew install php@7.3`

bashrcやbash_profiles等に以下を記述する

```
export PATH="/usr/local/opt/php@7.3/bin:$PATH"
export PATH="/usr/local/opt/php@7.3/sbin:$PATH"
```

### Composerのインストール

`$ brew install composer`

## 実行手順
### gRPC PHP拡張をインストール

https://github.com/grpc/grpc/tree/master/src/php

`$ git clone -b RELEASE_TAG_HERE https://github.com/grpc/grpc`

```
$ cd grpc
$ git submodule update --init
$ make
$ [sudo] make install
```

```
$ cd grpc/src/php/ext/grpc
$ phpize
$ ./configure
$ make
$ [sudo] make install
```

`$ echo "extension=grpc.so" >> /usr/local/etc/php/7.3/php.ini`

### 依存パッケージのインストール

`$ composer install`

### .envファイルの作成 

```
$ cp .env.example .env
$ php artisan key:generate
```

### サーバの起動

```
$ php artisan serve 

$ curl http://localhost:8000/api/test
>hello world
```
