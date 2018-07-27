// Creación de base de datos y de usuario.
GRANT ALL PRIVILEGES ON *.* TO 'shopadmin'@'localhost' IDENTIFIED BY 'secret';
CREATE DATABASE shopdb;

//Clonar el repositorio
git clone https://github.com/linampatino/search-product

//Instalar dependencias debe estar situada en la carpeta product-search
composer install
npm install

//Configurar archivo .env
APP_NAME=VirtualShop
APP_ENV=local
APP_KEY=base64:+kY442y78HT3xq5cy/fiEbRUhDn0c74XYVzub/n1Ork=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shopdb
DB_USERNAME=shopadmin
DB_PASSWORD=secret

//Ejecución de migraciones para generar las tablas de la base de datos
php artisan migrate

//Cargar información a las tablas de la base de datos
php artisan db:seed --class=DataSeeder

//Subir servidor
php artisan serve --host 0.0.0.0
npm run watch
