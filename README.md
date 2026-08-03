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

## Estrutura

```
fse/
  header.html     — template part header (FSE, blocos WP nativos)
  footer.html     — template part footer (FSE, blocos WP nativos)
  hero.html       — conteúdo da página inicial (8 seções em blocos WP nativos)
  styles.css      — CSS global (fontes, cores, layout, componentes)
  setup.php       — script de setup via runPHP
  mu-plugin.php   — must-use plugin (enqueue JS)
  img/            — ícones PNG 150×150 para header/footer nav

html-from-figma/
  index.html            — referência HTML puro gerada do Figma
  assets/fonts/         — Poppins 900 + Montserrat (woff2)
  assets/img/           — fotos (hero, about, notícias, organizadores), logos
  assets/img/icons/     — ícones SVG do drawer (nav, close) — html-from-figma apenas
```

## Arquitetura de blocos

Cada seção da home segue o padrão:

```
wp:group align=full className="section nome"   ← background fullwidth
  wp:group className="container [grid-class]"  ← conteúdo centrado em 1232px
    wp:heading / wp:paragraph                  ← blocos nativos
    wp:html                                    ← apenas: picture, form, SVG inline, acordeão
```

Validação: `block-runner validate fse/hero.html` — 69 blocos, 0 inválidos.

## Gerador de filtros CSS

Converte hex para `filter: brightness(0) saturate(100%) invert(...)` — usado nos ícones PNG monocromáticos:

```bash
python3 css-filter.py "#D43900" "#00595D" "#004E4D"
```
