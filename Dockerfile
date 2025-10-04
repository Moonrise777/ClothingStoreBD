FROM php:8.2-apache

# Copiar archivos al servidor
COPY . /var/www/html/

# Corregir permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurar Apache para escuchar en el puerto que Render asigna
RUN sed -i "s/80/${PORT}/g" /etc/apache2/sites-available/000-default.conf

EXPOSE ${PORT}

# Ejecutar Apache
CMD ["apache2-foreground"]
