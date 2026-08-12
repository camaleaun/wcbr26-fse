import type { HTMLAttributes } from 'astro/types'
import { getConfig } from '@libs/config'
import { getVersionedDocsPath } from '@libs/path'

export function getVersionedBsCssProps(direction: 'rtl' | undefined) {
  let bsCssLinkHref = '/dist/css/bootstrap'

  if (direction === 'rtl') {
    bsCssLinkHref = `${bsCssLinkHref}.rtl`
  }

  if (import.meta.env.PROD) {
    bsCssLinkHref = `${bsCssLinkHref}.min`
  }

  bsCssLinkHref = `${bsCssLinkHref}.css`

  const bsCssLinkProps: HTMLAttributes<'link'> = {
    href: getVersionedDocsPath(bsCssLinkHref),
    rel: 'stylesheet'
  }

  if (import.meta.env.PROD) {
    bsCssLinkProps.integrity = direction === 'rtl' ? getConfig().cdn.css_rtl_hash : getConfig().cdn.css_hash
  }

  return bsCssLinkProps
}

export function getVersionedBsJsProps() {
  const bsJsScriptSrc = '/assets/js/bootstrap.bundle.min.js'

  const bsJsLinkProps: HTMLAttributes<'script'> = {
    src: getVersionedDocsPath(bsJsScriptSrc)
  }

  return bsJsLinkProps
}
