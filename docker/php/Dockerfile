FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/agent-pro

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    libwebp-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libgd-dev \
    libonig-dev \
    libxml2-dev \
    locales \
    jpegoptim optipng pngquant gifsicle \
    nano \
    unzip \
    libzip-dev \
    apt-utils
    

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install node js
RUN curl -sLS https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

# Install imagick
# RUN mkdir -p /usr/src/php/ext/imagick; \
#     curl -fsSL https://github.com/Imagick/imagick/archive/06116aa24b76edaf6b1693198f79e6c295eda8a9.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
#     docker-php-ext-install imagick

# Install xdebug
RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug

# Install redis 
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Install extensions
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp
RUN docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/agent-pro

# Copy php.ini
COPY php.ini /usr/local/etc/php/conf.d/php.ini

# Change current user to www
USER www