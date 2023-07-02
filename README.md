# Laravel Online Store

## Installation

#### 1. Install **[laravel-webserver](https://github.com/a-kryvenko/laravel-10-webserver/)**;

#### 2. Clone e-store into webserver

```shell
cd www && git clone git@github.com:a-kryvenko/laravel-estore.git .
```

#### 3. Set up environment variables

```shell
cp .env.example .env && nano .env
```

## Usage

After installation install composer dependencies

```shell
docker-compose run --rm composer install
```

Install npm dependencies

```shell
docker-compose run --rm npm install
```

And for production server build assets

```shell
docker-compose run --rm npm run build
```

Or up dev server for dev environment

```shell
docker-compose run --rm npm run dev
```
