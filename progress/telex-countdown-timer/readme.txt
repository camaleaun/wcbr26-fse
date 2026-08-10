=== WordCamp Countdown Timer ===

Contributors:      WordPress Telex
Tags:              block, countdown, timer, wordcamp, events
Tested up to:      6.8
Stable tag:        0.1.0
License:           GPLv2 or later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

A beautiful, accessible countdown timer block designed for WordCamp and future events. Features a live-ticking preview in both the editor and frontend, translucent glassmorphism numeric cards, and full Gutenberg color integration.

== Description ==

The WordCamp Countdown Timer block lets you add a visually striking countdown to any upcoming event directly within the WordPress block editor.

**Key Features:**

* **Live Preview in Editor & Frontend** — The countdown ticks in real time so you always see the current state.
* **RichText Event Title** — Style your event name directly in the editor with bold, italic, and link formatting.
* **Four Translucent Cards** — Days, hours, minutes, and seconds are displayed in modern glassmorphism-style cards.
* **Inspector Controls** — Pick a target date/time and set a custom completion message from the sidebar.
* **Native Color Support** — Uses Gutenberg's built-in color settings for text, background, and link (accent). CSS-only defaults inspired by WordCamp visual identity (#f56530 accent, #00595d text, #fff9ef background) are automatically overridden by user selections.
* **Independent Instances** — Multiple countdown blocks on the same page each manage their own target date and interval independently.
* **Completion Handling** — When the countdown reaches zero it stops cleanly, never shows negative values, and displays your custom completion message.
* **Responsive & Accessible** — Mobile-friendly grid layout with proper ARIA attributes and semantic HTML.
* **Interval Cleanup** — Frontend JavaScript properly cleans up intervals when blocks are removed from the DOM.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/telex-countdown-timer` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. In the block editor, search for "WordCamp Countdown Timer" and add the block to your post or page.
4. Set your target date and customize colors from the sidebar.

== Frequently Asked Questions ==

= Can I have multiple countdowns on one page? =

Yes. Each block instance manages its own target date and ticking interval independently.

= What happens when the countdown reaches zero? =

The timer stops, displays "00" for all units, and shows your custom completion message. No negative values are ever displayed.

= Can I customize the colors? =

Absolutely. The block supports native Gutenberg color settings for text, background, and link (accent highlight). You can pick any color from your theme palette or use a custom color.

== Screenshots ==

1. The countdown timer block in the editor with live preview.
2. Frontend rendering with translucent glassmorphism cards.

== Changelog ==

= 0.1.0 =
* Initial release.

== Arbitrary section ==

This block was designed with the WordCamp visual identity in mind, featuring warm accent tones and a clean, modern aesthetic suitable for event websites.