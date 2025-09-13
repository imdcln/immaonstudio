# ImmaOnStudio

ImmaOnStudio is a website ....

---

## List of Contents

-   [Main Features](#main-features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Arschitecture & Tech Stack](#architecture--tech-stack)
-   [Contributor](#contributor)
-   [License](#license)

---

## Main Features

-   Reserve SMK Immanuel Pontianak's Studio Globally and Effortlessly\
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
    cd gallerytest
    ```
2. **Install PHP Dependencies**
    ```bash
    composer install
    ```
3. **Install Front-End Dependencies*
    ```bash
    npm install
    ```
4. **Copy Env File Example**
    ```bash
    cp .env.example .env
    ```
5. **Configure Database**
    - Edit file `.env` dan sesuaikan pengaturan database Anda.
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

-

---

## Architecture & Tech Stack

-   **Backend:** Laravel
-   **Frontend:** Alpine.js, Tailwind CSS
-   **Database:** MSSQL
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

## License

This project is licensed under MIT License. For more details, view [LICENSE](LICENSE) file.