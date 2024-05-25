FROM php:8.3-fpm

# Arguments defined in docker-compose.yml
ARG user=chacal
ARG uid=1000

# Install system dependencies
# RUN apt-get update -y && apt-get upgrade -y && \
RUN apt-get update -y && \
    apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    postgresql-contrib \
    zip \
    unzip


RUN apt-get update && apt-get install -y libzip-dev libicu-dev && docker-php-ext-configure intl && docker-php-ext-install intl

RUN docker-php-ext-install zip

# RUN composer install


# Install NodeJS
# RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
# RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
# RUN apt-get update && apt-get install -y nodejs && apt-get clean

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && \
    apt-get install -y nodejs && \
    apt-get clean

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
# RUN useradd -G www-data,root -u $uid -d /home/$user $user
# RUN id -u $user || useradd -G www-data,root -u $uid -d /home/$user $user
# RUN mkdir -p /home/$user/.composer && \
#     chown -R $user:$user /home/$user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis


# Change ownership of npm's cache and configuration folders
RUN mkdir -p /home/$user/.npm && \
    chown -R $user:$user /home/$user/.npm && \
    mkdir -p /home/$user/.config && \
    chown -R $user:$user /home/$user/.config


# Switch back to the root user for running entrypoint commands
# USER root
# Copy custom configurations PHP
COPY docker/php/custom_php.ini /usr/local/etc/php/conf.d/custom.ini

# RUN touch /usr/local/etc/php/conf.d/docker-php.ini
# # Configurações do PHP
# RUN echo "" > /usr/local/etc/php/conf.d/docker-php.ini
# RUN echo "post_max_size = 50M" >> /usr/local/etc/php/conf.d/docker-php.ini
# RUN echo "upload_max_filesize = 50M" >> /usr/local/etc/php/conf.d/docker-php.ini
# RUN echo \[Date] >> /usr/local/etc/php/conf.d/docker-php.ini
# RUN echo "date.timezone = America/Bahia" >> /usr/local/etc/php/conf.d/docker-php.ini

# Set working directory
WORKDIR /var/www

USER $user
