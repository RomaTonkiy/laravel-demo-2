FROM webdevops/php-apache-dev:8.2

ARG ARCHITECTURE="linux/amd64"

RUN echo "deb http://deb.debian.org/debian buster-backports main contrib non-free" | tee -a /etc/apt/sources.list
RUN apt-get update
RUN apt-get install -y jpegoptim optipng pngquant gifsicle libavif-bin nodejs npm
RUN npm install -g svgo

WORKDIR /var/www/html
EXPOSE 9000
ENTRYPOINT ["/entrypoint"]
CMD ["supervisord"]
