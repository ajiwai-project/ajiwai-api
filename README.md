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
