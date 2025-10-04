# Imagen base con PHP y Apache
FROM php:8.2-apache

# Copia todos los archivos del repositorio al servidor web
COPY . /var/www/html/

# Expone el puerto por donde Render servirá el sitio
EXPOSE 10000

# Inicia Apache escuchando en el puerto que Render usa
CMD ["apache2-foreground"]
