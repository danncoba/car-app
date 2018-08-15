# Laravel Car application
Aplikacija je napravljena na laravelu

### Pokretanje aplikacije u development environmentu.
- Pokrenuti seedere i migracije sa `php artisan migrate:refresh --seed`
- Pokrenuti laravel web server sa: `php artisan serve`

Seeder je napravio nekoliko usera(1 admin i 2 membera)  
Takodje su napravljene u sideru 9 auto kategorija  
Napravljena su 3 automobila sa defaultnima slikama

### User detalji za admina:
- email: `sysAdmin@example.com`
- password: `development`

### User detalji za membera:
- emails: `sysMember@example.com`, `sysMember1@example.com`
- password: `development`

##### Produkcijsko okruzenje nije napravljeno

Frontend je u vuejs okruzenju i webpackom je kompajliran i importovani js fajl
