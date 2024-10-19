# Laravel API Documentation

## Overview

This is a simple Laravel API for managing products and orders.

## API Endpoints

### Products

- **GET /api/products**
    - **Description:** Retrieve a list of products with pagination.
    - **Response:** JSON array of products.

- **POST /api/products**
    - **Description:** Create a new product.
    - **Request Body:**
      ```json
      {
        "name": "Product Name",
        "price": 100.00,
        "quantity": 50
      }
      ```
    - **Response:** JSON object of the created product.

### Orders

- **POST /api/orders**
    - **Description:** Place a new order.
    - **Request Body:**
      ```json
      {
        "customer_name": "John Doe",
        "customer_email": "john@example.com",
        "products": [
          {
            "id": 1,
            "quantity": 2
          }
        ]
      }
      ```
    - **Response:** JSON object of the created order.

- **GET /api/orders/{id}**
    - **Description:** Retrieve order details.
    - **Response:** JSON object of the order.

## Authentication

- Use **Laravel Sanctum** for API authentication. Include a Bearer token in the Authorization header for protected routes.

## Testing

- To run the tests, use the command:
  ```bash
  php artisan test

## Installation

Follow these steps to set up the Laravel project locally:

### Prerequisites

- PHP (version 8.0 or higher)
- Composer (version 2.x)
- MySQL (or any other supported database)
- Laravel (recommended: global installation of the Laravel installer)

### Steps to Install

1. **Clone the Repository:**
   Clone the repository to your local machine using Git:
   ```bash
   git clone <repository-url>

2. Navigate to the Project Directory: Change into the project directory:

    ```bash
- Copy code
- cd <project-directory>
3. Install Composer Dependencies: Run the following command to install PHP dependencies:

```bash
- Copy code
- composer install
4. Set Up Your Environment File: Copy the example environment file to create your own:

    ```bash
-Copy code
-cp .env.example .env
5. Generate Application Key: Generate an application key for your Laravel project:

```bash
-Copy code
-php artisan key:generate
7. Configure Database: Open the .env file in a text editor and update the database connection settings:

dotenv
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
Run Migrations: Run the database migrations to set up the initial database structure:



```bash
Copy code
npm run dev
Serve the Application: Start the local development server:

bash
Copy code
php artisan serve


