FROM centos:8

ARG DB_HOST
ARG DB_PORT
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD
ARG AWS_COGNITO_KEY
ARG AWS_COGNITO_SECRET
ARG AWS_COGNITO_REGION
ARG AWS_COGNITO_CLIENT_ID
ARG AWS_COGNITO_USER_POOL_ID
ARG S3_ACCESS_KEY_ID
ARG S3_SECRET_ACCESS_KEY
ARG S3_DEF_REGION
ARG S3_BUCKET

#RUN yum -y update && \
RUN yum -y install epel-release && \
    yum -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm && \
    dnf module install -y php:remi-7.4 && \
    dnf -y install dnf-utils php-mysqlnd php-gd unzip && \
    yum -y update && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    mkdir -p /opt/pmu_dashboard

COPY . /opt/pmu_dashboard

RUN cd /opt/pmu_dashboard && \
    cp /opt/pmu_dashboard/.env.example /opt/pmu_dashboard/.env && \
    composer install && \
    composer update
    #composer dump-autoload

# Inject DB parameters

RUN sed -i "s/.*DB_HOST=.*/DB_HOST=${DB_HOST}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_PORT=.*/DB_PORT=${DB_PORT}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" /opt/pmu_dashboard/.env

# Inject Cognito parameters

#RUN sed -i "s/.*AWS_COGNITO_KEY=.*/AWS_COGNITO_KEY=${AWS_COGNITO_KEY}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_COGNITO_SECRET=.*/AWS_COGNITO_SECRET=${AWS_COGNITO_SECRET}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_COGNITO_REGION=.*/AWS_COGNITO_REGION=${AWS_COGNITO_REGION}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_COGNITO_CLIENT_ID=.*/AWS_COGNITO_CLIENT_ID=${AWS_COGNITO_CLIENT_ID}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_COGNITO_USER_POOL_ID=.*/AWS_COGNITO_USER_POOL_ID=${AWS_COGNITO_USER_POOL_ID}/" /opt/pmu_dashboard/.env
	
# Inject S3 parameters

#RUN sed -i "s/.*AWS_ACCESS_KEY_ID=.*/AWS_ACCESS_KEY_ID=${S3_ACCESS_KEY_ID}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_SECRET_ACCESS_KEY=.*/AWS_SECRET_ACCESS_KEY=${S3_SECRET_ACCESS_KEY}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_DEFAULT_REGION=.*/AWS_DEFAULT_REGION=${S3_DEF_REGION}/" /opt/pmu_dashboard/.env && \
#    sed -i "s/.*AWS_BUCKET=.*/AWS_BUCKET=${S3_BUCKET}/" /opt/pmu_dashboard/.env

#RUN cat /opt/pmu_dashboard/.env

# (marco/mirco) 20200229 : workaround to fix "the no such file" error
RUN mkdir -p /opt/pmu_dashboard/storage/framework/sessions

WORKDIR /opt/pmu_dashboard

EXPOSE 7000

CMD ["php","-S","0.0.0.0:7000","-t","public"]
