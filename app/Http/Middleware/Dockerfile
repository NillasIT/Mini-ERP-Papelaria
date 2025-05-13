# Use uma imagem base do PHP com suporte ao Apache
FROM php:8.1-apache

# Instalar dependências necessárias
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
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Configurar o diretório de trabalho no contêiner
WORKDIR /var/www/html

# Copiar os arquivos do projeto para o contêiner
COPY . /var/www/html

# Instalar o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Definir permissões de pasta para o Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependências PHP (Composer)
RUN composer install --no-dev --optimize-autoloader

# Copiar o .env para configuração de produção
COPY .env.example .env

# Gerar a chave de aplicação do Laravel
RUN php artisan key:generate

# Configurar permissões de pasta para o Laravel
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta 80 (usada pelo Apache)
EXPOSE 80

# Comando para iniciar o servidor Apache
CMD ["apache2-foreground"]