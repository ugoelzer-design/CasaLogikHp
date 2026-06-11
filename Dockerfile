FROM php:8.2-apache

# Apache-Konfiguration
RUN apt-get update && apt-get install -y unzip && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Composer (für PHPMailer, optional)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Nur Anwendungsdateien kopieren
COPY . .

# PHPMailer installieren (falls composer.json vorhanden)
RUN if [ -f composer.json ]; then composer install --no-dev --no-interaction --optimize-autoloader; fi

# Rechte
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

ENV BASE_URL=""
ENV NOTIFY_EMAIL="u.goelzer@gmx.de"
ENV FROM_EMAIL="noreply@ferienhaus-ruegen-mit-hund.com"
ENV FROM_NAME="Ferienhaus Rügen mit Hund"
ENV SMTP_HOST=""
ENV SMTP_USER=""
ENV SMTP_PASS=""
ENV SMTP_PORT="587"
ENV GA_ID=""
