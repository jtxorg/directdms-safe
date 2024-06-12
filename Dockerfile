FROM php:7.4-apache

# Install necessary PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    certbot \
    openssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable Apache mod_rewrite and SSL
RUN a2enmod rewrite ssl

# Create a temporary self-signed certificate
RUN mkdir -p /etc/letsencrypt/live/standarddms.mytruecloud.com \
    && openssl req -x509 -nodes -newkey rsa:2048 -days 1 \
    -keyout /etc/letsencrypt/live/standarddms.mytruecloud.com/privkey.pem \
    -out /etc/letsencrypt/live/standarddms.mytruecloud.com/fullchain.pem \
    -subj '/CN=localhost'

# Copy HTTP and HTTPS configuration files from config directory
COPY config/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY config/000-default-ssl.conf /etc/apache2/sites-available/000-default-ssl.conf

# Copy the startup script
COPY start-apache.sh /usr/local/bin/start-apache.sh

# Ensure the startup script is executable
RUN chmod +x /usr/local/bin/start-apache.sh

# Enable HTTP and SSL site configuration
RUN a2ensite 000-default
RUN a2ensite 000-default-ssl

# Ensure the www-data user owns the directory and has write permissions
RUN mkdir -p /var/www/html \
    && chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Expose ports 80 and 443
EXPOSE 80 443

# Use the startup script as the entrypoint
ENTRYPOINT ["start-apache.sh"]
