.PHONY: test
test: src tests vendor/autoload.php
	./vendor/bin/phpmd src text \
		controversial,naming,unusedcode
	./vendor/bin/phpcs --standard=PSR2 --colors src
	./vendor/bin/phpunit

vendor/autoload.php:
	composer install

.PHONY: coverage
coverage: src tests vendor/autoload.php
	mkdir -p build
	rm -rf build/*
	./vendor/bin/phpmd src text \
			controversial,naming,unusedcode \
			--reportfile ./build/phpmd.xml
	./vendor/bin/phpcs --standard=PSR2 --colors src \
		--report-file=./build/phpcs.xml
	./vendor/bin/phpunit --coverage-clover=build/logs/clover.xml \
		--coverage-html=build/coverage --coverage-text
