# Laravel Task Manager Application

**Submission for:** Laravel Web Application Task  
**Tech Stack:** Laravel 11, PHP 8.3, TailwindCSS, MySQL/SQLite, SortableJS

## 📋 Project Overview
This is a production-grade Task Management application built strictly following **MVC architecture** and **Laravel best practices**. It allows users to manage tasks with priorities, ensuring a smooth user experience with drag-and-drop reordering.

### ✅ Features Implemented
1.  **Task Management (CRUD):**
    -   **Create:** Save task name and automatically assign priority (bottom of list).
    -   **Read:** View tasks with formatted timestamps (e.g., "30 minutes ago").
    -   **Update:** Edit task details.
    -   **Delete:** Remove tasks.
2.  **Drag-and-Drop Reordering:**
    -   Integrated `SortableJS` for smooth UI interaction.
    -   **Auto-Update:** Reordering tasks in the browser automatically updates their numeric priority in the database via an AJAX API endpoint.
3.  **Bonus: Project Functionality 🌟**
    -   Tasks are associated with specific Projects.
    -   **Project Filter:** A dropdown menu allows users to filter the view to show only tasks for a selected project.
4.  **Database Engineering:**
    -   MySQL compatible (SQLite configured for instant Codespaces execution).
    -   Indexed `priority` column for fast sorting.
    -   Unit-level Factories and Seeders included.
5.  **Dynamic Environment:**
    -   Automatically detects HTTPS/HTTP to work flawlessly in Cloud IDEs (GitHub Codespaces) and Local environments.

---

## 🚀 Setup & Deployment Instructions

### Option A: Running on GitHub Codespaces (Fastest)
This project comes pre-configured for Codespaces.

1.  Open the terminal.
2.  Install dependencies:
    ```bash
    composer install
    ```
3.  Setup configuration:
    ```bash
    cp .env.example .env
    php artisan key:generate
    touch database/database.sqlite
    ```
4.  Configure Environment:
    -   Open `.env`.
    -   Change `DB_CONNECTION=mysql` to `DB_CONNECTION=sqlite`.
    -   (Optional) Comment out `DB_HOST`, `DB_PORT`, etc.
5.  Migrate & Seed:
    ```bash
    php artisan migrate:fresh --seed
    ```
6.  Start the Server:
    ```bash
    php artisan serve
    ```

### Option B: Running Locally (MacOS/Linux/Windows)
Ensure you have **PHP 8.3+**, **Composer**, and **MySQL** installed.

1.  Navigate to the project folder:
    ```bash
    cd task_manager
    ```
2.  Install Dependencies:
    ```bash
    composer install
    ```
3.  Setup Environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  Database Setup:
    -   Create a database named `task_manager` in your MySQL server.
    -   Open `.env` and set your database credentials:
        ```ini
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=task_manager
        DB_USERNAME=root
        DB_PASSWORD=your_password
        ```
5.  Migrate & Seed:
    ```bash
    php artisan migrate:fresh --seed
    ```
6.  Serve Application:
    ```bash
    php artisan serve
    ```
    Visit `http://localhost:8000` in your browser.

---

## 🏗 Architecture & Code Structure

The application follows strict **Model-View-Controller (MVC)** principles:

### 1. **Models (Domain Layer)**
-   **`Task`**: Contains business logic for priorities.
    -   *Relationship:* `belongsTo(Project::class)`
    -   *Scope:* `scopeOrdered()` ensures tasks always load by priority.
-   **`Project`**: Represents a collection of tasks.
    -   *Relationship:* `hasMany(Task::class)`

### 2. **Controllers (Http Layer)**
-   **`TaskController`**: Handles all traffic.
    -   Uses **Resource Methods** (`index`, `store`, `edit`, `update`, `destroy`).
    -   **`reorder()`**: A specialized API method that accepts an array of IDs and updates their order in a single database transaction for data integrity.

### 3. **Validation (Security)**
-   Uses **FormRequests** (`StoreTaskRequest`, `UpdateTaskRequest`) to decouple validation logic from the Controller.
-   Ensures only valid data enters the database.

### 4. **Views (Presentation Layer)**
-   Built with **Blade Templates**.
-   Styled with **TailwindCSS** (via CDN for lightweight portability).
-   Uses `layouts/app.blade.php` for a consistent design system.
