# NGINX

## Sara Adi
**What is NGINX>**
* Nginx can serve web content, such as HTML files and images, to users when they request a website. It listens for incoming requests from web browsers and sends the appropriate responses.

**Sample NGINX Program**

* Nginx configuration file: 


```
server {
    listen 80;  # Listen on port 80 (HTTP)

    server_name example.com;  # Replace with your domain name or IP address

    root /path/to/your/html/files;  # Replace with the actual path to your HTML files

    index index.html;

    location / {
        try_files $uri $uri/ =404;
    }
}
```

## Maneesh Wijewardhana
-   Running `sudo nginx -t` will validate any changes in an NGINX config file for syntax errors and such
-   If you update the configuration file, then you'll have to instruct NGINX explicitly to reload the configuration file. There are two ways to do that.
    -   You can restart the NGINX service by executing the `sudo systemctl restart nginx` command.
    -   You can dispatch a reload signal to NGINX by executing the `sudo nginx -s reload` command.
-   The `root` directive will route all incoming requests to '/' to the specified HTML or PHP
-   The `location` directive is used to specify certain paths like '/maneesh' to respond with a different HTML or PHP page (think different page routes)
-   In the example above, the location is set to '/' and it will try to fetch the base uri, if it cannot it will serve a 404

## Simardeep Singh
- NGINX is pronounced as 'engine X'. It is more than a web server.  
    - **Reverse Proxy:** NGINX acts as a reverse proxy, distributing traffic among backend servers, enhancing security, and improving performance. It can also handle SSL/TLS encryption.
    - **Load Balancer:** NGINX balances loads across multiple servers using algorithms like round-robin, ensuring high availability and even distribution of requests.
    - **Caching:** It caches frequently accessed content, reducing the load on backend servers and improving response times.
    - **Application Gateway:** NGINX serves as an API gateway, managing APIs with features like rate limiting, authentication, and request/response transformation. It's ideal for microservices architecture.
    - **Content Delivery:** NGINX supports streaming media delivery, adaptive streaming, and content compression, making it valuable for media and web performance optimization.

## Fee Kim Ah-Poa
- NGINX is popular as it can handle a higher number of concurrent requests.
- It has a fast static content delivery while use less resource.
- It is used as a reverse proxy, HTTP cache, and load balancer.
- Nginx uses an asynchronous, event-driven approach where requests are handled in a single thread.
