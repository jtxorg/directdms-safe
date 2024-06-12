FROM nginx:latest

# Install OpenSSL for generating self-signed certificates and Certbot
RUN apt-get update && apt-get install -y \
    openssl \
    certbot \
    python3-certbot-nginx

# Create directories for Let's Encrypt certificates and webroot challenge
RUN mkdir -p /etc/letsencrypt/live/standarddms.mytruecloud.com \
    && mkdir -p /var/www/certbot/.well-known/acme-challenge \
    && chown -R www-data:www-data /etc/letsencrypt \
    && chown -R www-data:www-data /var/www/certbot

# Generate a temporary self-signed certificate
RUN openssl req -x509 -nodes -newkey rsa:2048 -days 1 \
    -keyout /etc/letsencrypt/live/standarddms.mytruecloud.com/privkey.pem \
    -out /etc/letsencrypt/live/standarddms.mytruecloud.com/fullchain.pem \
    -subj '/CN=localhost'

# Copy Nginx configuration file from config directory
COPY config/nginx.conf /etc/nginx/nginx.conf

# Copy the startup script
COPY start-nginx.sh /usr/local/bin/start-nginx.sh

# Ensure the startup script is executable
RUN chmod +x /usr/local/bin/start-nginx.sh

# Expose ports 80 and 443
EXPOSE 80 443

# Use the startup script as the entrypoint
ENTRYPOINT ["/usr/local/bin/start-nginx.sh"]
