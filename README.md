# Laravel Task Manager

A production-ready Task Management application built with **Laravel 11**, **TailwindCSS**, and **SortableJS**.

## Features
- **Task CRUD**: Create, Read, Update, Delete tasks effortlessly.
- **Projects**: Organize tasks into specific projects.
- **Drag & Drop Reordering**: Uses `SortableJS` to allow intuitive reordering of tasks. The order is persisted automatically.
- **Optimized Database**: Uses indexed priority columns and foreign key constraints for performance and integrity.
- **Validation**: Strict server-side validation using FormRequests.

## 🚀 Running on GitHub Codespaces (Recommended)
This project is optimized for GitHub Codespaces.

1.  **Open in Codespaces**:
    - Push this code to a GitHub repository.
    - Click "Code" -> "Codespaces" -> "Create codespace on main".

2.  **Setup Environment**:
    Codespaces usually handles the environment, but you'll need to set up the app:
    ```bash
    cp .env.example .env
    composer install
    php artisan key:generate
    touch database/database.sqlite
    ```

3.  **Configure Database**:
    Edit `.env` to use SQLite (easiest for Codespaces) OR use the default MySQL service if available.
    
    *For SQLite (Recommended for instant setup):*
    ```ini
    DB_CONNECTION=sqlite
    # DB_HOST=... (remove or comment out host/port/database/username/password)
    ```

4.  **Run Migrations & Seed**:
    ```bash
    php artisan migrate --seed
    ```

5.  **Serve**:
    ```bash
    php artisan serve
    ```
    Click the "Open in Browser" popup to view the app.

## 💻 Running Locally
Requirements: PHP 8.3+, Composer, MySQL.

1.  **Install Dependencies**:
    ```bash
    composer install
    ```
2.  **Environment**:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
3.  **Database**:
    - Create a database (e.g., `task_manager`).
    - Update `.env` with your DB credentials.
4.  **Migrate**:
    ```bash
    php artisan migrate --seed
    ```
5.  **Serve**:
    ```bash
    php artisan serve
    ```
    Go to http://localhost:8000

## Architecture
- **MVC Pattern**: Strict separation of concerns.
- **Controllers**: `TaskController` handles business logic.
- **Models**: `Task` and `Project` with Eloquent relationships.
- **Views**: Blade templates located in `resources/views/tasks`.
