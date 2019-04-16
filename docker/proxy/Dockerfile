FROM webdevops/nginx:alpine

COPY conf/90-proxys.conf /opt/docker/etc/nginx/conf.d/90-proxys.conf
COPY ssl/Nginx/www.bh3721.com_ssl.crt /opt/docker/etc/nginx/www.bh3721.com_ssl.crt
COPY ssl/Nginx/www.bh3721.com_ssl.key /opt/docker/etc/nginx/www.bh3721.com_ssl.key