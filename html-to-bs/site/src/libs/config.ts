import fs from 'node:fs'
import { load as yamlLoad } from 'js-yaml'
import { z } from 'zod'

const configSchema = z.object({
  title: z.string(),
  subtitle: z.string(),
  description: z.string(),
  authors: z.string(),
  baseURL: z.string(),
  docs_version: z.string(),
  docsDir: z.string(),
  repo: z.string(),
  anchors: z.object({ min: z.number(), max: z.number() }),
  toc: z.object({ min: z.number(), max: z.number() }),
  algolia: z.object({ api_key: z.string(), app_id: z.string(), index_name: z.string() }).optional(),
  analytics: z.object({ fathom_site: z.string() }).optional(),
  cdn: z.record(z.string()).optional(),
  current_version: z.string().optional(),
  current_ruby_version: z.string().optional(),
  download: z.record(z.string()).optional(),
  github_org: z.string().optional(),
  icons: z.string().optional(),
  opencollective: z.string().optional(),
  rfs_version: z.string().optional(),
  swag: z.string().optional(),
  blog: z.string().optional(),
  x: z.string().optional(),
})

let config: Config | undefined

export function getConfig(): Config {
  if (config) return config
  try {
    const rawConfig = yamlLoad(fs.readFileSync('./config.yml', 'utf8'))
    config = configSchema.parse(rawConfig)
    return config
  } catch (error) {
    if (error instanceof z.ZodError) {
      console.error('config.yml inválido:', error.issues)
    }
    throw new Error('Falha ao carregar config.yml', { cause: error })
  }
}

type Config = z.infer<typeof configSchema>
