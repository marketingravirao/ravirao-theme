# Industrial Vaastu page - developer notes

Files
- index-standalone.html - the same page with all photos embedded (works when opened from anywhere, e.g. e-mail preview or inside a zip viewer). Use it for quick review; use index.html + /images for production.
- index.html - full page (HTML + CSS in <style>, no JS needed). Photos in /images.
- compass-overlay.svg - the animated compass as a standalone, layered SVG (ids layer-1..9 below). Inline it or use <object>; the same markup is already inline in index.html.

Hero layer stack (bottom -> top)
1. .hero (background-image) - full-bleed factory photo (images/hall2.jpg)
2. .hero:before  - left-to-right dark gradient for text legibility
3. .hero__in      - content: text column (left) + compass (right)
   Compass (.ring, 520px, square):
   a. .ring__disk   - translucent dark disc behind the photo
   b. .ring__photo  - circular photo (images/blueprint.jpg), slow horizontal pan 26s, alternate
   c. svg layers (compass-overlay.svg):
      layer-rings, layer-ticks (rotates clockwise, 90s), layer-dotted-ring (clockwise, 140s),
      layer-ping (expanding wave, 4.5s), layer-spokes (16), layer-north-marker,
      layer-labels (N..NW; each lights up when the needle passes), layer-needle (radar sweep + needle,
      clockwise, 16s per turn, linear), layer-hub

Video block (#video, dark section after the intro)
- Large 16:9 frame (.frame) with poster image (images/hall.jpg) and a pulsing coral play button.
- To use a YouTube video: replace the <a class="frame"> with <div class="frame"><iframe src="https://www.youtube-nocookie.com/embed/VIDEO_ID" ...></iframe></div> (snippet is in a comment in index.html). For a self-hosted file use <video controls playsinline>. The same .frame CSS sizes iframe/video to fill the frame.
- Fill in the placeholders: short description, video title, duration.

Icons
- Service and metric icons are inline SVG line icons (24px grid, stroke 1.6, coral #d94d3f), class .ic.

Animation notes
- Everything rotates clockwise. Pure CSS animations; disabled under prefers-reduced-motion.
- Label highlight delays are tied to the 16s needle turn (45 degrees = 2s).

Brand tokens used
- Coral #e45b47 (buttons), #d94d3f (small text, band), #ed5545 (top bar); graphite #1f2933; beige #efebe1; blue #3c5d9f only in menu links.
- Fonts: Satoshi (body), Georgia (headings).

To replace before launch
- Stock photos (images/ and the Unsplash links in the sector cards) -> real project photos.
- Text logo -> official SVG logo. Items in [square brackets] -> real data (client logos, expert photo and credentials, e-mail, WhatsApp, response time, privacy note).
- Form action/handler: connect to the site's consultation form component.
