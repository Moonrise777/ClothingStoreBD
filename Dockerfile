FROM php:8.2-apache

# Copia todos los archivos del proyecto al servidor web
COPY . /var/www/html/

# Ajusta permisos para que Apache pueda acceder
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Asegura que Apache reconozca index.php e index.html como página principal
RUN echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf

# Corrige el ServerName para evitar advertencias
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configura Apache para escuchar en el puerto asignado por Render
RUN sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf

# Expone el puerto dinámico
EXPOSE ${PORT}

# Inicia Apache
CMD ["apache2-foreground"]
