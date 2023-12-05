# Use the official PHP image
FROM php:latest

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your PHP file into the container
COPY client.php /var/www/html/

# Install required packages and enable PHP sockets extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install sockets

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Copy Composer files and install dependencies
COPY composer.json composer.lock /var/www/html/
RUN composer install

# Expose port 80 to access the server
EXPOSE 80

# Command to start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:80"]