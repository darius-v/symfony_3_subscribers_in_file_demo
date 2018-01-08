#!/usr/bin/env bash

echo "post-install.sh started"

chmod 777 var/logs
chmod 777 var/cache
chmod 777 var/sessions

touch database.json
chmod a+w database.json
