dev-build:
	docker-compose -f dev.docker-compose.yml build
dev-down:
	docker-compose -f dev.docker-compose.yml down
dev-shell:
	docker-compose -f dev.docker-compose.yml exec lk-sanmark-eupheme-dev bash
dev-up:
	docker-compose -f dev.docker-compose.yml up -d
prod-build:
	docker-compose -f prod.docker-compose.yml build
prod-down:
	docker-compose -f prod.docker-compose.yml down
prod-shell:
	docker-compose -f prod.docker-compose.yml exec lk-sanmark-eupheme bash
prod-up:
	docker-compose -f prod.docker-compose.yml up -d