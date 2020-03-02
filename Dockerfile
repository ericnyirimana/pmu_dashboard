FROM centos:8

ARG DB_HOST
ARG DB_PORT
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD

RUN yum -y update && \
    yum -y install epel-release && \
    yum -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm && \
    dnf module install -y php:remi-7.4 && \
    dnf -y install dnf-utils php-mysqlnd php-gd && \
    yum -y update && \
    yum -y install unzip && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    mkdir -p /opt/pmu_dashboard

#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www

COPY . /opt/pmu_dashboard

RUN cd /opt/pmu_dashboard && \
    cp /opt/pmu_dashboard/.env.example /opt/pmu_dashboard/.env && \
    composer install && \
    composer update
    #composer dump-autoload

RUN sed -i "s/.*DB_HOST=.*/DB_HOST=${DB_HOST}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_PORT=.*/DB_PORT=${DB_PORT}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /opt/pmu_dashboard/.env

# (marco/mirco) 20200229 : workaround to fix "the no such file" error
RUN mkdir -p /opt/pmu_api/storage/framework/sessions

#COPY --chown=www:www . /opt/pmu_dashboard

WORKDIR /opt/pmu_dashboard

#RUN chown -R www:www /opt/pmu_dashboard

#USER www

EXPOSE 7000

CMD ["php","-S","0.0.0.0:7000","-t","public"]
