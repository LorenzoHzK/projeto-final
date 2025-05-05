
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

### 📡 API Endpoints

#### Authentication
```http
POST /api/auth/register    - Register new account
POST /api/auth/login       - User authentication
```

#### Products
```http
GET  /api/products         - List all auto parts
POST /api/products         - Create new product entry
```

#### Orders
```http
POST /api/cart             - Add item to cart
POST /api/orders           - Create new order
```

### 🧪 Testing

Run the test suite with:

```bash
php artisan test
```

**Test Coverage Includes:**
- Authentication tests
- Product CRUD operations
- Order processing workflow
- Cart management tests

### 📂 Project Architecture

```bash
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
```

### 👨‍💻 About the Developer

**Matheus Lorenzo Siqueira**  
Full Stack Developer specialized in Laravel.

[![GitHub](https://img.shields.io/badge/GitHub-@LorenzoHzK-181717?logo=github)](https://github.com/LorenzoHzK)  
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Perfil-0A66C2?logo=linkedin)](https://www.linkedin.com/in/matheuslorenzodeveloper)

---

## 🇧🇷 Versão em Português

### 📋 Sumário
- [Funcionalidades](#-funcionalidades)
- [Tecnologias](#-tecnologias-utilizadas)
- [Instalação](#-instalação)
- [Rotas da API](#-rotas-da-api)
- [Testes](#-testes)
- [Estrutura](#-estrutura-do-projeto)
- [Contribuição](#como-contribuir)
- [Licença](#-licença)
- [Autor](#autor)

### ✨ Funcionalidades

#### 👤 Gestão de Usuários
- Autenticação via JWT
- Cadastro e login de usuários
- Recuperação de senha

#### 🛠 Catálogo de Autopeças
- Campos específicos para compatibilidade veicular
- Categorização por marca/modelo
- Controle de estoque integrado

#### 🛒 Sistema de Vendas
- Carrinho de compras persistente
- Fluxo completo de pedidos
- Histórico de transações

### 🛠 Tecnologias Utilizadas

| Componente     | Tecnologia |
|----------------|------------|
| Backend        | Laravel 10 |
| Banco de Dados | MySQL 8.0  |
| Cache          | Redis      |
| Containerização| Docker     |

#### Ferramentas
- Testes de API: Insomnia/Postman
- Testes Unitários: PHPUnit
- CI/CD: GitHub Actions

### 🚀 Instalação

#### Pré-requisitos
- Docker 20.10+
- Docker Compose 2.0+
- Git

```bash
# Clonar repositório
git clone https://github.com/LorenzoHzK/autoparts-marketplace.git
cd autoparts-marketplace

# Configurar ambiente
cp .env.example .env
docker-compose up -d --build

# Acessar container
docker exec -it autoparts-app bash

# Instalar dependências
composer install
php artisan key:generate
php artisan migrate --seed

Acesse a API em: http://localhost:8080
```

### 📡 Rotas da API

#### Autenticação
```http
POST /api/auth/register   - Registrar usuário
POST /api/auth/login      - Login de usuário
```

#### Produtos
```http
GET  /api/products        - Listar autopeças
POST /api/products        - Cadastrar nova peça
```

#### Pedidos
```http
POST /api/cart            - Adicionar ao carrinho
POST /api/orders          - Finalizar pedido
```

### 🧪 Testes

Execute os testes com:
```bash
php artisan test
```

**Cobertura de Testes:**
- Autenticação de usuários
- Operações CRUD de produtos
- Fluxo de processamento de pedidos
- Testes de gerenciamento de carrinho

### 📂 Estrutura do Projeto

```bash
autoparts-marketplace/
├── app/
│   ├── Http/
│   │   ├── Controllers/   # Controladores
│   │   └── Middleware/    # Middlewares
│   ├── Models/            # Modelos Eloquent
│   └── Services/          # Lógica de negócio
├── config/                # Configurações
├── database/
│   ├── factories/         # Factories
│   ├── migrations/        # Migrations
│   └── seeders/           # Seeders
├── routes/                # Rotas
├── tests/                 # Testes
└── docker/                # Config Docker
```

### 👨‍💻 Sobre o Desenvolvedor

**Matheus Lorenzo Siqueira**  
Full Stack Developer.

[![GitHub](https://img.shields.io/badge/GitHub-@LorenzoHzK-181717?logo=github)](https://github.com/LorenzoHzK)  
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Perfil-0A66C2?logo=linkedin)](https://www.linkedin.com/in/matheuslorenzodeveloper)
