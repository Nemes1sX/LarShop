# E-Commerce core system
E-commerce core system build with Laravel 
## Functionality
1. Product shows under selected categories 
2. User shopping cart works under the session
## Installation instructions
1. Use ```copy .env.example .env``` to made copy of ```.env``` file.
2. Use ```php artisan key:generate``` to generate app key.
3. Provide correct DB credentials in .env file.
4. Migrate ```php artisan migrate```.
5. Use ```php artisan serve``` to launch app and ```npm run dev``` on the other terminal instance for front-end changes.
