## Fleet: A RESTful API for booking bus trips.

### 0. Prequsites
```
- PHP 8.2.6
- Composer 2.5.5
- Postgres 14.7
```

### 1. Installation
```shell
git clone https://github.com/omarabdelaz1z/bus-booking
cd bus-booking
composer install
```

### 2. Configuration
- Copy the `.env.example` file to `.env` and update the database credentials.
- Generate the application key.
```shell
cp .env.example .env
php artisan key:generate
```

### 3. Database
- Run the database migrations.
- Or use the dump file [schema.sql](/database_dump/schema.sql) to import the database.
```shell
php artisan migrate --seed
```

### 4. Run the application
```shell
php artisan serve
```

### 5. Endpoints


| Method | Endpoint | Token  | Description | Payload |
| ------------- | ------------- | ------------- | ------------- | ------------- |
| POST  | /api/auth/login  | | Login | ```{email, password}``` |
| POST  | /api/auth/register  | | Register | ```{name, email, password}``` |
| DELETE  | /api/auth/logout  | Yes | Logout | |
| GET  | /api/me  | Yes | Get current user info | | 
| GET  | /api/trips/{id}?source=&destination | Yes | List available trips | |
| POST  | /api/users/{id}/bookings | Yes | Book a trip | `{trip_id, seat_number, source, destination}` |
