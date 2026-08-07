# WordCamp Brasil 2026 — HTML from Figma

Landing page responsiva em **HTML + CSS puro** (sem frameworks, sem build), gerada a partir do design do Figma e mantida em sincronia bidirecional com ele.

- Figma (arquivo ativo): `eqkR2GPczngoIahZrM9p07` — time Pro
- Desktop: `node-id=587-5507` · Mobile: `node-id=587-5960` · Drawer: `node-id=587-6278`

## Estrutura

```
html-from-figma/
├── index.html            # Página completa (semântica, acessível)
├── assets/
│   ├── css/styles.css    # Mobile-first, custom properties, @font-face self-hosted
│   ├── js/main.js        # Menu offcanvas acessível (sem dependências)
│   ├── fonts/*.woff2      # Poppins (400/600/700/900) + Montserrat (var) — subset latin
│   └── img/
│       ├── *.{avif,webp,jpg}        # hero, about, 6 notícias (3 formatos cada)
│       ├── icons/*.svg              # ícones do drawer (baixados do Figma)
│       └── organizers/*.{avif,webp,jpg}  # 8 fotos dos organizadores
└── README.md
```

## Como visualizar

```bash
cd html-from-figma
python3 -m http.server 8000
# abra http://localhost:8000
```

> ⚠️ O `http.server` do Python **não** envia `Cache-Control` nem gzip — isso derruba a nota de
> Performance no Lighthouse por limitação do servidor, não do código. Para um teste fiel a
> produção, use o serviço HTTPS abaixo.

## Servir como produção (HTTPS + gzip + cache + HTTP/2)

Para o Lighthouse refletir produção (sem os artefatos do servidor local), sirva via **Caddy** em
Docker, com cert local confiável (`mkcert`). Do diretório `wcbr2026/` (onde está o `Makefile`):

```bash
make up      # gera o cert (se faltar) e sobe https://localhost:8443
make down    # derruba
make restart # reinicia
make status  # status do container
make logs    # segue os logs
```

O `Makefile` roda por baixo:

```bash
docker run -d --name wcbr-caddy -p 8443:8443 \
  -v "$PWD/html-from-figma":/srv:ro \
  -v "$PWD/.serve/Caddyfile":/etc/caddy/Caddyfile:ro \
  -v "$PWD/.serve/certs":/certs:ro caddy:2
```

O `Caddyfile` habilita **gzip/zstd**, **HTTP/2** e um `Cache-Control` por tipo de asset:
- `/assets/img/*` e `/assets/fonts/*` → `max-age=31536000, immutable` (conteúdo estável).
- `/assets/css/*` e `/assets/js/*` → `no-cache` (revalidam sempre — os nomes de arquivo são fixos,
  sem hash, então `immutable` faria o navegador/túnel servir CSS/JS **antigos** após uma edição).
- `.html` → `no-cache`.

> Se um dispositivo já pegou um `styles.css`/`main.js` com o `immutable` antigo, faça **um** hard
> refresh (ou limpar dados do site) uma vez; depois disso ele passa a atualizar sozinho.

### Critical CSS (inline above-the-fold) — ⏸️ desativado no momento

> **Estado atual:** o `index.html` carrega o CSS de forma simples e bloqueante
> (`<link rel="stylesheet" href="assets/css/styles.css">`, mantendo só os `preload` das fontes
> críticas). O critical CSS inline foi **removido enquanto ajustamos as seções** (evita ter que
> regenerar o inline a cada mudança above-the-fold). O procedimento completo para reativar está em
> [`SUGGESTIONS.md`](SUGGESTIONS.md) → *"Performance — Critical CSS above-the-fold"*.

Quando o layout estabilizar, o CSS crítico é extraído pelo serviço **`crimson-critical-css-server`**
(Puppeteer + CSSOM), cobrindo os breakpoints **mobile 360×640** e **desktop 1350×940** num único job:

```bash
curl -X POST http://localhost:3000/v2/generate -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" -d '{
    "url":"http://host.docker.internal:8123/","pageType":"home","salesChannelId":"wcbr2026",
    "callback_url":"http://host.docker.internal:9/noop",
    "breakpoints":[{"name":"mobile","width":360,"height":640},{"name":"desktop","width":1350,"height":940}],
    "safeList":[".drawer.is-open",".drawer-backdrop.is-open","body.no-scroll"]}'
# depois: GET /status/:jobId (polling) devolve o css quando status=done
```

O resultado vai inline em `<style>` (com `@font-face` e caminhos ajustados p/ a raiz) e o
`styles.css` completo carrega assíncrono (`preload` → `onload` troca para `stylesheet`), removendo o
**render-blocking** do CSS. Regenere quando o conteúdo above-the-fold mudar bastante.

## Qualidade (Lighthouse)

Nota cheia em **desktop e mobile** (51 auditorias, 0 falhas):

| Categoria        | Desktop | Mobile |
|------------------|:-------:|:------:|
| Accessibility    |   100   |  100   |
| Best Practices   |   100   |  100   |
| SEO              |   100   |  100   |
| Agentic Browsing |   100   |  100   |
| LCP              | ~0,1s   | —      |
| CLS              | 0,00    | —      |

> **Performance:** o score 100 dependia do **critical CSS inline** (atualmente ⏸️ desativado — ver
> acima). Com o CSS voltando a ser render-blocking, o Performance pode ficar um pouco abaixo de 100
> até reativarmos o critical CSS. As demais categorias (A11y/BP/SEO) não são afetadas.

## Sistema de design (extraído do Figma)

- **Tipografia:** **Poppins** (Black/Bold/SemiBold/Regular) para títulos, nav, botões e nomes;
  **Montserrat** (Regular/Bold) para corpo e rótulos (ex.: função dos organizadores).
- **Estilo "sticker" (flat):** cantos retos + borda 2px + **sombra dura `5px 5px 0`** em botões,
  cards e imagens. O hero tem **moldura offset dupla** (borda `#003e3e` + `::before` `#004e4d`);
  o `::before` usa `isolation: isolate` no `.hero__frame` pra não sumir atrás do fundo da seção.
- **Botões** "afundam" no `:hover` (translate + sombra menor).

## Imagens — `<picture>` com 3 formatos

Cada imagem raster é servida como **AVIF → WebP → JPG** (fallback):

```html
<picture>
  <source type="image/avif" srcset="…​.avif">
  <source type="image/webp" srcset="…​.webp">
  <img src="…​.jpg" alt="…" width="…" height="…" loading="lazy">
</picture>
```

- O navegador escolhe o AVIF (menor, ~30% abaixo do JPG); cai pra WebP e depois JPG em navegadores antigos.
- **PNG** fica reservado só para imagens com transparência (ex.: logos).
- `picture { display: contents }` mantém as regras de `img` valendo (wrapper não afeta o layout).
- Pipeline de geração: `cwebp` (WebP), `dwebp`→`avifenc -q 60` (AVIF), `dwebp`→`sips` (JPG).

## Menu offcanvas (drawer lateral direito)

Entra pela **lateral direita** (320px), com backdrop, `inert` quando fechado, foco preso,
fecha com Esc / backdrop / clique em link. Corresponde ao nó `587:6278`. Ícones = SVG exatos
do Figma em `assets/img/icons/`.

**Decisão importante — por que `position: fixed` e não um wrapper com `overflow: hidden`:**
- Um wrapper que recorta o drawer fora da tela **quebra a animação de abertura** (o elemento
  recortado não é "pintado", então a transição salta em vez de deslizar).
- O drawer `position: fixed` translado para fora (`translateX(100%)`) **não** estende a área de
  rolagem — logo, não causa scroll horizontal. A rolagem horizontal que existia vinha **dos grids**
  (ver abaixo), não do drawer.
- `main.js` força um reflow (`void drawer.offsetWidth`) antes de abrir, garantindo o quadro inicial
  da transição.

## Rolagem horizontal — causa e correção

O scroll horizontal em algumas larguras vinha de **grids `repeat(N, 1fr)`** (patrocinadores e
formatos): `1fr` = `minmax(auto, 1fr)`, e o `auto` impede a coluna de encolher abaixo do conteúdo,
estourando a largura. Correções:

- Todos os grids multi-coluna usam **`repeat(N, minmax(0, 1fr))`** + `min-width: 0` nos itens.
- O **header desktop** (nav + social/tags/data + botão) só aparece a partir de **1080px** — abaixo
  disso ele não cabe e estouraria; até lá fica o hambúrguer.

### Breakpoints
- **640px** — colunas de stats/formatos/notícias/patrocinadores/organização.
- **900px** — grids de conteúdo (hero, sobre, notícias) viram desktop.
- **1080px** — header desktop (senão estoura).

## Organizadores (sincronizado com o Figma)

8 organizadores reais, em **4×2** (desktop) / **2×4** (mobile), unificados entre os dois frames do
Figma e o HTML:

- **Fotos reais** (Gravatar) em avatar circular; borda alternando **Grenadier `#B52701` / Teal `#004E4D`**.
- **Nomes:** Poppins **SemiBold**, capitalizado, `--teal-d`.
- **Função:** Montserrat Regular, MAIÚSCULA, `--muted` (`#556260`).
- Sincronização **code→design** feita via `use_figma` + `upload_assets` do conector Figma
  (nomes, funções, fotos e o 8º card criados/atualizados nos dois frames).

## Cotas de patrocínio

Tropeirão (Ouro) · Torresmo de Rolo (Prata) · Pão de Queijo (Bronze) · Cafezinho (Ferro).

## Decisões de performance / acessibilidade

- Imagens com `width`/`height` + `aspect-ratio` → **CLS 0**; hero com `fetchpriority="high"`,
  demais com `loading="lazy"`.
- **Fontes self-hosted** (woff2, subset latin) com `font-display: swap` — sem terceiro (Google Fonts)
  no caminho crítico; as 2 fontes above-the-fold (Poppins 900 do H1 + Montserrat do corpo) usam `preload`.
- HTML semântico, hierarquia de headings, `alt` em imagens, `aria-*`, skip-link, foco visível.
- Cores de texto em contraste **AA** (cinza `#556260`, laranja `#B52701`).

## Paleta

| Token         | Cor       | Uso                                       |
|---------------|-----------|-------------------------------------------|
| `--teal`      | `#00595D` | Títulos, stats, chips                     |
| `--teal-d`    | `#004E4D` | Newsletter, moldura hero, nomes/bordas org |
| `--teal-dd`   | `#003E3E` | Footer, sombras do hero                    |
| `--grenadier` | `#D43900` | Botões (CTA)                              |
| `--south`     | `#F56530` | Bordas/sombras/ícones de acento           |
| `--brick`     | `#B52701` | Botão newsletter, texto/bordas org        |
| `--cream`     | `#FFF8F1` | Fundo base                                |
| `--cream-2`   | `#F5EDE3` | Fundo alternado (sobre/notícias/org)       |
| `--ink`       | `#3E4948` | Texto do corpo                            |
| `--muted`     | `#556260` | Texto secundário (função dos organizadores) |
