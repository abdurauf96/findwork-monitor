FROM webdevops/php-nginx:8.2-alpine

# Set working directory
WORKDIR /app

# Supervisor configurations
COPY etc/supervisor/supervisord.staging.conf /opt/docker/etc/supervisor.d/kornet.conf

# Update Alpine packages and install necessary dependencies
RUN apk add --no-cache \
    linux-headers \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libjpeg-turbo-dev \
    libxrender \
    libxext-dev \
    fontconfig-dev \
    imagemagick \
    imagemagick-dev \
    wget \
    libsm-dev \
    freetype-dev \
    libzip-dev \
    zip \
    unzip \
    autoconf \
    supervisor \
    postgresql-dev \
    rabbitmq-c-dev \
    nodejs \
    npm \
    curl \
    libstdc++ \
    libx11 \
    libxrender \
    libxext \
    ca-certificates \
    fontconfig \
    freetype \
    ttf-droid \
    ttf-freefont \
    ttf-liberation \
    pcre-dev ${PHPIZE_DEPS} \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    zip \
    sockets \
    && docker-php-ext-enable amqp redis

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Copy application source code
COPY src/ /app

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader
RUN composer dump-autoload


# Enable pcntl extension (already bundled in CLI but needs to be explicitly enabled)
RUN docker-php-ext-install pcntl

# Install Swoole
RUN pecl install swoole && docker-php-ext-enable swoole

# Ensure necessary directories are writable
RUN chown -R application:application /app

#RUN mkdir storage/logs

RUN php artisan optimize

# Expose default web server port
EXPOSE 80
EXPOSE 81

ENV WEB_DOCUMENT_ROOT="/app/public"

# Default entry point
CMD ["sh", "-c" , "php artisan config:clear && php artisan config:cache && php artisan migrate --force --isolated && supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
