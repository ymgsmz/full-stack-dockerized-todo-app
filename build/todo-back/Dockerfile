FROM php:7.3-fpm

# Change currently directory
WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
	apt-utils \
	libpq-dev \
	zip \
	vim \
	unzip \
	git \
	curl

# Clear APT's cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php's extensions
RUN docker-php-ext-install pgsql pdo_pgsql

# Install php Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g laraman www

# Copy php's config ini file to the php's expected path
COPY ./build/todo-back/conf/default.php.ini /usr/local/etc/php/conf.d

# Copy laravel application's files to WORKDIR
COPY ./app/todo-back/ .

# Install laravel application dependencies
RUN composer install

# Copy laravel application's permissions to WORKDIR
COPY --chown=laraman:www ./app/todo-back/ .

# Set current user
USER laraman

# Expose php-fpm default port
EXPOSE 9000

# Run daemon
ENTRYPOINT ["php-fpm"]
