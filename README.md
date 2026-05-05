# CalorieTrack 🍎

Веб-приложение для отслеживания суточного потребления калорий и макронутриентов. CalorieTrack помогает пользователям контролировать свой рацион питания, отслеживать калорийность продуктов и планировать здоровое питание.

## 📋 Содержание

- [Описание проекта](#описание-проекта)
- [Основные функции](#основные-функции)
- [Технологический стек](#технологический-стек)
- [Требования](#требования)
- [Установка и запуск](#установка-и-запуск)
- [Структура проекта](#структура-проекта)
- [API Endpoints](#api-endpoints)
- [Разработка](#разработка)

## 📱 Описание проекта

**CalorieTrack** — это полнофункциональное веб-приложение для управления рационом питания. Приложение позволяет:

- Создавать профиль пользователя с учетом персональных данных (вес, рост, возраст, пол, уровень активности)
- Добавлять продукты в базу данных с указанием калорийности и макронутриентов
- Отслеживать приемы пищи (завтрак, обед, ужин, перекусы)
- Анализировать потребление калорий и макронутриентов
- Администраторам управлять базой данных продуктов и уровнями активности

## 🎯 Основные функции

### Для пользователей

- 🔐 **Аутентификация** — регистрация и вход в приложение
- 👤 **Профиль** — управление личными данными (вес, рост, возраст, пол, уровень активности)
- 🍽️ **Отслеживание питания** — добавление и удаление продуктов из приемов пищи
- 📊 **Статистика** — анализ потребления калорий и макронутриентов
- 🔍 **Поиск продуктов** — быстрый поиск по базе данных продуктов

### Для администраторов

- 📦 **Управление продуктами** — добавление, редактирование и удаление продуктов
- ⚙️ **Уровни активности** — управление доступными уровнями активности

## 🛠️ Технологический стек

### Backend

- **Framework**: Laravel 12.x
- **PHP**: >=8.2
- **Database**: SQLite/MySQL
- **Authentication**: Laravel Sanctum (API tokens)
- **Validation**: Laravel Request Validation
- **Testing**: PHPUnit
- **Styling**: Tailwind CSS (backend resources)

### Frontend

- **Framework**: Vue 3
- **Build Tool**: Vite
- **Routing**: Vue Router 5
- **State Management**: Pinia
- **HTTP Client**: Axios
- **CSS Framework**: Tailwind CSS
- **Components**: Swiper (для слайдеров)
- **Node**: ^20.19.0 || >=22.12.0

## 📦 Требования

### Для разработки

- **PHP**: 8.2 или выше
- **Node.js**: 20.19.0 или выше / 22.12.0 или выше
- **npm**: 9.x или выше
- **Composer**: последняя версия

### Для продакшена

- **Web Server**: Nginx или Apache
- **Database**: MySQL 5.7+ или SQLite
- **SSL/TLS**: рекомендуется

## 🚀 Установка и запуск

### 1. Клонирование проекта

```bash
git clone <repository-url>
cd CalorieTrack
```

### 2. Установка и настройка Backend

```bash
cd backend

# Установка зависимостей PHP
composer install

# Копирование файла окружения
cp .env.example .env

# Генерация ключа приложения
php artisan key:generate

# Установка зависимостей Node.js
npm install

# Запуск миграций и сидеров
php artisan migrate --seed
```

### 3. Установка и настройка Frontend

```bash
cd ../frontend

# Установка зависимостей
npm install
```

### 4. Запуск приложения в режиме разработки

**Из директории backend:**

```bash
npm run dev
```

Эта команда запустит параллельно:

- Laravel сервер (http://localhost:8000)
- Queue listener для фоновых задач
- Vite dev server для backend ресурсов
- Vite dev server для frontend

**Альтернативно, из корня проекта:**

```bash
# Backend
cd backend && composer dev

# Frontend (в другом терминале)
cd frontend && npm run dev
```

Frontend будет доступен по адресу: http://localhost:5173 (или другой порт, указанный Vite)

### 5. Построение для продакшена

```bash
# Backend
cd backend
npm run build

# Frontend
cd frontend
npm run build
```

### 6. Запуск тестов

```bash
cd backend
composer test
```

## 📁 Структура проекта

```
CalorieTrack/
├── backend/                          # Laravel приложение
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/         # API контроллеры
│   │   │   │   └── Api/
│   │   │   │       ├── V1/          # API версия 1
│   │   │   │       └── ...
│   │   │   ├── Middleware/          # HTTP middleware
│   │   │   └── Requests/            # Form requests
│   │   ├── Models/
│   │   │   ├── User.php             # Модель пользователя
│   │   │   ├── Product.php          # Модель продукта
│   │   │   ├── Meal.php             # Модель приема пищи
│   │   │   ├── MealItem.php         # Модель позиции приема пищи
│   │   │   └── ActivityLevel.php    # Модель уровня активности
│   │   └── Providers/
│   ├── config/                       # Конфигурационные файлы
│   ├── database/
│   │   ├── migrations/              # Миграции БД
│   │   ├── seeders/                 # Сидеры для инициализации данных
│   │   └── factories/               # Фабрики для тестирования
│   ├── routes/
│   │   ├── api.php                  # Основные API маршруты
│   │   ├── api/
│   │   │   ├── auth.php            # Аутентификация
│   │   │   ├── users.php           # Пользователи
│   │   │   ├── products.php        # Продукты
│   │   │   ├── meals.php           # Приемы пищи
│   │   │   └── activityLevels.php  # Уровни активности
│   │   ├── web.php                  # Web маршруты
│   │   └── console.php              # Консольные команды
│   ├── tests/                        # Тесты
│   ├── storage/                      # Кэш, логи, загружаемые файлы
│   ├── bootstrap/                    # Инициализация приложения
│   ├── .env.example                  # Пример файла окружения
│   ├── composer.json                 # PHP зависимости
│   ├── package.json                  # Node.js зависимости для backend ресурсов
│   └── vite.config.js               # Конфигурация Vite для backend
│
├── frontend/                         # Vue 3 приложение
│   ├── src/
│   │   ├── components/              # Переиспользуемые компоненты
│   │   ├── pages/
│   │   │   ├── admin/               # Админ-панель
│   │   │   ├── auth/                # Аутентификация
│   │   │   ├── dashboard/           # Главная страница
│   │   │   ├── nutrition/           # Отслеживание питания
│   │   │   ├── products/            # Каталог продуктов
│   │   │   └── layouts/             # Макеты страниц
│   │   ├── router/                  # Маршруты Vue Router
│   │   ├── stores/                  # Pinia хранилище состояния
│   │   ├── assets/                  # Статические ассеты
│   │   ├── api.js                   # Axios конфигурация и API клиент
│   │   ├── App.vue                  # Корневой компонент
│   │   └── main.js                  # Точка входа приложения
│   ├── public/                       # Статические файлы
│   ├── index.html                    # HTML точка входа
│   ├── package.json                  # Node.js зависимости
│   ├── vite.config.js               # Конфигурация Vite
│   ├── jsconfig.json                # Конфигурация JavaScript
│   └── README.md                     # README frontend
│
└── README.md                         # Этот файл
```

## 🔌 API Endpoints

### Аутентификация

- `POST /api/v1/auth/register` — регистрация нового пользователя
- `POST /api/v1/auth/login` — вход в приложение
- `POST /api/v1/auth/logout` — выход из приложения

### Пользователи

- `GET /api/v1/users/me` — получить данные текущего пользователя
- `PUT /api/v1/users/{id}` — обновить профиль пользователя

### Продукты

- `GET /api/v1/products` — получить список продуктов (с фильтрацией и поиском)
- `POST /api/v1/products` — добавить новый продукт (admin only)
- `PUT /api/v1/products/{id}` — обновить продукт (admin only)
- `DELETE /api/v1/products/{id}` — удалить продукт (admin only)

### Приемы пищи

- `GET /api/v1/meals` — получить приемы пищи пользователя
- `POST /api/v1/meals` — создать новый прием пищи
- `GET /api/v1/meals/{id}` — получить детали приема пищи
- `PUT /api/v1/meals/{id}` — обновить прием пищи
- `DELETE /api/v1/meals/{id}` — удалить прием пищи

### Позиции приема пищи

- `POST /api/v1/meals/{mealId}/items` — добавить продукт в прием пищи
- `DELETE /api/v1/meals/{mealId}/items/{itemId}` — удалить продукт из приема пищи

### Уровни активности

- `GET /api/v1/activityLevels` — получить доступные уровни активности

### Получение текущего пользователя

- `GET /api/user` — получить данные текущего авторизованного пользователя

## 💻 Разработка

### Использованные средства и библиотеки

**Backend:**

- Laravel Sanctum — управление API токенами
- Laravel Pint — форматирование кода
- PHPUnit — тестирование
- Faker — генерация фиктивных данных
- Tinker — интерактивная оболочка

**Frontend:**

- Vue Router — маршрутизация
- Pinia — управление состоянием
- Axios — HTTP клиент
- Vite — быстрая разработка и сборка

### Добавление новой функции

1. Создайте миграцию (если нужны изменения в БД):

   ```bash
   php artisan make:migration create_table_name
   ```

2. Создайте модель и контроллер:

   ```bash
   php artisan make:model ModelName -c
   ```

3. Определите маршруты в `/backend/routes/api/`

4. Создайте Vue компоненты и страницы

5. Добавьте тесты:
   ```bash
   php artisan make:test FeatureNameTest
   ```

### Запуск отдельных компонентов

```bash
# Только Laravel сервер
cd backend
php artisan serve

# Только Vite для backend ресурсов
cd backend
npm run dev

# Только Vite для frontend
cd frontend
npm run dev

# Только очередь обработки задач
cd backend
php artisan queue:listen --tries=1 --timeout=0

# Только логирование
cd backend
php artisan pail
```

## 🐛 Решение проблем

### Port уже занят

Если порт 8000 занят, используйте:

```bash
php artisan serve --port=8001
```

### Проблемы с базой данных

Переинициализируйте БД:

```bash
php artisan migrate:fresh --seed
```

### Очистка кэша

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📝 Лицензия

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💼 Автор

CalorieTrack разработан как полнофункциональное приложение для управления питанием с использованием современного веб-стека.

## 📞 Поддержка

Для вопросов и предложений используйте систему Issues или свяжитесь с автором проекта.

---

**Спасибо за использование CalorieTrack! 🙏**
