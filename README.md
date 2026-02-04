<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## InsataDev | Red Social para Programadores 🚀

Pasos para la instalación: 

Antes de empezar, asegúrate de tener instalado:

- PHP >= 8.x  
- Composer  
- MySQL / PostgreSQL  
- XAMPP, Laragon o WAMP  


### 1. Clonar el proyecto

```bash
$ git clone https://github.com/Perseo-2025/instadev.git
```

### 2. Entrar al proyecto
cd repositorio

### 3. Instalar dependencias
```bash
$ composer install
$ pnpm i o npm i
```

### 4. Crear el archivo .env y generar la api key
```bash
$ php artisan key:generate
```

### 5. Configurar BD en .env antes de continuar
COLOCAR LAS CREDENCIALES 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=instadev
DB_USERNAME=root
DB_PASSWORD=
```
CONFIGURACIÓN PARA EL EMAIL
En este caso se puede utilizar gmail o cualquier gestor de email
-> mailtrap.io
```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

En un gestor de base de datos preferida (Mysql) crear la base de datos
-> 🛢 insatadev
```bash
$ php artisan migrate
```

### 6. Levantar servidor
En distintas terminal ejecutar el comando:

Ejecuta el frotend
```bash
$ pnpm run dev
```
Ejecuta el servidor
```bash
$ php artisan serve
```
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
