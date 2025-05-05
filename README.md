# 🚗 AutoParts Marketplace - Backend API

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-✓-2496ED?logo=docker&logoColor=white)
![License](https://img.shields.io/badge/license-MIT-blue)

## 🌐 Bilingual README
- [English Version](#-english-version)
- [Versão em Português](#-versão-em-português)

---

## 🇬🇧 English Version

### 📌 Table of Contents
- [Key Features](#-key-features)
- [Technology Stack](#-technology-stack)
- [Getting Started](#-getting-started)
- [API Endpoints](#-api-endpoints)
- [Testing](#-testing)
- [Project Architecture](#-project-architecture)
- [How to Contribute](#-how-to-contribute)
- [License](#-license)
- [About the Developer](#-about-the-developer)

### ✨ Key Features

#### 🔐 Authentication System
- JWT Token-based authentication
- User registration and login
- Password reset functionality

#### 🚘 Auto Parts Management
- Specialized fields for vehicle compatibility
- Product categorization by vehicle type
- Inventory tracking system

#### 🛒 E-Commerce Features
- Shopping cart persistence
- Order processing workflow
- Transaction history

### 🛠 Technology Stack

#### Core Technologies
| Component       | Technology |
|----------------|------------|
| Backend        | Laravel 10 |
| Database       | MySQL 8.0  |
| Cache          | Redis      |
| Containerization | Docker   |

#### Development Tools
- **API Testing**: Insomnia/Postman
- **Testing Framework**: PHPUnit
- **CI/CD**: GitHub Actions

### 🚀 Getting Started

#### Prerequisites
- Docker 20.10+
- Docker Compose 2.0+
- Git

#### Installation Guide
```bash
# Clone the repository
git clone https://github.com/LorenzoHzK/autoparts-marketplace.git
cd autoparts-marketplace

# Setup environment
cp .env.example .env
docker-compose up -d --build

# Enter the container
docker exec -it autoparts-app bash

# Install dependencies
composer install
php artisan key:generate
php artisan migrate --seed

Access the API at: http://localhost:8080
```
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

![image](https://github.com/user-attachments/assets/b1146715-33f1-4afe-8208-164496e3d902)
![image](https://github.com/user-attachments/assets/35d510a9-a857-4e99-9799-2ed8811c4f6f)
