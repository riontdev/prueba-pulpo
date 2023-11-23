# Prueba Técnica - test-pulpo

Este repositorio contiene mi solución para la prueba técnica [Prueba técnica Programador Laravel | Symfony]. A continuación, se proporciona una descripción general del proyecto y cómo ejecutar la solución.


## Tecnologías Utilizadas

- Laravel v10
- Vue.js v3
- Mysql
- DDD
- CleanCode

## Instrucciones de Ejecución

Asegúrate de tener instalados [enlaces a las tecnologías necesarias].

1. Clona este repositorio: `git clone https://github.com/riontdev/prueba-pulpo`
2. Instala las dependencias de Laravel: `composer install`
3. Instala las dependencias de Vue.js: `npm install`
4. Copia el archivo `.env.example` a `.env` y configura las variables de entorno.
5. Ejecuta las migraciones de la base de datos: `php artisan migrate`
6. Inicia el servidor de desarrollo de Laravel: `php artisan serve`
7. Compila los assets de Vue.js: `npm run dev`

## Variables de Entorno

En el archivo `.env`, debes rellenar las siguientes variables de entorno adicionalmente a un proyecto laravel normal...

- `CURRENCY_API_TOKEN`: Tu token de acceso para la API de monedas.
- `CURRENCY_API_URL`: La URL de la API de monedas. [http://api.currencylayer.com]
- `JWT_SECRET`: Tu secret de jwt

```dotenv
CURRENCY_API_TOKEN=your_token
CURRENCY_API_URL=your_api_url
JWT_SECRET=your_jwt