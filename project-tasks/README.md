# README

- **Categories**: Core PHP, Laravel, MySQL
- **Tech Stack**: `PHP` >= `8.1`, `Laravel` >= `11`, `MySQL` >= `7.x`
- **Time**: **24 hours**
- **Task Requirement**: Complete at least 9, up to 19
- ⚠️ Please note: This is a temporary repository and will be removed after 30th May 2025.

## Evaluation Criteria:

- Number of completed tasks
- Code quality (clean, structured, readable, commented)
- Use of best practices (**naming**, **separation of logic**, **DRY**, etc.)
- Git usage and project structure

## Folder Structure

```txt
/Root
  /core-php-tasks
    task-1/
    task-2/
    ...
  /mysql-tasks
    task-1.sql
    task-2.sql
    ...
  /laravel-tasks
    task-1/
    ...
README.md
.gitignore

```

You can include boilerplate folders or minimal starter code for Laravel tasks if needed (like auth scaffolding).

## Instructions

- Fork this repository (or clone and push to your own **GitHub** repo.)
- Work within the provided structure
- Complete **_at least 9 tasks_** (you may complete up to 19 tasks).
- Ensure your code follows **best practices**: _clean_, _readable_, and _well-commented_.
- Some tasks may not provide complete instructions—use your imagination and logical reasoning to fill the gaps and complete the task creatively and effectively.
- Use **PHP ≥ 8.1**, **Laravel ≥ 11**, and **MySQL ≥ 7.x** as specified.
- Push the completed tasks before the **24-hour deadline**
- Share the **GitHub/GitLab repo link** back with us via email (📧 TO: manuj@indigiconsulting.com) and 📧 CC: puja@indigiconsulting.com.
- **Deadline**: Submit your email before **29th May 2025, 12:00 Noon**.
  Submissions received after this time will not be considered.

## 🚫 Important Rules

- ❗ No push changes will be accepted after the deadline.
- ❗ Directly copied code from AI tools (ChatGPT, Bard, Copilot, etc.) will not be considered.
- ✅ You may use documentation and references, but your code must reflect your own understanding.
- 📌 You are encouraged to commit frequently to show your thought process and progress.
- 🧠 Bonus points for:
  - Modular and reusable code
  - Git commit clarity and consistency

## Task list

### 🟨 PHP Tasks

> Complete at Least 3 of the Following 4 Tasks

**💥 Task 1**: Form Handling & Validation

**Description**: Create a basic HTML + PHP form to collect:

1.  Name
2.  Email
3.  Age

On submit, the script should:

- Validate: `name` is required, `email` must be valid, `age` must be numeric
- Save to a **MySQL** table called `users`
- Display success or error messages

Skills Required:

- Basic PHP
- Server-side validation
- MySQL insert
- User-friendly error handling

**💥 Task 2**: File Upload

**Description**: Allow user to upload a profile picture (JPG/PNG). Store file in a folder and save file path in the DB.

Skills Required:

- Handling `$\_FILES`
- Validating file `type/size`
- Storing file and updating `DB`

**💥 Task 3**: Pagination

**Description**: Create a PHP page that displays data from products table with pagination (5 items per page).

Skills Required:

- SQL with `LIMIT` and `OFFSET`
- URL parameter handling
- Looping and displaying data

**💥 Task 4**: Role-Based Access Control

**Description**: Create a **PHP** script with two roles: `admin` and `user`.

- Admin can create and delete users.
- User can only view profile.

Implement login system using sessions.

Skills Required:

- **PHP** session management
- Role-based logic
- Secure form handling

**💥 Task 5**: JSON API Simulation

**Description**: Create a PHP script that reads user data from a MySQL table and returns JSON (`e.g., /api/users.php`).
Add optional filter by `age` or `city` via GET parameters.

Skills Tested:

- Working with headers and JSON
- Dynamic SQL queries
- RESTful response structure

**💥 Task 6**: Basic Login and Session System

**Description**:

- Build a login page:
- Hardcoded user or MySQL-based auth
- Use sessions to keep user logged in
- Add logout option
- Bonus: Redirect non-logged-in users from a protected page.

### 🟨 MySQL Tasks

> Complete at Least 3 of the Following 5 Tasks

**💥 Task 1**: Write Queries

Given a sales table:

```sql
sales(id, customer_id, amount, sale_date)
```

Questions:

1. Fetch total sales amount per customer.
2. Get top 5 customers by sales.
3. Count how many sales happened in the last 7 days.
4. List customers who haven’t made any purchase in 2024.

Skills Required:

- GROUP BY, SUM
- JOINs if needed
- Date filtering

**💥 Task 2**: Schema Design

**Problem**: Design tables for a blogging platform:

- Users
- Posts
- Comments
- Categories (1 post can have multiple categories)

Skills Tested:

- Normalization
- Relationships (1-to-many, many-to-many)

**💥 Task 3**: Subqueries and Joins

Table Example:

```sql
orders(id, user_id, amount, order_date)
users(id, name, email)
```

Questions:

- Get users who placed more than `5` orders.
- Find users whose average order amount is more than `$500`.
- List users who placed their first order in the last `30` days.

Skills Required:

- Aggregation
- Subqueries
- Joins with filters

**💥 Task 4**: Write a Normalized Schema

**Description**:
Design a schema for a school system with:

- Students
- Courses
- Teachers
- Enrollments

You should:

- Use foreign keys properly
- Normalize to at least 3NF
- Add example INSERTs and SELECT queries

**💥 Task 5**: Trigger to Track Deleted Records

**Description**:
Create a table `employees`. When a record is deleted, copy it to a `deleted_employees` archive table using **a trigger**.

Bonus: Include a `timestamp` in `archive`.

### 🟨 Laravel Tasks

> Complete at Least 3 of the Following 8 Tasks

**💥 Task 1**: Simple Blog CRUD

Create a blog system:

- Post `title`, `body`, `author` (`user`)
- User authentication
- Create, edit, delete, list posts
- Store in MySQL
- Use Laravel validation

Skills Required:

- Routing, controllers, views
- Auth (Laravel Breeze or basic auth)
- Relationships (User `hasMany` Posts)

**💥 Task 2**: API Endpoint

Create a Laravel API that:

- Accepts a POST request to `/api/attendance` with `employee_id`, `date`, `status`
- Stores it in attendances table
- Returns JSON response
- Bonus: Add API token middleware (sanctum or basic key check)

Skills Required:

- REST API
- Laravel Resource Controllers
- JSON request/response
- API authentication (optional)

**💥 Task 3**: Eloquent Relationships

Tables:

- users, projects, tasks

Task: Show all projects assigned to a user and each project's tasks.

Skills Required:

- Eloquent one-to-many & many-to-many
- hasMany, belongsToMany, eager loading

**💥 Task 4**: Email Notification

On new user registration, send a welcome email.

Skills Tested:

- Laravel Mail
- Event-driven flow
- Blade template for email

**💥 Task 5**: Search & Filter

Build a search bar to filter users (`id`, `name`, `email`, `address`, ...) by `name/email` in a Laravel app.

Skills Tested:

- Query builder
- Blade conditional rendering
- Handling GET parameters

**💥 Task 6**: Task Management System

**Description**: Create a Laravel app with 3 models:

- User
- Project
- Task

**Requirements**:

- A user can create multiple projects
- Each project has tasks with status (`pending`, `in progress`, `done`)
- Create views to:
  - Create tasks
  - Change status
  - Filter tasks by status/project

Skills Required:

- Nested CRUD
- Eloquent relationships
- Query **scopes** or **filters**

**💥 Task 7**: Export to CSV

**Description**: Create a Laravel route that allows exporting all `products` to CSV with fields: `name`, `price`, `category`, `stock`.

Skills Required:

- File streaming in Laravel
- CSV formatting
- Handling large data efficiently

**💥 Task 8**: Laravel Middleware

**Description**:
Write a custom middleware that:

- Blocks access to `/admin/*` routes if user is not admin
- Redirects to home with error

Skills Required:

- Middleware creation
- Auth checks
- Route protection
