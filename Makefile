dev-build:
	docker-compose -f dev.docker-compose.yml build
dev-down:
	docker-compose -f dev.docker-compose.yml down
dev-shell:
	docker-compose -f dev.docker-compose.yml exec lk-sanmark-eupheme-dev bash
dev-up:
	docker-compose -f dev.docker-compose.yml up -d
