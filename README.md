# WordCamp Brasil 2026 — FSE Preview

Prévia do site via WordPress Playground (sem instalação):

**[▶ Abrir no WordPress Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/camaleaun/wcbr26-fse/main/blueprint.json)**

Atualiza automaticamente a cada push na branch `main`.

## Como funciona

O `blueprint.json` configura um WordPress completo no browser:

1. Instala o tema Twenty Twenty-Five
2. Copia os arquivos de `fse/` para `wp-content/uploads/wcbr2026/`
3. Copia as fontes de `html-from-figma/assets/fonts/`
4. Copia as imagens de `html-from-figma/assets/img/` para `wp-content/uploads/wcbr2026/img/`
5. Executa `fse/setup.php` que:
   - Importa fotos para `wp-content/uploads/YYYY/MM/` via `wp_insert_attachment`
   - Insere `wp_template_part` para header e footer
   - Insere `wp_global_styles` com paleta de cores e CSS customizado
   - Cria página inicial com os blocos da home
   - Define template de página sem título do post
   - Cria 6 posts de notícias com categorias e imagem destacada
   - Cria 8 posts `wcb_organizer` com `wcb_organizer_team` e avatar via Gravatar (`media_sideload_image`)

## Estrutura

```
fse/
  header.html     — template part header (FSE, blocos WP nativos)
  footer.html     — template part footer (FSE, blocos WP nativos)
  hero.html       — conteúdo da página inicial (8 seções em blocos WP nativos)
  styles.css      — CSS global (fontes, cores, layout, componentes)
  setup.php       — script de setup via runPHP
  mu-plugin.php   — must-use plugin (CPTs wcb_organizer/wcb_sponsor, enqueue JS)
  img/            — ícones PNG 150×150 para nav e chips (pretos, coloridos via CSS filter)

html-from-figma/
  index.html            — referência HTML puro gerada do Figma
  assets/fonts/         — Poppins + Montserrat (woff2)
  assets/img/           — fotos (hero, about, notícias, logos)
  assets/img/icons/     — ícones SVG do drawer (nav, close) — html-from-figma apenas

organizers.yml    — dados dos organizadores (título, wcb_organizer_team, _wcpt_user_name, _gravatar_hash)
```

## Arquitetura de blocos

Cada seção da home segue o padrão:

```
wp:group align=full layout=constrained className="section nome"   ← fullwidth + centra filhos em 1232px
  wp:heading / wp:paragraph / wp:image                           ← blocos nativos
  wp:query                                                        ← loop dinâmico (posts, wcb_organizer)
  wp:html                                                         ← apenas: form, SVG inline, acordeão
```

O `layout:constrained` no grupo externo elimina o grupo interno `.container` — o WP centraliza os filhos diretos em `contentSize` (1232px). A seção newsletter usa `contentSize:720px` próprio.

Validação: `block-runner validate fse/hero.html` — 76 blocos, 0 inválidos.

## Custom Post Types (mu-plugin.php)

| CPT | Suporte | Taxonomia |
|-----|---------|-----------|
| `wcb_organizer` | title, thumbnail, page-attributes | `wcb_organizer_team` (flat) |
| `wcb_sponsor` | title, thumbnail, page-attributes, editor | `wcb_sponsor_level` (hierárquica) |

Avatares dos organizadores são sideloaded do Gravatar usando `_gravatar_hash` de `organizers.yml`:
```
https://secure.gravatar.com/avatar/{hash}?s=96&d=mm&r=g
```

## Gerador de filtros CSS

Converte hex para `filter: brightness(0) saturate(100%) invert(...)` — usado nos ícones PNG monocromáticos:

```bash
python3 css-filter.py "#D43900" "#00595D" "#004E4D"
```

## Criar ícone PNG a partir de SVG

```bash
sips -s format png icon.svg --out fse/img/icon-nome.png
```
