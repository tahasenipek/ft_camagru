FROM mysql:8.0

# Set working directory
WORKDIR /var/lib/mysql

# Copy existing application directory contents
COPY . .

EXPOSE 3306

ENTRYPOINT ["mysqld"]

CMD ["mysql", "-u", "root", "-p", "-e", "CREATE DATABASE IF NOT EXISTS db"]
