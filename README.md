# Ravi Rao Theme

Classic WordPress theme. Install the ZIP through Appearance → Themes → Add New → Upload Theme.

## Fonts
Copy Nunito Sans variable WOFF2 fonts to `assets/fonts/` with these exact filenames:
- `NunitoSans-Variable.woff2`
- `NunitoSans-Italic-Variable.woff2`

See `assets/fonts/README.md`. Until installed, Arial is used as a fallback.
Font sizes and type scale are in `assets/css/base.css`.

## Assets
- Global: base.css, header.css, footer.css, main.js
- Front page: homepage.css, homepage.js
- Landing Page: landing.css, landing.js
- Full Width: full-width.css
- Blank Page: blank.css (without site header/footer)

## Versioning
Production uses the theme `Version` header in style.css. Bump it for each deployment that changes assets.
For development, set `define('RAVIRAO_THEME_DEV_ASSETS', true);` in wp-config.php to use file modification timestamps.

## Templates
The homepage sections are rendered by `front-page.php`, registered as the **Ravi Rao Homepage (Testing)** page template. Select it from the page template selector to test the layout on a regular page, or set the desired page as the static homepage under Settings → Reading. Its styles and scripts load on either use.

Select Landing Page, Full Width, or Blank Page from the WordPress page template selector.
Configure the Main Menu and optional logo in Appearance → Menus or the WordPress Site Editor.
# ravirao-theme
