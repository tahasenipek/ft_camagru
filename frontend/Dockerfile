FROM nginx:1.21-alpine

# Set working directory

WORKDIR /var/www/html

# Copy existing application directory contents

COPY . .

# Expose port 80 and start nginx server

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
