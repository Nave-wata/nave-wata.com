FROM rockylinux:8

# Install required repositories
RUN dnf -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm \
    && dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm \
    && dnf -y install dnf-utils \
    && dnf module reset php \
    && dnf module enable php:remi-8.2 -y

# Install PHP 8.2 and required extensions
RUN dnf -y install \
    php \
    php-apcu \
    php-bcmath \
    php-bz2 \
    php-calendar \
    php-cli \
    php-common \
    php-ctype \
    php-curl \
    php-dba \
    php-dom \
    php-exif \
    php-fileinfo \
    php-filter \
    php-ftp \
    php-gd \
    php-gettext \
    php-gmp \
    php-iconv \
    php-intl \
    php-json \
    php-ldap \
    php-mbstring \
    php-mysqli \
    php-mysqlnd \
    php-openssl \
    php-pdo \
    php-pdo_mysql \
    php-pdo_pgsql \
    php-pdo_sqlite \
    php-pgsql \
    php-phar \
    php-posix \
    php-pspell \
    php-reflection \
    php-session \
    php-shmop \
    php-simplexml \
    php-soap \
    php-sockets \
    php-spl \
    php-sqlite3 \
    php-standard \
    php-sysvmsg \
    php-sysvsem \
    php-sysvshm \
    php-tokenizer \
    php-xml \
    php-xmlreader \
    php-xmlwriter \
    php-xsl \
    php-zip \
    php-zlib \
    php-pecl-imagick \
    php-pecl-mcrypt \
    php-imap

# Install packages
RUN dnf -y install \
    httpd \
    httpd-tools \
    httpd-filesystem \
    mod_ssl \
    unzip \
    wget \
    git

# Create app directory
WORKDIR /var/www/html

# Install Composer 2.8
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --version=2.8.9 --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Expose port 8080
EXPOSE 8080

# Start Apache in foreground
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
