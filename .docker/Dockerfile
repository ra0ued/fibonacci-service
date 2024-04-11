FROM php:8.3-alpine
LABEL authors="ra0ued"

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions gmp

CMD ["/bin/sh"]