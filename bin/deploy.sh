#!/usr/bin/env bash

# Download & run the Composer installer.
curl -s https://getcomposer.org/installer | php

# Install production dependencies.
php composer.phar install --no-dev --prefer-dist --optimize-autoloader
php composer.phar install --no-dev --prefer-dist --optimize-autoloader --working-dir=wp-content/themes/maxinacube

# Clean up.
rm composer.phar

# Activate default theme
wp theme activate maxinacube

# Activate plugins
wp plugin activate wordpress-seo

# Setup the Permalinks
wp rewrite structure '/%postname%/'
wp rewrite flush
