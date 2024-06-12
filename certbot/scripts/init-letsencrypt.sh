#!/bin/sh

domain="standarddms.mytruecloud.com"
rsa_key_size=4096
data_path="/etc/letsencrypt"
email="jbaggio@rsttechnology.com"
staging=0

if [ -d "$data_path/live/$domain" ]; then
  echo "Existing certificate found for $domain. Skipping certificate request."
else
  echo "### Requesting Let's Encrypt certificate for $domain ..."

  domain_args="-d $domain"

  case "$email" in
    "") email_arg="--register-unsafely-without-email" ;;
    *) email_arg="--email $email" ;;
  esac

  if [ $staging != "0" ]; then staging_arg="--staging"; fi

  certbot certonly --webroot -w /var/www/certbot \
    $staging_arg \
    $email_arg \
    $domain_args \
    --rsa-key-size $rsa_key_size \
    --agree-tos \
    --force-renewal \
    --non-interactive
fi

echo "### Reloading Apache ..."
docker exec $(docker-compose ps -q apache) apachectl -k graceful
