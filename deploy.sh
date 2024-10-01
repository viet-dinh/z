#!/bin/bash

# Variables
SERVER_USER="ucrhuof"
SERVER_HOST="c11.vinahost.vn"
SERVER_PATH="~/public_html"
LOCAL_PATH="."  # Current directory
PRIVATE_KEY_PATH="../id_rsa"  # Path to your private key

# Exclude patterns
EXCLUDES=(
  --exclude=node_modules
  --exclude=.git
)

# Sync using rsync
echo "Starting deployment..."

rsync -avz -e "ssh -i $PRIVATE_KEY_PATH -vvv" "${EXCLUDES[@]}" "$LOCAL_PATH/" "$SERVER_USER@$SERVER_HOST:$SERVER_PATH"

if [ $? -eq 0 ]; then
    echo "Deployment completed successfully!"
else
    echo "Deployment failed."
fi
