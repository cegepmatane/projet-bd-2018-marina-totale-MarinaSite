FROM php:7.1-apache
RUN apt-get update && \
    apt-get install -y wget gnupg2 libpq-dev && docker-php-ext-install pdo pdo_pgsql mbstring
RUN echo "deb http://apt.postgresql.org/pub/repos/apt/ stretch-pgdg main" > /etc/apt/sources.list.d/pgdg.list
RUN wget --quiet -O - https://www.postgresql.org/media/keys/ACCC4CF8.asc | \
   apt-key add -
RUN apt-get update
RUN apt-get install -y postgresql-client
RUN docker-php-ext-install gettext
COPY ./wait-for-postgres.sh wait-for-postgres.sh
RUN chmod +x wait-for-postgres.sh
COPY src/ /var/www/html

