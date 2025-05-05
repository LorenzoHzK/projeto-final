# 🚗 AutoParts Marketplace - Backend API

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20.svg?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4.svg?logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1.svg?logo=mysql)
![Docker](https://img.shields.io/badge/Docker-✓-2496ED.svg?logo=docker)
![License](https://img.shields.io/badge/license-MIT-blue.svg)

A robust backend API for an auto parts e-commerce platform built with Laravel 10.

## 📌 Table of Contents
- [Key Features](#-key-features)
- [Technology Stack](#-technology-stack)
- [Getting Started](#-getting-started)
- [API Endpoints](#-api-endpoints)
- [Testing](#-testing)
- [Project Architecture](#-project-architecture)
- [How to Contribute](#-how-to-contribute)
- [License](#-license)
- [About the Developer](#-about-the-developer)

## ✨ Key Features

### 🔐 Authentication System
- JWT Token-based authentication
- User registration and login
- Password reset functionality

### 🚘 Auto Parts Management
- Specialized fields for vehicle compatibility
- Product categorization by vehicle type
- Inventory tracking system

### 🛒 E-Commerce Features
- Shopping cart persistence
- Order processing workflow
- Transaction history

## 🛠 Technology Stack

### Core Technologies
| Component       | Technology |
|----------------|------------|
| Backend        | Laravel 10 |
| Database       | MySQL 8.0  |
| Cache          | Redis      |
| Containerization | Docker   |

### Development Tools
- **API Testing**: Insomnia/Postman
- **Testing Framework**: PHPUnit
- **CI/CD**: GitHub Actions

## 🚀 Getting Started

### Prerequisites
- Docker 20.10+
- Docker Compose 2.0+
- Git

### Installation Guide
```bash
# Clone the repository
git clone https://github.com/LorenzoHzK/autoparts-marketplace.git
cd autoparts-marketplace

# Setup environment
cp .env.example .env
docker-compose up -d --build

# Enter the container
docker exec -it autoparts-app bash

# Install dependencies and setup
composer install
php artisan key:generate
php artisan migrate --seed
Access the API at: http://localhost:8080

📚 API Endpoints
Authentication
Method	Endpoint	Description
POST	/api/auth/register	Register new account
POST	/api/auth/login	User authentication
Products
Method	Endpoint	Description
GET	/api/products	List all auto parts
POST	/api/products	Create new product entry
Orders
Method	Endpoint	Description
POST	/api/cart	Add item to cart
POST	/api/orders	Create new order
Note: Complete API documentation available in API_DOCS.md

🧪 Testing
Run the test suite with:

bash
php artisan test
Test Coverage Includes:

Authentication tests

Product CRUD operations

Order processing workflow

Cart management tests

📂 Project Architecture
autoparts-marketplace/
├── app/
│   ├── Http/
│   │   ├── Controllers/   # API controllers
│   │   └── Middleware/    # Custom middleware
│   ├── Models/            # Eloquent models
│   └── Services/          # Business logic
├── config/                # Configuration files
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database schemas
│   └── seeders/           # Test data
├── routes/                # API routes
├── tests/                 # Feature & unit tests
└── docker/                # Docker configuration

👨‍💻 About the Developer
Matheus Lorenzo Siqueira
Full Stack Developer specializing in Laravel applications.

![image](https://github.com/user-attachments/assets/39710c94-3220-423b-ab50-44a8e5bd50d0)
![image](https://github.com/user-attachments/assets/3f70f38e-cbae-4196-b4ae-ea6f3f85ebca)
