#!/usr/bin/env node
import { readFileSync, existsSync } from 'node:fs'
import { createHash } from 'node:crypto'
import { execSync } from 'node:child_process'
import { join, dirname } from 'node:path'
import { fileURLToPath } from 'node:url'
import { load as yamlLoad } from 'js-yaml'

const ROOT = join(dirname(fileURLToPath(import.meta.url)), '..')
const MANIFEST_PATH = join(ROOT, 'i18n/manifest.yml')

function sha(filePath) {
  const abs = join(ROOT, filePath)
  if (!existsSync(abs)) return null
  return createHash('sha256').update(readFileSync(abs)).digest('hex').slice(0, 12)
}

function status(pair) {
  const enCur = sha(pair.en)
  const ptCur = sha(pair.pt)
  const enSaved = pair.en_sha || ''
  const ptSaved = pair.pt_sha || ''

  if (!enCur && !ptCur) return { code: 'missing', label: 'both files missing' }
  if (!ptCur) return { code: 'missing-pt', label: 'PT-BR file missing' }
  if (!enCur) return { code: 'missing-en', label: 'EN file missing' }
  if (!enSaved && !ptSaved) return { code: 'unregistered', label: 'not yet synced — run i18n-sync' }

  const enChanged = enCur !== enSaved
  const ptChanged = ptCur !== ptSaved

  if (!enChanged && !ptChanged) return { code: 'ok', label: 'in sync' }
  if (enChanged && !ptChanged) return { code: 'en-ahead', label: 'EN updated — PT-BR needs sync' }
  if (!enChanged && ptChanged) return { code: 'pt-ahead', label: 'PT-BR updated — EN needs sync' }
  return { code: 'both', label: 'both updated — verify manually' }
}

const manifest = yamlLoad(readFileSync(MANIFEST_PATH, 'utf8'))
const args = process.argv.slice(2)
const diffId = args.includes('--diff') ? args[args.indexOf('--diff') + 1] : null

if (diffId) {
  const pair = manifest.pairs.find(p => p.id === diffId)
  if (!pair) { console.error(`Unknown pair: ${diffId}`); process.exit(1) }
  const enAbs = join(ROOT, pair.en)
  const ptAbs = join(ROOT, pair.pt)
  if (!existsSync(enAbs)) { console.error(`EN file not found: ${pair.en}`); process.exit(1) }
  if (!existsSync(ptAbs)) { console.error(`PT-BR file not found: ${pair.pt}`); process.exit(1) }
  try {
    const diff = execSync(`diff -u "${ptAbs}" "${enAbs}"`, { encoding: 'utf8' })
    console.log(diff || '(files are identical)')
  } catch (e) {
    console.log(e.stdout || '(no diff output)')
  }
  process.exit(0)
}

const date = new Date().toISOString().slice(0, 10)
console.log(`\ni18n check — ${date}`)

let issues = 0
for (const pair of manifest.pairs) {
  const s = status(pair)
  const icon = s.code === 'ok' ? '✓' : '⚠'
  const id = pair.id.padEnd(28)
  console.log(`  ${icon}  ${id} ${s.label}`)
  if (s.code !== 'ok') issues++
}

if (issues > 0) {
  console.log(`\n${issues} pair(s) out of sync.`)
  console.log(`Show diff:  node scripts/i18n-check.js --diff <id>`)
  console.log(`After fix:  node scripts/i18n-sync.js [<id>]\n`)
  process.exit(1)
} else {
  console.log('\nAll pairs in sync. ✓\n')
}
