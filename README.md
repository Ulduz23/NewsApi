## INSTALLATION
- Run git clone 
- Open Terminal and Run Code
```bash
    git clone https://github.com/alakhber/NewsApi.git
```
- Run cp .env.example .env
- Create a mysql database and edit the ".env" file as you like
- Open Terminal 
```bash
    # Installing Dependencies
    composer install
    # Generate an encryption key
    php artisan key:generate
    # Running Migrations
    php artisan migrate
    # It will add news as many as the number you have written 
    php artisan generate:news --count=20
    # Run Project
    php artisan serve
``` 


