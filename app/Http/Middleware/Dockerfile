# Use uma imagem base com PHP 8.4.6 e Apache
FROM php:8.4.6-apache

# Atualizar o sistema e instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Configurar o diretório de trabalho do Laravel no contêiner
WORKDIR /var/www/html

# Copiar todos os arquivos do projeto para o contêiner
COPY . .

# Configurar permissões para as pastas de cache e armazenamento do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar as dependências do Laravel via Composer
RUN composer install --no-dev --optimize-autoloader

# Configurar o .env para produção
RUN cp .env.example .env

# Gerar a chave de aplicação do Laravel
RUN php artisan key:generate

# Expor a porta 80 para o servidor Apache
EXPOSE 80

# Comando para iniciar o servidor Apache
CMD ["apache2-foreground"]