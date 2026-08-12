import fs from 'node:fs'
import path from 'node:path'
import { fileURLToPath } from 'node:url'
import sharp from 'sharp'

const root = path.resolve(fileURLToPath(import.meta.url), '../..')
const iconsDir = path.resolve(root, '../html-from-figma/icons')
const outDir = path.resolve(root, 'site/public/docs/2026/icons')

fs.mkdirSync(outDir, { recursive: true })

const svgs = fs.readdirSync(iconsDir).filter((f) => f.endsWith('.svg'))

for (const f of svgs) {
  const name = f.replace('.svg', '')
  const svgBuf = fs.readFileSync(path.join(iconsDir, f))
  await sharp(svgBuf, { density: 96 })
    .resize(150, 150, { fit: 'contain', background: { r: 0, g: 0, b: 0, alpha: 0 } })
    .png()
    .toFile(path.join(outDir, `${name}.png`))
  console.log(`✓ ${name}.png`)
}

console.log(`\n${svgs.length} PNG icons → ${path.relative(root, outDir)}/`)
