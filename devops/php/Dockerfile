FROM php:8.2-fpm

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd xdebug
RUN install-php-extensions gd pdo_dblib
RUN install-php-extensions gd pdo_mysql
RUN install-php-extensions gd pdo_pgsql
RUN install-php-extensions gd redis
RUN install-php-extensions gd soap
RUN install-php-extensions gd xmlrpc
RUN install-php-extensions gd sockets
RUN install-php-extensions gd opcache
RUN install-php-extensions gd memcached
RUN install-php-extensions gd memcache
RUN install-php-extensions gd mailparse
RUN install-php-extensions gd json_post
RUN install-php-extensions gd http
RUN install-php-extensions gd grpc
RUN install-php-extensions gd decimal
RUN install-php-extensions gd csv
RUN install-php-extensions gd apcu
RUN install-php-extensions gd intl

RUN groupadd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/app

USER www-data
