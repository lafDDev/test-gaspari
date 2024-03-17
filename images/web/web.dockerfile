FROM nginx:1.10

ADD ./app.vhost.dev.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www
