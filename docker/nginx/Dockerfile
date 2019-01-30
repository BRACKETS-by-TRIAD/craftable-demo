FROM ubuntu:16.04

MAINTAINER BRACKETS by TRIAD

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y nginx \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

ADD default /etc/nginx/sites-available/default

EXPOSE 80

CMD ["nginx"]
