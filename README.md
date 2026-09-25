# 📚 BookMind: Online Bookstore Management System

> A full-stack online bookstore with separate **customer** and **admin** portals: browse and search books by genre, manage a cart, check out, and let admins manage inventory, orders, users and messages.

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?logo=xampp&logoColor=white)

---

## ✨ Features

### 🛒 For customers
- Register and log in (separate user and admin roles)
- Browse the shop with **genre** and **description** for every book
- **Search by title and filter by genre** (Fiction, Non-Fiction, Science, History, Biography)
- **Best Sellers** section that ranks books by the revenue they generated from orders
- Shopping cart: add, update quantities, remove items
- Checkout with delivery details and payment method
- View your order history and payment status
- Contact form to send questions to the store

### 🛠️ For admins
- **Dashboard**: pending vs. completed payments, order count, products, users and admins at a glance
- **Product management**: add books with price, genre, description and cover image; delete books
- **Order management**: update payment status (pending → completed), delete orders
- **User management**: view and remove accounts
- **Messages**: read and delete customer queries

## 🙌 Credits & my contributions

This project builds on the open-source **[tanishahaha/bookstore](https://github.com/tanishahaha/bookstore)** ("Bookiee").
On top of that base, I added:

- 🏷️ **Genres & descriptions** for books (admin form, storage and display)
- 🔎 **Genre filter** in search, combined with title search
- 🏆 A new **Best Sellers** page that ranks books by order revenue
- 🎨 Rebranding to **BookMind**, plus a refreshed UI across the home, shop, login and admin pages
- 🧹 Various fixes and improvements to redirects and page flow

## 🗂️ Project structure

The source code is inside `bookstore-main.zip`:

```
bookstore-main/
├── home.php, shop.php, search_page.php, Best-seller.php, about.php, contact.php
├── cart.php, checkout.php, orders.php          # customer flow
├── admin_page.php, admin_products.php, admin_orders.php,
│   admin_users.php, admin_messages.php         # admin panel
├── login.php, register.php, logout.php         # authentication
├── user_header.php, admin_header.php, footer.php
├── config.php                                  # database connection
├── dbqueries                                   # SQL to create the tables
├── *.css, *.js                                 # styling & interactions
└── uploaded_img/                               # book cover images
```

## 🚀 Run it locally (XAMPP)

1. Install **[XAMPP](https://www.apachefriends.org/)** and start **Apache** and **MySQL**.
2. Unzip `bookstore-main.zip` into `C:\xampp\htdocs\` (you should end up with `htdocs\bookstore-main\`).
3. Open **http://localhost/phpmyadmin**, create a database named **`books`**, open its **SQL** tab and run the
   contents of the `dbqueries` file.
4. Still in the SQL tab, add the two columns used by the genre feature:

   ```sql
   ALTER TABLE `products`
     ADD `genre` VARCHAR(50) NULL,
     ADD `description` TEXT NULL;
   ```

5. Visit **http://localhost/bookstore-main/register.php**, create an account with type **admin**, then another with
   type **user**, and log in.

`config.php` connects with MySQL user `root` and an empty password, which is XAMPP's default. Edit it if yours is different.

## 📝 Notes

- Built as a learning project. Before real-world use, you'd want stronger password hashing (`password_hash()`
  instead of MD5), prepared statements for SQL queries, and admin sign-up restricted to existing admins.
- On Linux servers (which are case-sensitive), rename `Best-seller.php` to `best-seller.php` so that `home.php` can include it.

## 🧰 Tech stack

**PHP** · **MySQL** · **HTML5** · **CSS3** · **JavaScript** · **Font Awesome** · **XAMPP**

## 👩‍💻 Author

**Rishitha Naga Durga Gona**: [@rishithagona28](https://github.com/rishithagona28)
