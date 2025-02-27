# Wardrobe-Management-System
This *Wardrobe Management System* allows users to manage their clothing items, including the ability to add, edit, delete, categorize, and filter items. The system uses **Laravel 11** as the backend and **Vue3** as the frontend framework. The application also features user authentication, with login and registration functionalities using **Laravel Breeze**. The UI is built using **Tailwind CSS**, providing a responsive, user-friendly interface. **Inertia.js** is used to seamlessly connect the frontend and backend.The backend uses **SQLite** as the database.

## Features
### User Authentication**

- Login and registration functionality powered by Laravel Breeze.
- Protected routes for authenticated users.
### Clothing Item Management**

- Add, edit, and delete clothing items.
- Clothing items can be categorized (e.g., tops, bottoms, shoes).
- Ability to upload images for clothing items.
### Search and Filter**

- Search clothing items by name, category, or other properties.
### Filter clothing items by category.
### Responsive UI

- Mobile-first design.
- 2-column grid system for displaying clothing items.

## Tech Stack
### Frontend:
- Vue3
- Tailwind CSS
- Inertia.js
### Backend:
- Laravel 11
- Laravel Breeze (Authentication)
- Pest (Testing)
### Database: SQLite.
#### Prerequisites
Before you begin, ensure you have the following software installed:

- PHP 8.1+ (for Laravel 11)
- Composer (for PHP dependencies)
- Node.js 14+ (for Vue3)
- NPM (for JavaScript dependencies)
- SQLite
**Project Setup**
1. Clone the Repository.

- Clone the repository to your local machine:

     ```git clone https://github.com/your-username/wardrobe-management.git cd wardrobe-management ``` 

2. Backend Setup (Laravel)
- Install Laravel Dependencies.

Run the following command to install the backend dependencies:

  ```cd backend composer install```

#### Set up Environment Variables

Copy the ```.env.example``` file to .env and set up your environment configuration:

   ```cp .env.example .env```

3. Modify the .env file to include your database credentials:

```DB_CONNECTION=sqlite DB_DATABASE=/path_to_your_project/database/database.sqlite```

#### Generate Application Key
- Run the following command to generate a new application key:

    ```php artisan key:generate```
- Run Database Migrations Run the migrations to create the necessary database tables:

     ```php artisan migrate```

### Install Laravel Breeze for Authentication
Laravel Breeze provides simple authentication features. To install it, run the following:

  ```composer require laravel/breeze --dev```
  ```php artisan breeze:install vue```
  ``` npm install && npm run dev php artisan migrate ```

#### Install Pest for Testing
To install Pest for testing, run:

  ```composer require pestphp/pest --dev```
You can write your tests inside the tests folder using Pest's syntax.

##### Start the Laravel Development Server
Start the backend server:

   ```php artisan serve```

The Laravel API should now be available at http://127.0.0.1:8000.

3. Frontend Setup (Vue3)
#### Install Node.js Dependencies
Navigate to the frontend folder and install the necessary frontend dependencies:

   ```cd frontend npm install```
#### Set up Environment Variables
Create a .env file in the frontend directory:

   ```cp .env.example .env```
Modify the .env file to include the backend URL:

   ```VUE_APP_BACKEND_URL=http://127.0.0.1:8000```
##### Build and Run the Vue Development Server
To run the Vue development server:

   ```npm run dev```
The Vue frontend should now be running at http://localhost:3000.

### File Structure
#### Backend (Laravel)
``` backend/ ├── app/ │ ├── Http/ │ │ ├── Controllers/ │ │ │ ├── AuthController.php │ │ │ ├── ClothingItemController.php │ │ ├── Middleware/ │ │ │ ├── Authenticate.php │ ├── Models/ │ │ ├── ClothingItem.php │ │ ├── Category.php │ │ ├── User.php ├── database/ │ ├── migrations/ │ │ ├── 2021_XX_XX_XXXXXX_create_clothing_items_table.php │ │ ├── 2021_XX_XX_XXXXXX_create_categories_table.php │ ├── seeders/ │ │ ├── CategorySeeder.php │ │ ├── ClothingItemSeeder.php ├── routes/ │ ├── api.php │ ├── web.php ├── .env ├── composer.json```

#### Frontend (Vue3)
``` frontend/ ├── src/ │ ├── components/ │ │ ├── ClothingItemCard.vue │ │ ├── ClothingItemList.vue │ ├── views/ │ │ ├── Home.vue │ │ ├── Login.vue │ │ ├── Register.vue │ ├── store/ │ │ ├── index.js ├── .env ├── package.json └── tailwind.config.js ```

### API Endpoints
- POST /api/register - Register a new user.
- POST /api/login - Login a user.
- GET /api/clothing-items - Get all clothing items (with optional filtering).
- POST /api/clothing-items - Add a new clothing item.
- PUT /api/clothing-items/{id} - Edit an existing clothing item.
- DELETE /api/clothing-items/{id} - Delete a clothing item.
- GET /api/categories - Get all categories.
### Frontend Components
**Home.vue**
This is the main view where users can see the list of clothing items, with options to filter, search, and view details.

### Login.vue & Register.vue
These are the authentication pages for user login and registration.

### ClothingItemCard.vue
This component displays individual clothing items, including their name, category, and options for editing, viewing, and deleting.

### Styling
The application uses Tailwind **CSS** to create a responsive, mobile-first design. The grid system displays clothing items in a 2-column format on larger screens.

### Running Tests
To run tests using Pest, use the following command:

``` php artisan test ```

### Contributions
Feel free to fork this repository and submit pull requests. If you have any issues or suggestions, open an issue, and I will address it as soon as possible.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments
- Laravel (https://laravel.com/)
- Vue.js (https://vuejs.org/)
- Tailwind CSS (https://tailwindcss.com/)
- Inertia.js (https://inertiajs.com/)
- Pest (https://pestphp.com/)

