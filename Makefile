build:
	@cp .env.example .env
	@composer install --no-autoloader
	@vendor/bin/sail build --no-cache
	@vendor/bin/sail up -d
	@vendor/bin/sail composer install
	@vendor/bin/sail artisan storage:link
	@vendor/bin/sail artisan key:generate
	@vendor/bin/sail artisan migrate:install
	@vendor/bin/sail artisan migrate:install --env=testing
	@vendor/bin/sail artisan migrate --force
	@vendor/bin/sail artisan migrate --force --env=testing
	@vendor/bin/sail artisan db:seed --force
	@vendor/bin/sail npm install
	@vendor/bin/sail npm run build

up:
	@vendor/bin/sail up -d

down:
	@vendor/bin/sail down

refresh:
	@vendor/bin/sail artisan migrate:refresh --force --seed
	@vendor/bin/sail artisan migrate:refresh --force --env=testing
	@vendor/bin/sail artisan cache:clear

run-migrations:
	@vendor/bin/sail artisan migrate --force
	@vendor/bin/sail artisan migrate --force --env=testing
	@vendor/bin/sail artisan schema:dump

shell:
	@vendor/bin/sail shell

root-shell:
	@vendor/bin/sail root-shell

console:
	@vendor/bin/sail artisan tinker

pail:
	@vendor/bin/sail pail -vvv

lint:
	@vendor/bin/sail pint -vvv

analyse:
	@vendor/bin/sail bin phpstan analyse --memory-limit=1G --ansi

phpcs:
	@vendor/bin/sail bin phpcs

phpcbf:
	@vendor/bin/sail bin phpcbf

rector:
	@vendor/bin/sail bin rector --ansi

bench:
	@vendor/bin/sail bin phpbench run --report=aggregate --ansi

docs:
	@vendor/bin/sail artisan ide-helper:generate
	@vendor/bin/sail artisan ide-helper:meta
	@vendor/bin/sail artisan ide-helper:models --write

test:
	@vendor/bin/sail pest --parallel --compact --profile --coverage --min=100

schedule:
	@vendor/bin/sail artisan schedule:work

queue:
	@vendor/bin/sail artisan queue:failed
	@vendor/bin/sail artisan queue:retry all
	@vendor/bin/sail artisan queue:work --queue=default --stop-when-empty -v

horizon:
	@vendor/bin/sail artisan horizon

horizon-clear:
	@vendor/bin/sail artisan horizon:clear --queue=default --force

cache-clear:
	@vendor/bin/sail artisan cache:clear
	@vendor/bin/sail artisan route:clear
	@vendor/bin/sail artisan config:clear
	@vendor/bin/sail artisan view:clear
	@vendor/bin/sail artisan schedule:clear-cache
