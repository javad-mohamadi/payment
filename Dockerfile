FROM php:8.2-fpm-alpine

WORKDIR /var/www

RUN apk add --update --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    icu-dev \
    vim \
    unzip \
    git \
    curl \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    redis

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure zip

RUN docker-php-ext-install pdo pdo_mysql

RUN rm -rf /var/cache/apk/*

COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

RUN addgroup -g 1000 payment && adduser -u 1000 -G payment -s /bin/sh -D payment

USER payment

COPY --chown=payment:payment . .

RUN chmod -R ug+rwx storage bootstrap/cache

RUN chmod -R 664 /var/www/composer.json

# Expose port 9000 and start php-fpm server
EXPOSE 9000

RUN chmod 755 ./docker/entrypoint*

ENTRYPOINT ["./docker/entrypoint-app.sh"]
