# Prompt — FSE WCBR2026 com Twenty Twenty-Five

Abrir em: `/Users/camaleaun/workspace/wcbr2026`

---

## Prompt de abertura

Vamos converter o design de `html-from-figma/index.html` em FSE usando o tema Twenty Twenty-Five que já está em `playground/wp-content/themes/twentytwentyfive/`.

**Regras absolutas:**
- Sem tema novo, sem plugin, sem pasta nova
- Editar apenas arquivos dentro de `playground/wp-content/themes/twentytwentyfive/`
- Design de referência: `html-from-figma/index.html` (HTML+CSS puro, mobile-first)
- Figma fileKey para dúvidas visuais: `eqkR2GPczngoIahZrM9p07`

**Escopo desta sessão — três partes:**

### 1. Header → `parts/header.html`

Substituir o header atual do TT25 pelo design de `html-from-figma/`. Estrutura do HTML de referência (linha ~1–122):

- Logo (`header__logo`) linkado para home
- Nav desktop com 4 itens: Evento (submenu), Agenda, Chamadas (submenu), Notícias — chevrons SVG inline nos itens com sub
- Header meta: social icons inline SVG Bootstrap Icons (WhatsApp · Instagram · X · TikTok · LinkedIn · Contato), hashtags `#WCBR #WCBR2026`, data `Belo Horizonte MG, 30 e 31 outubro 2026`
- Botão `Ingressos` (`btn btn--sm`)
- Hamburger (`nav-toggle`) para mobile
- Drawer offcanvas (`#mobile-drawer`): nav com ícones SVG de `assets/img/icons/`, submenus accordion, CTA Ingressos, social icons, tags, data

### 2. Footer → `parts/footer.html`

Substituir o footer atual do TT25 pelo design de `html-from-figma/`. Estrutura (linha ~372–423):

- Brand: logo, social icons (mesmo conjunto do header), tags, data
- Texto descritivo do evento
- Duas colunas nav: "Menu Rápido" e "Participação"
- Footer bottom: links legais (Política de Privacidade, Código de Conduta, Acessibilidade, Contato), motto `Código é possível.`, copyright

### 3. Hero → `patterns/wcbr2026-hero.php`

Criar novo pattern para a seção hero (linha ~123–150):

- Grid: coluna conteúdo + coluna mídia
- Conteúdo: dois chips (teal `WordCamp` + orange `30 e 31 outubro 2026`), título h1, texto lead, CTA Ingressos
- Mídia: frame com foto (`mirante-das-mangabeiras.jpg`)
- Registrar com `Title: WCBR2026 Hero` e `Categories: wcbr2026`

**Abordagem:**
1. Ler `html-from-figma/index.html` e `playground/wp-content/themes/twentytwentyfive/theme.json`
2. Mapear tokens de cor e tipografia do CSS de referência para o `theme.json` do TT25
3. Converter cada parte para markup de blocos WP (HTML comentado `<!-- wp:... -->`)
4. Usar MCP `wp-playground` para testar no browser após cada parte

Começar pelo `theme.json` (tokens) → header → footer → hero.
