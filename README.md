# WordCamp Brasil 2026 — FSE Preview

Prévia do site via WordPress Playground (sem instalação):

**[▶ Abrir no WordPress Playground](https://playground.wordpress.net/?blueprint-url=https://raw.githubusercontent.com/camaleaun/wcbr26-fse/main/blueprint.json)**

Atualiza automaticamente a cada push na branch `main`.

## Como funciona

O `blueprint.json` configura um WordPress completo no browser:

1. Instala o tema Twenty Twenty-Five
2. Copia os arquivos de `fse/` para `wp-content/uploads/wcbr2026/`
3. Copia as fontes de `html-from-figma/assets/fonts/`
4. Executa `fse/setup.php` que insere no banco:
   - `wp_template_part` para header e footer
   - `wp_global_styles` com paleta de cores e CSS customizado
   - Página inicial com o bloco hero
5. Ativa mu-plugin para registrar o padrão hero

## Estrutura

```
fse/
  header.html     — template part header (FSE)
  footer.html     — template part footer (FSE)
  hero.html       — conteúdo da página inicial
  styles.css      — CSS global (fontes, cores, layout)
  setup.php       — script de setup via runPHP
  mu-plugin.php   — must-use plugin (enqueue JS, registra padrões)
  img/            — ícones SVG monocromáticos (pretos, coloridos via CSS filter)

html-from-figma/
  assets/fonts/   — Poppins 900 + Montserrat (woff2)
  assets/img/     — logo-white.png

css-filter.py     — gerador de CSS filter a partir de hex
                    (port de angel-rs/css-color-filter-generator)
```

## Uso do gerador de filtros CSS

```bash
python3 css-filter.py "#D43900" "#00595D" "#004E4D"
```

Também disponível em `~/workspace/bash/css-filter.py`.
