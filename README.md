# Reading Tracker

Reading Tracker is a web application built with the Laravel framework. It helps users track their reading habits, manage book lists, and set reading goals.

## Features

- User authentication and profile management.
- Add, edit, and delete books in your reading list.
- Track reading progress and set goals.
- Generate reports on reading habits.
- Responsive design for mobile and desktop.

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and npm
- A database (e.g., MySQL, SQLite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/timpers/reading-tracker.git
   cd reading-tracker
   ```

# Reading Tracker

Reading Tracker is a web application built with the Laravel framework. It helps users track their reading habits, manage book lists, and set reading goals.

## Features

- User authentication and profile management.
- Add, edit, and delete books in your reading list.
- Track reading progress and set goals.
- Generate reports on reading habits.
- Responsive design for mobile and desktop.

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and npm
- A database (e.g., MySQL, SQLite)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/reading-tracker.git
   cd reading-tracker
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

6. Run database migrations:
   ```bash
   php artisan migrate
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```

8. Compile frontend assets:
   ```bash
   npm run dev
   ```

## Testing

Run the test suite using PHPUnit:
```bash
php artisan test
```

## Contributing

Contributions are welcome! Please follow the [Laravel contribution guide](https://laravel.com/docs/contributions).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
