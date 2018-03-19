# slimrest_api
REST API using Slim Micro framework and MySQL

Version
1.0.0

Usage
Installation
Create database or import from sql/restapi.sql

Edit db/config params

Install SlimPHP and dependencies

$ composer

API Endpints for login
$ GET /api/login
$ GET /api/login/{id}
$ POST /api/login/add
$ PUT /api/login/update/{id}
$ DELETE /api/login/delete/{id}

API Endpoints for register
$ GET /api/register
$ GET /api/register/{id}
$ POST /api/register/add
$ PUT /api/register/update/{id}
$ DELETE /api/register/delete/{id}

API Endpoints for products
$ GET /api/products
$ GET /api/product/{id}
$ POST /api/product/add
$ PUT /api/product/update/{id}
$ DELETE /api/product/delete/{id}

API Endpoints for category
$ GET /api/category
$ GET /api/category/{id}
$ POST /api/category/add
$ PUT /api/category/update/{id}
$ DELETE /api/category/delete/{id}

API Endpoints for brand
$ GET /api/brands
$ GET /api/brand/{id}
$ PUT /api/brand/update/{id}
$ DELETE /api/brand/delete/{id}
