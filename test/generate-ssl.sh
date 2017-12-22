#!/usr/bin/env bash

# Generate a passphrase
openssl rand -base64 48 > passphrase.txt

# Generate private and public keys
openssl req \
	-days 3560 \
	-subj "/C=UK/O=cosmonova/OU=Domain Control Validated/CN=*.test.corp" \
	-new -newkey rsa:2048 -passin file:passphrase.txt -nodes -x509 \
	-keyout key.pem -out cert.pem
