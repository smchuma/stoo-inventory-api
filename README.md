# Stoo API

## Overview

Stoo API is a Laravel 11-powered inventory management system designed to help manage and track store inventory and sales. The system includes two roles:

-   **Admin**: Manage inventory, register users, and oversee the system.
-   **Salesperson**: View available products and record sales transactions.

The API uses Laravel Sanctum for secure token-based authentication.

---

## Features

### Admin

-   Manage inventory (add, update, delete items).
-   Categorize items into categories.
-   Register users and assign roles.
-   Manage suppliers.
-   View audit logs and generate reports.

### Salesperson

-   View available products.
-   Record sales transactions.
-   View personal sales history.

---

## Installation

### Prerequisites

-   PHP 8.2+
-   Composer
-   A database MongoDB
-   Laravel 11

### Steps

1. Clone the repository:

    ```bash
    git clone https://github.com/your-repo/Stoo-api.git
    cd Stoo-api
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Set up environment variables:

    - Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    - Update database credentials and other settings in `.env`.

4. Run migrations:

    ```bash
    php artisan migrate
    ```

5. Install Laravel Sanctum:

    ```bash
    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
    ```

6. Start the development server:
    ```bash
    php artisan serve
    ```

---

## API Endpoints

### Authentication

-   **POST** `/api/login`: Log in a user.
-   **POST** `/api/logout`: Log out the authenticated user.

### Admin Endpoints

-   **GET** `/api/dashboard`: Fetch dashboard data.
-   **POST** `/api/items`: Add a new item.
-   **PUT** `/api/items/{id}`: Update an existing item.
-   **DELETE** `/api/items/{id}`: Delete an item.
-   **GET** `/api/categories`: Fetch all categories.
-   **POST** `/api/categories`: Add a new category.
-   **POST** `/api/users`: Register a new user.
-   **POST** `/api/suppliers`: Add a new supplier.
-   **GET** `/api/reports`: Fetch reports.
-   **GET** `/api/audit-logs`: View system activity logs.

### Sales Endpoints

-   **GET** `/api/products`: Fetch all available products.
-   **POST** `/api/sales`: Record a sale.
-   **GET** `/api/sales/history`: View personal sales history.

---

## Usage

### Authentication Flow

1. **Login**: Use `/api/login` to get a token for authenticated requests.
    - Request:
        ```json
        {
            "email": "user@example.com",
            "password": "password"
        }
        ```
    - Response:
        ```json
        {
            "token": "your-access-token"
        }
        ```
2. Include the token in the `Authorization` header for subsequent requests:
    ```
    Authorization: Bearer your-access-token
    ```
3. To log out, send a `POST` request to `/api/logout`.

---

## Development Notes

### Relationships

-   **User** belongs to a `Role`.
-   **Item** belongs to a `Category` and a `Supplier`.
-   **Sale** belongs to an `Item` and a `User`.
-   **AuditLog** belongs to a `User`.

### Middleware

-   Sanctum is used for API authentication.
-   Role-based access control ensures only authorized users can access admin or sales endpoints.

---

## Contribution

If you'd like to contribute:

1. Fork the repository.
2. Create a feature branch.
3. Submit a pull request with detailed descriptions of your changes.

---

## License

This project is open-source and available under the [MIT License](LICENSE).
