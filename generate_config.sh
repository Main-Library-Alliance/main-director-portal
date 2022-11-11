#!/bin/sh

sed -i "s/\${DB_USERNAME}/$DB_USERNAME/g" config.php
sed -i "s/\${DB_HOSTNAME}/$DB_HOSTNAME/g" config.php
sed -i "s/\${DB_PASSWORD}/$DB_PASSWORD/g" config.php
sed -i "s/\${DB_NAME}/$DB_NAME/g" config.php
