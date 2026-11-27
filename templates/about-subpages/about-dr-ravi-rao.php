<?php
if (!defined('ABSPATH')) {
    exit;
}

$asset = static function ($path) {
    return get_theme_file_uri('/assets/images/' . ltrim($path, '/'));
};

$books = [
    ['A Nation’s Prophecy', 'homepage-design/nations-prophecy-cover.jpg'],
    ['Sports Astrology', 'homepage-design/sports-astrology-cover.jpg'],
    ['Vaastu Shastra for Everyone', 'homepage-design/vaastu-for-everyone-cover.jpg'],
];

$gallery_url = get_post_type_archive_link('gallery');

get_header();
?>
<main class="ravirao-homepage rr-about-dr-page">
    <section class="ab-hero" id="top" aria-labelledby="rr-about-dr-title">
        <figure class="ab-hero-bg">
            <img src="<?php echo esc_url($asset('about-dr-ravi-rao/hero-city-balcony.jpg')); ?>"
                alt="Dr. Ravi Rao looking out over a city and the sea" fetchpriority="high">
        </figure>
        <div class="ab-hero-ornament" aria-hidden="true"></div>
        <div class="ab-wrap ab-hero-grid">
            <div class="ab-hero-copy">
                <p class="eyebrow">About Dr. Ravi Rao</p>
                <h1 id="rr-about-dr-title" class="serif rr-hero-worded">Dr. Ravi Rao — A Legacy of Wisdom, Vision &amp; Astro-Vaastu Excellence</h1>
                <p class="ab-sub">Over 30 Years of Expertise in Corporate and Industrial Astro-Vaastu, Vedic Astrology, and Strategic Business Consulting</p>
                <p class="ab-lead">Dr. Ravi Rao is a distinguished Indian Astro-Vaastu expert, Vedic astrologer, author, and founder of Astro-Vaastu Research Centre. For more than three decades, he has advised corporate leaders, industrialists, entrepreneurs, and private clients, bringing the traditional wisdom of Vaastu Shastra and Jyotisha into the context of contemporary life and business.</p>
                <p>Throughout his professional career, Dr. Rao has earned recognition for his work with corporate and industrial properties, his deep understanding of traditional disciplines, and his individualized approach to every project. His consulting practice spans diverse industries, regions of India, and international markets.</p>
            </div>
            <span class="chip">Knowledge · Vision · Service</span>
        </div>
    </section>

    <nav class="ab-explore" aria-label="Explore this page">
        <div class="ab-wrap">
            <b>Explore</b>
            <a href="#experience"><span>01</span>Experience</a>
            <a href="#approach"><span>02</span>Approach</a>
            <a href="#centre"><span>03</span>Research Centre</a>
            <a href="#books"><span>04</span>Astrology &amp; Books</a>
            <a href="#journey"><span>05</span>His Journey</a>
            <a href="#albums"><span>06</span>Photo Albums</a>
        </div>
    </nav>

    <section class="ab-sec be" id="experience" aria-labelledby="rr-about-dr-experience-title">
        <div class="ab-wrap">
            <p class="eyebrow">01 / Experience</p>
            <h2 class="serif" id="rr-about-dr-experience-title">Over Three Decades of Experience and Trust</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>Dr. Rao’s professional career has been closely connected with India’s business and industrial communities. Over the years, he has advised clients across a wide range of sectors, including manufacturing, textiles, chemicals, construction, hospitality, and commercial real estate.</p>
                    <p>His expertise encompasses industrial complexes, manufacturing facilities, corporate headquarters, office environments, commercial developments, and private residences. Working alongside business owners, corporate executives, architects, and project teams, Dr. Rao provides Vaastu guidance for both new developments and existing infrastructure.</p>
                    <p>His approach reflects an understanding that every enterprise operates as a complex system, with its own production processes, management structure, and spatial requirements. Rather than relying on standardized solutions, he develops recommendations tailored to the nature of the business, the purpose of the property, and the traditional principles of Vaastu Shastra.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-right">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/experience-control-room.jpg')); ?>"
                        alt="Dr. Ravi Rao discussing plans in a corporate control room" loading="lazy" decoding="async">
                    <figcaption>Guidance shaped by experience and the needs of each project</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec nv rev" id="approach" aria-labelledby="rr-about-dr-approach-title">
        <div class="ab-wrap">
            <p class="eyebrow">02 / Approach</p>
            <h2 class="serif" id="rr-about-dr-approach-title">A Strategic Approach to Astro-Vaastu for Business and Industry</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>For Dr. Rao, Vaastu Shastra is more than a system of architectural recommendations. It is a traditional discipline concerned with the relationship between space, human activity, and the natural order.</p>
                    <p>His practice brings together the principles of Vaastu and the interpretative methods of Jyotisha, offering an integrated approach to understanding and organizing the built environment.</p>
                    <p>In corporate and industrial projects, particular attention is given to building orientation, functional zoning, the positioning of production facilities, administrative spaces, executive offices, and other essential elements of infrastructure.</p>
                    <p>At the same time, Dr. Rao considers not only the traditional requirements of Vaastu but also the practical realities of business operations. His objective is to provide recommendations that can be integrated into existing architectural and operational frameworks.</p>
                    <p>This approach is particularly relevant to large industrial and commercial developments, where Vaastu guidance must be considered alongside technical requirements, production processes, and long-term development plans.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-left">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/approach-foundation-stone.jpg')); ?>"
                        alt="Dr. Ravi Rao taking part in a foundation-stone ceremony" loading="lazy" decoding="async">
                    <figcaption>Traditional principles in contemporary spaces</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec be" id="centre" aria-labelledby="rr-about-dr-centre-title">
        <div class="ab-wrap">
            <p class="eyebrow">03 / Research Centre</p>
            <h2 class="serif" id="rr-about-dr-centre-title">Founder of Astro-Vaastu Research Centre</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>An important part of Dr. Ravi Rao’s professional legacy is the establishment of Astro-Vaastu Research Centre, an institution dedicated to the study, preservation, and dissemination of traditional knowledge in Vaastu Shastra, Jyotisha, and related disciplines.</p>
                    <p>Today, the Centre brings together traditional research, decades of practical experience, and modern educational technologies, making India’s intellectual heritage accessible to an international audience.</p>
                    <p>One of its key initiatives is professional multilingual online education in Jyotisha. Through its educational platform, Online Astrology Classes, the Centre offers structured Vedic astrology programmes with opportunities to earn certificates. These programmes serve both beginners and students seeking advanced knowledge and professional development.</p>
                    <p>Vaastu Shastra education is another important area of the Centre’s work. Its online courses and practical workshops are designed for a diverse audience — from individuals interested in applying Vaastu principles to their homes and everyday lives to architects, interior designers, property developers, and other professionals working with the built environment.</p>
                    <p>This educational approach connects traditional knowledge with contemporary professional needs, presenting Vaastu not only as a subject of study but also as a foundation for thoughtful spatial planning and design.</p>
                    <p>Through Astro-Vaastu Research Centre, Dr. Rao continues to pursue his long-term mission: to preserve the depth and authenticity of traditional Indian disciplines while making them accessible to new generations of students and professionals around the world.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-right">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/centre-credai-event.jpg')); ?>"
                        alt="Dr. Ravi Rao receiving a commemorative plaque at an event" loading="lazy" decoding="async">
                    <figcaption>Learning and sharing traditional knowledge</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec nv rev" id="books" aria-labelledby="rr-about-dr-books-title">
        <div class="ab-wrap">
            <p class="eyebrow">04 / Astrology &amp; Books</p>
            <h2 class="serif" id="rr-about-dr-books-title">An Author and Expert in Vedic Astrology</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>Dr. Rao’s professional interests extend beyond architecture and Vaastu. He is also recognized for his work in sports astrology and mundane astrology, including the analysis of sporting competitions, political developments, and events of national significance.</p>
                    <p>His contribution to sharing traditional knowledge is reflected in his published books:</p>
                    <ul class="bk-list">
                        <?php foreach ($books as [$title, $cover]) : ?>
                            <li>
                                <img src="<?php echo esc_url($asset($cover)); ?>"
                                    alt="<?php echo esc_attr('Cover of ' . $title); ?>" loading="lazy" decoding="async">
                                <span><?php echo esc_html($title); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p>Through his publications, research, and educational initiatives, Dr. Rao seeks to make Vaastu Shastra and Jyotisha accessible to a wider international audience while maintaining respect for their traditional principles and methodologies.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-left">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/centre-astrology-conference.jpg')); ?>"
                        alt="Dr. Ravi Rao with guests at an astrology programme" loading="lazy" decoding="async">
                    <figcaption>Sharing traditional knowledge through books and research</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec be" id="journey" aria-labelledby="rr-about-dr-journey-title">
        <div class="ab-wrap">
            <p class="eyebrow">05 / His Journey</p>
            <h2 class="serif" id="rr-about-dr-journey-title">A Life Dedicated to Knowledge and Professional Service</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>Originally from Visakhapatnam, Dr. Rao developed an early interest in astrology, numerology, and Vaastu Shastra — an interest that gradually became his life’s work.</p>
                    <p>His professional journey later brought him to Ahmedabad, one of India’s major industrial and commercial centres, where he established an extensive consulting practice and built enduring professional relationships within the business community.</p>
                    <p>Today, his work encompasses corporate consulting, traditional research, authorship, and education.</p>
                    <p>For more than 30 years, Dr. Ravi Rao has helped clients approach important decisions through the perspective of traditional knowledge, with particular attention to individual circumstances, confidentiality, and the practical application of his recommendations.</p>
                    <p>His professional journey demonstrates how a deep understanding of India’s ancient disciplines can find meaningful application in the modern world of business, industry, and architecture.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-right">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/journey-industrial-plant.jpg')); ?>"
                        alt="Dr. Ravi Rao presenting at an industrial plant" loading="lazy" decoding="async">
                    <figcaption>Decades of professional service to business and industry</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-gal" id="albums" aria-labelledby="rr-about-dr-albums-title">
        <div class="ab-wrap">
            <div class="ab-gal-head">
                <div>
                    <p class="eyebrow">A life in practice</p>
                    <h2 class="serif" id="rr-about-dr-albums-title">The journey <em>in pictures</em></h2>
                    <p>A growing collection of photo albums gathered over the years.</p>
                </div>
                <?php if ($gallery_url) : ?>
                    <a class="ab-gal-more" href="<?php echo esc_url($gallery_url); ?>">All photo albums <span aria-hidden="true">→</span></a>
                <?php endif; ?>
            </div>
            <div class="ab-mos">
                <figure class="mo m1">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/album-temple-projects.jpg')); ?>"
                        alt="Temple projects and site visits" loading="lazy" decoding="async">
                    <figcaption class="cp">Temple Projects</figcaption>
                </figure>
                <figure class="mo m2">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/album-vedic-scholars.jpg')); ?>"
                        alt="Dr. Ravi Rao with a gathering of Vedic scholars" loading="lazy" decoding="async">
                    <figcaption class="cp">Gathering of Vedic Scholars</figcaption>
                </figure>
                <figure class="mo m3">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/album-homa-ceremony.jpg')); ?>"
                        alt="Homa ceremony" loading="lazy" decoding="async">
                    <figcaption class="cp">Homa Ceremony</figcaption>
                </figure>
                <figure class="mo m4">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/album-ganesha-shrine.jpg')); ?>"
                        alt="Ganesha shrine" loading="lazy" decoding="async">
                    <figcaption class="cp">Ganesha Shrine</figcaption>
                </figure>
                <figure class="mo m5">
                    <img src="<?php echo esc_url($asset('about-dr-ravi-rao/album-steel-plant.jpg')); ?>"
                        alt="Dr. Ravi Rao visiting a steel plant" loading="lazy" decoding="async">
                    <figcaption class="cp">Steel Plant Visit</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-quote" aria-labelledby="rr-about-dr-quote-title">
        <div class="ab-wrap">
            <p class="eyebrow">A guiding principle</p>
            <h2 class="serif" id="rr-about-dr-quote-title">Rooted in Tradition.<br>Guided by Knowledge.<em>Driven by Vision.</em></h2>
        </div>
    </section>
</main>
<?php get_footer(); ?>
