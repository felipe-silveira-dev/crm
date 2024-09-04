## CRM 

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm
DB_USERNAME=root
DB_PASSWORD=password

docker compose up

composer install

php artisan key:generate

php artisan migrate:fresh --seed

npm install

php artisan serve

npm run dev


---
sudo chown -R $USER:www-data storage
chmod +x console.sh