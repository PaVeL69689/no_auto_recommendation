<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Основная структура:

- Принимает api запросы от клиентского приложения.
- Предоставляет административную панель.

## Основные задачи:

- Регистрация/Авторизация
Реализовано на laravel sanctum
https://laravel.com/docs/12.x/sanctum


- Загрузка файлов.
  Используется стандартный File Storage Laravel
  
- Запись в базу данных с использованием ORM модели.
- Отправка соощений в Kafka с использованием библиотеки
  mateusjunges/laravel-kafka
- Запросы на получение данных отрабатываются через GraphQL
  rebing/graphql-laravel

  
