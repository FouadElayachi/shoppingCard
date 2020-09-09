<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Description

Api endpoints for the management of a shopping cart instance to be used in an e-commerce website/App Based on Laravel.
Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation

- To install you should have PHP >= 7.3 installed.
- You need also to install composer, if that's not the case you can just download It from here: https://getcomposer.org/doc/00-intro.md#downloading-the-composer-executable. 

## Usage

- First clone the project: `git clone https://github.com/FouadElayachi/devinwebBackend-shoppingCard.git`.
- Move to the project directory: `cd devinwebBackend-shoppingCard`
- Install composer: `composer install`
- create .env file and link It with you database informations.
- create database tables: `php artisan migrate`.

## APIs testing

- Create a row on the carts table.
- Create multiple rows on the products table.
- Testing https://localhost:8000/carts/{cart_id} POST API to add a product to the cart. Enter the following attributes: `product_id, quantity`.
- Testing https://localhost:8000/carts/{cart_id} PUT API to edit a product on the cart. Enter the following attributes: `product_id, quantity, row_id`.
- Testing https://localhost:8000/carts/{cart_id} DELETE API to delete a product from the cart. To do this maneuver you should have the `row_id`.
- Add a row to the discounts table. Run `php artisan db:seed --class=DiscountSeeder`.
- Testing https://localhost:8000/carts/{cart_id}/discount POST API to Attach the discount=TestDevinweb to a the cart and return the response. To do this maneuver you should send the `discount_code` in our case is "TestDevinweb".
- Testing https://localhost:8000/carts/{cart_id} GET API to get the cart content. The returned object shloud follow this from:

```{
    "cart": {
        "identifier": 1,
        "items": [
            {
                "row_id": "SYxDRWGTKVkTwRtuecjF",
                "product_id": 2,
                "qty": 6,
                "price": 100,
                "options": [
                    "public_urlB1",
                    "public_urlB2"
                ],
                "tax": 30,
                "subtotal": 630
            },
            {
                "row_id": "SYxDRWGTKVkTwRtuesds",
                "product_id": 1,
                "qty": 1,
                "price": 150,
                "options": [
                    "public_urlA1",
                    "public_urlA2"
                ],
                "tax": 7.5,
                "subtotal": 157.5
            }
        ],
        "discount": [
            {
                "code": "TestDevinweb",
                "discounted_amount": 25,
                "value": 10
            }
        ],
        "summary": {
            "discount_amount": 25,
            "tax": 37.5,
            "total_amount": 725
        }
    }
}
```