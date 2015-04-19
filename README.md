Personal web site
========================
This is my personal web site


1) Installing
-------------

### Clone the repository

    --

### Install vendor libraries with composer

At the root of the project :

    curl -s http://getcomposer.org/installer | php
    php composer.phar install

### Install less.css

Linux

    sudo apt-get install npm
    sudo npm install -g less@1.7.5

### Install uglify

    sudo npm install -g uglify-js
    sudo npm install -g uglifycss


 2) Server setup
----------------

    apt-get install nginx-extras php5-fpm php5-mysql php5-cli php-apc php5-intl php5-gd mysql-server git unison

```nginx

server {
    listen 80;
    server_name localhost;
    root /var/www/siteWeb/web;

    client_max_body_size 1024M;

    #    Do not log access to robots.txt, to keep the logs cleaner
    location = /robots.txt { access_log off; log_not_found off; }

    #    Do not log access to the favicon, to keep the logs cleaner
    location = /favicon.ico { access_log off; log_not_found off; }

    location / {
        try_files $uri @rewriteapp;
    }

    location @rewriteapp {
        # rewrite all to app.php
        rewrite ^(.*)$ /app.php/$1 last;
    }

    location ~ ^/(app|app_dev|config)\.php(/|$) {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;
    }
}
```


3) Setup directories
--------------------

``` bash
mkdir -p app/tmp app/files web/upload/
sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs app/tmp app/files web/upload/
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs app/tmp app/files web/upload/
```
Replace `www-data` with the user running the web server
