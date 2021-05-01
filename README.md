# Laravel Restful API

Contexto: Crear un api para obtener los nombres de los presidentes de colombia en orden

# 1. Crear proyecto

composer create-project laravel/laravel restapi

# 2. Configurar base de datos

# 2.1 Crear BD de pruebas en MySQL

create database restapi_test;
create user 'restapi_test_user'@'localhost' identified by 'Password12345$';
grant all privileges on restapi_test . * to 'restapi_test_user'@'localhost';
flush privileges;

# 2.2 Abrir archivo config/database.php y sobreescribir con los datos de acceso a la BD.

# 2.3 Editar datos de acceso a BD en archivo .env en la raiz

# 2.4 Aplicar patch a Providers/AppServiceProvider

use Illuminate\Support\Facades\Schema;

#...dentro de la funcion boot()...

Schema::defaultStringLength(191);

# 2.5 Crear modelo presidentes

php artisan make:model Presidente

#..dentro de clase Models/Presidente...

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'orden'
    ];

# 2.6 Crear migracion de presidentes

php artisan make:migration create_presidentes_table

#..dentro de clase Migrations/<fecha>_create_presidentes_table.php
#..dentro del método up()

Schema::create('presidentes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('orden');
        });


# 2.7 Ejecutar migracion

php artisan migrate

# 2.8 Crear factory para presidentes

php artisan make:factory PresidenteFactory

#..dentro de clase factories/PresidenteFactory

use App\Models\Presidente;

#..dentro de metodo definition()

return [
            'nombre' => $this->faker->name(),
            'orden' => $this->faker->numberBetween(1,200),
        ];

# 2.9 Escribir código en seeder

php artisan make:seeder PresidenteSeeder

use App\Models\Presidente;

#..dentro de metodo run() en seeders/PresidenteSeeder

Presidente::truncate();
        Presidente::factory()
            ->count(20)
            ->create();

#..dentro de metodo run() en seeders/DatabaseSeeder

        $this->call([
            PresidenteSeeder::class,
        ]);

php artisan db:seed


# 3. Crear ruta
En este caso dado que es un restful, se crean rutas con resource controllers.

# 3.1 Crear resource controller

php artisan make:controller PresidentesController --api 

# 3.2 Agregar ruta a archivo routes/api.php

use App\Http\Controllers\PresidentesController;

Route::resource('presidentes', PresidentesController::class)->only([
    'index'
]);

# 4. Cargar proyecto en servidor Sail

php artisan serve

# 5. Ejecutar endpoint en Postman

curl --location --request GET '127.0.0.1:8000/api/presidentes'

