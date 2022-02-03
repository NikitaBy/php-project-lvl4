start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	php artisan migrate
	npm install

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

log:
	tail -f storage/logs/laravel.log

test:
	php artisan test

cache:
	php artisan cache:clear

deploy:
	git push heroku

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcs -- --standard=PSR12 app

test-coverage:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml