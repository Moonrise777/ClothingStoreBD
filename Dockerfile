FROM php:8.2-apache

# Copiar archivos al directorio de Apache
COPY . /var/www/html/

# Dar permisos de lectura a Apache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto
EXPOSE 10000

# Ejecutar Apache
CMD ["apache2-foreground"]

