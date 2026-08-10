<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">

<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-0aa01211 wp-block-buttons-is-layout-flex">

<div class="wp-block-button">

<a href="https://europe.wordcamp.org/2026/speaker-by-category/" class="wp-block-button__link wp-element-button">Back to Categories</a>

</div>

</div>

</div>

Security talks at WordCamps can go one of two ways. There’s the kind that reminds you to keep plugins updated and use a strong password — useful advice, poorly timed at a conference full of people who already know. And then there are sessions that leave you genuinely uncomfortable, because you realise your setup has a problem you didn’t know existed until thirty minutes ago.

This year’s security track leans hard into the second kind.

Three sessions. Three very different problems. At least two of them will be relevant to something you’re currently running or maintaining.

## Why this keeps getting more complicated

The basic WordPress security hygiene hasn’t changed much. Keep things updated. Use a decent host. Don’t install every plugin you find. Most people in this community know the list.

What’s changed is the context around it. The EU’s NIS2 Directive is now in force, which means incident reporting is no longer just good practice — for a significant chunk of European WordPress businesses and the agencies that serve them, it’s a legal obligation with specific deadlines. The regulation doesn’t care whether you’re a freelancer with three client sites or an agency with thirty. If you qualify, you’re on the hook.

Meanwhile, the attack surface keeps growing in unexpected directions. The assumption that DDoS protection lives at the network level — your host, your CDN, Cloudflare — turns out to miss a whole category of threat that originates inside WordPress itself. And hosting providers keep selling security features whose real-world effectiveness nobody has seriously tested. Until now.

## The Talks

<div class="wp-block-group has-base-background-color has-background has-global-padding is-layout-constrained wp-container-core-group-is-layout-4924166b wp-block-group-is-layout-constrained" style="border-bottom-right-radius:80px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20);box-shadow:var(--wp--preset--shadow--shadow-1)">

### The hidden DDoS threat in WordPress: abusing the search endpoint

<div class="wp-block-media-text is-stacked-on-mobile" style="grid-template-columns:30% auto">

<figure class="wp-block-media-text__media">
<img src="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/05/samuel-silva-1.jpg?resize=630%2C630&amp;ssl=1" class="wp-image-9248 size-full" data-recalc-dims="1" loading="lazy" decoding="async" srcset="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/05/samuel-silva-1.jpg?w=630&amp;ssl=1 630w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/05/samuel-silva-1.jpg?resize=300%2C300&amp;ssl=1 300w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/05/samuel-silva-1.jpg?resize=150%2C150&amp;ssl=1 150w" sizes="auto, (max-width: 630px) 100vw, 630px" width="630" height="630" />
</figure>

<div class="wp-block-media-text__content">

**Speaker:** <a href="https://europe.wordcamp.org/2026/speaker/samuel-silva/" data-type="wcb_speaker" data-id="6876">Samuel Silva </a>

**Where**: Track 2

**When:** Saturday 6 June at 14:00

**Session page:** <a href="https://europe.wordcamp.org/2026/session/the-hidden-ddos-threat-in-wordpress-abusing-the-search-endpoint/" data-type="wcb_session" data-id="7052" target="_blank" rel="noreferrer noopener">The hidden DDoS threat in WordPress: abusing the search endpoint</a>

</div>

</div>

Here’s the scenario: your site goes down, but your host can’t see anything unusual at the network level. The CDN isn’t reporting traffic spikes. Nothing looks obviously wrong. And yet the database is on its knees.

What Samuel Silva is going to show you is how WordPress’s own search endpoint — present and exposed on essentially every public WordPress install — can be abused to generate a disproportionate server load from a small number of crafted requests. This isn’t theoretical. It doesn’t require compromising anything. It just requires knowing the endpoint is there.

Ten minutes. You’ll leave knowing something you didn’t know before, and probably thinking about a few sites you’re responsible for.

------------------------------------------------------------------------

Samuel Silva is a web developer from Portugal and an active contributor in the WordPress community.

Follow his work on WordPress.org as [@samuelsilvapt](https://profiles.wordpress.org/samuelsilvapt/)

</div>

<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">

<div class="wp-block-spacer" style="height:40px" aria-hidden="true">

</div>

<figure class="wp-block-image aligncenter size-full is-resized">
<img src="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=1000%2C112&amp;ssl=1" class="wp-image-6302" style="width:400px" data-recalc-dims="1" loading="lazy" decoding="async" srcset="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?w=1000&amp;ssl=1 1000w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=300%2C34&amp;ssl=1 300w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=768%2C86&amp;ssl=1 768w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=500%2C56&amp;ssl=1 500w" sizes="auto, (max-width: 1000px) 100vw, 1000px" width="1000" height="112" />
</figure>

<div class="wp-block-spacer" style="height:40px" aria-hidden="true">

</div>

</div>

<div class="wp-block-group has-base-background-color has-background has-global-padding is-layout-constrained wp-container-core-group-is-layout-4924166b wp-block-group-is-layout-constrained" style="border-bottom-right-radius:80px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20);box-shadow:var(--wp--preset--shadow--shadow-1)">

<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">

### NIS2 Incident Report in 10 minutes

<div class="wp-block-media-text is-stacked-on-mobile" style="border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:0px;border-bottom-right-radius:0px;grid-template-columns:30% auto">

<figure class="wp-block-media-text__media">
<img src="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/francesco-canovi-2.jpg?resize=630%2C630&amp;ssl=1" class="wp-image-7669 size-full" data-recalc-dims="1" loading="lazy" decoding="async" srcset="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/francesco-canovi-2.jpg?w=630&amp;ssl=1 630w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/francesco-canovi-2.jpg?resize=300%2C300&amp;ssl=1 300w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/francesco-canovi-2.jpg?resize=150%2C150&amp;ssl=1 150w" sizes="auto, (max-width: 630px) 100vw, 630px" width="630" height="630" />
</figure>

<div class="wp-block-media-text__content">

**Speaker:** <a href="https://europe.wordcamp.org/2026/speaker/francesco-canovi/" data-type="link" data-id="https://europe.wordcamp.org/2026/speaker/francesco-canovi/" target="_blank" rel="noreferrer noopener">Francesco Canoviett</a> 

**Where**: Tbd

**When:** Tbd

**Session page:** NIS2 Incident Report in 10 minutes

</div>

</div>

</div>

If you work with European clients and haven’t looked at NIS2 yet, this is the talk to start with — and a lightning slot is honestly the right format, because the regulation itself isn’t complicated. What’s complicated is the timeline.

Under NIS2, a significant security incident requires an early warning to the relevant authority within 24 hours. Not 72. Not “once you’ve figured out what happened.” Twenty-four hours, at which point you probably still don’t know the full extent of it.

------------------------------------------------------------------------

Francesco Canovi has been working on this problem specifically for smaller WordPress agencies and freelancers — the people NIS2 guidance typically forgets to address. His session gives you a practical incident report structure you can actually use under pressure, built around how real incidents unfold rather than the hypothetical orderly version the directive seems to assume.

He’s the founder of Black Studio, an Italian digital agency, with over two decades building WordPress solutions for businesses and public entities. He’s been talking about NIS2 across the European WordPress conference circuit and at this point knows exactly which parts confuse people most.

Follow him on X as [@thedarkmist](https://x.com/thedarkmist) and connect on [LinkedIn](https://www.linkedin.com/in/francescocanovi/)

</div>

<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">

<div class="wp-block-spacer" style="height:40px" aria-hidden="true">

</div>

<figure class="wp-block-image aligncenter size-full is-resized">
<img src="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=1000%2C112&amp;ssl=1" class="wp-image-6302" style="width:400px" data-recalc-dims="1" loading="lazy" decoding="async" srcset="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?w=1000&amp;ssl=1 1000w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=300%2C34&amp;ssl=1 300w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=768%2C86&amp;ssl=1 768w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/Speaker-Pattern.webp?resize=500%2C56&amp;ssl=1 500w" sizes="auto, (max-width: 1000px) 100vw, 1000px" width="1000" height="112" />
</figure>

<div class="wp-block-spacer" style="height:40px" aria-hidden="true">

</div>

</div>

<div class="wp-block-group has-base-background-color has-background has-global-padding is-layout-constrained wp-container-core-group-is-layout-4924166b wp-block-group-is-layout-constrained" style="border-bottom-right-radius:80px;padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--20);box-shadow:var(--wp--preset--shadow--shadow-1)">

<div class="wp-block-group has-global-padding is-layout-constrained wp-block-group-is-layout-constrained">

### Testing the promise: does secure hosting deliver?

<div class="wp-block-media-text is-stacked-on-mobile" style="border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:0px;border-bottom-right-radius:0px;grid-template-columns:30% auto">

<figure class="wp-block-media-text__media">
<img src="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/maciek-palmowski-2.jpg?resize=630%2C630&amp;ssl=1" class="wp-image-7682 size-full" data-recalc-dims="1" loading="lazy" decoding="async" srcset="https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/maciek-palmowski-2.jpg?w=630&amp;ssl=1 630w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/maciek-palmowski-2.jpg?resize=300%2C300&amp;ssl=1 300w, https://i0.wp.com/europe.wordcamp.org/2026/files/2026/04/maciek-palmowski-2.jpg?resize=150%2C150&amp;ssl=1 150w" sizes="auto, (max-width: 630px) 100vw, 630px" width="630" height="630" />
</figure>

<div class="wp-block-media-text__content">

**Speaker:** <a href="https://europe.wordcamp.org/2026/speaker/maciek-palmowski/" data-type="wcb_speaker" data-id="6880">Maciek Palmowski</a>

**Where**: Track 2

**When:** Saturday 6 June at 15:30

**Session page:** <a href="https://europe.wordcamp.org/2026/session/testing-the-promise-does-secure-hosting-deliver/" data-type="wcb_session" data-id="7056" target="_blank" rel="noreferrer noopener">Testing the promise: does secure hosting deliver?</a>

</div>

</div>

</div>

Every managed WordPress host has a security page. Malware scanning. Automatic updates. Firewall. DDoS protection. It’s more or less the same list across every provider, which tells you either that managed WordPress security has been thoroughly solved, or that these are marketing claims nobody has seriously pressure-tested.

------------------------------------------------------------------------

Maciek Palmowski works at Patchstack, which means he spends a lot of time looking at WordPress vulnerabilities from the inside. He went and actually tested what the security promises at various hosting providers do — and don’t — deliver. This session is where he reports back.

It will be uncomfortable for anyone who’s been confidently recommending managed hosting to clients on the basis of that security page. It should also be useful for the same people, because knowing where the gaps actually are is how you start to close them.

Maciek has been in the WordPress world for over 15 years, writes regularly about security and modern WordPress development, and co-organises CMS Conf in Gdynia. He’s exactly the right person to say the quiet part out loud on a subject this easy to oversell.

Follow him on X as [@palmiak_fp](https://x.com/palmiak_fp) and connect on [LinkedIn](https://www.linkedin.com/in/maciekpalmowski/)

</div>

<div class="wp-block-buttons is-content-justification-center is-layout-flex wp-container-core-buttons-is-layout-5f2b14c0 wp-block-buttons-is-layout-flex" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:var(--wp--preset--spacing--30)">

<div class="wp-block-button">

<a href="https://europe.wordcamp.org/2026/schedule/" class="wp-block-button__link wp-element-button">SEE THE FULL SCHEDULE</a>

</div>

</div>
