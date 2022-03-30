
# Bookfriends

![framework: laravel (shields.io)](https://img.shields.io/badge/framework-laravel-red)
![framework: laravel (shields.io)](https://img.shields.io/badge/tests-pest-blueviolet)

> Share books you are reading, wants to read or read with your circle of friends, see a feed of books yours friends are interacting.

This project was developed following [Alex Garrett-Smith](https://twitter.com/alexjgarrett) -  [Up And Running with Pest](https://codecourse.com/courses/up-and-running-with-pest) course to familiarize with writing tests using [Pest testing Framework](https://pestphp.com/).

# :pushpin: Table of Contents

* [Requirements](# :computer:-requirements)
* [Installation](#🔧-installaling-bookfriends)
* [Running](#:rocket:-running-bookfriends)
* [Tests](#:test_tube:-running-tests)

## 💻 Requirements


* Docker
* Docker-compose

## 🔧 Installaling Bookfriends

To install Bookfriends, run the following command on project root directory
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
Configure env file as needed
```
cp .env.example .env
```
Start project Container
```
./vendor/bin/sail up -d 
```
Run Migrations | with container running, execute
```
./vendor/bin/sail artisan migrate 
```
Install package.json dependencies | with container running, execute
```
sail yarn install
```
## :rocket: Running Bookfriends

Start the project running on root directory
```
./vendor/bin/sail up -d
```
or, if laravel sail is aliased
```
sail up -d
```
Serve assets development
```
sail yarn hot
```
<br>
Then you can access the application at localhost:80 by default

## :test_tube: Running Tests

With the container running you can
```
./vendor/bin/sail up -d
```
or, if laravel sail is aliased
```
sail up -d
```
Serve assets development
```
sail yarn hot
```
<br>
Then you can access the application at localhost:80 by default

[⬆ back to top](#bookfriends)<br>
