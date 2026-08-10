# Navegação Principal (Header) — WordCamp Brasil 2026

Mapeamento comparativo dos menus de navegação principal de cada evento de referência, com proposta para o WCBR2026.

Referências: [WCBR2025](https://brasil.wordcamp.org/2025) · [WCEU2026](https://europe.wordcamp.org/2026) · [WCUS2026](https://us.wordcamp.org/2026) · [WCAS2026](https://asia.wordcamp.org/2026)

---

## WCBR2025

Evento regional brasileiro, 2 dias, ~500 participantes, público predominantemente PT-BR.

**Estrutura:**
```
O Evento ▾
  Localização
  Organização
  Palestrantes
  Participantes
  Patrocinadores
  Código de Conduta
  Contato
Programação
Chamadas ▾
  Seja Voluntário
  Seja Patrocinador
Notícias
```

**Observações:**
- Menu muito completo, quase todos os itens visíveis no topo
- "Ingressos" não estava no menu principal (vendas não abertas no período)
- "Participantes" no topo é incomum — sinal de valorização da comunidade
- Chamadas agrupadas em dropdown único; faltou chamar para Palestrantes
- Sem separação clara entre "O Evento" (informacional) e "Agenda" (operacional)

---

## WCEU2026

Evento europeu de grande porte, 3 dias, ~3.000 participantes, Cracóvia (Polônia), público majoritariamente EN + idiomas europeus.

**Estrutura:**
```
About ▾
  About WordCamp Europe
  Contributor Day
  Akademia WordPressa (parceiro local)
  Spread the Word
  WCEU for Agencies
  Call for Host City 2028
News ▾
  Blog
  Podcast
Community ▾
  Organisers
  Media Partners
  Attendees
  WordPress Community Booth
  Speakers by Category
  Grab Your Badge
Code of Conduct
Location ▾
  Venue Maps
  The Venue
  Visa Information
  Accommodation
  Transportation
  Discover Kraków
Schedule ▾
  Contributor Day (June 4)
  Conference Day 1 (June 5)
  Conference Day 2 (June 6)
  Workshop Registration
  After Party
  Childcare
  Side Events
Sponsors ▾
  Sponsors
  Microsponsors
```

**Observações:**
- 7 itens de topo, todos com dropdown — nav muito rico, adequado ao porte do evento
- "About" agrupa contexto, história e missão; inclui item local (Akademia) e chamada futura (Host City 2028)
- "Community" reúne pessoas, crachás e Booth num único grupo
- "Location" inclui visa e hospedagem — sinal de público internacional
- "Schedule" é o dropdown mais denso: 7 subitens com ancoragem por dia
- Sponsors tem modalidade própria (Microsponsors) — ecossistema de patrocínio grande
- Sem "Speakers" no topo — acessado via Community ou Schedule

---

## WCUS2026

Evento norte-americano de grande porte, 3 dias, Portland (Oregon), público EN.

**Estrutura:**
```
Schedule
Speakers
News
About ▾
  About WordCamp US
  Contributor Day
  Contact
  Code of Conduct
Community ▾
  Organizers
  Sponsors
  Call for Sponsors
  Attendees
  Grab Your Badge
Location ▾
  Travel & Accommodation
  Venue Information
  Tickets
```

**Observações:**
- 6 itens no topo; mais compacto que WCEU, mais expandido que WCBR2025
- Schedule, Speakers, News são links diretos — conteúdo principal acessível em 1 clique
- "About" agrega metainformações + Contact + CoC
- "Community" mistura equipe (Organizers) com participação (Sponsors, Attendees) — grupo heterogêneo
- "Location" inclui Tickets — decisão de UX para converter visitantes direto do menu de logística
- Sem Ingressos como item de topo separado

---

## WCAS2026

Evento asiático de grande porte, 3 dias, Mumbai (Índia), público EN + idiomas asiáticos.

**Estrutura:**
```
Details ▾
  News (Updates)
  Event Info
  Live Streaming
  Live Captioning
  About WC Asia
  Venue and Locations
  Shuttle Service Guide
  Official Hotels
  Visa
  Side Events
  Accessibility
  Explore Mumbai
  Hotel Choices
  FAQ
  Contact
Program ▾
  Schedule
  Contributor Day
  YouthCamp
  After Party
People ▾
  Organizers
  Speakers
  Media Partners
  Volunteers
  Attendees
  Emcees
Sponsors
```

**Observações:**
- 4 itens de topo — estrutura mais enxuta que WCEU mas submenus extensos
- "Details" é muito denso (15 subitens): agrupa acesso, mobilidade, hospedagem, visa e FAQ — adequado ao evento em cidade com logística complexa (Mumbai)
- "Program" agrupa todas as atividades incluindo YouthCamp (único entre os 4 eventos)
- "People" reúne todos os papéis: Emcees é item único do WCAS
- Live Streaming e Live Captioning no menu reforçam compromisso com acessibilidade e audiência remota
- Sem "News" separado no topo (dentro de Details)

---

## Proposta WCBR2026

Evento regional brasileiro, 2 dias, público ~70% PT-BR, ~30% internacional.

### Fase 1 — Divulgação (antes de abrir inscrições)

```
Sobre ▾
  Sobre o Evento
  Localização
  Dia da Colaboração
  Código de Conduta
  Organização
Chamadas ▾
  Seja Palestrante
  Seja Patrocinador
  Seja Voluntário
Notícias
Assinar Novidades
```

Foco em capturar interesse e promover chamadas. Menu enxuto enquanto o conteúdo de evento ainda não existe.

### Fase 2 — Inscrições abertas (principal)

```
Agenda
Sessões
Palestrantes
Sobre ▾
  Sobre o Evento
  Localização
  Dia da Colaboração
  Organização
  Código de Conduta
Chamadas ▾
  Seja Palestrante   [fechar quando encerrar]
  Seja Patrocinador
  Seja Voluntário
Ingressos
Notícias
```

### Fase 3 — Pós-evento

```
Agenda
Sessões
Palestrantes
Vídeos
Sobre ▾
  Sobre o Evento
  Localização
  Organização
  Código de Conduta
```

---

### Decisões para o WCBR2026

| Questão | Opções | Ref. |
|---|---|---|
| Sessões no menu? | Sim (novo 2026) / Não (inclui em Agenda) | WCEU+WCUS têm |
| Participantes no menu? | Sim (como WCBR2025) / Não | Só WCBR2025 tinha |
| Contato no menu? | Item direto / Dentro de Sobre | WCUS=dentro, WCBR2025=direto |
| Ingressos em fase 2? | Item de topo (converter visitante) / Dentro de Localização | WCUS coloca em Location |
| Chamadas: page ou post? | Afeta se aparecem no feed | A decidir |
| Idioma do menu? | PT-BR puro / Misturar EN em itens bidiomas | WCBR2025=PT-BR puro |
