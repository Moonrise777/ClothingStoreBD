# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Copia todos los archivos del proyecto a la raíz del servidor web
COPY . /var/www/html/

# Ajusta permisos para Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Habilita módulos necesarios de Apache
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Asegura que Apache reconozca index.php y que sirva correctamente el sitio
RUN echo "<Directory /var/www/html/> \
    AllowOverride All \
    Options Indexes FollowSymLinks \
    Require all granted \
</Directory>" > /etc/apache2/conf-available/app.conf \
    && a2enconf app.conf

# Asegura que el archivo de inicio sea index.php o index.html
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Corrige el ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Render usa la variable PORT, la agregamos a Apache para que escuche ahí
ENV PORT=10000
RUN sed -i "s/80/${PORT}/g" /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

CMD ["apache2-foreground"]
