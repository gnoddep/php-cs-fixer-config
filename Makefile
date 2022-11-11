SHELL := /bin/bash

.PHONY: test
test: php-cs-fixer

.PHONY: php-cs-fixer
php-cs-fixer:
	./vendor/bin/php-cs-fixer fix --diff -v --dry-run

.PHONY: fix
fix:
	./vendor/bin/php-cs-fixer fix --diff -v

.PHONY: clean
clean:
	rm -f .php-cs-fixer.cache
