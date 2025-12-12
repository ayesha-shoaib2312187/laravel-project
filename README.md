# Project Documentation

##  Project Overview

This Laravel e‑commerce application provides a complete product browsing and shopping experience. It includes product listing, product details with reviews, a session-based cart system, a checkout flow, contact form, and informational policy pages. The project also includes API endpoints for accessing product and review data.

The goal of the application is to demonstrate core Laravel concepts, including:

* MVC structure
* CRUD operations
* Routing (web + API)
* Blade templating
* Database migrations
* Session management (Cart)
* Basic relationships (e.g., Product → Reviews)

---

##  Setup Instructions

Follow the steps below to run this project locally:

### **1. Clone the Repository**

```bash
git clone https://github.com/<username>/<repository>.git
cd <repository>
```

### **2. Install PHP & Node Dependencies**

```bash
composer install
npm install
npm run dev
```

### **3. Configure the Environment File**

```bash
cp .env.example .env
php artisan key:generate
```

Set your database credentials inside the `.env` file:

```
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### **4. Run Database Migrations**

```bash
php artisan migrate --seed
```

### **5. Start the Development Server**

```bash
php artisan serve
```

Visit the project in your browser:

```
http://127.0.0.1:8000
```

---

## Usage Guide

This section explains how to use each module of the application.

### **Products Module**

* View all products on the homepage
* Click any product to view details
* Add product to cart from detail page

### **Cart System**

* View your cart
* Increase or decrease quantity
* Remove items
* Proceed to checkout

### **Checkout**

* Fill checkout form
* Confirm order

### **Contact Form**

* Submit a message via the contact page
* Message is stored in the database

### **Reviews**

* Users can add reviews on product detail page
* Reviews are linked to specific products

### **Policies Section**

* View Privacy Policy
* View Return/Refund Policy
* View Terms & Conditions

### **APIs (Basic Usage)**

Example endpoints:

```
/api/products
/api/products/{id}
/api/products/{id}/reviews
/api/policies
```

Use these endpoints to fetch JSON data.

---

