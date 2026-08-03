---
name: Vibrant Pulse
colors:
  teal:      '#00595D'
  teal-d:    '#004E4D'
  teal-dd:   '#003E3E'
  grenadier: '#D43900'
  south:     '#F56530'
  brick:     '#B52701'
  brick-b:   '#C94220'
  cream:     '#FFF8F1'
  cream-2:   '#F5EDE3'
  line:      '#BEC9C8'
  panel:     '#E9E1D8'
  ink:       '#3E4948'
  muted:     '#556260'
  white:     '#FFFFFF'
  foot-head: '#FFB4A3'
  foot-text: '#F7F0E6'
typography:
  h1:
    fontFamily: Poppins
    fontWeight: '900'
    fontSize: clamp(36px, 6.2vw, 58px)
    lineHeight: '1.08'
    letterSpacing: -0.02em
    textTransform: uppercase
  h2:
    fontFamily: Poppins
    fontWeight: '900'
    fontSize: clamp(30px, 5vw, 48px)
    lineHeight: '1.08'
    letterSpacing: -0.01em
    textTransform: uppercase
  h3:
    fontFamily: Poppins
    fontWeight: '900'
    fontSize: clamp(22px, 3vw, 30px)
    lineHeight: '1.08'
    textTransform: uppercase
  body:
    fontFamily: Montserrat
    fontWeight: '400'
    fontSize: 18px
    lineHeight: '1.45'
  body-lg:
    fontFamily: Montserrat
    fontWeight: '400'
    fontSize: clamp(17px, 2.2vw, 22px)
    lineHeight: '1.4'
  nav:
    fontFamily: Poppins
    fontWeight: '700'
    fontSize: 16px
    textTransform: uppercase
    letterSpacing: 0.05em
  btn:
    fontFamily: Poppins
    fontWeight: '900'
    fontSize: 16.8px
    textTransform: uppercase
    letterSpacing: 0.05em
  tag:
    fontFamily: Montserrat
    fontWeight: '600'
    fontSize: 13px
    textTransform: uppercase
    letterSpacing: 0.06em
rounded:
  btn: 0
  chip: 2px
  drawer-item: 8px
  avatar: 50%
spacing:
  container-max: 1232px
  container-gutter: 24px
  section-v-padding: clamp(64px, 9vw, 102px)
  section-head-mb: clamp(40px, 6vw, 64px)
breakpoints:
  tablet: 640px
  desktop-content: 900px
  desktop-header: 1080px
---

## Brand & Style

Este design system captura o espírito profissional e enérgico de um evento de comunidade tecnológica de destaque. O equilíbrio entre a confiabilidade de uma conferência educacional e o pulso vibrante de um festival criativo.

A estética é **Sticker Flat** (neobrutalist-lite): superfícies sólidas, bordas visíveis e sombras duras diagonais `5px 5px 0` que simulam profundidade física sem recorrer a blurs ou gradientes. Zero border-radius nos botões e componentes primários — a "dureza" comunica autoridade; os arredondamentos aparecem apenas em elementos secundários (drawer, avatar) para manter a amizade da comunidade.

**Princípios centrais:**
- **Tactile Feedback:** botões e cards "afundam" no hover com `translate(2px, 2px)` + redução da sombra.
- **Hierarquia extrema:** peso 900 + uppercase + `clamp()` agressivo guiam o olhar imediatamente ao CTA e ao título.
- **Contraste intencional:** Teal sobre Cream, Grenadier sobre Teal, Brick acessível (AA) sobre Cream.

## Cores

A paleta tem dois eixos: **Teal** (autoridade, navegação, estrutura) e **Laranja** (ação, destaque, energia). O Grenadier é o laranja puro de CTA; o South é o laranja mais quente usado em bordas e sombras de acento; o Brick é o laranja mais escuro, com contraste AA, usado em texto e no botão da newsletter.

**Tokens e usos:**

| Token | Valor | Uso principal |
|---|---|---|
| `--teal` | `#00595D` | títulos, nav, stats, chips |
| `--teal-d` | `#004E4D` | newsletter bg, moldura hero, nomes org |
| `--teal-dd` | `#003E3E` | footer bg, sombras hero |
| `--grenadier` | `#D43900` | botão CTA primário |
| `--south` | `#F56530` | bordas/sombras de acento (about, formatos) |
| `--brick` | `#B52701` | botão newsletter, hashtags, tags, bordas org |
| `--brick-b` | `#C94220` | sombra do btn-brick |
| `--cream` | `#FFF8F1` | fundo base, header, hero, cards |
| `--cream-2` | `#F5EDE3` | fundo alternado (sobre, notícias, org) |
| `--line` | `#BEC9C8` | bordas de cards e separadores |
| `--panel` | `#E9E1D8` | fundos de ícone neutros |
| `--ink` | `#3E4948` | texto de corpo |
| `--muted` | `#556260` | texto secundário (função dos org, contraste AA) |
| `--white` | `#FFFFFF` | texto sobre teal/grenadier |
| `--foot-head` | `#FFB4A3` | títulos e hover no footer |
| `--foot-text` | `#F7F0E6` | texto geral do footer |

**Regras de combinação:**
- Sobre `--teal` → texto branco, botão `--grenadier`.
- Sobre `--teal-d` (newsletter) → texto branco, botão `--brick`.
- Sobre `--cream` → texto `--ink`, botões `--grenadier` ou `--brick`.
- Sobre `--teal-dd` (footer) → texto `--foot-text`, destaques `--foot-head`.

## Tipografia

Poppins (títulos, nav, botões) + Montserrat (corpo, tags). Ambas self-hosted em woff2 subset latin com `font-display: swap`. Poppins Black (900) é o peso máximo disponível — o sistema não usa pesos 950/1000.

**Regras:**
- Headings sempre uppercase com `clamp()` — escalam entre mobile e desktop sem overflow.
- Botões e nav: Poppins 900/700, uppercase, `letter-spacing: 0.05em`.
- Tags/rótulos: Montserrat 600, uppercase, `letter-spacing: 0.06em`, cor `--brick`.
- Corpo: Montserrat 400, `18px / 1.45`.

## Layout & Espaçamento

Container máximo `1232px` com `padding-inline: 24px`. Mobile-first com três breakpoints:

- **640px** — colunas de stats, formatos, notícias, patrocinadores, org; newsletter vira inline.
- **900px** — grids de conteúdo (hero, sobre, notícias) viram dois/três colunas.
- **1080px** — header desktop (nav + social + data + botão de ingressos). Abaixo deste ponto só o hambúrguer aparece, pois o conjunto do header não cabe sem gerar overflow horizontal.

Padding vertical das sections: `clamp(64px, 9vw, 102px)`.

## Elevação & Profundidade

Sombra dura diagonal `5px 5px 0 0 <cor>` — sem blur, sem opacidade. Simula um offset físico impresso. A cor da sombra é sempre um tom mais escuro/saturado da borda do elemento:

| Contexto | Borda | Sombra |
|---|---|---|
| Botão primário (grenadier) | `--south` | `--south` |
| Botão newsletter (brick) | `--brick-b` | `--brick-b` |
| Hero frame | `--teal-dd` | `--teal-dd` |
| Cards "O que esperar" | `--line` | `--teal` |
| Cards sponsor | `--line` | `--teal` |
| Imagem "Sobre" | `--south` | `--south` |

**Interação:** hover move `translate(2px, 2px)` e reduz sombra para `3px 3px 0 0`; active bate no fundo (`translate(5px, 5px)`, sombra zero).

**Hero frame duplo:** borda `2px solid --teal-dd` + `box-shadow 5px 5px 0 0 --teal-dd` no elemento pai; `::before` absoluto posicionado `-16px 16px 16px -16px` com `border: 4px solid --teal-d`. O `.hero__frame` usa `isolation: isolate` para o `::before` não sumir atrás do fundo da seção.

## Formas

| Elemento | Border-radius |
|---|---|
| Botões (`.btn`) | `0` — sticker flat |
| Chips do hero | `2px` |
| Ícones de formato | `2px` |
| Itens do drawer/nav | `8px` |
| Avatares dos org | `50%` |
| Cards de notícia | sem radius |
| Cards de sponsor | sem radius |

## Componentes

### Botões

```css
/* Primário (CTA laranja) */
background: var(--grenadier);
border: 2px solid var(--south);
box-shadow: 5px 5px 0 0 var(--south);
border-radius: 0;
font-family: Poppins; font-weight: 900; text-transform: uppercase; letter-spacing: .05em;
padding: 20px 40px; font-size: 1.05rem;

/* Secundário (newsletter, brick) */
.btn--brick → background: var(--brick); border/shadow: var(--brick-b);

/* Small */
.btn--sm → padding: 13px 30px; font-size: .9rem;

/* Hover */
transform: translate(2px, 2px); box-shadow: 3px 3px 0 0 <cor>;

/* Active */
transform: translate(5px, 5px); box-shadow: 0 0 0 0 <cor>;
```

### Header

Sticky, fundo `--cream`, borda inferior `1px solid --line`. Nav desktop só acima de 1080px (links Poppins 700 uppercase, cor `--teal`, underline laranja `--south` no hover). Hambúrguer abaixo de 1080px.

### Drawer (offcanvas mobile)

Lateral direita, 320px, fundo `--cream`, `translateX(100%)` → 0. Itens com `border-radius: 8px`, texto Poppins 700 uppercase `--ink`. Submenus colapsáveis via `grid-template-rows: 0fr → 1fr`. Fecha com Esc / backdrop / clique em link. Usa `inert` quando fechado.

### Cards de notícia

Fundo `--cream`, borda `1px solid --line`, sem sombra, sem radius. Mobile: sem imagem, sem descrição. 640px+: imagem 16:9 no topo + descrição Montserrat 400 aparecem. Tag: Montserrat 600 uppercase `--brick`. Título: Poppins 400 (não uppercase) `--teal-d`.

### Cards de sponsor

Fundo `--cream`, borda `2px solid --line`, sombra `4px 4px 0 0 --teal`, sem radius. Três tamanhos: `--lg` (96px alto, logo grande), default (72px), `--text` (56px, texto/muted, sombra `--line`).

### Cards "O que esperar" (formatos)

Fundo `--cream`, borda `2px solid --line`, sombra `5px 5px 0 0 --teal`. Mobile: acordeon (cabeçalho clicável, painel com `grid-template-rows` collapsível). 640px+: cards sempre abertos, ícone 64px, layout coluna.

### Avatares dos organizadores

Círculo 72px, `border: 3px solid`. Borda alterna entre `--teal-d` e `--brick` (ou `--south`). Nome: Poppins 600 `--teal-d`. Função: Montserrat 400 uppercase `--muted`.

### Newsletter

Fundo `--teal-d`, texto branco. Input: fundo `--cream`, `border-radius: 0`, `border: 2px solid --cream`. Botão `--brick`. Mobile: form em coluna; 640px+: inline (input + botão lado a lado).

### Footer

Fundo `--teal-dd`. Grid 4 colunas a partir de 640px (1.4fr + 3×1fr). Destaques e hovers em `--foot-head`. Barra inferior separada por `border-top: 1px solid rgba(255,255,255,.12)`.

### Navegação

Links: Poppins 700, uppercase. Desktop: `gap: 24px`, underline `3px solid --south` no hover. Mobile drawer: `border-radius: 8px`, `background: --cream-2` no hover/active. Submenus desktop: dropdown com `border: 1px solid --line`, `box-shadow: 0 10px 30px rgba(0,0,0,.14)`.

### Separadores de tier (patrocinadores)

`::before` e `::after` de `2px` de altura e `40px` de largura, cor `--south`. Variante `--sm` usa `--line` e `24px`.
