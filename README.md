

### Установка

Шаги для установки и настройки проекта:

```bash
  git clone https://github.com/saintgottenn/laravel_vue_app
  cd laravel_vue_app
  
  npm install
  composer install
```


Подключите бд(MySQL)

```bash
  php arisan migrate
  php artisan db:seed
```
Замените поля в .env

```env
  DB_HOST=your_host 
  DB_PORT=your_port
  DB_DATABASE=your_db
  DB_USERNAME=your_username
  DB_PASSWORD=your_password
```
