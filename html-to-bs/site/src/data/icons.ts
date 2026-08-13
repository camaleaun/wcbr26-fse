import fs from 'node:fs'
import path from 'node:path'

export interface WcbrIcon {
  name: string
  title: string
  svg: string
  categories: string[]
  tags: string[]
}

const iconsDir = path.join(process.cwd(), 'icons')

function titleFromName(name: string): string {
  return name
    .split('-')
    .map((w) => w.charAt(0).toUpperCase() + w.slice(1))
    .join(' ')
}

const categoryMap: Record<string, string[]> = {
  'lightning':        ['Format'],
  'people-fill':      ['Format'],
  'broadcast':        ['Format'],
  'instagram':        ['Social'],
  'linkedin':         ['Social'],
  'tiktok':           ['Social'],
  'twitter-x':        ['Social'],
  'whatsapp':         ['Social'],
  'map-marker':       ['Geo'],
  'envelope':         ['Communication'],
  'calendar':         ['Date'],
  'arrow-right-short':['Arrow'],
}

const tagMap: Record<string, string[]> = {
  'lightning':        ['format', 'mini', 'lightning', 'workshop', 'flash'],
  'people-fill':      ['format', 'paineis', 'panels', 'people', 'group', 'audience'],
  'broadcast':        ['format', 'palestras', 'talks', 'speaker', 'broadcast', 'voice'],
  'instagram':        ['instagram', 'social', 'photo'],
  'linkedin':         ['linkedin', 'social', 'professional'],
  'tiktok':           ['tiktok', 'social', 'video'],
  'twitter-x':        ['twitter', 'x', 'social'],
  'whatsapp':         ['whatsapp', 'social', 'chat', 'message'],
  'map-marker':       ['map', 'pin', 'location', 'geo'],
  'envelope':         ['envelope', 'email', 'mail', 'contact'],
  'calendar':         ['calendar', 'date', 'event', 'schedule'],
  'arrow-right-short':['arrow', 'right', 'direction'],
}

export const icons: WcbrIcon[] = fs
  .readdirSync(iconsDir)
  .filter((f) => f.endsWith('.svg'))
  .sort()
  .map((f) => {
    const name = f.replace('.svg', '')
    return {
      name,
      title: titleFromName(name),
      svg: fs.readFileSync(path.join(iconsDir, f), 'utf-8').trim(),
      categories: categoryMap[name] ?? [],
      tags: tagMap[name] ?? [],
    }
  })
