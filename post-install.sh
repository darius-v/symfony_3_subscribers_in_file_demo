#!/usr/bin/env bash

chmod 777 var/logs
chmod 777 var/cache
chmod 777 var/sessions

touch database.json
sudo chmod a+w database.json