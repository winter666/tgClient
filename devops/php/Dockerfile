FROM php:8.2-fpm

ARG UID=1000
ARG USER=appuser

# create unprivileged user
RUN adduser \
    --disabled-password \
    --shell "/sbin/nologin" \
    --gecos "" \
#    --uid "$UID" \
    "$USER" \
    # create directory for application sources
    && mkdir /var/www/app \
    && chown -R $USER:$USER /var/www/app/

WORKDIR /var/www/app

#RUN chown 777 /var/www/app/devops/databases -RUN

# copy application sources into image (completely)
COPY --chown=$USER:$USER . /var/www/app/

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

COPY --from=composer /usr/bin/composer /usr/bin/composer

#RUN install-php-extensions gd xdebug
RUN install-php-extensions gd pdo_dblib
RUN install-php-extensions gd pdo_mysql
#RUN install-php-extensions gd pdo_pgsql
RUN install-php-extensions gd redis
#RUN install-php-extensions gd soap
#RUN install-php-extensions gd xmlrpc
#RUN install-php-extensions gd sockets
#RUN install-php-extensions gd opcache
#RUN install-php-extensions gd memcached
#RUN install-php-extensions gd memcache
#RUN install-php-extensions gd mailparse
#RUN install-php-extensions gd json_post
#RUN install-php-extensions gd http
#RUN install-php-extensions gd grpc
#RUN install-php-extensions gd decimal
#RUN install-php-extensions gd csv
#RUN install-php-extensions gd apcu
#RUN install-php-extensions gd intl

RUN apt-get update && apt-get install -y \
    git \
    libzip-dev \
    zip

USER $USER:$USER
