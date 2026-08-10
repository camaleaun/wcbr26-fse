# WordCamps da América Latina

Levantamento extraído da **API REST pública do wordcamp.org**
(`https://central.wordcamp.org/wp-json/wp/v2/wordcamps`), filtrado pelos códigos
de país da América Latina. Base consultada em 2026-07-28 (1.486 WordCamps no total).

## Conteúdo
- `dados/wordcamps-america-latina.csv` — 97 edições (CSV, pronto p/ planilha)
- `dados/wordcamps-america-latina.json` — mesma base em JSON
- `wordcamps-brasil.md` — detalhamento das 28 edições do Brasil

## Resumo por país
| País | Edições |
|------|---------|
| 🇧🇷 Brasil | 28 |
| 🇨🇷 Costa Rica | 18 |
| 🇳🇮 Nicarágua | 13 |
| 🇲🇽 México | 10 |
| 🇨🇴 Colômbia | 6 |
| 🇬🇹 Guatemala | 5 |
| 🇦🇷 Argentina | 5 |
| 🇵🇪 Peru | 5 |
| 🇵🇷 Porto Rico | 2 |
| 🇧🇴🇪🇨🇵🇦🇺🇾🇨🇱 (1 cada) | 5 |

## "Brasil é o maior da América Latina?"
- ✅ **Sim, por nº de edições** (28, mais que o dobro do 2º).
- ✅ **Sim, por maior público previsto** (São Paulo, 700 — recorde regional).
- ⚠️ Por *capacidade de local*, Managua (NI) e Cidade do México aparecem com 1.000.
- ⚠️ A API **não** tem público real confirmado; os números são autodeclarados no planejamento.

## Campos do CSV/JSON
`pais, codigo_pais, cidade, ano, data_inicio, data_fim, publico_previsto,
capacidade_max, virtual, titulo, url, slug`
