# Email Log to Database - Laravel Plugin

A Laravel plugin to log email information to a database table and provide a user interface for viewing, filtering, and managing email logs. This plugin is intended to help developers keep track of emails sent through their application.

## Features
- Log emails sent from your Laravel application.
- View email logs in a Bootstrap-based table.
- Filter logs by recipient, subject, or sent date.
- Real-time filtering using AJAX.
- View detailed information in a modal pop-up.
- Easily override the default views without publishing.

## Installation

### Step 1: Install the Package
Clone or install this package into your `plugins` directory. Alternatively, you can add it to your `composer.json` as a local package:

```bash
composer require vikramsra/email-log-to-db
```

### Step 2: Add Service Provider
Add the `EmailLogServiceProvider` to your `bootstrap/providers.php` file or in your `composer.json` to automatically register the provider:

**Register in `bootstrap/providers.php`**

```php
'providers' => [
    // Other service providers...
    Vikramsra\EmailLogToDb\EmailLogServiceProvider::class,
],
```

### Step 3: Run Migrations
This package includes a migration to create the `email_logs` table. Run the migration using:

```bash
php artisan migrate
```

## Usage

### Step 1: Log Emails
The package will automatically log emails sent from your Laravel application. No further configuration is needed.

### Step 2: View Email Logs
You can access the email logs in your Laravel application by visiting `/email-logs`.

The logs are presented in a user-friendly table with the following features:
- **Real-Time Search**: Filter by recipient or subject in real-time.
- **Date Filter**: Filter by sent date.
- **View Details**: Click on the "View Details" button to see the full email body and attachments in a modal pop-up.

### Step 3: Overriding Views
If you need to customize the views, simply create corresponding Blade files in your main Laravel application at `resources/views/vendor/emailLogs/`.

For example:
- To override the email log listing page, create `resources/views/vendor/emailLogs/index.blade.php`.
- To override the details modal, create `resources/views/vendor/emailLogs/show.blade.php`.

Laravel will automatically prioritize these views over the package-provided ones.

## Available Routes
- **GET /email-logs**: View and filter the list of email logs.
- **GET /email-logs/{id}**: View details for a specific email log.

## Customization

### Overriding the Default Views
The package provides a default UI to manage the email logs. If you want to modify the views to fit your application's style, you can override them without publishing:
- Create Blade files in `resources/views/vendor/emailLogs/` to override the default views.
- The default views will be used if no overriding views are found.

## Requirements
- Laravel 11+.
- PHP 8.2 or newer.

## Contributing
If you would like to contribute, please open a pull request or an issue in the repository. Contributions are always welcome!

## License
This package is open-source software licensed under the [MIT license](LICENSE).

