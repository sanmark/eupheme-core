dev-down:
	docker-compose -f dev.docker-compose.yml down
dev-shell:
	docker-compose -f dev.docker-compose.yml exec lk-sanmark-minerva-dev bash
dev-up:
	docker-compose -f dev.docker-compose.yml up -d --build
