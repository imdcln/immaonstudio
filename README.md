# ImmaOnStudio

![Laravel](https://img.shields.io/badge/Laravel-10-red)
![PHP](https://img.shields.io/badge/PHP-8.1-blue)
![License](https://img.shields.io/badge/License-MIT-green)
![Status](https://img.shields.io/badge/Status-In%20Development-yellow)

We present to you, ImmaOnStudio! ImmaOnStudio is a website where you can reserve SMK Immanuel Pontianak's Studio. We have just developed this website project for about 1 month. In this process, we want to create ImmaOnStudio as a website used for reserving studio effortlessly and effectively through the internet. Let alone, teachers (with admin role) also have the access to a dashboard to monitor and know the studio usages.

---

## List of Contents

-   [Main Features (On Progress)](#main-features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Arschitecture & Tech Stack](#architecture--tech-stack)
-   [Contributor](#contributor)
-   [Contact](#contact)
-   [License](#license)

---

## Main Features

-   Reserve SMK Immanuel Pontianak's Studio Globally and Effortlessly
-   Prevent Reservation Schedule Collissions
-   Visualize Studio Usage Systematically
-   Help Teacher Admins to Monitor Studio Usage

---

## Installation

### Requirements

-   PHP >= 8.1
-   Composer
-   Node.js & npm
-   MySQL

### Steps

1. **Clone Repository**
    ```bash
    git clone <repository-url>
    cd immaonstudio
    ```
2. **Install PHP Dependencies**
    ```bash
    composer install
    ```
3. **Install Front-End Dependencies**
    ```bash
    npm install
    ```
4. **Copy Env File Example**
    ```bash
    cp .env.example .env
    ```
5. **Configure Database**
    - Edit your copied `.env` file and configure your database.
6. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```
7. **Run Migration**
    ```bash
    php artisan migrate --seed
    ```
8. **Run Front-End Assets**
    ```bash
    npm run build
    ```
9. **Run Local Server**
    ```bash
    php artisan serve
    ```

---

## Usage

### As User
1. *Signup/Login*
    - Create your account or log in to your account.
2. *Reserve Studio*
    - After logging in, you may reserve studio.
3. *Pending*
    - Wait for admin's action, whether to accept/decline your reservation.
    - If accepted, your reservation will be scheduled and you may then proceed to use the studio.
4. *Check Reservation List*
    - You may check your reservation or others' reservation through the Reservation List Page.
  
### As Admin
1. *Login*
    - Log in to admin's account to go through dashboard.
2. *Dashboard*
    - Entering dashboard, there are many statistics/data that you may go through.
    - Admins may have access to do CRUD based on their role permission given.


---

## Architecture & Tech Stack

-   **Backend:** Laravel
-   **Frontend:** Alpine.js, Tailwind CSS
-   **Database:** MSSQL/SQLSRV
-   **Build Tool:** Vite

### Main Folder Structure

-   `app/` : Application Logics (Controllers, Models)
-   `resources/views/` : Blade View Files
-   `routes/` : Application Routing
-   `public/` : Application File Source

---

## Contributor

-   **Declane Joseph Delvino**: Full-Stack Developer
-   **Jason Valentino Putra**: UI/UX Designer
-   **Silviana Febrianti**: UI/UX Designer
-   **Ying Er Aleitheia Fangidae**: UI/UX Designer

---

## Contact

Project Lead: Declane Joseph Delvino  
Email: declanecun@gmail.com  
GitHub: https://github.com/imdcln

---

## License

This project is licensed under MIT License. For more details, view [LICENSE](LICENSE) file.
