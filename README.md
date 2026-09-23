# Workout Tracker

A full-stack web application for tracking workouts, exercises, sets, body measurements, and nutrition goals.

The project was built as a personal full-stack development project with a focus on practical workout tracking, responsive UI, REST API development, authentication, database design, and data visualization.

## Overview

Workout Tracker allows users to record their workouts, track progress over time, monitor body measurements, and calculate daily nutrition targets.

The application is designed as a responsive single-page application and works across desktop, tablet, and mobile screen sizes.

## Features

### Authentication and Account Management

* User registration and login
* Cookie-based authentication with Laravel Sanctum
* Protected application routes
* Logout
* Account deletion with related data cleanup

### Workout Tracking

* Create and edit workouts
* Set workout name and date
* Add multiple exercises to a workout
* Create custom exercises
* Add multiple sets to each exercise
* Record weight and repetitions for each set
* Edit and remove sets
* View workout history
* View detailed workout information

### Body Measurements

Users can track:

* Body weight
* Neck
* Chest
* Biceps
* Forearms
* Waist
* Hips
* Calves

Measurement history can be reviewed and edited over time.

### Progress Visualization

* Weight progress chart
* Historical measurement data
* Interactive charts built with Chart.js
* Chronological tracking of measurements

### Nutrition Calculator

The application calculates daily nutrition targets using the Mifflin-St Jeor equation.

The calculator takes into account:

* Gender
* Age
* Height
* Weight
* Activity level
* Goal

It provides estimated:

* Daily calorie target
* Protein
* Fat
* Carbohydrate intake

### User Interface

* Responsive design
* Desktop, tablet, and mobile layouts
* Light and dark themes
* English and Latvian localization
* Form validation
* Loading states
* Error and success feedback
* Responsive navigation and dialogs

## Tech Stack

### Frontend

* Vue 3
* Vite
* Vue Router
* Vuetify 4
* Axios
* Chart.js
* Vue I18n
* Material Design Icons

### Backend

* Laravel 12
* PHP 8.4
* Laravel Sanctum
* REST API
* Eloquent ORM
* Laravel Validation

### Database

* MySQL
* Laravel Migrations
* Eloquent relationships

### Deployment

* Railway

## Architecture

The application follows a client-server architecture.

```text
┌──────────────────────────────┐
│          Vue 3 SPA           │
│                              │
│  Views · Components · Router │
│  Axios · Chart.js · Vuetify  │
└──────────────┬───────────────┘
               │
               │ REST API
               │
┌──────────────▼───────────────┐
│         Laravel 12           │
│                              │
│ Controllers · Models         │
│ Validation · Sanctum         │
│ Business Logic               │
└──────────────┬───────────────┘
               │
               │ Eloquent ORM
               │
┌──────────────▼───────────────┐
│            MySQL             │
│                              │
│ Users · Workouts · Exercises │
│ Sets · Measurements          │
└──────────────────────────────┘
```

## Database Structure

The main entities include:

* `users` — application users
* `user_profiles` — user data used for personalization and nutrition calculations
* `workouts` — workout sessions
* `exercises` — available and user-created exercises
* `workout_exercises` — exercises assigned to specific workouts
* `sets` — weight and repetition data for each exercise
* `measurements` — body measurement history

The database relationships are handled through Laravel Eloquent models and migrations.

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   └── Requests/
├── Models/
└── ...

database/
├── migrations/
└── seeders/

resources/
├── js/
│   ├── components/
│   ├── views/
│   ├── router/
│   ├── stores/
│   ├── utils/
│   ├── locales/
│   └── ...
├── css/
└── views/

routes/
├── api.php
├── auth.php
└── web.php

public/
└── ...

vite.config.js
composer.json
package.json
```

## Local Development

### Requirements

Make sure the following are installed:

* PHP 8.4+
* Composer
* Node.js and npm
* MySQL
* Git

### Installation

Clone the repository:

```bash
git clone <repository-url>
cd workout-tracker
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=workout_tracker
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations:

```bash
php artisan migrate
```

If the project includes seed data:

```bash
php artisan db:seed
```

### Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Start the Vite development server in a separate terminal:

```bash
npm run dev
```

The application will be available at:

```text
http://127.0.0.1:8000
```

## Production Build

Create the frontend production build:

```bash
npm run build
```

The application can then be deployed to a production environment such as Railway with the required PHP, database, and environment configuration.

## Environment Configuration

The application uses environment variables for configuration and database credentials.

Important variables include:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

Authentication and session configuration should also be adjusted according to the deployment environment.

Sensitive environment variables should never be committed to the repository.

## Validation and Security

The application uses Laravel's validation system for server-side validation and Vue/Vuetify validation for immediate client-side feedback.

Authentication is handled using Laravel Sanctum with cookie-based sessions.

Protected API endpoints require an authenticated user, and user-related resources are scoped to the currently authenticated account.

## Localization

The interface supports:

* English
* Latvian

Translations are managed with Vue I18n.

Language preference is stored locally so the selected language can be preserved between sessions.

## Responsive Design

The interface is designed with a mobile-first approach where appropriate and includes specific layouts for:

* Desktop
* Tablet
* Mobile

Special attention is given to workout creation dialogs, measurement forms, navigation, dashboard cards, charts, and application controls on smaller screens.

## Deployment

The application is deployed using Railway.

The production environment consists of:

```text
Laravel Application
        │
        ├── Vue production build
        │
        └── MySQL Database
```

Environment-specific configuration is provided through Railway environment variables.

## Project Goals

The main goals of the project are:

* Build a practical workout tracking application
* Gain experience with full-stack web development
* Practice REST API design
* Work with relational databases and Eloquent relationships
* Implement authentication and authorization
* Build responsive interfaces with Vue and Vuetify
* Visualize user data with charts
* Implement internationalization
* Deploy a full-stack application to a cloud platform

## Future Improvements

Potential future improvements include:

* More detailed exercise progress analytics
* Additional chart types and filters
* Workout templates
* Personal records tracking
* Exercise search and categorization
* Improved workout statistics
* More advanced progress comparisons
* Additional localization options

## License

This project was created as a personal learning and portfolio project.
