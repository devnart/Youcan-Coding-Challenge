# Youcan Coding Challenge

A small project using Laravel 8/Vue.js 3 for the **YouCan** Software Engineer application 

## Overview
 - List your products
 - Create products
 - Celete products
 - Create categories
 - Delete Categories
 - Filter products by category
 - Sort by name
 - Sort by price

## Requirements

 - PHP >= 7.3
 - [Node](https://nodejs.org/en/)
 - [Composer](https://getcomposer.org/)
 -  A supported database: MySQL, PostgreSQL or SQLite

## Installation

 1. clone the repository and cd to the project folder:
```
git clone https://github.com/devnart/Youcan-Coding-Challenge
cd Youcan-Coding-Challenge
```
2. create a database for the project
3. from the project root run `cp .env.example .env` 
4. edit your `.env` file
5. Install the necessary dependencies:
```
composer install
```
6. from the project root run `php artisan key:generate`
7. from the project root run `php artisan migrate`

#### Build the Front End Assets with Mix
1. From the projects root folder run  `npm install`
2. From the projects root folder run  `npm run dev`  or  `npm run production`
-   You can watch assets with  `npm run watch`
## Commands
#### Create Category
To create a category from the command line you can run the following command and follow the instructions :
```
php artisan category:create
```
#### Delete Category
To delete a category from the command line run ( replace category_id with the category id you wish to delete ) :
```
php artisan category:delete --id=category_id
```
#### Create Product
To create a product from the command line you can run the following command and follow the instructions :
```
php artisan product:create
```

#### Delete Product
To delete a product from the command line run ( replace product_id with the product id you wish to delete ) :
```
php artisan product:delete --id=product_id
```
## API Endpoints

#### *Get products*
```
[GET] /api/products 
```
#### *Create product*
```
[POST] /api/products 
```
##### Required Inputs :
 - Name
 - Description
 - Price
 - Image
#### *Delete product*
```
[DELETE] /api/products/{id}
```
#### *Attach product with category*
```
[POST] /products/categories
```
##### Required Inputs :
 - product_id
 - category_id
 
#### *Get products by category*
```
[GET] /categories/{id}
```
#### *Get Categories*
```
[GET] /api/categories
```
#### *Create categories*
```
[POST] /api/categories 
```
##### Required Inputs :
 - Name
##### Optional Inputs :
- parent_id

#### *Sort products*
By name `[GET] /api/products?sort=name`
By price `[GET] /api/products?sort=price`

#### *Sort products within category*
By name `[GET] /api/products?sort=name?category=1`

## Demo

You can check the live demo of this application by visiting this link