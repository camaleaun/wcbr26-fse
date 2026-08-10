#!/usr/bin/env bash
# download.sh [YEAR]
# YEAR=2025 (default) → REST API at brasil.wordcamp.org/2025 → content-2025/
# YEAR=2026           → YAML export in wcbr26-translate/     → content-2026/
set -euo pipefail

YEAR="${1:-2025}"
WORKSPACE_ROOT="$(cd "$(dirname "$0")" && pwd)"
CONTENT_DIR="$WORKSPACE_ROOT/content-$YEAR"

if ! command -v jq >/dev/null 2>&1; then
  echo "Error: jq not found. Install with: brew install jq" >&2; exit 1
fi

# ---------------------------------------------------------------------------
# Shared helpers
# ---------------------------------------------------------------------------

slugify() {
  echo "$1" | tr '[:upper:]' '[:lower:]' \
    | sed -E 's/[^a-z0-9]+/-/g; s/(^-+|-+$)//g'
}

to_markdown() {
  local dir="$1"
  command -v pandoc >/dev/null 2>&1 || return 0
  local n=0
  for html in "$dir"/*.html; do
    [[ -f "$html" ]] || continue
    local md="${html%.html}.md"
    [[ -f "$md" && "$md" -nt "$html" ]] && continue
    pandoc -f html -t gfm --wrap=none "$html" -o "$md" 2>/dev/null && n=$((n+1))
  done
  [[ "$n" -gt 0 ]] && echo "  → $n markdown files written"
}

# ---------------------------------------------------------------------------
# Mode 2025: REST API
# ---------------------------------------------------------------------------

api_download() {
  local base_url="https://brasil.wordcamp.org/$YEAR"
  local endpoints=(pages posts sessions speakers sponsors organizers wcb_volunteer)

  echo "Source: $base_url"
  echo "Output: $CONTENT_DIR"
  echo ""

  for endpoint in "${endpoints[@]}"; do
    local out_dir="$CONTENT_DIR/$endpoint"
    mkdir -p "$out_dir"

    local url="$base_url/wp-json/wp/v2/$endpoint?per_page=100"
    local tmp status body
    tmp="$(mktemp)"
    status="$(curl -fsS -A "Mozilla/5.0" -o "$tmp" -w '%{http_code}' "$url" 2>/dev/null || echo 000)"
    body="$(cat "$tmp")"; rm -f "$tmp"

    if [[ "$status" != "200" ]] || ! echo "$body" | jq -e 'type=="array"' >/dev/null 2>&1; then
      echo "$endpoint: skipped (HTTP $status)"
      continue
    fi

    local total
    total="$(echo "$body" | jq 'length')"
    echo "$endpoint: $total items"

    echo "$body" | jq -r '
      .[]
      | [
          (.id | tostring),
          (.slug // ("id-" + (.id | tostring))),
          (.content.rendered // .content // .excerpt.rendered // "")
        ]
      | @tsv
    ' | while IFS=$'\t' read -r id slug html; do
      printf '%s' "$html" > "$out_dir/${id}-${slug}.html"
    done

    to_markdown "$out_dir"
  done
}

# ---------------------------------------------------------------------------
# Mode 2026: YAML export
# ---------------------------------------------------------------------------

yaml_extract() {
  local yaml_file
  yaml_file="$(find "$WORKSPACE_ROOT/wcbr26-translate" -name '*.yml' | grep -v glossary | head -1)"

  if [[ -z "$yaml_file" ]]; then
    echo "Error: no YAML file found in wcbr26-translate/" >&2; exit 1
  fi

  echo "Source: $yaml_file"
  echo "Output: $CONTENT_DIR"
  echo ""

  python3 - "$yaml_file" "$CONTENT_DIR" <<'PYEOF'
import sys, re, os, yaml

yaml_file, content_dir = sys.argv[1], sys.argv[2]

TYPE_TO_DIR = {
    'page':         'pages',
    'post':         'posts',
    'wcb_sponsor':  'sponsors',
    'wcb_session':  'sessions',
    'wcb_speaker':  'speakers',
    'wcb_organizer':'organizers',
    'wcb_volunteer':'volunteers',
}

def slugify(text):
    text = str(text).lower()
    text = re.sub(r'[^a-z0-9]+', '-', text)
    return text.strip('-')

with open(yaml_file) as f:
    data = yaml.safe_load(f)

items = data.get('items', [])
counts = {}

for item in items:
    post_type = item.get('post_type', '')
    folder = TYPE_TO_DIR.get(post_type)
    if not folder:
        continue

    pid   = str(item.get('post_id', ''))
    slug  = item.get('post_name') or slugify(item.get('title', '') or f'id-{pid}')
    html  = str(item.get('content', '') or '')

    out_dir = os.path.join(content_dir, folder)
    os.makedirs(out_dir, exist_ok=True)

    fname = os.path.join(out_dir, f'{pid}-{slug}.html')
    with open(fname, 'w') as f:
        f.write(html)

    counts[folder] = counts.get(folder, 0) + 1

for folder, n in sorted(counts.items()):
    print(f'{folder}: {n} items')
PYEOF

  for dir in "$CONTENT_DIR"/*/; do
    to_markdown "$dir"
  done
}

# ---------------------------------------------------------------------------
# Dispatch
# ---------------------------------------------------------------------------

mkdir -p "$CONTENT_DIR"

case "$YEAR" in
  2026) yaml_extract ;;
  *)    api_download ;;
esac

echo ""
echo "Done → $CONTENT_DIR"
