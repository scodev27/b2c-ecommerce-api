# B2C E-Commerce Platform API

A lightweight, decoupled B2C e-commerce platform built with Symfony. This project serves as a complete backend solution for managing a digital storefront, featuring a RESTful API, asynchronous background processing, secure payment gateway integration, and an administrative backoffice.

## 🚀 Key Features

*   **Decoupled Architecture:** A clean RESTful API designed to be consumed by any frontend (SPA, Mobile App, etc.).
*   **Asynchronous Processing:** Background workers handle email notifications and non-blocking tasks using Symfony Messenger, ensuring lightning-fast API responses.
*   **Payment Integration:** Server-to-server secure integration with the **Stripe API** for checkout sessions.
*   **Interactive API Docs:** Auto-generated OpenAPI (Swagger) documentation.
*   **Admin Backoffice:** Secure dashboard for inventory and order management.

## 🛠️ Tech Stack

*   **Backend:** PHP, Symfony, Doctrine ORM
*   **Database:** MariaDB / MySQL
*   **Message Broker / Queues:** Symfony Messenger
*   **Payments:** Stripe API
*   **API Documentation:** OpenAPI / NelmioApiDocBundle
*   **Frontend (Demo):** Vanilla JS Single Page Application (SPA)

---

## 🧩 System Architecture

The system follows a microservices-inspired workflow with the following core components:

1.  **Frontend (Client):** A lightweight SPA consuming data via HTTP fetch requests.
2.  **REST API (Backend):** The central core processing business logic and handling authentication.
3.  **Database:** Relational schema storing the catalog, users, and orders (interacted via Doctrine ORM).
4.  **Stripe Gateway:** External service connected via backend to request secure payment sessions.
5.  **Async Worker:** A background process consuming the queue (`messenger_messages`) to dispatch transactional emails without blocking the HTTP request thread.

---

## 📦 Installation & Setup

**Prerequisites:** PHP 8.x, Composer, MariaDB/MySQL, and a Stripe Test Account.

1. **Install dependencies:**
   ```bash
   composer install
   ```

2. **Environment Configuration:** 
   Create a `.env.local` file in the project root to configure your database connection and Stripe keys:
   ```env
   DATABASE_URL="mysql://root:@127.0.0.1:3306/terra_a_casa?serverVersion=mariadb-10.4.0&charset=utf8mb4"
   STRIPE_SECRET_KEY="sk_test_YOUR_STRIPE_KEY"
   ```

3. **Database Initialization:**
   Create the database, update the schema, and setup the messenger transports:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:schema:update --force
   php bin/console messenger:setup-transports
   ```

4. **Load Fixtures (Test Data):**
   Seed the database with an admin user and a base product catalog:
   ```bash
   php bin/console doctrine:fixtures:load --append
   ```
   *Admin Credentials:* `admin@terraacasa.cat` / `123456`

---

## ⚙️ Running the Application

To simulate a full production environment with asynchronous tasks, you need to run three separate processes (terminals):

**Terminal 1: Start the Backend API (Port 8000)**
```bash
symfony server:start
```

**Terminal 2: Start the Async Worker (Message Queue Consumer)**
```bash
php bin/console messenger:consume async -vv --no-debug
```

**Terminal 3: Start the Frontend Client (Port 5500)**
```bash
php -S localhost:5500
```

---

## 📡 API Documentation & Endpoints

The API is fully documented using the OpenAPI standard. Once the backend server is running, you can access the interactive **Swagger UI** at:
👉 `http://localhost:8000/api/doc`

### Core Endpoints

*   `GET /api/products` - Retrieve the catalog list (ID, name, price).
*   `GET /api/products/{id}` - Retrieve detailed product information including stock and images.
*   `POST /api/order` - Create a new order.
    *   *Payload:* `{ "email": "customer@example.com", "product_id": 1 }`
    *   *Action:* Triggers the async email worker and generates a Stripe payment session.
    *   *Response:* Returns a JSON with the `transaction_id` and the Stripe `payment_url`.

## 🗄️ Database Schema

The relational database is built with the following core entities:
*   `user`: Admin credentials (hashed passwords, roles) for Backoffice access.
*   `product`: Store catalog (name, description, price, image, stock).
*   `order`: Order records (customer email, total price, payment status, Stripe `session_id`, timestamp).
*   `messenger_messages`: Symfony's internal table for handling the asynchronous task queue.
