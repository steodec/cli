.PHONI: controllers entities server help server install

vendor: composer.json
	composer install

composer.lock: composer.json
	composer update

install: vendor

help: ## Retourne les commandes
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-10s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

controllers: controller.php ## Création d'un fichier controllers
	php controller.php

entities: entities.php ## Création d'une entité pour la base de donnée
	php entities.php

server: install ## Lance le serveur interne de PHP
	php -S localhost:8000 -t public/ -d display_errors=1