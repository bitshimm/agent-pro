FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    curl \
    apt-utils \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip unzip \
    libmagickwand-dev \
    git && \
    curl -sLS https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY php.ini /usr/local/etc/php/conf.d/php.ini

RUN mkdir -p /usr/src/php/ext/imagick; \
    curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
    docker-php-ext-install imagick;

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

# Add user for laravel application
# RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# # Change current user to www
# USER www

WORKDIR /var/www/agent-pro