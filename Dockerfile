FROM php:8.0-cli-alpine

WORKDIR /app

ENV COMPOSER_VERSION="2.2.6"

RUN apk update && apk add --no-cache --no-progress --virtual .build-deps \
        git \
        make \
        automake \
        libmcrypt-dev \
        linux-headers \
        g++ \
        autoconf \
        pkgconfig \
        freetype-dev \
        musl-dev \
        gcc \
        oniguruma-dev \
        libxml2-dev \
        libpng-dev \
        libjpeg-turbo-dev \
        libsodium-dev \
        curl-dev \
        icu-dev \
        libzip-dev \
    && apk add --no-cache --no-progress \
        libcurl \
        openssh \
        libmcrypt \
        zlib \
        libgomp \
        zip \
        unzip \
        icu-libs \
        libsodium \
        libpng \
        libjpeg \
        freetype \
        icu \
        curl \
        mysql-client \
        libxml2 \
        oniguruma \
        libzip \
        gettext \
        php8-sockets \
        php8-bcmath \
    && pecl install igbinary mcrypt  msgpack \
    && pecl install --onlyreqdeps --nobuild redis \
    && cd "$(pecl config-get temp_dir)/redis" \
    && phpize \
    && ./configure --enable-redis-igbinary --enable-redis-lzf \
    && make && make install && make clean \
    && docker-php-ext-configure gd \
        --with-jpeg \
        --with-freetype \
    && docker-php-ext-install -j$(nproc) \
        mbstring \
        xml \
        zip \
        opcache \
        iconv \
        gd \
        curl \
        exif \
        intl \
        mysqli \
        pcntl \
        pdo \
        pdo_mysql \
    && docker-php-ext-enable \
        curl.so \
        exif.so \
        gd.so \
        iconv.so \
        igbinary.so \
        intl.so \
        mbstring.so \
        mcrypt.so \
        msgpack.so \
        mysqli.so \
        opcache.so \
        pcntl.so \
        pdo.so \
        pdo_mysql.so \
        redis.so \
        sodium.so \
        xml.so \
        zip.so \
    && CFLAGS="$CFLAGS -D_GNU_SOURCE" docker-php-ext-install sockets \
    && apk del .build-deps \
    && cd ~ \
    && rm -rf "$(pecl config-get temp_dir)/redis" \
    && curl -s -f -L -o /tmp/installer.php https://getcomposer.org/installer \
    && php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
    && rm -rf /tmp/installer.php
