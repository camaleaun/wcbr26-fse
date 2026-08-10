# Plano de Páginas e Posts — WordCamp Brasil 2026

Documento de planejamento colaborativo do site do WCBR2026.
Cada item traz o contexto do scaffold padrão do WordCamp.org (EN) e o que cada evento de referência fez.

Referências: [WCBR2025](https://brasil.wordcamp.org/2025) · [WCEU2026](https://europe.wordcamp.org/2026) · [WCUS2026](https://us.wordcamp.org/2026) · [WCAS2026](https://asia.wordcamp.org/2026)

---

## Confirmadas

### Páginas

#### Agenda

**Slug:** `agenda` &nbsp;|&nbsp; **Título:** Agenda &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `programacao`](https://brasil.wordcamp.org/2025/programacao/) · [WCEU2026 `schedule`](https://europe.wordcamp.org/2026/schedule/) · [WCUS2026 `schedule`](https://us.wordcamp.org/2026/schedule/)
**Scaffold EN2026:** `publish` como `schedule` — conteúdo vazio com nota: _"You can enter content for this page in the Sessions menu item in the sidebar."_ O plugin gera a grade automaticamente a partir dos dados de `wcb_session`.
**PT-BR traduzido:** título → **Agenda** · nota traduzida: _"Você pode inserir conteúdo para esta página no item de menu Sessões na barra lateral."_
**Scaffold placeholders:** nota de instrução fica visível na página publicada — _remover antes de abrir ao público: não_

No WCBR2025 a página `programacao` reunia o Dia da Colaboração (sexta-feira) e as palestras dos dois dias com horários e locais. WCEU2026 e WCUS2026 separam `schedule` (grade com horários) de `sessions` (catálogo de sessões) — adotamos essa separação em 2026.

**Versão EN?** avaliar — _participantes e palestrantes internacionais acompanham a grade_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Sessões

**Slug:** `sessoes` &nbsp;|&nbsp; **Título:** Sessões &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCEU2026 `sessions`](https://europe.wordcamp.org/2026/sessions/) · [WCUS2026 `sessions`](https://us.wordcamp.org/2026/sessions/)
**Scaffold EN2026:** `publish` como `sessions` — mesma nota do schedule: _"You can enter content for this page in the Sessions menu item in the sidebar."_
**PT-BR traduzido:** título → **Sessões** · nota: _"Você pode inserir conteúdo para esta página no item de menu Sessões na barra lateral."_
**Scaffold placeholders:** nota de instrução fica visível na página publicada — _remover antes de abrir ao público: não_

Página nova em 2026 — não existia separada no WCBR2025, onde sessões e horários ficavam juntos em `programacao`. WCEU2026 e WCUS2026 mantêm `sessions` como catálogo navegável de todas as palestras, independente de horário.

**Versão EN?** avaliar — _palestrantes e participantes internacionais buscam as sessões_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Palestrantes

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `palestrantes`](https://brasil.wordcamp.org/2025/palestrantes/) · [WCEU2026 `speakers`](https://europe.wordcamp.org/2026/speakers/) · [WCUS2026 `speakers`](https://us.wordcamp.org/2026/speakers/)
**Scaffold EN2026:** `publish` como `speakers` — conteúdo vazio com nota: _"You can enter content for this page in the Speakers menu item in the sidebar."_ O plugin lista automaticamente os posts `wcb_speaker`.
**PT-BR traduzido:** título → **Palestrantes** · nota: _"Você pode inserir conteúdo para esta página no item de menu Palestrantes na barra lateral."_
**Scaffold placeholders:** nota de instrução fica visível na página publicada — _remover antes de abrir ao público: não_

No WCBR2025 usou-se `palestrantes` (PT-BR). Decidir slug: `palestrantes` (consistência com 2025) ou `speakers` (alinhamento com WCEU/WCUS).

**Versão EN?** avaliar — _palestrantes internacionais e público EN buscam seus perfis_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Patrocinadores

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `patrocinadores`](https://brasil.wordcamp.org/2025/patrocinadores/) · [WCEU2026 `sponsors`](https://europe.wordcamp.org/2026/sponsors/) · [WCUS2026 `sponsors`](https://us.wordcamp.org/2026/sponsors/)
**Scaffold EN2026:** `publish` como `sponsors` — veio com nota de alerta sobre patrocinadores globais automáticos (Bluehost, Automattic, Hostinger, Woo) e instrução para remover os que não se aplicam ao evento, consultando a página de [Global Community Sponsorship](https://make.wordpress.org/community/handbook/wordcamp-organizer/planning-details/fundraising/global-community-sponsorship-for-event-organizers/). Também já criou os quatro sponsors globais como posts `wcb_sponsor`.
**PT-BR traduzido:** título → **Patrocinadores** · nota: _"Os patrocinadores de múltiplos eventos foram criados automaticamente no menu Patrocinadores, mas você precisará remover os que não se aplicam ao seu evento específico."_
**Scaffold placeholders:** 4 posts `wcb_sponsor` globais criados automaticamente (Bluehost, Automattic, Hostinger, Woo); a nota de alerta aparece na página publicada — _revisar e remover patrocinadores não aplicáveis: não_

No WCBR2025 os patrocinadores eram agrupados por modalidade (Ouro, Prata etc.) com logo e link.

**Versão EN?** sim — _patrocinadores globais (Bluehost, Automattic, Hostinger, Woo) precisam de EN para validar sua presença_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Localização

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `local`](https://brasil.wordcamp.org/2025/local/) · [WCEU2026 `location`](https://europe.wordcamp.org/2026/location/) · [WCUS2026 `venue`](https://us.wordcamp.org/2026/venue/)
**Scaffold EN2026:** `publish` como `location` — conteúdo **completamente vazio**. Nenhuma instrução foi gerada.
**PT-BR traduzido:** título → **Local** · conteúdo permaneceu vazio.
**Scaffold placeholders:** página **completamente vazia** — todo o conteúdo (descrição do local, endereço, mapa, como chegar) precisa ser criado do zero — _conteúdo criado: não_

No WCBR2025 o local era a UERJ com descrição do espaço, mapa e como chegar. WCUS2026 usa o slug `venue`. Decidir slug: `local` (PT-BR, consistência com 2025) ou `localizacao`.

**Conteúdo RAG:** scaffold=página completamente vazia · WCBR2025=descrição do espaço (UERJ), endereço, como chegar, mapa · WCEU2026=ICE Kraków (centro de convenções), planta baixa interativa, salas por andar, expo zone · WCUS2026=Phoenix Convention Center, foto do venue, endereço com mapa · WCAS2026=Jio World Convention Centre Mumbai, planta baixa por tipo de atividade — _incluir: foto do venue + descrição do espaço + endereço completo + mapa embed + como chegar (transporte público, estacionamento); se houver múltiplas salas, considerar planta baixa._

**Versão EN?** sim — _participantes internacionais precisam de EN para planejar a viagem_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Organização

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `organizacao`](https://brasil.wordcamp.org/2025/organizacao/) · [WCEU2026 `organisers`](https://europe.wordcamp.org/2026/organisers/) · [WCUS2026 `organizers`](https://us.wordcamp.org/2026/organizers/)
**Scaffold EN2026:** `publish` como `organizers` — conteúdo vazio com nota: _"You can enter content for this page in the Organizers menu item in the sidebar."_ O plugin lista automaticamente os posts `wcb_organizer`.
**PT-BR traduzido:** título → **Organizadores** · nota: _"Você pode inserir conteúdo para esta página no item de menu Organizadores na barra lateral."_ ⚠️
**Scaffold placeholders:** nota de instrução fica visível na página publicada — _remover antes de abrir ao público: não_ Atenção: o scaffold traduziu como **"Organizadores"**, enquanto o WCBR2025 usou **"Organização"** — decidir qual usar em 2026.

No WCBR2025 listava a equipe com foto e nome por seção de liderança. Slug sugerido: `organizacao` (PT-BR).

**Versão EN?** não — _página interna de equipe, audiência é local_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Contato

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `contato`](https://brasil.wordcamp.org/2025/contato/) · [WCEU2026 `contact`](https://europe.wordcamp.org/2026/contact/) · [WCUS2026 `contact`](https://us.wordcamp.org/2026/contact/)
**Scaffold EN2026:** `publish` como `contact` — veio com o bloco `jetpack/contact-form` vazio inserido, sem campos pré-configurados. Os campos precisam ser adicionados manualmente.
**PT-BR traduzido:** título → **Contato** · conteúdo (form) permaneceu sem alteração.
**Scaffold placeholders:** bloco `jetpack/contact-form` inserido sem campos configurados — _campos adicionados (Nome, E-mail, Mensagem): não_

No WCBR2025 usou formulário Jetpack com campos Nome, E-mail e Mensagem. Slug sugerido: `contato`.

**Versão EN?** não — _formulário é neutro de idioma_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Código de Conduta

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `codigo-conduta`](https://brasil.wordcamp.org/2025/codigo-conduta/) · [WCEU2026 `code-of-conduct`](https://europe.wordcamp.org/2026/code-of-conduct/) · [WCUS2026 `code-of-conduct`](https://us.wordcamp.org/2026/code-of-conduct/)
**Scaffold EN2026:** `publish` como `code-of-conduct` — veio com boilerplate EN completo (6 seções: Purpose, Open Source Citizenship, Expected Behavior, Unacceptable Behavior, Consequences, Contact Info) com campos em vermelho para substituir: nome da cidade, e-mail de contato. Também referencia a [Ada Initiative anti-harassment policy](http://geekfeminism.wikia.com/wiki/Conference_anti-harassment/Policy) e o guia de [como receber um relato de assédio](http://geekfeminism.wikia.com/wiki/Conference_anti-harassment/Responding_to_reports).
**PT-BR traduzido:** título → **Código de Conduta** · boilerplate completo traduzido para PT-BR incluindo as 6 seções e as referências externas.
**Scaffold placeholders:** `[nome da cidade]` e `[e-mail de contato]` em vermelho nas seções Expected Behavior e Contact Info — _substituídos: não_

O WCBR2025 tinha versão PT-BR completa das mesmas 6 seções. Recomendado reutilizar e atualizar o texto PT-BR do WCBR2025 em vez de traduzir o boilerplate do zero. Slug sugerido: `codigo-conduta`.

**Conteúdo RAG:** scaffold=boilerplate EN completo (6 seções) com campos em vermelho · WCBR2025=PT-BR completo das 6 seções, atualizando só campos de cidade/email · WCEU2026+WCUS2026+WCAS2026=todos usam o mesmo boilerplate WordCamp padrão em EN — _ação: atualizar os campos em vermelho `[nome da cidade]` e `[e-mail de contato]`; reutilizar texto PT-BR do WCBR2025 atualizando apenas dados de contato 2026._

**Versão EN?** sim — _deve ser acessível a todos os participantes, inclusive internacionais_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Ingressos

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCBR2025 `ingressos`](https://brasil.wordcamp.org/2025/ingressos/) · [WCEU2026 `tickets`](https://europe.wordcamp.org/2026/tickets/) · [WCUS2026 `tickets`](https://us.wordcamp.org/2026/tickets/)
**Scaffold EN2026:** `draft` como `tickets` — veio com alerta importante: _"If you'd like to change the slug for this page, please make sure you do that before opening ticket sales. Changing the page slug after tickets have started selling will break the link that users receive in their receipt e-mail."_ Seguido do shortcode `[camptix]`.
**PT-BR traduzido:** título → **Ingressos** · alerta traduzido: _"Se você quiser alterar o slug desta página, certifique-se de fazer isso antes de abrir a venda de ingressos."_
**Scaffold placeholders:** alerta de slug aparece na página; shortcode `[camptix]` funciona automaticamente — _slug definitivo definido: não · alerta removido: não_

No WCBR2025 o ingresso incluía almoço no restaurante universitário e coffee break para os dois dias. Publicar apenas quando as vendas abrirem. Definir o slug definitivo antes disso.

**Versão EN?** não — _venda provavelmente local; se houver venda internacional, avaliar_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Participantes

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCBR2025 `participantes`](https://brasil.wordcamp.org/2025/participantes/) · [WCEU2026 `attendees`](https://europe.wordcamp.org/2026/attendees/) · [WCUS2026 `attendees`](https://us.wordcamp.org/2026/attendees/)
**Scaffold EN2026:** `draft` como `attendees` — conteúdo apenas com `[camptix_attendees columns="3"]`. Sem texto adicional.
**PT-BR traduzido:** título → **Participantes** · shortcode permaneceu sem alteração.
**Scaffold placeholders:** nenhum — shortcode `[camptix_attendees columns="3"]` funciona automaticamente sem edição editorial — _ação necessária: nenhuma_

Lista quem se inscreveu e autorizou exibição do nome. Gerado automaticamente via shortcode — não exige conteúdo editorial. No WCBR2025 usou o mesmo shortcode. Slug sugerido: `participantes`.

**Versão EN?** não — _lista gerada automaticamente, sem texto editorial_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Dia da Colaboração

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `contributor-day`](https://europe.wordcamp.org/2026/contributor-day/) · [WCUS2026 `contributor-day`](https://us.wordcamp.org/2026/contributor-day/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente pelo WordCamp.org.

No WCBR2025 não havia página dedicada — o Contributor Day (sexta-feira, 28/11, 12h–18h no CEPUERJ) era descrito dentro de `programacao` com link para um post explicativo. WCEU2026 e WCUS2026 têm página própria com descrição das equipes (make teams) abertas para contribuição e instruções de como participar. Recomendado criar página dedicada em 2026.

**Conteúdo RAG:** WCBR2025=sem página dedicada, só menção na agenda · WCEU2026=horário detalhado (08h30–16h30), lista de make teams, mapa do venue para o dia, inscrição separada obrigatória · WCUS2026=muito completo: o que é contribuir (técnico e não-técnico), todas as make teams, como se preparar, FAQ, aberto para não-participantes do evento principal · WCAS2026=ecossistema próprio (Getting Started, Make Teams, Workshops, Open-Source Library, Contributor Stories, FAQ, YouthCamp) — _incluir: o que é contribuir e por que ir (WCUS), horário do dia (WCEU), make teams abertas, se ingresso é necessário, como se preparar; avaliar incluir workshops e "getting started" para primeiros contribuidores._

**Versão EN?** sim — _contributor day atrai contribuidores internacionais do WordPress_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Notícias

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `noticias`](https://brasil.wordcamp.org/2025/noticias/) · [WCEU2026 `blog`](https://europe.wordcamp.org/2026/blog/) · [WCUS2026 `news`](https://us.wordcamp.org/2026/news/)
**Scaffold EN2026:** não existia no scaffold — o índice de posts no WordCamp.org é configurado nas opções de leitura do WordPress, não como página criada.

No WCBR2025 existia a página `noticias` sem conteúdo próprio — funcionava como índice dos posts. WCEU2026 usa `blog`, WCUS2026 usa `news`. Slug sugerido: `noticias` (PT-BR).

**Versão EN?** não — _conteúdo editorial em PT-BR_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Informações de Viagem

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `travel-information`](https://europe.wordcamp.org/2026/travel-information/) · [WCUS2026 `travel-accommodation`](https://us.wordcamp.org/2026/travel-accommodation/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente pelo WordCamp.org.

Não existia no WCBR2025. WCEU2026 tem página detalhada com voos, trem, hotel e mobilidade urbana (evento em Cracóvia, maioria dos participantes vinda do exterior). Para o WCBR2026 seria útil com dicas de bairros, transporte público e hotéis próximos ao local do evento.

**Versão EN?** sim — _visitantes internacionais são o público principal desta página_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Assinar Novidades

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `newsletter`](https://europe.wordcamp.org/2026/newsletter/) · [WCUS2026 `subscribe-for-updates`](https://us.wordcamp.org/2026/subscribe-for-updates/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente pelo WordCamp.org.

Não existia no WCBR2025. Útil para capturar interesse antes de abrir inscrições. Definir qual ferramenta será usada para o formulário (Jetpack, Mailchimp, etc.) antes de criar a página.

**Versão EN?** não — _formulário é neutro de idioma_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Sobre o Evento

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `wordcamp-o-evento`](https://brasil.wordcamp.org/2025/wordcamp-o-evento/) · [WCUS2026 `about`](https://us.wordcamp.org/2026/about/)
**Scaffold EN2026:** não existia no scaffold como página dedicada. O scaffold criou `sample-page` com texto de exemplo (_"This is an example page… Most people start with an About page…"_) que não é uma página real do evento.

No WCBR2025 a página `wordcamp-o-evento` contava a história do WordCamp Brasil desde 2009 (16 anos) com retrospecto por edição. WCUS2026 usa `about` com descrição do evento atual. WCEU2026 não tem página "sobre" separada. Boa oportunidade de contar a história da comunidade brasileira de WordPress.

**Conteúdo RAG:** WCBR2025=história desde 2009 (16 anos), retrospecto por edição · WCEU2026=sem página dedicada; história no wordcamp-europe-2026 com storytelling da cidade-sede · WCUS2026=o que é WordCamp, quando e onde, por que participar (sessões, contributor day, showcase day, networking) · WCAS2026=4ª edição asiática, 3 objetivos centrais (expand beyond WP, educação, networking), foco em audiência além de WP — _incluir: o que é WordCamp para novos visitantes + história do WCBR desde 2009 + números de edições anteriores + o que esperar desta edição._

**Versão EN?** avaliar — _apresentar o WCBR e a comunidade BR ao público internacional_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Privacidade

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `privacidade`](https://brasil.wordcamp.org/2025/privacidade/)
**Scaffold EN2026:** não existia no scaffold — não gerada automaticamente pelo WordCamp.org.

No WCBR2025 havia política completa em PT-BR: finalidades de coleta, restrição de acesso à equipe organizadora e direito de exclusão do cadastro. Não tem equivalente explícito em WCEU2026 ou WCUS2026. Recomendado reutilizar e atualizar o texto do WCBR2025.

**Versão EN?** não — _documento legal em PT-BR_

**Responsável:** &nbsp;&nbsp; **Data:**


---

### Posts

#### Bem-Vindo

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** post &nbsp;|&nbsp; **Status:** publish
**Refs:** [WCBR2025 `inicio`](https://brasil.wordcamp.org/2025/inicio/)
**Scaffold EN2026:** `publish` como `welcome-to-wordcamp-brasil-2026` — veio com template em inglês e campos em vermelho para preencher: _"We're happy to announce that WordCamp YourCityName is officially on the calendar! WordCamp YourCityName will be DATE(S) at LOCATION."_ Também criou um segundo post `hello-world` (`publish`) com apenas _"This WordCamp site is in early planning. Check back soon for more information."_ — pode ser excluído.
**PT-BR traduzido:** título → **Boas-vindas ao WordCamp Brasil 2026** · template traduzido: _"Temos o prazer de anunciar que o WordCamp Brasil 2026 está oficialmente no calendário! O WordCamp Brasil 2026 será em DATA(S) em LOCAL."_ · `hello-world` → **"Olá, mundo!"** com _"Este site do WordCamp está em fase inicial de planejamento. Volte em breve para mais informações."_
**Scaffold placeholders:** `DATA(S)` e `LOCAL` em vermelho no template principal — _substituídos: não_ · post `hello-world` deve ser excluído após publicar o post de boas-vindas real — _excluído: não_

No WCBR2025 o post `inicio` era a homepage com data e local: "Rio de Janeiro, 28 e 29 de novembro de 2025". Deve ser o primeiro conteúdo publicado ao sair do modo Coming Soon.

**Conteúdo RAG:** WCBR2025=data+local, tom de celebração · WCUS2026=missão do evento + quando/onde + por que participar (sessões, contributor day, showcase) · WCAS2026=edição número, cidade, venue, 3 objetivos centrais — _incluir: data e local confirmados; parágrafo "O que é o WordCamp Brasil" para novos participantes; chamada para assinar novidades._

**Versão EN?** não — _post de abertura direcionado à comunidade local_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Chamada Palestrantes

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** **a decidir** (WCEU=post · WCUS=page · WCBR2025=post) &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCBR2025 `seja-palestrante`](https://brasil.wordcamp.org/2025/seja-palestrante/)
**Scaffold EN2026:** `draft` como `call-for-speakers` — veio com nota técnica de automação: submissões criam rascunhos de `wcb_speaker` e `wcb_session` automaticamente. Aviso: campos **Name, Email, WordPress.org Username, Your Bio, Session Title, Session Description** não devem ser renomeados ou removidos ou a automação quebra. Conteúdo editorial estava vazio — apenas _"[Other speaker instructions/info goes here.]"_
**PT-BR traduzido:** título → **Chamada para Palestrantes** · nota técnica traduzida mantendo os avisos de automação. Conteúdo editorial ainda vazio — precisa ser escrito pela equipe.
**Scaffold placeholders:** `[Other speaker instructions/info goes here.]` — texto editorial vazio que precisa ser substituído pelo conteúdo motivacional da chamada — _conteúdo escrito: não_

> Decidir: **page** (permanente no menu, acessível mesmo depois que a chamada fechar) ou **post** (anúncio com data, aparece no feed de notícias)?

No WCBR2025 era um post com texto motivacional rico: _"Você tem uma história para contar, um insight técnico ou uma experiência inovadora que pode transformar a jornada de alguém com o WordPress?"_

**Conteúdo RAG:** scaffold=`[Other speaker instructions/info goes here.]` · WCBR2025=texto motivacional emocional, sem formatos definidos · WCEU2026=4 formatos (talk 30min, lightning 10min, workshop 75min, experimental 3h), lista de tópicos desejados por área (técnico, usuário, negócios, educação) · WCUS2026=máx 3 propostas, 2 formatos (45/90min), tabela de datas abertura/fechamento/notificação · WCAS2026=4 formatos (lightning 15min, regular 40min, joint 40min, workshop 90min), suporte a palestrantes sub-representados, pergunta sobre backup speaker — _incluir: motivação emocional + formatos com duração clara + tabela de datas + tópicos desejados para o contexto BR + menção à diversidade._

**Versão EN?** sim — _palestrantes internacionais submetem propostas em EN_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Chamada Patrocinadores

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** **a decidir** (WCEU=post · WCUS=page · WCBR2025=page) &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCBR2025 `seja-patrocinador`](https://brasil.wordcamp.org/2025/seja-patrocinador/)
**Scaffold EN2026:** `draft` como `call-for-sponsors` — veio com nota técnica: submissões criam rascunhos de `wcb_sponsor` automaticamente. Aviso: campos **name, email, username** e **"first time sponsoring"** não devem ser alterados. Conteúdo editorial estava apenas como _"Blurb with information for potential sponsors."_
**PT-BR traduzido:** título → **Chamada para Patrocinadores** · nota traduzida com avisos de automação mantidos. Conteúdo editorial vazio — precisa ser escrito pela equipe.
**Scaffold placeholders:** `Blurb with information for potential sponsors.` — texto editorial placeholder que precisa ser substituído pelas modalidades de patrocínio e benefícios — _conteúdo escrito: não_

> Decidir: **page** ou **post**?

No WCBR2025 existia como page `seja-patrocinador`. O texto deve incluir as modalidades de patrocínio e benefícios.

**Conteúdo RAG:** scaffold=`Blurb with information for potential sponsors.` · WCBR2025=modalidades com benefícios (sem texto salvo no download) · WCEU2026=texto emocional ("Become part of the story"), números da edição anterior (1700+ participantes, 80+ países, 600+ contributors), 4 benefícios (visibility, engagement, networking, contribution), planta baixa da expo zone · WCUS2026=missão open source, 6 modalidades nomeadas por funções WP (Super Admin→Subscriber), deck PDF para download, formulário Google Forms, critério 100% GPL · WCAS2026=texto emocional "Power the Future of Open Source", slots esgotados demonstram alta demanda — _incluir: contexto emocional + números de edições anteriores do WCBR + modalidades com tabela de benefícios + deck PDF ou página de proposta + email de contato + critério GPL._

**Versão EN?** sim — _empresas internacionais precisam de EN para avaliar o patrocínio_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Chamada Voluntários

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** **a decidir** (WCEU=post · WCUS=page · WCBR2025=post) &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCBR2025 `chamada-voluntarios`](https://brasil.wordcamp.org/2025/chamada-voluntarios/)
**Scaffold EN2026:** `draft` como `call-for-volunteers` — veio com nota técnica: submissões criam rascunhos de `wcb_volunteer` automaticamente. Aviso: campos **name, email, username** e **"first time volunteering"** não devem ser alterados. Conteúdo editorial estava apenas como _"Blurb with information for potential volunteers."_
**PT-BR traduzido:** título → **Chamada para Voluntários** · nota traduzida com avisos de automação mantidos. Conteúdo editorial vazio — precisa ser escrito pela equipe.
**Scaffold placeholders:** `Blurb with information for potential volunteers.` — texto editorial placeholder que precisa ser substituído pelo texto de engajamento da chamada — _conteúdo escrito: não_

> Decidir: **page** ou **post**?

No WCBR2025 era um post com texto de engajamento: _"O WordCamp Brasil 2025 não existiria sem voluntários. Somos um evento genuinamente Open Source, construído pela comunidade e para a comunidade."_ Listava benefícios: ingresso gratuito, networking, acesso aos bastidores.

**Conteúdo RAG:** scaffold=`Blurb with information for potential volunteers.` · WCBR2025=motivação open source, benefícios explícitos (ingresso gratuito, networking, bastidores) · WCEU2026=página separada de volunteer-roles com funções detalhadas (Registration Wrangler, Swag Station, Social Media Support etc.) · WCAS2026=chamada motivacional ("volunteers make the magic happen"), lista completa de funções por área (Room Staff, Attendee Services, Media, Session Staff, Sponsors Services), info sobre ingresso (comprar e receber reembolso após seleção), suporte a visto — _incluir: motivação emocional (WCBR2025) + lista de funções disponíveis (WCAS/WCEU) + benefícios claros + processo seletivo + datas._

**Versão EN?** não — _voluntários são majoritariamente locais_

**Responsável:** &nbsp;&nbsp; **Data:**


#### Agradecimento aos Patrocinadores

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** post &nbsp;|&nbsp; **Status:** draft
**Refs:** —
**Scaffold EN2026:** `draft` como `thank-you-to-our-gold-sponsors` — veio pré-preenchido com a bio do patrocinador global Bluehost: _"Bluehost has been a WordPress partner since 2005, and powers over 2 million websites…"_ Serve de modelo para posts de agradecimento por modalidade.
**PT-BR traduzido:** título → **Agradecemos aos nossos patrocinadores Ouro** · bio da Bluehost traduzida: _"A Bluehost é parceira do WordPress desde 2005 e hospeda mais de 2 milhões de sites ao redor do mundo."_
**Scaffold placeholders:** bio da Bluehost como texto modelo — substituir com os patrocinadores Ouro reais do WCBR2026 — _conteúdo atualizado: não_

Não existia no WCBR2025 nem como padrão no WCEU2026. WCUS2026 publicou posts similares ao longo da divulgação de patrocinadores. Publicar após confirmação de cada leva de patrocinadores.

**Versão EN?** avaliar — _se o post mencionar patrocinadores globais, versão EN reforça o relacionamento_

**Responsável:** &nbsp;&nbsp; **Data:**


---

## A Decidir

### Páginas

#### Dia do Evento

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** —
**Scaffold EN2026:** `draft` como `day-of-event` — veio com conteúdo mínimo: data placeholder _"January 1, 1970"_ e dois blocos dinâmicos: `## Schedule` e `## Latest Posts`. Sem texto editorial.
**PT-BR traduzido:** título → **Dia do Evento** · conteúdo: _"1 de janeiro de 1970 · Agenda · Posts mais recentes"_ (data placeholder traduzida).
**Scaffold placeholders:** data `1 de janeiro de 1970` precisa ser substituída pela data real do evento — _data atualizada: não_
> Sem equivalente em WCEU2026 ou WCUS2026.

Página de informações de último minuto no dia do evento (credenciamento, avisos, programação do dia). Avaliar se será necessária ou se essas informações entram na página de Agenda ou num post de avisos.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Vídeos

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** —
**Scaffold EN2026:** `draft` como `videos` — veio com instrução pós-evento: _"After your WordCamp is over and the sessions are published to WordPress.tv, you can embed them here."_ e shortcode `[wptv event="enter-event-slug-here"]`.
**PT-BR traduzido:** título → **Vídeos** · instrução traduzida: _"Após o término do seu WordCamp e a publicação das sessões no WordPress.tv, você pode incorporá-los aqui."_
**Scaffold placeholders:** slug `enter-event-slug-here` no shortcode `[wptv event="enter-event-slug-here"]` precisa ser preenchido com o slug real do evento no WordPress.tv — _slug preenchido: não_
> Sem equivalente em WCEU2026 ou WCUS2026.

Página pós-evento para gravações. O WCBR2025 não publicou. Avaliar se será usada ou se os vídeos serão referenciados de outra forma (WordPress.tv, posts individuais).

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Slideshow

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** —
**Scaffold EN2026:** `draft` como `slideshow` — no YAML aparecia vazio, mas no XML original tinha um bloco `wp-block-jetpack/slideshow` inserido (galeria de imagens deslizante).
**PT-BR traduzido:** título → **Apresentação de Slides** · bloco do slideshow permaneceu sem texto traduzível.
**Scaffold placeholders:** bloco `jetpack/slideshow` vazio — precisa de imagens adicionadas para funcionar — _imagens adicionadas: não_
> Sem equivalente em WCEU2026 ou WCUS2026.

O WCBR2025 não publicou. Slides geralmente ficam no Speakerdeck ou Google Slides e são linkados pelos próprios palestrantes. Avaliar necessidade.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Funções de Voluntário

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `volunteer-roles`](https://europe.wordcamp.org/2026/volunteer-roles/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Descreve cada função disponível (credenciamento, apoio a palestrantes, A/V etc.). Existe em WCEU2026 e WCAS2026, não em WCUS2026 nem no WCBR2025. Útil para ajudar candidatos a voluntários a escolher a função antes de se inscrever.

**Conteúdo RAG:** WCEU2026=funções agrupadas por time (Attendee Team: Registration Wrangler, Swag Station; Media & Communications: Social Media Support; etc.) com o que a função inclui e o que não inclui · WCAS2026=lista completa embutida na própria call-for-volunteers (Room Staff, Attendee Services, Media, Session Staff, Sponsor Services, Volunteers & Team Services) — _se criar página dedicada: usar estrutura por área com "o que faz" e "o que não faz" (WCEU); avaliar integrar à chamada de voluntários (WCAS) ou manter como página separada._

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### O que Esperar

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `what-to-expect`](https://europe.wordcamp.org/2026/what-to-expect/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Guia para quem vai a um WordCamp pela primeira vez: o que é o evento, como funciona, o que levar, dicas de networking. Existe em WCEU2026 e no about do WCUS2026; não no WCBR2025. Especialmente útil para atrair novos participantes.

**Conteúdo RAG:** WCEU2026=visão geral do cronograma (Contributor Day Jun 4, dias de conferência Jun 5-6), com foto e descrição de cada dia · WCUS2026=abordagem no about: "por que participar" com 4 blocos (sessões, contributor day, showcase day, networking) · WCAS2026=página `need-to-know` que estava "Coming Soon" — _se criar: estrutura com "o que é um WordCamp" + programação prevista + dicas práticas (o que trazer, como chegar, onde comer); pode ser integrado ao "Sobre o Evento" em vez de página separada._

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Eventos Paralelos

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `side-events`](https://europe.wordcamp.org/2026/side-events/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Lista eventos satélites ao redor do WordCamp (happy hours, encontros de comunidades locais, after party). Existe no WCEU2026, não em WCUS2026 nem no WCBR2025. Avaliar se haverá side events suficientes para justificar uma página dedicada.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Crachás

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `badges`](https://europe.wordcamp.org/2026/badges/) · [WCUS2026 `badge`](https://us.wordcamp.org/2026/badge/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Permite que participantes criem e compartilhem crachás digitais personalizados nas redes sociais. WCEU2026 e WCUS2026 têm — gera buzz orgânico antes do evento. Não existia no WCBR2025. Depende de ter uma ferramenta de geração configurada.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Mapa do Local

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `map`](https://europe.wordcamp.org/2026/map/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Mapa do venue com localização de salas, credenciamento, banheiros, alimentação. Existe no WCEU2026 (ICE Kraków é centro de convenções grande). Não existe em WCUS2026 nem no WCBR2025. Avaliar conforme o venue do WCBR2026.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


#### Palestrantes por Categoria

**Slug:** `—` &nbsp;|&nbsp; **Título:** — &nbsp;|&nbsp; **Tipo:** page &nbsp;|&nbsp; **Status:** draft
**Refs:** [WCEU2026 `speaker-by-category`](https://europe.wordcamp.org/2026/speaker-by-category/)
**Scaffold EN2026:** não existia no scaffold — página nova, não gerada automaticamente.

Listagem alternativa de palestrantes agrupados por trilha (Desenvolvimento, Negócios, Comunidade etc.). Existe em WCEU2026, não em WCUS2026 nem no WCBR2025. Útil se o evento tiver trilhas temáticas bem definidas.

**Incluir?** sim / não / avaliar &nbsp;&nbsp; **Responsável:** &nbsp;&nbsp; **Data:**


---

## Fora do Escopo

Páginas presentes em WCEU2026 ou WCUS2026 avaliadas como não aplicáveis ao WCBR2026. Nenhuma delas estava no scaffold padrão do WordCamp.org.

- **Imprensa** (`press`) — WCEU2026 tem página para credenciar jornalistas. Não se aplica ao porte atual do WCBR.
- **Parceiros de Mídia** (`media-partners`) — específico WCEU2026, para veículos que cobrem o evento.
- **Micro-patrocinadores** (`microsponsors`) — modalidade de patrocínio de menor valor do WCEU2026, não adotada no WCBR.
- **Reembolso de Ingressos** (`ticket-refunds`) — WCEU2026 tem política pública de reembolso. No WCBR a política é tratada via contato.
- **Divulgue** (`spread-the-word`) — WCEU2026 tem página com assets para divulgação. No WCBR feito via posts e redes sociais.
- **Stand da Comunidade WordPress** (`wordpress-community-booth`) — espaço físico específico do WCEU2026.
- **Conta no WordPress.org** (`wordpress-org-account`) — guia do WCEU2026 para criar conta antes do evento. Pode virar um post se necessário.
- **Inscrição em Workshops** (`workshop-registration`) — WCEU2026 tem workshops com vagas limitadas e inscrição separada. Não adotado no WCBR.
- **Contato com Equipe de Palestrantes** (`contact-our-speakers-team`) — formulário específico do WCEU2026.
- **Compromisso dos Organizadores** (`organisers-pledge`) — documento interno do WCEU2026.
- **Chamada de Organizadores** (`call-for-organizers`) — WCUS2026 recruta organizadores para futuras edições via página pública. Não adotado no WCBR.
- **Responsabilidades da Equipe** (`squad-responsibilities`) — descrição interna das equipes do WCUS2026.
- **Chamada para Parceiros de Mídia** (`call-for-media-partners`) — específico WCEU2026.
- **Chamadas Abertas** (`open-calls`) — página-índice do WCEU2026 que agrupa todas as chamadas. No WCBR cada chamada tem sua própria entrada no menu.
- **Podcast** (`podcast`) — WCEU2026 tem podcast próprio. Não se aplica ao WCBR2026.
