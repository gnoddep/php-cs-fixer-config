SHELL := /bin/bash

.PHONY: test
test: php-cs-fixer

.PHONY: php-cs-fixer
php-cs-fixer:
	PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer fix --diff -v --dry-run

.PHONY: fix
fix:
	PHP_CS_FIXER_IGNORE_ENV=1 ./vendor/bin/php-cs-fixer fix --diff -v

.PHONY: clean
clean:
	rm -f .php-cs-fixer.cache
