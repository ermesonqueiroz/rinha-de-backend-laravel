FROM php:8.2-cli

ENV WORKDIR=/var/www/ \
    USER=rinha \
    GROUP=rinha

WORKDIR ${WORKDIR}

RUN echo "\e[1;33mInstalando Composer\e[0m"
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update

RUN echo "\e[1;33mInstalando ferramentas básicas\e[0m"
RUN apt-get -y install apt-utils nano wget dialog vim

# Install important libraries
RUN echo "\e[1;33mInstalando lib's\e[0m"
RUN apt-get -y install --fix-missing \
    apt-utils \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev

# Create a user and group
# RUN addgroup -g 1000 ${GROUP} && \
#     adduser -G ${GROUP} -H -D -s /sbin/nologin -u 1000 ${USER}

COPY ./ ${WORKDIR}

# USER ${USER}

EXPOSE 8000

ENTRYPOINT [ "sh", "./run.sh" ]
