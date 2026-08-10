# WordCamp Brasil 2026 — servidor local fiel a produção (Caddy: HTTPS + gzip + cache + HTTP/2)
NAME  := wcbr-caddy
PORT  := 8443
SITE  := $(CURDIR)/html-from-figma
SERVE := $(CURDIR)/.serve
CERTS := $(SERVE)/certs
IMAGE := caddy:2
URL   := https://localhost:$(PORT)/
TUNLOG := $(SERVE)/cloudflared.log
TUNPID := $(SERVE)/cloudflared.pid

FSE_PORT  := 8001
WP_PORT   := 9999

.DEFAULT_GOAL := help
.PHONY: help up down restart logs status cert tunnel untunnel tunnel-url fse playground playground-dev

help: ## Lista os comandos
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN{FS=":.*?## "}{printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2}'

cert: ## Gera o cert local (mkcert) se ainda não existir
	@command -v mkcert >/dev/null || { echo "mkcert ausente — instale: brew install mkcert && mkcert -install"; exit 1; }
	@mkdir -p $(CERTS)
	@test -f $(CERTS)/localhost.pem || mkcert -cert-file $(CERTS)/localhost.pem -key-file $(CERTS)/localhost-key.pem localhost 127.0.0.1 ::1

up: cert ## Sobe o servidor em https://localhost:8443
	@docker rm -f $(NAME) >/dev/null 2>&1 || true
	@docker run -d --name $(NAME) -p $(PORT):$(PORT) \
		-v "$(SITE)":/srv:ro \
		-v "$(SERVE)/Caddyfile":/etc/caddy/Caddyfile:ro \
		-v "$(CERTS)":/certs:ro \
		$(IMAGE) >/dev/null
	@echo "▲ no ar: $(URL)"

down: untunnel ## Derruba o servidor (e o túnel)
	@docker rm -f $(NAME) >/dev/null 2>&1 && echo "▼ parado" || echo "já estava parado"

tunnel: up ## Expõe via Cloudflare Quick Tunnel (URL pública HTTPS, sem login)
	@command -v cloudflared >/dev/null || { echo "cloudflared ausente — instale: brew install cloudflared"; exit 1; }
	@pkill -f "cloudflared tunnel --url $(URL:/=)" >/dev/null 2>&1 || true
	@nohup cloudflared tunnel --url $(URL:/=) --no-tls-verify --http-host-header localhost > $(TUNLOG) 2>&1 & echo $$! > $(TUNPID)
	@printf "▲ abrindo túnel"; url=""; \
		for i in $$(seq 1 20); do url=$$(grep -oE 'https://[a-z0-9-]+\.trycloudflare\.com' $(TUNLOG) 2>/dev/null | head -1); [ -n "$$url" ] && break; printf "."; sleep 1; done; echo; \
		if [ -n "$$url" ]; then echo "🌐 público: $$url"; \
			echo "   (se seu DNS local bloquear *.trycloudflare.com, abra pelo 4G ou troque o DNS p/ 1.1.1.1)"; \
		else echo "não consegui a URL — veja $(TUNLOG)"; exit 1; fi

untunnel: ## Derruba o túnel
	@pkill -f "cloudflared tunnel --url $(URL:/=)" >/dev/null 2>&1 && echo "▼ túnel parado" || echo "túnel já estava parado"
	@rm -f $(TUNPID)

tunnel-url: ## Mostra a URL pública do túnel atual
	@if pgrep -f "cloudflared tunnel --url $(URL:/=)" >/dev/null 2>&1; then \
		grep -oE 'https://[a-z0-9-]+\.trycloudflare\.com' $(TUNLOG) 2>/dev/null | tail -1 || echo "túnel rodando, mas sem URL no log ($(TUNLOG))"; \
	else echo "nenhum túnel ativo — rode: make tunnel"; fi

restart: ## Reinicia (down + up)
	@$(MAKE) --no-print-directory down
	@$(MAKE) --no-print-directory up

logs: ## Segue os logs do container
	@docker logs -f $(NAME)

fse: ## Serve fse/ via HTTP na porta 8001 (necessário para make playground-dev)
	@echo "▲ servindo fse/ em http://localhost:$(FSE_PORT)  (Ctrl-C para parar)"
	python3 -m http.server $(FSE_PORT) --directory fse

playground: ## Inicia WP Playground CLI na porta 9999 — lê fse/ do GitHub/main
	npx @wp-playground/cli server --blueprint=./blueprint.json --port=$(WP_PORT)

playground-dev: ## Inicia WP Playground CLI na porta 9999 — lê fse/ do localhost:8001 (rodar make fse primeiro)
	npx @wp-playground/cli server --blueprint=./blueprint-dev.json --port=$(WP_PORT)

status: ## Mostra status do container (e a URL do túnel, se ativo)
	@docker ps --filter name=$(NAME) --format 'status: {{.Status}}\nports:  {{.Ports}}'
	@echo "url:    $(URL)"
	@if pgrep -f "cloudflared tunnel --url $(URL:/=)" >/dev/null 2>&1; then \
		echo "túnel:  $$(grep -oE 'https://[a-z0-9-]+\.trycloudflare\.com' $(TUNLOG) 2>/dev/null | tail -1)"; \
	else echo "túnel:  inativo (make tunnel)"; fi
