# Journal (Vedic colour version) - developer notes

Same page as the approved Journal (hero, filter bar, 01 featured article, 02 articles and news, 03 photo albums, 04 press and interviews, 05 video, 06 calendars, consultation form, footer). Pure HTML + CSS, no JavaScript. Layout, text, photos and the page's own animations are unchanged; this pass changes colour, ornament and the photo-album layout so the page matches Temples and is no longer dark and plain.

Files
- index.html - full page (HTML + CSS in <style>). Photos in /images.
- index-standalone.html - same page with all photos embedded, for quick review from e-mail.

Colour rhythm down the page (navy and noble beige kept, red and gold added)
- Top bar: red with a gold line. Header: white with a gold double rule.
- Hero: noble beige #EDE8DC with a soft sand glow behind the lotus (no yellow or orange tint), thin sand-coloured rays and a red frieze along the bottom edge. The pen-drawn lotus keeps its animation; petals are red in three depths with gold outlines and veins, the swastika above it is red, falling petals are red, orange and gold. Text is navy, the word "Journal" is red italic.
- Filter bar: white, gold double rule, active chip red with a gold ring.
- 01 Featured: ivory #F7F5F0 with a faint lotus mandala; white card with a red top, gold frame and dashed red inner line. Under the teaser the card carries the first paragraph of the article as a plain paragraph (class .feat-p), taken word for word from the article file supplied by the client (Bhoomi Poojan in Vastu Shastra: From Soil to Soul).
- 02 Articles and news: noble beige #EDE8DC with a mandala, dashed gold rules, round red arrow buttons, white "Latest news" card. The news card is larger (about 460 px wide on desktop, bigger title, text and book covers) and stretches to the same height as the three article rows; "All news" sits at its bottom edge.
- 03 Photo albums: bright kumkum red (#d8301f to #8f1a12), gold swastika friezes top and bottom, thin gold mount line round every photo, red arrow buttons, white heading and captions. Chosen after trying gold and cool beige. The #albums background line and the few #albums colour rules under it set this.
- 04 Press and interviews: ivory with mandalas; the CIO World card stays navy with a double gold frame; two features on the right with gold-framed photos.
- 05 Video: navy, gold friezes, gold frame on the big video, a natural gold-line lotus behind.
- 06 Calendars: noble beige with mandalas, white cards with a red top.
- Consultation: the one red block (maroon to bright red sunrise), swastika frieze on top, form on ivory with a gold double frame.
- Footer: navy #101D36 as approved, with a gold frieze on top.
- A small lotus divider (.orn) sits under each section heading: an empty aria-hidden <span class="orn">; .orn.l is the light version for navy and red sections.
- All of this is in one block at the end of the <style>, marked "Vedic colour pass".

Section navigation strip (new)
- A navy strip with gold lines directly under the hero: 01 Featured article, 02 Articles and news, 03 Photo albums, 04 Press and interviews, 05 Video, 06 Calendars, 07 Consultation. Plain anchor links to the section ids (#featured, #articles, #albums, #press, #video, #calendars, #consult); no JavaScript.
- It is sticky (position:sticky; top:0) so it stays at the top while scrolling. To make it a normal strip, remove position:sticky from .jnav. Sections have scroll-margin-top:58px so a section starts just below the strip; scrolling is smooth unless the visitor prefers reduced motion. On phones the strip scrolls sideways.
- Markup: nav.jnav > div.jn-in > a (with <b>number</b>). Styles are in the Vedic block, "section navigation strip".

Lotus drawings (natural petals)
- The petals of the hero lotus and of the lotus behind the videos were redrawn: slender, widest at about 60 percent of the length, long acute tip, each petal slightly different (asymmetry, bend, tip curl), curved veins instead of straight ones. Positions, angles, sizes, class names (pf, ln, vn) and the existing pen-drawing animation of the hero lotus are unchanged.
- The faint mandala in the beige and ivory blocks is a clean gold top-view lotus with exactly 12 identical petals (tidy double outline and a centre line, small centre circle, thin and dotted outer rings), a CSS background data URI in the variable --m. There is one mandala per block, only partly visible at the left or right edge (featured: right, articles: left, press: right, calendars: left); change its position or size in the background line of each section (#featured, #articles, #press, #calendars). It is switched off on phones.

Photos are rectangular
- Every photo and photo card on the page has square corners (no rounding, no arches): featured photo, gallery, press cards, calendar cards, video frames. Only buttons, chips and form fields keep rounded corners.

01 Featured photo
- The photo (trowel.jpg, portrait 760 x 896) is shown whole in its own proportions with a thin gold outline. On wide screens (from 1040 px) the card overlaps it from the lower right and is offset downwards so it never covers the RaviRao logo on the photo.

03 Photo albums layout (desktop from 1101 px)
- Editorial layout, not a grid: three bands. Band 1: one large photo (Temple Projects) with two photos stacked on its right (CREDAI, ICAS), the bottoms line up. Band 2: three photos of different sizes at staggered heights (Ganesha Shrine tall, Gathering of Vedic Scholars wide, Homa Ceremony smaller and lower). Band 3 mirrors it (Steel Plant, Manufacturing Unit, Printing Press).
- Each photo has a thin gold outline with a small gap (like a mount) and its caption under the photo, not on top of it. Red arrow button in the corner of each photo; on hover the image zooms slightly and a thin inner gold frame appears.
- Markup: .mos > .band.b1 / .b2 / .b3 (and .stk for the two stacked photos) > a.mt.t1 to .t9 > span.ph (photo + arrow) and span.cp (caption). Sizes come from flex ratios and --ar (aspect ratio) per tile, so everything scales with the window; vertical offsets are margin-top on the tiles. Photo order in the HTML is unchanged (t1 to t9).
- Tablet (701 to 1100 px): two columns, Temple, Vedic Scholars and Steel Plant full width; bands switch to display:contents. Phone: one column.
- Captions still switch off with data-captions="off" on .mos (or class "nocap" on one tile).

04 Press and interviews
- One large card on the left (CIO World cover story) and two more features on the right (Passion Vista Cover Story, Television Interviews). Two other cards from the earlier version (The Most Admired Global Indians 2020 and the Who's Who coffee-table book) were taken out because there are not that many interviews; their files images/press2.jpg and images/bk-whos.png are kept in /images but not used. Add a card back only if there is real content for it. The two right cards now carry a paragraph (class .ex) between the title and the link: it is placeholder text in square brackets and is to be replaced with the first paragraph of each interview. The photo takes 46 percent of the card, text the rest.
- Phone: one column (also fixes the original rule order that left the two small cards squeezed side by side).

Colour palette
- Navy #101D36, noble beige #EDE8DC, ivory #F7F5F0, kumkum red #c8281e / #b8231a / #7a130d, gold #d9951c / #e9a923 / #ffd479. The RaviRao logo colours are not changed.

Notes for the developer
- The Vedic block uses !important to override the inline section backgrounds of the original page. If you move the inline styles into classes, drop the !important.
- Friezes and mandalas are CSS background SVG data URIs (no extra files).
- On phones (max-width 700px) the mandala backgrounds are switched off for the beige and ivory blocks to keep text clean.
- images/poster.jpg (the featured video poster) already contains a red graphic on the right side. It comes from the supplied image, not from the code; replace the poster if it is not wanted.
- Titles: no full stop at the end of any heading, sub-heading or caption (project rule).
- Links are placeholders (href="#top"); article, album, press and video addresses still need to be connected.

Headline lengths (SEO)
- Only what Google cuts is shortened: the page title tag (22 characters here, limit about 60 to 64) and the meta description of a page. Visible headings, including the three article titles, are unchanged and Google indexes them in full. The live articles on ravirao.com need their own SEO title (title tag in WordPress) under about 60 characters; the long titles are: "From Soil to Soul: The Untold Power of Bhoomi Poojan in Vaastu Shastra" (70), "Not Your Home? Not a Problem: Vaastu Hacks for Rented Spaces That Actually Work" (79), "Hidden Wealth: How Vaastu-Compliant Storage Can Boost Factory Output and Harmony" (80).
- This page has no meta description yet.
