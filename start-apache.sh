#!/bin/sh

CERT_PATH="/etc/letsencrypt/live/standarddms.mytruecloud.com/fullchain.pem"

# Wait until the certificate file is generated
while [ ! -f "$CERT_PATH" ]; do
  echo "Waiting for SSL certificate to be generated..."
  sleep 5
done

# Start Apache
apache2-foreground
