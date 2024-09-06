
# SereneCart

SereneCart is a feature-rich e-commerce platform built with Laravel. It provides a seamless shopping experience for users and a robust management system for administrators. The platform supports user authentication, product management, cart operations, and order processing.


## Features
### User Features
- Browse Products: View a catalog of products.
- Product Details: Get detailed information about individual products.
- Search Products: Search for products using keywords.
- Add to Cart: Add products to your shopping cart.
- View Cart: Review items in your cart.
- Remove from Cart: Remove items from your cart.
- Place Orders: Place orders using cash or electronic payment methods (Future Enhancement).
- View Orders: Track and view past orders.
- Cancel Orders: Cancel pending orders.
- Manage Wishlist: Add products to and remove them from your wishlist.

### Admin Features
- Category Management: View, add, and delete product categories.
- Product Management: View, add, update, and delete products.
- Order Management: View all orders, mark orders as delivered, and print order details as PDF.
- Search Orders: Search for orders based on criteria.
- Search Products: Search for products in the admin panel.

### Authentication & Authorization
- User Authentication: Secure user login and registration.
- Admin Access: Restricted access to product and order management for administrators.
- User Access: Restricted cart and order operations for authenticated users.

## Screenshots

![App Screenshot](https://raw.githubusercontent.com/rewaj56/serenecart/main/screenshots/screenshot1.PNG)

![App Screenshot](https://raw.githubusercontent.com/rewaj56/serenecart/main/screenshots/screenshot2.PNG)

![App Screenshot](https://raw.githubusercontent.com/rewaj56/serenecart/main/screenshots/screenshot3.PNG)

![App Screenshot](https://raw.githubusercontent.com/rewaj56/serenecart/main/screenshots/screenshot4.PNG)


## Prerequisites
- **PHP >= 7.4 (7.4.33)**
- **Composer**
- **MySQL**
- **WAMP / XAMPP (for local development)**
## Run Locally

Clone the project

```bash
  git clone https://github.com/rewaj56/serenecart.git
```

Go to the project directory

```bash
  cd serenecart
```

Install dependencies

```bash
  composer install
```

Create Environment File
```bash
  cp .env.example .env
  (Configure your database and other settings in the .env file.)
```

Generate Application Key
```bash
  php artisan key:generate
```

Import the Database from phpMyAdmin
```bash
  File: db.sql
```

Run the project
```bash
  php artisan serve
```



## License

[MIT](https://choosealicense.com/licenses/mit/)

