## CRM 

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm
DB_USERNAME=root
DB_PASSWORD=password

docker compose up

<!-- sudo docker compose exec --user root php chown -R www-data:www-data /var/www/html
sudo docker compose exec --user root php chmod -R 755 /var/www/html -->
sudo chown -R $USER:$USER 'project/path'
sudo chown -R www-data:www-data storage

./console.sh composer install

./console.sh artisan key:generate


chmod +x console.sh
