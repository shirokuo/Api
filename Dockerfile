# Dockerfile sederhana untuk menjalankan PHP built-in server
FROM php:8.1-cli

WORKDIR /app

# salin semua file ke image
COPY . /app

# expose port yang akan dipakai
EXPOSE 8080

# jalankan PHP built-in web server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/app"]
