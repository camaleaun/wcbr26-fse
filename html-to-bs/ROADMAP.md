# WCBR2026 Design System — Roadmap

## Internationalization (i18n)

**Status:** planned — not yet implemented

**Current state:** All site docs content is in English (primary language).

### Goal

Support a pt-br (Portuguese, Brazil) translation of the docs, accessible at `/docs/2026/pt-br/` alongside the English content at `/docs/2026/`.

### Proposed approach

#### 1. Content structure

Mirror the EN directory under a `pt-br/` prefix inside `site/src/content/docs/`:

```
site/src/content/docs/
  getting-started/
    introduction.mdx          ← EN (primary)
  pt-br/
    getting-started/
      introduction.mdx        ← PT-BR translation
```

The `sidebar.yml` stays language-agnostic; slug resolution adds the `pt-br/` prefix at build time for translated pages.

#### 2. Language switcher

Add a language dropdown to the header (alongside the theme toggler) that alternates between:

- `/docs/2026/<slug>` — English
- `/docs/2026/pt-br/<slug>` — Português (Brasil)

Falls back to the equivalent EN page if no translation exists for the current slug.

#### 3. Astro implementation options

**Option A — content collection `lang` field (simpler):**
Add `lang: 'pt-br'` to the frontmatter schema. The page router generates separate paths for each lang. Sidebar filters by active lang.

**Option B — Astro i18n routing (more complete):**
Use Astro's built-in `i18n` config (`locales: ['en', 'pt-br'], defaultLocale: 'en'`). Gives automatic `Astro.currentLocale`, `getRelativeLocaleUrl()`, and redirect helpers out of the box.

Recommended: **Option B** for a cleaner URL and redirect story, but Option A is faster to prototype.

#### 4. UI strings

Component copy (footer labels, navigation strings, "Skip to main content") also needs translation. Use a `data/translations.yml` (already present in the site) to drive locale-aware strings in Astro components.

### Priority

Low — the primary audience for the design system (developers contributing to WCBR2026) is comfortable in English. The pt-br translation becomes more relevant if the docs are published publicly as a reference for future Brazilian WordCamps.
