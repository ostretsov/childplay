FROM phusion/baseimage:0.10.1

RUN apt-get update && apt-get install -y nginx net-tools

ADD nginx.conf /etc/nginx/

RUN ln -s /etc/nginx/sites-available/symfony.conf /etc/nginx/sites-enabled/symfony
RUN rm /etc/nginx/sites-enabled/default

RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

CMD ["/sbin/my_init"]

EXPOSE 80
EXPOSE 443
