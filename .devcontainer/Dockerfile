FROM php:8.4.5-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    sudo \
    curl \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure Nginx
COPY default.conf /etc/nginx/sites-available/default

# Configure PHP
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Create directory for php-fpm socket
RUN mkdir -p /var/run/php

# Create a non-root user to run the container (same UID/GID as VSCode defaults)
RUN groupadd --gid 1000 vscode \
    && useradd --uid 1000 --gid vscode --shell /bin/bash --create-home vscode \
    && echo "vscode ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/vscode \
    && chmod 0440 /etc/sudoers.d/vscode

# Copy startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

# Set working directory
WORKDIR /var/www/html

# Create a simple PHP info file
RUN echo "<?php phpinfo(); ?>" > /var/www/html/index.php

# Expose port 80 for Nginx
EXPOSE 80

# Run startup script
CMD ["/start.sh"]
