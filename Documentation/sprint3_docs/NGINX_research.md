#NGINX

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