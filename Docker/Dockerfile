FROM php:8.2-fpm

# Force apt to use IPv4 (build-time)
# RUN echo 'Acquire::ForceIPv4 "true";' > /etc/apt/apt.conf.d/99force-ipv4

RUN apt-get update --fix-missing && \
    apt-get install -y \
        git \
        curl \
        zip \
        unzip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
