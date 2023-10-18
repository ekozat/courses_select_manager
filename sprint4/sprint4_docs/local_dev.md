# Setting up MySQL, PHP, and NGINX on MacOS

## Note: YOU NEED HOMEBREW FOR ALL OF THIS

## Note: IF YOU ARE ON AN INTEL MAC, THE PATH `/opt/homebrew` WILL NOT EXIST, IT IS `/usr/local` INSTEAD

### Set up MySQL

1. `brew install mysql`
2. `brew services start mysql`
3. `mysql -V` to check version
4. `mysql -u root`
5. Now should be in an interactive terminal and can run sql scripts

### Set up PHP

1. `brew install php`
2. `brew services start php`
3. `php -v` to check version

### Set up NGINX

1. `brew install nginx`
2. `brew services start nginx`
3. Copy this nginx config into `/opt/homebrew/etc/nginx/nginx.conf` or `/usr/local/etc/nginx/nginx.conf`

-   NOTE: If you are on intel, anywhere you see /opt/homebrew, the path should be /usr/local in this config
```nginx
events {
}

http {
    server {
        listen 8080;
        root /opt/homebrew/var/www/html;

        index index.php;
        location / {
          include  /opt/homebrew/etc/nginx/mime.types;
          try_files $uri $uri/ /index.php;
        }
        location /courses/get/ {
          try_files $uri $uri/ /server.php;
        }
        location ~ \.php$ {
          fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
          fastcgi_index server.php;
          include fastcgi_params;
          fastcgi_pass 127.0.0.1:9000;
          fastcgi_split_path_info ^(.+\.php)(/.+)$;
        }
    }
}
```

4. Navigate to our cis3760 repo, make sure you are up to date on the sprint4 branch
5. Copy the html folder from the sprint4 files into `/opt/homebrew/var/www/` or `/usr/local/var/www/` on intel by doing `cp -r html /opt/homebrew/var/www/`
    - It contains a new file called `server.php` that just has a hardcoded json string
6. Run `sudo nginx -t` and make sure there are no errors
7. Run `brew services reload nginx`
8. You _should_ be able to navigate to http://localhost:8080 and see our page
9. You _should_ also be able to navigate to http://localhost:8080/courses/get and see our "mock" API that returns some json

-   On the real VM, we would just have to change the mysql connection url. (probably more stuff I am forgetting)
    -   To access MySQL on the VM, run `mysql -u cis3760 -p` and then enter `pass1234` when asked
-   The `server.php` script is already on the server with the nginx config edited similar to the local one so https://cis3760f23-01.socs.uoguelph.ca/courses/get/ will work
