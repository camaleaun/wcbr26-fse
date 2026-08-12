import { defineConfig } from 'astro/config'
import { unified } from '@astrojs/markdown-remark'
import { bootstrap } from './src/libs/astro'
import { getConfig } from './src/libs/config'

const site = process.env.DEPLOY_PRIME_URL ?? getConfig().baseURL

export default defineConfig({
  build: {
    assets: `docs/${getConfig().docs_version}/assets`
  },
  integrations: [bootstrap()],
  markdown: {
    processor: unified()
  },
  site,
})
