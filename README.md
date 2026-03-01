# NCST Bloodletting Portal

A web-based donor screening form portal built for **National College of Science and Technology (NCST)** school bloodletting events. The portal streamlines the donation process by allowing students to fill out their donor screening form online, select an assigned hospital partner, and automatically receive their completed form as a PDF via email — eliminating paperwork and preventing students from choosing hospitals on their own.

---

## Features

- **Online Donor Screening Form** — Students fill out their screening questionnaire digitally before the event.
- **Hospital Assignment** — The system controls which partner hospital a donor is assigned to, keeping the event organized.
- **Automated PDF Generation** — Completed forms are generated as PDFs tailored to each hospital's required format (VMMC, TSMC, Red Cross, UMC, EACMED).
- **Email Delivery** — The PDF is securely stored and a signed download link is emailed to the donor.
- **Secure Download Landing Page** — The email contains a link to a landing page where the donor can download their PDF, preventing issues with email providers modifying direct file links.
- **Admin Dashboard** — Authenticated staff can view submitted forms.
- **Queue-based Processing** — PDF generation and email sending are handled asynchronously via Laravel queues.

---

## Tech Stack

| Layer          | Technology                             |
| -------------- | -------------------------------------- |
| Framework      | Laravel 12                             |
| Frontend       | Livewire 4 + Flux UI + Tailwind CSS v4 |
| PDF Generation | Spatie Laravel PDF + DomPDF            |
| Authentication | Laravel Fortify                        |
| Testing        | Pest 4                                 |
| Build Tool     | Vite                                   |

---

## Requirements

Before installing, make sure the following are available on your machine:

- **PHP** >= 8.2
- **Composer**
- **Node.js** >= 18 & **npm**
- **MySQL** or another supported database
- **A local server** (e.g. [Laragon](https://laragon.org/), Laravel Herd, or `php artisan serve`)
- **Mail driver** configured (SMTP, Mailgun, etc.)
- **Puppeteer / Chromium** — required by Spatie Laravel PDF for browser-based PDF rendering

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-org/ncst-bloodletting-portal.git
cd ncst-bloodletting-portal
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Set up your environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configure the `.env` file

Open `.env` and update the following sections:

```env
APP_NAME="NCST Bloodletting Portal"
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ncst_bloodletting
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@ncst.edu.ph
MAIL_FROM_NAME="NCST Bloodletting Portal"

QUEUE_CONNECTION=database
```

### 6. Run database migrations

```bash
php artisan migrate
```

### 7. (Optional) Seed the database

```bash
php artisan db:seed
```

### 8. Build frontend assets

```bash
npm run build
```

### 9. Link storage

```bash
php artisan storage:link
```

---

## Running the Application

Use the following command to start the server, queue worker, and Vite dev server all at once:

```bash
composer run dev
```

Or run them individually:

```bash
# Laravel dev server
php artisan serve

# Queue worker (required for PDF generation and email sending)
php artisan queue:listen --tries=1

# Vite dev server
npm run dev
```

The application will be available at `http://localhost:8000` (or your configured `APP_URL`).

---

## How It Works

1. A student visits the portal and fills out the donor screening form.
2. Upon submission, the form is saved to the database and a background job is dispatched.
3. The job generates the donor's PDF (formatted for their assigned hospital) and stores it privately on the server.
4. A **7-day signed link** to a download landing page is emailed to the donor.
5. The donor opens the email, clicks the link, and is taken to the landing page where they can safely download their PDF.

---

## Running Tests

```bash
php artisan test --compact
```

---

## Code Style

This project uses [Laravel Pint](https://laravel.com/docs/pint) for code formatting:

```bash
vendor/bin/pint
```

---

## License

This project is proprietary software developed for NCST internal use.
