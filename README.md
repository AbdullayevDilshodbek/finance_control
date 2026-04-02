# 📱 Finance Control - Native Mobile App

A powerful, privacy-focused finance management application built for mobile devices. Track your income, expenses, and manage your budget with a seamless native experience, all powered by the robust Laravel ecosystem.

![Laravel](https://img.shields.io/badge/Laravel-13.0-FF2D20?style=for-the-badge&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-4.0-4e56a6?style=for-the-badge&logo=livewire)
![SQLite](https://img.shields.io/badge/SQLite-Local-003B57?style=for-the-badge&logo=sqlite)
![NativePHP](https://img.shields.io/badge/NativePHP-Mobile-4F46E5?style=for-the-badge)

## ✨ Features

- **📊 Comprehensive Dashboard**: Get a quick overview of your financial health at a glance.
- **💸 Transaction Management**: Effortlessly add and categorize your income and expenses.
- **📅 Monthly Summaries**: Analyze your spending patterns with detailed monthly reports.
- **🌐 Multilingual Support**: Fully localized in **English** and **Uzbek**.
- **🔒 Privacy First**: Your data stays on your device. We use **SQLite** for secure, local-only storage—no cloud required.
- **🚀 Native Performance**: Built using **NativePHP (Mobile)** to provide a smooth, responsive mobile experience.

## 🛠️ Tech Stack

- **Framework**: [Laravel 13](https://laravel.com)
- **Frontend**: [Livewire 4](https://livewire.laravel.com) (TALL Stack approach)
- **Mobile Wrapper**: [NativePHP Mobile](https://nativephp.com)
- **Database**: SQLite (Local)
- **Styling**: Tailwind CSS (integrated via Vite)

## 🚀 Getting Started

### Prerequisites

- **PHP**: 8.3 or higher
- **Composer**: Latest version
- **Node.js & NPM**: For frontend assets
- **NativePHP Mobile**: Environment setup for iOS/Android (see [NativePHP docs](https://nativephp.com))

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/your-username/php-native-finance.git
   cd php-native-finance
   ```

2. **Run the setup script**:
   The project includes a convenient setup command that installs dependencies, generates keys, and prepares the database:
   ```bash
   composer run setup
   ```

3. **Install NativePHP Mobile (if not already done)**:
   ```bash
   php artisan native:install
   ```

### Development

To run the app in development mode with hot-reloading:

```bash
# Start the development environment (Vite + Laravel)
npm run dev

# Run the app on your mobile emulator/device
php artisan native:run
```

Use `php artisan native:watch` to sync changes to the running app in real-time.

### 📦 Production Build (Android)

To build and package the application for Android:

1. **Build the assets**:
   ```bash
   npm run build
   ```

2. **Package the app for Android**:
   ```bash
   php artisan native:package android
   ```
   This command will compile the app and generate a signed/unsigned APK/AAB for distribution.

3. **Build the app specifically**:
   ```bash
   php artisan native:build android
   ```

## 📁 Project Structure

- `app/Livewire`: Contains the core application logic (Dashboard, Transactions, etc.).
- `database/migrations`: Defines the SQLite schema for local storage.
- `lang/`: Localization files for English and Uzbek.
- `native/`: NativePHP mobile configuration and assets.

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).
