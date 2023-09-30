# How to Reproduce

-   If you are on a fresh VM install, perform these steps to run and host our website

    1. Ensure you have NGINX and PHP installed
    2. Copy the `html` directory to `/var/www/`
    3. Copy the `nginx` directory to `/etc`
        -   if nginx created one already when installing, just overwrite it
    4. Restart nginx by running `sudo systemctl restart nginx`
    5. If images are not loading, make sure to change folder permissions in the `html` directory by running `sudo chmod 777 <filename or directory>`

-   The `html` directory contains all of the php and css files that make up our site while the `nginx` directory contains the web server with the appropriate routes
