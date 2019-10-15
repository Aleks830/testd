 FROM ubuntu:18.04
 MAINTAINER turbopipe@gmail.com
 ARG DEBIAN_FRONTEND=noninteractive
 RUN apt-get update && apt-get upgrade -y
 RUN apt --no-install-recommends install nginx php php-fpm php-mysql iputils-ping supervisor -y 
 RUN apt-get update && apt-get upgrade -y
 #COPY index.php /home/manager/app/
 #COPY default /etc/nginx/sites-enabled/
 #COPY supervisord.conf /etc/supervisord.conf
 #CMD supervisord -n -c /etc/supervisord.conf
 ####
 ENTRYPOINT ["nginx", "-g", "daemon off;"]
 EXPOSE 80:80
