# Education Journal

## Описание проекта

Это полный проект образовательного журнала на базе Laravel, упакованный в Docker для удобного развертывания. Проект включает API для управления лекциями, учебными программами, студентами и классами.

## Архитектура

- **src/** - Основное Laravel-приложение
- **docker-compose.yml** - Конфигурация Docker для запуска сервисов
- **.gitignore** - Исключаемые файлы для Git

## Основные возможности

- **Лекции (Lectures)**: CRUD операции с лекциями.
- **Учебные программы (Training Programs)**: Управление программами обучения.
- **Элементы программ (Training Program Items)**: Связывание лекций с программами.
- **Студенты (Students)**: Управление списком студентов.
- **Классы (Training Classes)**: Организация учебных классов.

## Технологии

- **Laravel 12** - Фреймворк для backend API.
- **PHP 8.2** - Язык программирования.
- **MySQL/SQLite** - База данных.
- **Docker & Docker Compose** - Контейнеризация.
- **Composer** - Менеджер зависимостей PHP.

## Установка и запуск

### С Docker (рекомендуется)

1. Убедитесь, что Docker и Docker Compose установлены.

2. Клонируйте репозиторий:
   ```bash
   git clone https://github.com/kondykov/education-journal
   cd education-journal
   ```

3. Запустите контейнеры:
   ```bash
   docker-compose up -d
   ```

4. Приложение будет доступно по адресу: `http://localhost:8000`

### Без Docker (локально)

1. Перейдите в папку приложения:
   ```bash
   cd src
   ```

2. Установите зависимости:
   ```bash
   composer install
   ```

3. Настройте окружение:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Запустите миграции:
   ```bash
   php artisan migrate
   ```

5. Запустите сервер:
   ```bash
   php artisan serve
   ```

### С использованием Docker для команд (рекомендуется для разработки)

Если вы используете Docker, все команды PHP и Composer выполняются из контейнера:

1. Установка зависимостей:
   ```bash
   docker-compose exec app composer install
   ```

2. Генерация ключа приложения:
   ```bash
   docker-compose exec app php artisan key:generate
   ```

3. Запуск миграций:
   ```bash
   docker-compose exec app php artisan migrate
   ```

4. Генерация Postman коллекции:
   ```bash
   docker-compose exec app php artisan postman:generate
   ```

## Генерация Postman Collection

Для генерации коллекции Postman используйте команду:

```bash
php artisan postman:generate
```

## Структура проекта

- `src/app/Models/` - Модели Eloquent
- `src/app/Http/Controllers/` - Контроллеры API
- `src/app/Services/` - Бизнес-логика
- `src/database/migrations/` - Миграции базы данных
- `src/routes/api.php` - Маршруты API
- `docker-compose.yml` - Конфигурация контейнеров

## Разработка

- Используйте `docker-compose exec app bash` для входа в контейнер приложения.
- Логи Laravel находятся в `src/storage/logs/`.
- Для тестирования используйте `php artisan test` внутри контейнера.

## Лицензия

MIT
