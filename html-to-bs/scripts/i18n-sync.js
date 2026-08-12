#!/usr/bin/env node
import { readFileSync, writeFileSync, existsSync } from 'node:fs'
import { createHash } from 'node:crypto'
import { join, dirname } from 'node:path'
import { fileURLToPath } from 'node:url'
import { load as yamlLoad, dump as yamlDump } from 'js-yaml'

const ROOT = join(dirname(fileURLToPath(import.meta.url)), '..')
const MANIFEST_PATH = join(ROOT, 'i18n/manifest.yml')

function sha(filePath) {
  const abs = join(ROOT, filePath)
  if (!existsSync(abs)) return ''
  return createHash('sha256').update(readFileSync(abs)).digest('hex').slice(0, 12)
}

const manifest = yamlLoad(readFileSync(MANIFEST_PATH, 'utf8'))
const targetId = process.argv[2] || null

let count = 0
for (const pair of manifest.pairs) {
  if (targetId && pair.id !== targetId) continue
  pair.en_sha = sha(pair.en)
  pair.pt_sha = sha(pair.pt)
  count++
  console.log(`  synced  ${pair.id}`)
}

if (targetId && count === 0) {
  console.error(`Unknown pair: ${targetId}`)
  process.exit(1)
}

writeFileSync(MANIFEST_PATH, yamlDump(manifest, { lineWidth: 120 }))
console.log(`\n${count} pair(s) synced → i18n/manifest.yml updated.\n`)
