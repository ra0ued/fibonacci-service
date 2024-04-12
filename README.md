# Simple Fibonacci Service

[![Coverage Status](https://coveralls.io/repos/github/ra0ued/fibonacci-service/badge.svg?branch=main)](https://coveralls.io/github/ra0ued/fibonacci-service?branch=main)

## Description

Application calculates Fibonacci numbers. It allows to work with big numbers avoiding redundant calculations due to caching. Based on micro framework [Slim](https://www.slimframework.com/).

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 8.0 or newer.

```bash
git clone https://github.com/ra0ued/fibonacci-service.git
```

You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands 

```bash
cd fibonacci-service
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd fibonacci-service
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser to get main page with simple UI.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now try this: `http://localhost:8080` or try request API GET method directly: `http://localhost:8080/api/v1/fibonacci?from=3&to=6`
