FROM php:8.2-apache

# Copia el proyecto a la carpeta pública
COPY . /var/www/html/

# Permisos
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Extensiones PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Configuración de Apache
RUN printf "<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Options FollowSymLinks\n\
    Require all granted\n\
</Directory>\n" > /etc/apache2/conf-available/app.conf \
    && a2enconf app.conf

RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Puerto dinámico de Render
ENV PORT=10000
EXPOSE ${PORT}

# Inicio de Apache ajustando el puerto en runtime
CMD ["sh", "-c", "sed -i 's/80/$PORT/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
