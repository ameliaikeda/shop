# Shop

An online store implementation as a package; made for Laravel 5 (but usable elsewhere)

## Installation

Open your app.php config file and add `'Amelia\Shop\ShopServiceProvider'` to your `providers` array.

*(Optional): add `'Cart' => 'Amelia\Shop\Facades\Cart'` to your facades to use `Cart::add()`, etc.*

Publish everything in the package by running `php artisan shop:publish "My Store Name"`. You can change this with `php artisan shop:rename "New Name"`.

If you want to publish everything manually, run:

```zsh
php artisan config:publish amelia/shop
php artisan view:publish amelia/shop
php artisan asset:publish amelia/shop
php artisan migrate --package="amelia/shop"
```

If you want controllers to be added, run `php artisan shop:controllers [--update]` (update will attempt to overwrite published controllers). Alternatively, you can run `php artisan shop:publish "My Shop Name" --controllers` to include them while creating the shop

Happy coding!

## License

This package is licensed under the [MIT License](http://opensource.org/licenses/MIT).

tl;dr for non-lawyers: do what you like (commercial, proprietary inclusion), but I'm not responsible.