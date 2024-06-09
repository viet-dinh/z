<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Project Setup Guide

This guide provides step-by-step instructions to set up the project on your local machine.

## Requirements

-   Node 16
-   Docker
-   Docker Compose

## Installation

1. Clone the project repository to your local machine.
2. Open a terminal and navigate to the project's dockers folder: `cd /path/to/project/dockers`
3. Build web image: `docker-compose build`
4. Create DB docker external volume: `docker volume create z-db-volume`
5. Run the following command to start the Docker containers: `docker-compose up -d`
6. Once the containers are up and running, execute the following command to install vendor: `docker exec z-app bash -c "composer install"`
7. Copy env file: `docker exec z-app bash -c "cp .env.example .env"`
8. Generate app key: `docker exec z-app bash -c "php artisan key:generate"`
9. Migrate the database: `docker exec z-app bash -c "php artisan migrate"`
10. Install node_modules: `npm install`
11. Run Vite: `npm run dev`
12. Finally, open a web browser and navigate to http://localhost:8088 to access the application.

Congratulations! You have successfully set up the project on your local machine.
