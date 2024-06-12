#!/bin/bash

domains=(standarddms.mytruecloud.com)
rsa_key_size=4096
data_path="/etc/letsencrypt"
email="jbaggio@rsttechnology.com"
staging=0

if [ -d "$data_path/live/$domains" ]; then
  echo "Existing certificate found for $domains. Skipping certificate request."
else
  echo "### Requesting Let's Encrypt certificate for $domains ..."

  domain_args=""
  for domain in "${domains[@]}"; do
    domain_args="$domain_args -d $domain"
  done

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
    --force-renewal
fi

echo "### Reloading Apache ..."
docker-compose exec web apachectl -k graceful
