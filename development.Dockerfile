FROM arquivei/php:7.4-cli-alpine

COPY php-ini-overrides.ini /usr/local/etc/php/conf.d/99-overrides.ini

#phpize = autoconf build-base (php-dev)
RUN apk add autoconf build-base git openssh \
    && pecl install xdebug && docker-php-ext-enable xdebug \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
