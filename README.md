# User Management Application

Welcome to the User Management Application, a Laravel-based web application for managing users. This application provides an easy-to-use interface for user management tasks such as creating, updating, deleting, and viewing user information.

## Features

- **User CRUD Operations**: Perform Create, Read, Update, and Delete operations on user records.
- **Database Seeding**: Initial data seeding provided for easy testing and demonstration.
- **Responsive UI**: Designed with a responsive user interface for seamless use across devices.
- **Authentication**: Secure authentication system for user login and access control.

## Installation

To get started with the User Management Application, follow these steps:

1. **Clone the repository**:

git clone https://github.com/rnscth/user-mgmnt-laravel.git

2. **Install Dependencies**:

cd user-management-app
composer install


3. **Set Up Environment**:

- Duplicate the `.env.example` file and rename it to `.env`.
- Configure your database connection in the `.env` file.

4. **Generate Application Key**:

php artisan key:generate


5. **Run Migrations and Seeders**:

php artisan migrate:fresh --seed


6. **Start the Application**:

php artisan serve


Access the application at `http://localhost:8000` in your browser.

## Frontend Integration

This application requires the Vue.js frontend for user interface interactions. Please ensure that the `user-mgmnt-vue` frontend project is set up and integrated for the full functionality of the User Management Application.

## Contributing

Contributions are welcome! Please feel free to submit bug reports, feature requests, or pull requests.

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/NewFeature`).
3. Commit your changes (`git commit -am 'Add some feature'`).
4. Push to the branch (`git push origin feature/NewFeature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
