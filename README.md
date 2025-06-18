# Reading Tracker

Reading Tracker is a comprehensive web application built with Laravel 12 that helps users track their reading habits, manage book collections, monitor music listening, and generate insightful reports on their media consumption patterns.

## Features

### 📚 Book Management
- **Complete CRUD operations** for books with detailed metadata
- **Reading sessions tracking** with start/end times and pages read
- **Status management**: to_read, currently_reading, finished
- **Rating and notes system** for personal reviews
- **Progress tracking** with automatic status updates

### 🎵 Music Collection
- **Album management** with artist, genre, and release information
- **Listening logs** to track when and how you engage with music
- **Multiple format support** (vinyl, CD, digital, etc.)
- **Personal notes and ratings** for albums

### 📊 Advanced Reporting
- **Reading statistics** including total books, pages read, and average ratings
- **Visual reports** with charts and graphs
- **Book status breakdowns** and reading session analytics
- **Comprehensive dashboard** for tracking progress

### 🔧 Technical Features
- **User authentication** with secure login/logout
- **Responsive design** optimized for desktop and mobile
- **AI-powered logging** with CraftyLogger integration
- **Database migrations** with proper relationships
- **Comprehensive test suite** with Feature and Unit tests
- **Modern Laravel 12** with latest PHP 8.2 features

## Requirements

- **PHP 8.2** or higher
- **Composer** for dependency management
- **Node.js and npm** for frontend assets
- **Database**: MySQL, PostgreSQL, or SQLite
- **Web server**: Apache, Nginx, or Laravel's built-in server

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/timpers/reading-tracker.git
   cd reading-tracker
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**
   ```bash
   npm install
   ```

4. **Environment configuration:**
   ```bash
   cp .env.example .env
   ```
   
   Configure your database and other settings in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=reading_tracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   
   # CraftyLogger Configuration (optional)
   LLM_API_KEY=your_llm_api_key
   LLM_API_ENDPOINT=https://api.example.com/v1/llm
   LLM_MODEL=llama3.2
   ```

5. **Generate application key:**
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations:**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional):**
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets:**
   ```bash
   npm run build
   # Or for development:
   npm run dev
   ```

9. **Start the development server:**
   ```bash
   php artisan serve
   ```

## Usage

### Quick Start
1. Register a new account or login at `http://localhost:8000`
2. Navigate to **Books** to add your first book
3. Start a **Reading Session** to track your progress
4. Explore **Albums** to manage your music collection
5. Check **Reports** for insights into your reading habits

### Book Management
- **Add books** with title, author, genre, publication year, and page count
- **Track reading sessions** with precise start/end times
- **Update book status** automatically as you progress
- **Rate and review** completed books

### Music Tracking
- **Catalog albums** with detailed metadata
- **Log listening sessions** with timestamps and notes
- **Track different formats** and organize by genre

### Reports & Analytics
- View **comprehensive statistics** about your reading habits
- Analyze **reading patterns** over time
- Export data for external analysis

## Development

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test suites
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Run static analysis
./vendor/bin/phpstan analyse
```

### Development Commands
```bash
# Start development environment with all services
composer run dev

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Generate factory data
php artisan tinker
>>> User::factory(10)->create()
>>> Book::factory(50)->create()
```

## Architecture

### Models & Relationships
- **User** → hasMany Books, Albums
- **Book** → belongsTo User, hasMany ReadingSessions
- **Album** → belongsTo User, hasMany ListeningLogs
- **ReadingSession** → belongsTo Book
- **ListeningLog** → belongsTo Album

### Key Controllers
- `BookController` - Complete CRUD + reading session management
- `AlbumController` - Music collection management
- `ReportController` - Analytics and data visualization

### Custom Packages
- **CraftyLogger** - AI-powered exception handling and logging

## Database Schema

The application uses a well-structured database with the following main tables:

- `users` - User authentication and profiles
- `books` - Book metadata and reading status
- `reading_sessions` - Individual reading session tracking
- `albums` - Music album information
- `listening_logs` - Music listening history

## API Endpoints

All routes are protected by authentication middleware:

```
GET    /books              - List all books
POST   /books              - Create new book
GET    /books/{book}       - Show book details
PUT    /books/{book}       - Update book
DELETE /books/{book}       - Delete book
POST   /books/{book}/reading-sessions - Start reading session
PUT    /books/{book}/reading-sessions/{session} - End reading session

GET    /albums             - List all albums
POST   /albums             - Create new album
GET    /albums/{album}     - Show album details
PUT    /albums/{album}     - Update album
DELETE /albums/{album}     - Delete album

GET    /reports/books      - Book reading reports
```

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure:
- All tests pass (`php artisan test`)
- Code follows PSR-12 standards
- New features include appropriate tests

## Testing

The application includes comprehensive test coverage:

- **Feature Tests**: End-to-end testing of controllers and routes
- **Unit Tests**: Individual model and service testing
- **Database Tests**: Migration and relationship testing

## Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Configure database and mail settings
3. Run `php artisan config:cache`
4. Run `php artisan route:cache`
5. Set proper file permissions
6. Configure web server (Apache/Nginx)

### Docker Support
```bash
# Using Laravel Sail
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

## Troubleshooting

### Common Issues
- **Database connection errors**: Check `.env` database settings
- **Permission issues**: Ensure `storage/` and `bootstrap/cache/` are writable
- **Missing dependencies**: Run `composer install` and `npm install`
- **Migration errors**: Check database exists and user has proper permissions

### Debug Mode
Enable debug mode in `.env` for development:
```env
APP_DEBUG=true
```

## Security

- All routes protected by authentication middleware
- CSRF protection enabled for all forms
- SQL injection prevention through Eloquent ORM
- XSS protection with Blade templating
- User authorization checks for resource access

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support and questions:
- Create an issue on GitHub
- Check the [Laravel documentation](https://laravel.com/docs)
- Review the test files for usage examples

## Changelog

### Version 1.0.0
- Initial release with book and album tracking
- Reading session management
- Comprehensive reporting system
- AI-powered logging integration
