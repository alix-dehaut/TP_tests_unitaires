FROM php:7.4.0-apache-buster

ENV PROJECT_DIR /var/www/project
ENV DOCUMENT_ROOT ${PROJECT_DIR}/public
ENV APP_ENV dev

WORKDIR $PROJECT_DIR

COPY --chown=www-data:www-data . $PROJECT_DIR

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
 && sed -i 's|variables_order = "GPCS"|variables_order = "EGPCS"|' $PHP_INI_DIR/php.ini \
 && a2enmod rewrite \
 && chown -R www-data ${DOCUMENT_ROOT} \
 && sed -i "s|DocumentRoot /var/www/html|DocumentRoot ${DOCUMENT_ROOT}|" /etc/apache2/sites-available/000-default.conf \
 && echo "ServerName localhost" | tee /etc/apache2/conf-available/servername.conf && a2enconf servername \
 && docker-php-ext-install pdo_mysql

ENTRYPOINT []
CMD sed -i "s/80/$PORT/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf && docker-php-entrypoint apache2-foreground

