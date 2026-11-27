# Ravi Rao Theme

Classic WordPress theme. Install the ZIP through Appearance → Themes → Add New → Upload Theme.

## Fonts
The site uses the locally bundled Satoshi variable font (`.woff2` with `.woff` fallback) in `assets/fonts/satoshi/`, licensed under the Fontshare Free Font License (`LICENSE-FFL.txt`).
Shared page heading, eyebrow, and body-copy scales are defined in `assets/css/shared-typography.css`; global font families and colors are defined in `assets/css/base.css`.

## Site-specific settings
Links and images use `home_url()` / `content_url()`, so the theme works on staging and production without edits (media uploads must exist on each site).
The contact email defaults to `office@ravirao.com`. Override it in wp-config.php with `define('RAVIRAO_THEME_CONTACT_EMAIL', 'you@example.com');`.

## Assets
- Global: base.css, header.css, footer.css, main.js
- Reusable proof sections: template-parts/sections/trusted-brands.php, template-parts/sections/industry-testimonials.php
- Reviews slider: industry-testimonials.php renders the reviews in a Swiper slider (Swiper 11 from cdnjs, `assets/css/reviews-slider.css`, `assets/js/reviews-slider.js`), loaded by `ravirao_theme_enqueue_reviews_slider()`. Add reviews to the arrays in that partial; one card shows on mobile, two from 768px, with arrows and dots.
- Branded footer: LeadConnector form embed script (loaded only where the footer form is rendered, so not on Blank Page)
- Front page: homepage.css, homepage.js (GSAP and ScrollTrigger loaded from cdnjs)
- Landing Page: landing.css, landing.js
- Full Width: full-width.css
- Industrial Vaastu: industrial-vaastu.css, industrial-vaastu.js, generic-animations.js (GSAP), images in assets/images/industrial-vaastu/
- Blank Page: blank.css (without site header/footer)

## Versioning
Local theme CSS and JavaScript URLs use each file's modification time as their version, so changed assets automatically receive a new URL without a manual theme-version bump.
After deploying this cache-busting change, purge any page/CDN cache that may still serve HTML containing the old asset URLs.

## Templates
The homepage sections are rendered by `front-page.php`, registered as the **Ravi Rao Homepage (Testing)** page template. Select it from the page template selector to test the layout on a regular page, or set the desired page as the static homepage under Settings → Reading. Its styles, scripts, and GSAP animations load on either use.
The homepage is built from `design/home-page-design.html` (content in `template-parts/homepage/design-content.php`, styles in `assets/css/homepage-design.css`, scoped to `.ravirao-homepage`). It uses the site header and branded footer like other pages; the footer's enquiry form is the homepage contact form, and all homepage CTAs link to `#business-enquiry`.

Select Landing Page, Full Width, or Blank Page from the WordPress page template selector.

### Clients
Select **Client Page** as the page template. It follows `design/clients-page/`, uses the existing client-logo uploads with All, India, and Overseas filters, includes the shared consultation form embed in its page design, and retains the standard site footer.

### About Dr. Ravi Rao
Select **About Dr. Ravi Rao (New)** as the page template. The page follows the editorial design in `design/about-dr-ravirao-page/`, uses the theme header and branded consultation form/footer, and loads its page-specific layout from `assets/css/about-dr-ravi-rao.css`. Its photographs are stored in `assets/images/about-dr-ravi-rao/`.

### About Vaastu
Select **About Vaastu (New)** as the page template. It follows the editorial design in `design/about-vaastu-page/`, uses the theme header and branded consultation form/footer, and loads its layout, animated inline Vaastu illustrations, and mobile introduction toggle from `assets/css/about-vaastu-page.css` and `assets/js/about-vaastu.js`. The hero photo and Vaastu diagrams are stored in `assets/images/about-vaastu/`.

### Industrial Vaastu
Select **Industrial Vaastu** as the page template. It is built from `design/ravirao-industrial-vaastu/`, uses BEM-style classes scoped to the `.industrial-vaastu` block, and uses the site header and branded footer (the footer's enquiry form is the page's contact form; all page CTAs link to `#business-enquiry`).
The video section is enabled by default with `https://youtu.be/KdKxlitTMsU`. Optional page custom fields can override it: `industrial_vaastu_video` (YouTube URL or direct .mp4/.webm URL), `industrial_vaastu_video_title`, and `industrial_vaastu_video_text`.
The photos in `assets/images/industrial-vaastu/` are stock images from the design and should be replaced with real project photos before launch.
### Temple Vaastu
Select **Temple Vaastu** as the page template. It is built from `design/ravirao-temples-vaastu-standalone2.html`, uses BEM-style classes scoped to `.temple-vaastu`, the site header and the branded footer (the footer's enquiry form is the page's contact form; CTAs link to `#business-enquiry`).
`assets/css/temple-vaastu.css` holds layout, spacing and motion only: every color is a base.css variable from the temple palette (`--rr-temple-*`, the design's own saffron / maroon / gold colors, reusable on other pages) and fonts come from base.css. Images are in `assets/images/temple-vaastu/`.
Optional page custom fields: `temple_vaastu_video` (YouTube URL or .mp4/.webm; defaults to `https://youtu.be/KdKxlitTMsU`), `temple_vaastu_video_title`, `temple_vaastu_video_text`, and `temple_vaastu_article` (URL of the featured Prana Pratishtha article; the "Read the article" button only shows when it is set).

### Journal and Gallery
Journal and Gallery content management are included in the theme; no separate plugin installation or activation is required. After installing or updating the theme, **Journal** and **Gallery** appear in the WordPress admin menu. The theme registers the post types, shared **Types** and **Topics** taxonomies, and editorial fields.
If the earlier standalone **Ravi Rao Journal Content** plugin was installed, deactivate it after updating the theme. The theme avoids loading the same code twice while that plugin is active, then loads its built-in content module automatically once the plugin is deactivated.

The Journal archive is `/journal/`; Gallery (photo albums and videos together) is `/gallery/`. Gallery images and videos open in popups; individual Gallery URLs return a 404 and Gallery cards have no read-more links. Both archives use design-matching Type and Topic pill filters, a debounced live search, and live pagination. Filtering also works with JavaScript disabled, with server-rendered results and pagination.

With ACF Pro active, the editor uses grouped **Classification**, **Editorial Details**, and **Gallery Media** fields. Choose a Type and Topics in Classification, mark the featured Journal entry in Editorial Details, and use Gallery Media to add a video URL or instructions for an album. Photo albums use the WordPress Gallery block in the main editor.

On the first admin visit after the theme update, the theme creates and publishes the example Journal and Gallery entries from the approved design, assigns their Types and Topics, and copies their design images into the Media Library. Previously imported matching drafts are published; existing matching published entries are left untouched. The theme also moves exact duplicate imported Gallery examples to Trash; those posts can be restored from the Trash if needed. The design provides excerpts and cover images for some items rather than complete article bodies or photo albums, and it has no playable video URLs. Add real YouTube links in **Gallery Media**; video and photo thumbnails open in a large popup, and videos without a URL no longer appear as image-only videos. Complete article bodies and albums in the editor. **Tools → Journal Content Setup** shows the import status.

Journal and Gallery pages retain the shared footer content and LeadConnector consultation form, with Journal-specific background, color, and decorative styling inspired by the standalone design.

Regular WordPress Posts remain separate from the new Journal. To reserve `/journal/` for the Journal archive, set the Posts page slug to `/blog/` in **Settings → Reading** (create/select a Blog page if needed), then save **Settings → Permalinks**. Update the main menu’s Journal link to `/journal/` and the Blog link, if needed, to `/blog/`.

The homepage and Journal Calendars section share the theme's Travel Calendar layout, which reads published events from the My Calendar plugin and supports month and category navigation. It currently displays My Calendar categories 3, 1, and 2; update the category IDs in `template-parts/travel-calendar.php` if the site's categories differ. The layout requires My Calendar to be active. Both sections also link to the Muhurat Calendar at `/new-muhurat/`. Assign the **Muhurat Calendar** page template to that page and keep its `[my_calendar category="4" weekends="true"]` shortcode in the page content.

Because Journal and Gallery are registered by the theme, switching to a different theme hides their admin menus until this theme is active again. Their saved content remains in the database.

Configure the Main Menu and optional logo in Appearance → Menus or the WordPress Site Editor.
