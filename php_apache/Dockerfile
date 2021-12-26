FROM php:7.1-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get update
RUN apt-get install libmariadb3 -y
RUN apt-get install libaprutil1-dbd-mysql -y
RUN a2enmod dbd
RUN a2enmod authn_dbd
RUN a2enmod socache_shmcb
RUN a2enmod authn_socache
RUN pecl install redis-3.1.1 && docker-php-ext-enable redis

# менеджер пакетов - для скачивания библиотек
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip

# задаёт рабочую директорию для следующей инструкции
WORKDIR "/"

# генерация данных
RUN composer require fakerphp/faker

# сжатие изображений
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

# установка GD - конвертация графика в картинку и добавление водяного знака
RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-xpm-dir \
    --with-freetype-dir \
    --enable-gd-native-ttf
RUN docker-php-ext-install gd
WORKDIR "/"
#  library to make graphs and charts
RUN composer require amenadiel/jpgraph:4.0.3
