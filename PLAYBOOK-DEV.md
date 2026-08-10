# Playbook — Dev Loop WP Playground

Objetivo: aprender como o WordPress renderiza blocos FSE na prática,
observando o DOM real via Chrome DevTools MCP.

---

## Pré-requisitos

- Node.js instalado (`node -v`)
- `npx` disponível
- Python 3 instalado (`python3 --version`)
- Chrome aberto com DevTools MCP conectado

---

## Como iniciar

Abra dois terminais na raiz do projeto:

**Terminal 1 — serve os arquivos locais**
```bash
make fse
# → http://localhost:8001 (fse/ disponível para o blueprint)
```

**Terminal 2 — sobe o WordPress**
```bash
make playground-dev
# → http://localhost:9999 (WP rodando)
```

Aguarde o Terminal 2 mostrar a URL pronta. A primeira vez demora ~2 min
(baixa TwentyTwentyFive, fontes e imagens do GitHub).

---

## Páginas úteis no Playground

| O quê | URL |
|---|---|
| Site (front-end) | `http://localhost:9999/` |
| Style Book | `http://localhost:9999/wp-admin/site-editor.php?canvas=edit` |
| Editor de estilos globais | `http://localhost:9999/wp-admin/site-editor.php?path=%2Fwp_global_styles` |
| Templates | `http://localhost:9999/wp-admin/site-editor.php?path=%2Fwp_template` |
| Template Parts | `http://localhost:9999/wp-admin/site-editor.php?path=%2Fwp_template_part` |

---

## Loop de aprendizado

### Usuário edita no Site Editor → Claude observa

1. Você abre o Style Book e altera algo (cor, shadow, tipografia, bloco)
2. Claude tira screenshot via Chrome DevTools MCP
3. Claude inspeciona o DOM com `evaluate_script`:
   ```js
   getComputedStyle(document.querySelector('.wp-block-group')).gap
   ```
4. Claude documenta o que WP gera e atualiza `~/.claude/skills/html-to-wp/SKILL.md`

### Claude edita arquivo local → ver resultado

1. Claude edita `fse/styles.css` ou `fse/header.html`
2. No Terminal 2: `Ctrl-C` e `make playground-dev` novamente
3. Claude navega para `http://localhost:9999/` e tira screenshot

> Dica: mudanças em `styles.css` (só CSS) recarregam sem reiniciar.
> Mudanças em HTML ou `setup.php` precisam reiniciar o playground.

---

## O que aprender no Style Book

- **Cores**: como WP aplica `has-{slug}-color` e `--wp--preset--color--{slug}`
- **Tipografia**: escala de tamanhos, font-family via preset
- **Shadows**: presets de sombra (`--wp--preset--shadow--*`)
- **Blocos**: o que cada bloco gera de HTML e classes CSS por padrão
- **Spacing**: como `blockGap` e `padding` viram variáveis `--wp--preset--spacing--*`

---

## Quando reiniciar vs recarregar

| Mudança | Ação |
|---|---|
| `styles.css` | Recarregar a página no Chrome |
| `header.html` / `footer.html` / `hero.html` | Reiniciar: `Ctrl-C` + `make playground-dev` |
| `setup.php` (paleta, fontes) | Reiniciar |
| Edição no Site Editor (in-browser) | Salva no DB automaticamente, sem reiniciar |

---

## Arquivos do projeto

```
fse/
├── styles.css      ← CSS customizado (entra em wp_global_styles)
├── setup.php       ← cria paleta, templates e posts no DB
├── mu-plugin.php   ← registra CPTs e enfileira JS
├── header.html     ← template part: header
├── footer.html     ← template part: footer
└── hero.html       ← conteúdo da página inicial

blueprint-dev.json  ← lê fse/ do localhost:8001 (dev)
blueprint.json      ← lê fse/ do GitHub/main (produção/compartilhar)
```
