# Simple Fibonacci Service

[![Coverage Status](https://coveralls.io/repos/github/ra0ued/fibonacci-service/badge.svg?branch=main)](https://coveralls.io/github/ra0ued/fibonacci-service?branch=main)

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
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now try this: `http://localhost:8080`
