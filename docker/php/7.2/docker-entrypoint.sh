#!/usr/bin/env bash

if [ ! "production" == "$APP_ENV" ] && [ ! "prod" == "$APP_ENV" ] && [ ! "testing" == "$APP_ENV" ] && [ "on" == "$DOCKER_PHP_XDEBUG" ]; then
    # Enable xdebug

    ## FPM
    ln -sf /etc/php/7.2/mods-available/xdebug.ini /etc/php/7.2/fpm/conf.d/20-xdebug.ini

    ## CLI
    ln -sf /etc/php/7.2/mods-available/xdebug.ini /etc/php/7.2/cli/conf.d/20-xdebug.ini
else
    # Disable xdebug

    ## FPM
    if [ -e /etc/php/7.2/fpm/conf.d/20-xdebug.ini ]; then
        rm -f /etc/php/7.2/fpm/conf.d/20-xdebug.ini
    fi

    ## CLI
    if [ -e /etc/php/7.2/cli/conf.d/20-xdebug.ini ]; then
        rm -f /etc/php/7.2/cli/conf.d/20-xdebug.ini
    fi
fi

# Config /etc/php/7.2/mods-available/xdebug.ini
sed -i "s/xdebug\.remote_host\=.*/xdebug\.remote_host\=$XDEBUG_HOST/g" /etc/php/7.2/mods-available/xdebug.ini

# Ensure /.composer exists and is writable
if [ ! -d /.composer ]; then
    mkdir /.composer
fi
chmod -R ugo+rw /.composer

if [ -f /root/.ssh/id_rsa ]; then
    chmod -R 0600 /root/.ssh/id_rsa
fi

exec "$@"
