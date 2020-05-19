FROM centos:8

ARG DB_HOST
ARG DB_PORT
ARG DB_DATABASE
ARG DB_USERNAME
ARG DB_PASSWORD
ARG AWS_COGNITO_KEY
ARG AWS_COGNITO_SECRET
ARG AWS_COGNITO_CLIENT_ID
ARG AWS_COGNITO_USER_POOL_ID

RUN yum -y install epel-release && \
    yum -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm && \
    dnf module install -y php:remi-7.4 && \
    dnf -y install dnf-utils php-mysqlnd php-gd unzip && \
    yum -y update && yum -y install nc telnet vim && \
    dnf -y install python3 && \
    curl -O https://bootstrap.pypa.io/get-pip.py && \
    python3 get-pip.py && \
    pip3 install awscli --upgrade && \
    curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    mkdir -p /opt/pmu_dashboard

COPY . /opt/pmu_dashboard
RUN mv /opt/pmu_dashboard/php.ini /etc/

RUN ls -ali /opt/pmu_dashboard/

RUN cd /opt/pmu_dashboard && \
    cp /opt/pmu_dashboard/.env.example /opt/pmu_dashboard/.env && \
    composer install --optimize-autoloader --no-dev && \
    composer update
    #composer dump-autoload

RUN echo "alias ll='ls -l'" > ~/.bashrc

RUN sed -i "s@.*AWS_COGNITO_KEY=.*@AWS_COGNITO_KEY=${AWS_COGNITO_KEY}@" /opt/pmu_dashboard/.env && \
    sed -i "s@.*AWS_COGNITO_SECRET=.*@AWS_COGNITO_SECRET=${AWS_COGNITO_SECRET}@" /opt/pmu_dashboard/.env && \
    sed -i "s/.*AWS_COGNITO_CLIENT_ID=.*/AWS_COGNITO_CLIENT_ID=${AWS_COGNITO_CLIENT_ID}/" /opt/pmu_dashboard/.env && \
    sed -i "s/.*AWS_COGNITO_USER_POOL_ID=.*/AWS_COGNITO_USER_POOL_ID=${AWS_COGNITO_USER_POOL_ID}/" /opt/pmu_dashboard/.env

RUN cat /opt/pmu_dashboard/.env

#RUN aws cognito-idp sign-up --region eu-west-1 --client-id 35vlfdldmpreh89t3gbtlqf8r2 --username admin5@example.com --password Passw0rd!

# (marco/mirco) 20200229 : workaround to fix "the no such file" error
RUN mkdir -p /opt/pmu_dashboard/storage/framework/sessions

WORKDIR /opt/pmu_dashboard

EXPOSE 7000

CMD ["php","-S","0.0.0.0:7000","-c","/etc/php.ini","-t","public"]
