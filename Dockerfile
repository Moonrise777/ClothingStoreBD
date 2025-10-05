FROM php:8.2-apache

# Copia el proyecto a la carpeta pública
COPY . /var/www/html/

# Corrige permisos para Apache
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Instala extensiones PHP comunes (por ejemplo para MySQL)
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Crea un archivo de configuración para permitir acceso y habilitar index.php
RUN printf "<Directory /var/www/html/>\n\
    AllowOverride All\n\
    Options Indexes FollowSymLinks\n\
    Require all granted\n\
</Directory>\n" > /etc/apache2/conf-available/app.conf \
    && a2enconf app.conf

# Asegura que Apache reconozca los archivos index
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Corrige el ServerName para eliminar advertencias
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Render usa una variable PORT dinámica
ENV PORT=10000
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

CMD ["apache2-foreground"]
