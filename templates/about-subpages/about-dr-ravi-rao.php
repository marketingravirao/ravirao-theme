<?php
if (!defined('ABSPATH')) {
    exit;
}

$client_logos = [
    ['Adani-Logo.png', 'Adani'],
    ['Arvind-Logo.png', 'Arvind'],
    ['CERA-logo.png', 'CERA'],
    ['Havmor-logo.png', 'Havmor'],
    ['RKumar-logo.png', 'R Kumar'],
    ['Shobha-logo.png', 'Shobha Asar'],
    ['Sintex-logo.png', 'Sintex'],
    ['Somnay-logo.png', 'Somany'],
    ['vadilal-logo.png', 'Vadilal'],
];

$industries = [
    ['Manufacturing', 'M3 21V9l6 3V8l6 4V5l6 3v13H3Z M7 17h2m3 0h2m3 0h2'],
    ['Corporate Office', 'M4 21V4h16v17M8 8h2m4 0h2M8 12h2m4 0h2M8 16h2m4 0h2M10 21v-3h4v3'],
    ['Healthcare', 'M3 21V8h18v13M7 8V4h10v4M7 12h2m3 0h2m3 0h1m-11 4h2m3 0h2m3 0h1'],
    ['IT / Digital', 'M3 4h18v13H3zM8 21h8m-4-4v4'],
    ['Finance', 'M3 21h18M5 21V9l7-5 7 5v12M9 21v-7h6v7M8 10h.01M12 10h.01M16 10h.01'],
    ['Hospitality', 'M4 21V5l8-3 8 3v16M8 9h2m4 0h2m-8 4h2m4 0h2m-8 4h2m4 0h2'],
    ['Retail', 'M4 5h16l-1 16H5L4 5Zm-2 0h20M9 9h6m-6 4h6'],
    ['Entertainment', 'M3 5h18v14H3zM10 9l5 3-5 3V9Z'],
    ['Pharma', 'M9 3h6m-5 0v6l-5 9a2 2 0 0 0 2 3h10a2 2 0 0 0 2-3l-5-9V3m-7 12h12'],
    ['Logistics', 'M3 21h18M5 21V8l7-5 7 5v13M9 21v-5h6v5M8 10h.01M12 10h.01M16 10h.01'],
];

$fortune_sectors = [
    ['Manufacturing & Industrial Plants', 'M3 21V9l6 3V8l6 4V5l6 3v13H3Z M7 17h2m3 0h2m3 0h2'],
    ['Corporate Offices & IT Companies', 'M3 4h18v13H3zM8 21h8m-4-4v4'],
    ['Real Estate & Construction', 'M4 21V4h16v17M8 8h2m4 0h2M8 12h2m4 0h2M10 21v-3h4v3'],
    ['Hospitality & Retail', 'M4 21V5l8-3 8 3v16M8 9h2m4 0h2m-8 4h2m4 0h2'],
];

get_header();
?>
<main class="ravirao-homepage rr-about-dr-page">
    <section class="rr-about-dr-hero rr-section-soft" aria-labelledby="rr-about-dr-title">
        <div class="rr-about-dr-hero-content">
            <p class="rr-about-dr-eyebrow">About Dr. Ravi Rao</p>
            <h1 id="rr-about-dr-title" class="rr-hero-title rr-hero-worded">Dr. Ravi Rao: India’s Most Trusted
                Astro-Vaastu Expert for Global Leaders &amp; Fortune 500 Companies</h1>
            <p class="rr-about-dr-hero-summary">More than 30 years of guiding organizations and individuals through
                Vaastu, astrology and practical insight.</p>
        </div>
        <figure class="rr-about-dr-portrait rr-reveal rr-reveal-right">
            <img src="<?php echo esc_url(content_url('/uploads/2025/07/55-scaled-e1751979726799.jpg')); ?>"
                alt="Dr. Ravi Rao" fetchpriority="high">
        </figure>
    </section>

    <section class="rr-about-dr-biography rr-section" aria-labelledby="rr-about-dr-biography-title">
        <div class="rr-about-dr-biography-inner rr-container">
            <header class="rr-about-dr-biography-heading rr-reveal rr-reveal-up">
                <p class="rr-about-dr-eyebrow">Experience &amp; approach</p>
                <h2 id="rr-about-dr-biography-title">A career shaped by research, practice and perspective</h2>
            </header>
            <div class="rr-about-dr-biography-copy">
                <p class="rr-about-dr-bio-lead rr-reveal rr-reveal-up">A founding member of <strong>Astro-Vaastu Research Foundation</strong>, Dr. Ravi Rao is an internationally renowned Vaastu and astrology expert. A prolific scholar and dedicated practitioner, Dr. Rao has mastered his craft under legendary gurus. For decades, he has been guiding people on professional, personal, and political matters with a reputation for precise, actionable solutions.</p>
                <p class="rr-about-dr-bio-detail rr-reveal rr-reveal-up">Drawing on ancient Vedic sciences, Dr. Rao offers remedies that revive fortunes for individuals, companies, and industries—often within a short timeframe and with minimal investment. He is especially sought after for turning around sick industries and for consulting on Fortune 500 companies. His deep insights have empowered entrepreneurs, small business owners, and major industrialists worldwide.</p>
                <p class="rr-about-dr-bio-detail rr-reveal rr-reveal-up">Dr. Rao specializes in <strong>corporate Astro-Vaastu</strong>, offering strategic guidance that brings peace and success through a unique blend of Vaastu, astrology, and numerology. He is also renowned for transforming company growth with Vaastu-optimized logos, and his niche predictions have been featured on NASDAQ-BSE and in global publications.</p>
                <p class="rr-about-dr-bio-reach rr-reveal rr-reveal-up">His diverse clientele, both in India and internationally, attests to his expertise—spanning Africa, Australia, the UK, USA, Canada, the UAE, South-East Asia, and beyond. His clients range from power and textile to chemicals, construction, manufacturing, and trading sectors.</p>
            </div>
            <blockquote class="rr-about-dr-quote rr-reveal rr-reveal-up">
                <p>“My biggest success is making other people successful.”</p>
                <cite>- Dr. Ravi Rao</cite>
            </blockquote>
        </div>
    </section>

    <section class="infinite-logo-carousel rr-section rr-section-soft" aria-labelledby="rr-about-dr-clients-title">
        <div class="rr-section-heading">
            <h2 class="rr-section-title" id="rr-about-dr-clients-title">Trusted by leading brands</h2>
            <p class="rr-section-tagline">Organizations across industries have placed their trust in Dr. Ravi Rao’s
                Vaastu expertise.</p>
        </div>
        <div class="carousel-track" aria-label="Client organizations">
            <?php foreach ([false, true] as $is_duplicate): ?>
                <?php foreach ($client_logos as [$image, $name]): ?>
                    <img src="<?php echo esc_url(content_url('/uploads/2025/07/' . $image)); ?>"
                        alt="<?php echo $is_duplicate ? '' : esc_attr($name); ?>" <?php echo $is_duplicate ? 'aria-hidden="true"' : ''; ?> loading="lazy">
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="vaastu-industries-animated-section rr-section" aria-labelledby="rr-about-dr-fortune-title">
        <div class="rr-section-heading">
            <h2 class="rr-section-title" id="rr-about-dr-fortune-title">Trusted advisor to Fortune 500 leaders worldwide
            </h2>
        </div>
        <div class="vaastu-industries-animated-grid rr-container">
            <?php foreach ($fortune_sectors as [$name, $icon]): ?>
                <div class="vaastu-industry-card-outer">
                    <div class="vaastu-industry-card rr-card">
                        <span class="vaastu-industry-icon" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false">
                                <path d="<?php echo esc_attr($icon); ?>"></path>
                            </svg></span>
                        <span class="vaastu-industry-title"><?php echo esc_html($name); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="industry-section-premium rr-section rr-section-soft" aria-labelledby="rr-about-dr-industries-title">
        <div class="rr-section-heading industry-heading-bar">
            <h2 class="industry-heading-text rr-section-title" id="rr-about-dr-industries-title">Industries thriving
                with Vaastu guidance</h2>
        </div>
        <div class="industry-glow-bg" aria-hidden="true"></div>
        <div class="infinite-industry-carousel" aria-label="Industries served">
            <div class="carousel-track">
                <?php foreach ([false, true] as $is_duplicate): ?>
                    <?php foreach ($industries as [$name, $icon]): ?>
                        <div class="industry-card" <?php echo $is_duplicate ? 'aria-hidden="true"' : ''; ?>>
                            <span class="industry-icon" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false">
                                    <path d="<?php echo esc_attr($icon); ?>"></path>
                                </svg></span>
                            <span class="industry-name"><?php echo esc_html($name); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="testimonials-section-handdrawn rr-section" aria-labelledby="rr-about-dr-testimonials-title">
        <div class="rr-section-heading">
            <h2 class="testimonial-section-main-heading rr-section-title" id="rr-about-dr-testimonials-title">What
                industry leaders say about Dr. Rao’s Vaastu expertise</h2>
        </div>
        <div class="testimonials-cards-handdrawn rr-container" data-reveal-group>
            <figure class="testimonial-card-sketch rr-card">
                <h3 class="testimonial-card-heading highlight">Results after Vaastu correction</h3>
                <blockquote class="testimonial-card-quote-block"><span class="testimonial-card-text">“Before coming into
                        contact with Dr. Rao our office had few clients and lesser inquiries. After we changed our
                        office as per Dr. Rao’s instructions, we started getting more clients and lots of phone
                        inquiries.”</span></blockquote>
                <figcaption class="testimonial-card-profile"><span class="testimonial-card-meta"><strong
                            class="testimonial-card-name">Manufacturer of Footwear</strong><span
                            class="testimonial-card-role">Industry Client</span></span></figcaption>
            </figure>
            <figure class="testimonial-card-sketch rr-card">
                <h3 class="testimonial-card-heading highlight">Business growth through branding</h3>
                <blockquote class="testimonial-card-quote-block"><span class="testimonial-card-text">“When Dr. Rao saw
                        our logo he felt there was a serious mismatch between our line of business and the colors and
                        balance within the logo. After we adopted his suggestions, this change became very significant
                        to our business fortunes.”</span></blockquote>
                <figcaption class="testimonial-card-profile"><span class="testimonial-card-meta"><strong
                            class="testimonial-card-name">Owner of Office Furniture Systems</strong><span
                            class="testimonial-card-role">Design/Manufacturing Client</span></span></figcaption>
            </figure>
            <figure class="testimonial-card-sketch rr-card">
                <h3 class="testimonial-card-heading highlight">Expert guidance and clarity</h3>
                <blockquote class="testimonial-card-quote-block"><span class="testimonial-card-text">“The best part of
                        Dr. Rao, if I may say so, is three characteristics. The first is clarity in explaining Vaastu,
                        the second is his convincing ability, and finally, his patient listening to our
                        expectations.”</span></blockquote>
                <figcaption class="testimonial-card-profile"><span class="testimonial-card-meta"><strong
                            class="testimonial-card-name">Business Owner of BPO</strong><span
                            class="testimonial-card-role">Corporate Client</span></span></figcaption>
            </figure>
        </div>
    </section>
</main>
<?php get_footer(); ?>