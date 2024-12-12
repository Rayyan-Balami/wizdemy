# Use the official PHP image
FROM php:8.2-cli

# Set the working directory inside the container
WORKDIR /app

# Copy project files into the container
COPY . .

# Install MySQL extension for PHP
RUN docker-php-ext-install pdo_mysql

# Expose port 8080 for the PHP built-in server
EXPOSE 8080

# Command to start PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "./public"]
