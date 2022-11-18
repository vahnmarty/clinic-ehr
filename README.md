# About


## Installation

Clone

```
git clone https://github.com/vahnmarty/clinic-ehr.git

```

Setup

```
cd clinic-ehr
composer install
cp .env.example .env
php artisan key:generate
```


NPM 

```
npm i && npm run build
```



### 

Database

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ehr
DB_USERNAME=root
DB_PASSWORD=
```

```
php artisan migrate
```


Create a Tenant called `app`

```
php artisan db:seed --class=TenantTableSeeder
```

## Demo

Go to `http://app.ehr.test` or `http://app.{APP_URL}`

Login

```
Email: admin@myapp.com
Password: password
```
