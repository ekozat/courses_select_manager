#!/bin/bash

# Define variables
SSH_USER="socs"
SSH_HOST="cis3760f23-01.socs.uoguelph.ca"
SSH_PASSWORD=$SSH_PASSWORD
HTML_DIR="/var/www/html"

# Copy HTML directory to VM
/usr/bin/scp -r -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null -o LogLevel=ERROR html/* $SSH_USER@$SSH_HOST:$HTML_DIR
