FROM php:7.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    vim

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install & configure PHP extensions
RUN docker-php-ext-install \
    bcmath \
    mysqli \
    pdo_mysql \
    pcntl \
    && pecl install \
    mcrypt-1.0.2 \
    redis \
    && docker-php-ext-configure intl && docker-php-ext-install intl

# Enable PHP Extentions
RUN docker-php-ext-enable \
    mysqli \
    redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]