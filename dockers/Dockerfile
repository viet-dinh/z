FROM php:8.2-fpm

ENV USER=www
ENV GROUP=www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Postgre PDO
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Setup working directory
WORKDIR /var/www/html

# Create User and Group
RUN groupadd -g 1000 ${GROUP} && useradd -u 1000 -ms /bin/bash -g ${GROUP} ${USER}

# Grant Permissions
RUN chown -R ${USER} /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel files into the container
COPY . .

# Install Laravel dependencies
#RUN composer install

# Set the correct permissions
#RUN chown -R www:www storage bootstrap/cache

# Gen app key
#RUN php artisan key:generate

# Select User
USER ${USER}

# Copy permission to selected user
COPY --chown=${USER}:${GROUP} . .

EXPOSE 9000

CMD ["php-fpm"]