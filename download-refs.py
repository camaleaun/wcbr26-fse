#!/usr/bin/env python3
"""Download pages and posts from WordCamp reference sites for RAG."""
import os, sys, json, urllib.request, urllib.error

SITES = {
    "wceu2026": "https://europe.wordcamp.org/2026",
    "wcus2026": "https://us.wordcamp.org/2026",
    "wcas2026": "https://asia.wordcamp.org/2026",
}

HEADERS = {"User-Agent": "Mozilla/5.0 (compatible; wcbr2026-rag/1.0)"}
ROOT = os.path.dirname(os.path.abspath(__file__))


def fetch(url):
    req = urllib.request.Request(url, headers=HEADERS)
    try:
        with urllib.request.urlopen(req, timeout=30) as r:
            return json.loads(r.read().decode())
    except Exception as e:
        print(f"  ERROR {url}: {e}", file=sys.stderr)
        return []


def download_site(key, base):
    print(f"=== {key} ({base}) ===")
    for ep in ("pages", "posts"):
        out_dir = os.path.join(ROOT, f"content-{key}", ep)
        os.makedirs(out_dir, exist_ok=True)
        items = fetch(f"{base}/wp-json/wp/v2/{ep}?per_page=100")
        print(f"  {ep}: {len(items)} items")
        for item in items:
            iid = str(item.get("id", ""))
            slug = item.get("slug") or f"id-{iid}"
            html = (item.get("content") or {}).get("rendered") or ""
            fname = os.path.join(out_dir, f"{iid}-{slug}.html")
            with open(fname, "w", encoding="utf-8") as f:
                f.write(html)


if __name__ == "__main__":
    targets = sys.argv[1:] if len(sys.argv) > 1 else list(SITES.keys())
    for key in targets:
        if key in SITES:
            download_site(key, SITES[key])
        else:
            print(f"Unknown site: {key}", file=sys.stderr)
    print("Done")
