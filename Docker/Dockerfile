FROM php:8.2-fpm

# ENV DEBIAN_FRONTEND=noninteractive

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
WORKDIR /var/www
