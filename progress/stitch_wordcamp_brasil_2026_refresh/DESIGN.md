---
name: Vibrant Pulse
colors:
  surface: '#fff8f1'
  surface-dim: '#e0d9cf'
  surface-bright: '#fff8f1'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#faf2e9'
  surface-container: '#f5ede3'
  surface-container-high: '#efe7dd'
  surface-container-highest: '#e9e1d8'
  on-surface: '#1e1b15'
  on-surface-variant: '#3e4948'
  inverse-surface: '#33302a'
  inverse-on-surface: '#f7f0e6'
  outline: '#6e7978'
  outline-variant: '#bec9c8'
  surface-tint: '#046a69'
  primary: '#004e4d'
  on-primary: '#ffffff'
  primary-container: '#006867'
  on-primary-container: '#95e4e2'
  inverse-primary: '#85d4d2'
  secondary: '#b52701'
  on-secondary: '#ffffff'
  secondary-container: '#ff5c36'
  on-secondary-container: '#5a0f00'
  tertiary: '#653c00'
  on-tertiary: '#ffffff'
  tertiary-container: '#865100'
  on-tertiary-container: '#ffce9a'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#a1f0ee'
  primary-fixed-dim: '#85d4d2'
  on-primary-fixed: '#00201f'
  on-primary-fixed-variant: '#00504f'
  secondary-fixed: '#ffdad2'
  secondary-fixed-dim: '#ffb4a3'
  on-secondary-fixed: '#3d0700'
  on-secondary-fixed-variant: '#8a1c00'
  tertiary-fixed: '#ffddbb'
  tertiary-fixed-dim: '#ffb868'
  on-tertiary-fixed: '#2b1700'
  on-tertiary-fixed-variant: '#673d00'
  background: '#fff8f1'
  on-background: '#1e1b15'
  surface-variant: '#e9e1d8'
  teal-deep: '#003e3e'
  orange-deep: '#c94220'
  success-green: '#2d8a48'
  ink: '#111827'
typography:
  display-lg:
    fontFamily: Poppins
    fontSize: 58px
    fontWeight: '1000'
    lineHeight: '1.06'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Poppins
    fontSize: 36px
    fontWeight: '1000'
    lineHeight: '1.1'
  headline-lg:
    fontFamily: Poppins
    fontSize: 48px
    fontWeight: '1000'
    lineHeight: '1.08'
  headline-lg-mobile:
    fontFamily: Poppins
    fontSize: 32px
    fontWeight: '1000'
    lineHeight: '1.1'
  headline-md:
    fontFamily: Poppins
    fontSize: 30px
    fontWeight: '950'
    lineHeight: '1.2'
  body-lg:
    fontFamily: Montserrat
    fontSize: 22px
    fontWeight: '700'
    lineHeight: '1.4'
  body-md:
    fontFamily: Montserrat
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.45'
  label-bold:
    fontFamily: Poppins
    fontSize: 15px
    fontWeight: '950'
    lineHeight: '1'
    letterSpacing: 0.05em
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1280px
  section-v-padding: clamp(64px, 8vw, 104px)
  gutter: 32px
  gap-grid: 28px
  gap-nav: 30px
  stack-sm: 8px
  stack-md: 16px
---

## Brand & Style

This design system captures the professional yet high-energy spirit of a premier technology community event. It balances the structured reliability required for an educational conference with the vibrant, community-driven "pulse" of a creative festival.

The aesthetic is a **Neobrutalist-Lite** approach: it prioritizes clarity and information density while using "loud" typography and physical, tactile UI elements. The design avoids the ethereal nature of glassmorphism in favor of "hard" surfaces, distinct borders, and solid 3D-simulated depth. This creates a grounded, confident interface that feels authoritative yet approachable.

**Core Principles:**
- **Tactile Feedback:** Every interaction should feel like a physical button press.
- **Extreme Hierarchy:** Use weight and scale to guide users instantly to key calls-to-action and session titles.
- **Intentional Contrast:** High-contrast pairings (Teal on Off-White, Orange on Teal) ensure maximum legibility and energy.

## Colors

The palette is built on a foundation of high-contrast, energetic pairings. The primary **Teal** acts as the anchor for professional content and navigation, while the **Orange** is reserved strictly for high-priority calls to action.

- **Primary (Teal):** Used for primary section backgrounds, navigation links, and primary headlines.
- **Secondary (Orange):** The "Action" color. Used for primary buttons and critical highlight elements.
- **Tertiary (Gold):** A secondary accent used for specific high-tier content like "Gold Sponsorship" sections to add warmth and hierarchy.
- **Neutral (Off-White):** The default background color. This soft off-white reduces eye strain compared to pure white while maintaining high contrast with the **Ink** text.

**Functional Pairing Rules:**
- On **Teal** backgrounds, use white text and the **Secondary (Orange)** button.
- On **Neutral** backgrounds, use **Ink** text and the **Primary (Teal)** or **Secondary (Orange)** buttons.
- Every colored surface should use its "Deep" variant (e.g., `orange-deep`) for its 3D shadow effect.

## Typography

The typography system relies on **extreme weights** to create a "heavy-ink" feel. Poppins provides the geometric structural integrity for headers, while Montserrat handles body copy with its high legibility.

**Styling Rules:**
- **All-Caps Headers:** Display and Primary Section headings should be set in All-Caps with tight line height to create a block-like visual effect.
- **Weight as Hierarchy:** Use weight `950` or `1000` for all UI interactions (buttons, tabs) and headers.
- **Fluid Scaling:** Display sizes utilize a `clamp()` function logic. Headings should feel "massive" on desktop and scale aggressively on mobile to prevent overflow while maintaining their "bold" personality.

## Layout & Spacing

The layout follows a **Fixed Grid** philosophy within a `1280px` maximum container, ensuring content remains legible and organized on ultra-wide displays.

**Spacing Rhythm:**
- **Vertical Breathing:** Large vertical padding (up to 104px) separates major sections to prevent information overload.
- **The 28px Constant:** A consistent 28px gap is used for grid layouts (news cards, sponsor logos, and header elements) to create a rhythmic "beat" throughout the scroll.
- **Responsive Transitions:** On mobile devices, side margins compress to 20px, and section padding reduces to 64px to maximize screen real estate.

## Elevation & Depth

This system rejects soft shadows and blurs in favor of **Hard 2D Depth**. Visual hierarchy is communicated through solid color offsets.

- **The "Block" Shadow:** Buttons and interactive cards do not have "glow." Instead, they use a solid, 5px bottom-offset shadow in a darker shade of the element's base color (e.g., Orange button with a Deep Orange shadow).
- **Physical Interaction:** Upon hover or active state, elements should "press" into the page. This is achieved by reducing the `translateY` and the shadow height simultaneously (e.g., moving from 5px shadow to 2px shadow on hover).
- **Tonal Layering:** Deeply nested content (like news articles) uses white surfaces on top of the `neutral-off-white` background to create a subtle tiered effect without needing complex shadows.

## Shapes

The shape language is **Softly Geometric**. While the overall layout is rigid and blocky, the corners are rounded to maintain the "friendly" community vibe of the event.

- **Default Radius:** 8px to 9px for all primary elements, including buttons, cards, and input fields.
- **Media Containers:** Images (speakers, venue, news) must always utilize the `rounded-lg` (16px) or `rounded-xl` (24px) property to soften the "heavy" typography and high-contrast colors.
- **Buttons:** Use a specific 9px radius to give them a distinct, slightly more refined look compared to standard 8px grid cards.

## Components

### Buttons
- **Primary:** Orange background, white text, weight 950, 5px hard shadow (`orange-deep`).
- **Secondary:** Teal background, white text, weight 950, 5px hard shadow (`teal-deep`).
- **Interaction:** On hover, transform `translateY(3px)` and reduce shadow to 2px.

### Cards (Sponsors & News)
- **Sponsor Cards:** Pure white background, 8px radius, no shadow. Content is centered.
- **News Cards:** Image at top (4:3 aspect ratio), 8px radius on the container. Typography inside uses `body-md` for description and `label-bold` for metadata.

### Input Fields
- **Search/Subscribe:** `neutral-off-white` or pure white background with a 1px solid `#777` border. 8px radius. Text should be `body-md`.

### Chips / Tags
- **Hero Tags:** Small, all-caps labels with high-weight typography. No background, just high-contrast text to keep the focus on the hero headline.

### Lists
- **Navigation:** All-caps, weight 950. 30px spacing between items. Active state indicated by a color change to the Brand Primary or a bottom border.