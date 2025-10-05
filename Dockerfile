FROM php:8.2-apache

# Copia proyecto
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Extensiones PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Configuración Apache
RUN printf "<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Options FollowSymLinks\n\
    Require all granted\n\
</Directory>\n" > /etc/apache2/conf-available/app.conf \
    && a2enconf app.conf

RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponer puerto
EXPOSE ${PORT}

# Reemplazar puerto dinámico al iniciar Apache
CMD ["sh", "-c", "\
    sed -i \"s/Listen 80/Listen ${PORT}/\" /etc/apache2/ports.conf && \
    sed -i \"s/<VirtualHost 80>/<VirtualHost ${PORT}>/\" /etc/apache2/sites-available/000-default.conf && \
    apache2-foreground \
"]
