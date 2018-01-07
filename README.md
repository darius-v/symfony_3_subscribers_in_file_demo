# Symfony 3 news subscribers demo

Functionality:
 - Create subscriber (validation in frontend and backend), without logging in
 - List, edit, delete subscribers - you have to be logged in.
 - Sort list by various columns

Other notes:
 - Data is save to text file
 - Login info: admin/kitten
 
### Prerequisites

PHP 7 (tested only with 7.1.11)

Composer https://getcomposer.org/

Git

Web server like nginx, apache.

### Installing

```git clone git@github.com:darius-v/symfony_3_subscribers_in_file_demo.git```

```cd symfony_3_subscribers_in_file_demo```

```composer install```

Edit your operating system hosts file and add line:

```127.0.0.1		subscribers-demo.com```

If you are using apache, add something like this to http-vhosts.conf

```<VirtualHost *:80>   
    DocumentRoot "E:/path/to/this/project/web"
    ServerName subscribers-demo.com
	
   <Directory "E:/path/to/this/project/web">
        AllowOverride None
        Order Allow,Deny
        Allow from All

        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^(.*)$ index.php [QSA,L]
        </IfModule>
    </Directory>
</VirtualHost>
```

and restart apache.

See more here how to configure:

https://symfony.com/doc/3.4/setup/web_server_configuration.html

If everything is configured well, go to http://subscribers-demo.com/app_dev.php
