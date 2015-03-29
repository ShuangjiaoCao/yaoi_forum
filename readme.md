## BBS

This is a simple Laravel app for a BBS website to demonstrate key features of this web framework


It is recommended that you run this example on the BBS Appliance

### Setup

1. Install composer (for dependency management)

`curl -sS https://getcomposer.org/installer | php`

`sudo mv composer.phar /usr/local/bin/composer`

2. Download the repository.

Distribution code: `https://github.com/farrah8888/yaoi_forum.git`

Completed example: `git clone -b completed https://github.com/farrah8888/yaoi_forum.git`

3. Navigate into the new `BBS` folder and install dependencies

`composer install`

4. If you're running the completed example, you need to create the database called `BBS` and then run

`php artisan migrate`

5. Run the server using

`php artisan serve`

6. Go to this in your browser

`http://localhost:8000`
