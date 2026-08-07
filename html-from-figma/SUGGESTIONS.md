# Sugestões / liberdades criativas — WCBR 2026

Este arquivo guarda ideias e desvios em relação ao design do Figma. O `index.html` local é
mantido **fiel ao Figma**; o que estiver aqui são propostas opcionais (não aplicadas), seção a
seção. Se alguma for aprovada, sincronizamos Figma + HTML depois.

Referência de sincronização: fileKey `eqkR2GPczngoIahZrM9p07` · desktop `587-5507` · mobile `587-5960`.

---

## Performance — Critical CSS above-the-fold (PARADO por enquanto)

**Estado atual:** o `index.html` carrega o CSS de forma simples e bloqueante:
`<link rel="stylesheet" href="assets/css/styles.css">` (mantendo só os `preload` das fontes críticas).
O critical CSS inline foi **removido a pedido** enquanto ajustamos as seções (evita ter que
regenerar o inline a cada mudança above-the-fold, ex.: hero).

**Como reaplicar depois (quando o layout estabilizar):**
1. Servir o site (`make up` → https://localhost:8443) e apontar o **crimson-critical-css-server**
   para ele.
2. `POST /v2/generate` com os breakpoints **mobile 360×640** e **desktop 1350×940** num único job;
   `safeList`: `.drawer.is-open`, `.drawer-backdrop.is-open`, `body.no-scroll`, e o que mais for
   dinâmico. Fazer polling em `GET /status/:jobId` até `done`.
3. Inline do resultado em `<style>` no `<head>` (com os `@font-face` e caminhos ajustados p/ a raiz)
   e trocar o `<link rel="stylesheet">` por carregamento assíncrono:
   `<link rel="preload" as="style" href="assets/css/styles.css" onload="this.onload=null;this.rel='stylesheet'">`
   + `<noscript>` de fallback.
4. Regenerar sempre que o conteúdo above-the-fold mudar bastante.

> Ganho esperado: remove o render-blocking do CSS (LCP mais rápido). Custo: precisa regenerar o
> inline a cada mudança grande no topo — por isso está parado durante o passo-a-passo das seções.

---

## Navegação — submenus (Evento, Chamadas)

**Como está (HTML + Figma):**
- Desktop: **dropdown no hover/foco** em Evento e Chamadas; chevron na **mesma cor do texto** (teal).
- Mobile (drawer/offcanvas): itens Evento e Chamadas com **chevron** e **submenu expansível** (acordeon).
- Figma: exemplo do submenu **aberto em Chamadas** — no header desktop (dropdown) e no offcanvas.

**Conteúdo dos submenus = exemplo (ajustar quando houver as páginas reais):**
- Evento → *Sobre o evento* (`#sobre`), *O que esperar* (`#formatos`)
- Chamadas → *Palestrantes*, *Patrocinadores*, *Voluntários* (todos → `#noticias` por ora)

---

## #formatos — "O que esperar"

**Como está no Figma (aplicado no HTML):**
- Desktop: 3 cards sempre abertos (ícone em caixa colorida 64px, título Poppins Black, descrição).
- Mobile: acordeon — 3 linhas fechadas (ícone 40px + título + chevron ⌄), expansível.
- Ícones reais do Figma (Palestras: pessoa+ondas mint / Mini: raio duplo branco / Painéis: grupo teal).
- Caixas de ícone unificadas desktop↔mobile: tokens `--teal`/`--south`/`--panel`, raio 2.

**Sugestões (não aplicadas):**
1. **Acordeon também no desktop** — os 3 cards virarem clicáveis (abrir/fechar), 1 aberto por vez.
   Deixaria a interação idêntica entre desktop e mobile. (Descartado: preferimos cards sempre abertos.)
2. **Ícones em linha (stroke) simplificados** — versão mais leve/minimalista dos ícones (mic, raio,
   pessoas em contorno 2px) no lugar dos ícones preenchidos do Figma. Estética mais "clean".
3. **Hover lift nos cards (desktop)** — leve elevação + aumento da sombra no `:hover`, no mesmo
   idioma "sticker" dos botões. Dá feedback tátil sem sair do estilo.
4. **Abrir o 1º item no mobile por padrão** — em vez de todos fechados, deixar "Palestras" aberto
   para o usuário já ver o formato de conteúdo. (Figma mostra todos fechados.)

---

## #noticias — "Últimas notícias"

**Como está no Figma (aplicado no HTML):**
- Desktop: grid 3 col × 2, 6 cards **flat** (borda 1px `--line`, sem sombra), imagem 16:9, tag
  Montserrat brick, título **Poppins Regular** teal-d (sentence-case, não uppercase/black),
  descrição 18px, link "Leia mais →".
- Mobile: **as mesmas 6 notícias do desktop**, como cards (fundo `--cream` + borda 1px). A **única
  diferença** no mobile é **sem imagem e sem descrição/resumo** (mostra tag + título + "Leia mais").
  Link "Ver todas" ao final.
- Link "Leia mais/Ver todas": texto teal simples, **sem** a barra laranja.
- Tag unificada em `--brick` (mobile estava #C94220).

> Nota: o design original do Figma mobile mostrava os itens como **lista de texto** (só 3, sem
> caixa). Por decisão do cliente, **desktop e mobile foram alinhados** (HTML **e** Figma): as **6
> notícias como card** (contorno/fundo/borda) no mobile, só escondendo imagem e descrição — mesmo
> conteúdo do desktop.

**Sugestões (não aplicadas):**
1. **Cards "sticker" (desktop)** — borda 2px + sombra dura `5px 5px 0 --teal` + hover (afunda 2px,
   sombra menor, imagem dá leve zoom). Dá mais personalidade e alinha com o estilo dos botões/hero,
   mas foge do visual flat do Figma.
2. **Título mais forte** — Poppins Black/uppercase no título da notícia (como nos H2). Mais impacto,
   porém o Figma usa Regular sentence-case (leitura editorial).
3. **Barra laranja no "Leia mais"** — sublinhado 4px `--south` no link (identidade forte de CTA).
   Figma usa texto simples.
4. **Notícias com imagem no mobile** — manter os 6 cards com thumbnail no mobile (em vez de lista de
   3 sem imagem). Mais rico visualmente, porém mais pesado e diferente do Figma.

**Pendência de asset (RESOLVIDA):**
- As imagens `news-patrocinio.*` e `news-evento.*` estavam com o **conteúdo trocado** vs Figma.
  Corrigido: os arquivos (avif/webp/jpg) foram trocados; Patrocínio agora mostra o crachá e Evento
  o "Save the Date".

---

## hero · stats · sobre

**Como está (aplicado no HTML):**
- **Hero:** chips (data teal + local laranja), H1 "Bem-vindo ao WordCamp Brasil", lead, botão
  "Garanta seu ingresso" + **imagem (cityscape BH) no desktop E no mobile** (decisão do cliente —
  ver nota).
- **Stats:** 4 números (100+, 16+, 15+, 2) — 1 linha no desktop, **2×2 no mobile**. (já batia)
- **Sobre:** título, 2 parágrafos, link "Conheça nossa história →" (com barra laranja, que aqui é
  do Figma) + **imagem no desktop E no mobile** (mesma decisão do hero).
- Figma mobile do "Sobre" corrigido: "campus da UFMG" → **"FUMEC"**.
- Header (Figma) restaurado para **3 linhas**: ícones / hashtags / local-data (as hashtags tinham
  ido parar na linha dos ícones ao trocar os ícones sociais).

> Nota: o **Figma mobile omite as imagens** de hero e sobre. O cliente preferiu **manter as imagens
> no mobile**. Divergência consciente HTML↔Figma (se quiser, dá pra adicionar as imagens ao Figma
> mobile para sincronizar).
