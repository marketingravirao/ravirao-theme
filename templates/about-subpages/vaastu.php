<?php
if (!defined('ABSPATH')) {
    exit;
}

$asset = static function ($path) {
    return get_theme_file_uri('/assets/images/about-vaastu/' . ltrim($path, '/'));
};

$render_svg = static function ($path) {
    include get_theme_file_path('/assets/images/about-vaastu/' . ltrim($path, '/'));
};

$corporate_url = home_url('/services/');

$principles = [
    [
        'A Foundation for Long-Term Stability',
        'business-stability.svg',
        [
            'Land selection, building orientation, architectural proportions, and the arrangement of functional areas are fundamental considerations in traditional Vaastu. Addressing them during the early stages of a project allows these principles to be incorporated before major construction and investment decisions are finalized.',
        ],
    ],
    [
        'Harmony Between Space and Operations',
        'business-harmony.svg',
        [
            'Industrial and commercial facilities depend on the effective coordination of interconnected activities. Vaastu considers the placement of production areas, machinery, utilities, storage facilities, administrative offices, and circulation routes in relation to their purpose and traditional directional associations.',
            'This approach encourages a comprehensive understanding of the property as an integrated spatial system rather than a collection of independent structures.',
        ],
    ],
    [
        'An Environment for Leadership and Growth',
        'business-growth.svg',
        [
            'In corporate Vaastu, particular attention is given to the positioning of entrances, executive offices, administrative departments, and working areas.',
            'Their appropriate arrangement is traditionally associated with managerial stability, clarity in decision-making, harmonious professional relationships, and favourable conditions for business development.',
        ],
    ],
    [
        'Prosperity and Long-Term Business Development',
        'business-prosperity.svg',
        [
            'Within the Vaastu tradition, a well-organized environment is associated with stability, prosperity, and favourable business activity.',
            'Professional Vaastu consultation examines the existing or proposed spatial arrangement, identifies imbalances according to traditional principles, and develops recommendations suited to the nature and requirements of the enterprise.',
            'For new developments, this allows Vaastu considerations to be integrated into the architectural planning process. For existing facilities, the emphasis is on identifying appropriate adjustments while respecting structural, technical, and operational constraints.',
        ],
    ],
    [
        'Vaastu and Long-Term Planning',
        'business-planning.svg',
        [
            'Industrial facilities, corporate headquarters, and commercial properties are often designed to serve an enterprise for decades. Decisions concerning their location, orientation, and spatial organization can be difficult and costly to change once construction is complete.',
            'Integrating Vaastu principles into long-term planning therefore offers an opportunity to bring traditional architectural knowledge into dialogue with contemporary design, operational priorities, and business strategy.',
            'Vaastu Shastra encourages us to understand the built environment not merely as a physical setting for business, but as an integral part of an enterprise’s stability, harmony, and long-term prosperity.',
        ],
    ],
];

get_header();
?>
<main class="ravirao-about-page rr-about-shell rr-vaastu-page rr-about-vaastu-design">
    <section class="ab-hero" id="top" aria-labelledby="rr-vaastu-title">
        <figure class="ab-hero-bg">
            <img src="<?php echo esc_url($asset('hero-vaastu-site.jpg')); ?>"
                alt="Dr. Ravi Rao at a building-site excavation" fetchpriority="high">
        </figure>
        <?php $render_svg('rose-light.svg'); ?>
        <div class="ab-wrap ab-hero-grid">
            <div class="ab-hero-copy">
                <p class="eyebrow">About Vaastu</p>
                <h1 id="rr-vaastu-title" class="serif rr-hero-worded">Vaastu Shastra — The Ancient Indian Wisdom of Space and Architecture</h1>
                <p class="ab-sub">Timeless Wisdom for Modern Architecture and Business</p>
                <p class="ab-lead">A traditional Indian system of architectural knowledge that brings together the principles of direction, proportion, spatial order, and harmony between human life, the environment, and natural forces.</p>
                <div class="ab-more-wrap" id="vaastu-hero-more">
                    <div class="ab-more-in">
                        <p>Vaastu Shastra is one of India’s ancient architectural traditions, concerned with site selection, planning, construction, and the organization of space in accordance with the principles of natural and cosmic order. For centuries, its teachings have guided the construction of temples, palaces, residences, and entire settlements.</p>
                        <p>Today, Vaastu continues to hold significance not only in residential architecture but also in the planning of industrial facilities, corporate buildings, commercial developments, and modern infrastructure. Within the Indian tradition, the proper organization of space is regarded as an important foundation for well-being, stability, and prosperity.</p>
                    </div>
                </div>
                <button class="ab-more" type="button" aria-expanded="false" aria-controls="vaastu-hero-more" data-vaastu-more>
                    <span data-vaastu-more-label>Read more</span>
                    <span class="ab-more-chevron" aria-hidden="true">⌄</span>
                </button>
            </div>
            <span class="chip">Direction · Proportion · Harmony</span>
        </div>
    </section>

    <nav class="ab-explore" aria-label="On this page">
        <div class="ab-wrap">
            <b>Explore</b>
            <a href="#heritage"><span>01</span>Heritage</a>
            <a href="#elements"><span>02</span>Elements</a>
            <a href="#mandala"><span>03</span>Mandala</a>
            <a href="#industry"><span>04</span>Modern Industry</a>
            <a href="#business"><span>05</span>Business</a>
        </div>
    </nav>

    <section class="ab-sec be" id="heritage" aria-labelledby="rr-vaastu-heritage-title">
        <div class="ab-wrap">
            <p class="eyebrow">01 / Heritage</p>
            <h2 class="serif" id="rr-vaastu-heritage-title">A Heritage of Architectural Knowledge</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>Vaastu Shastra is an integral part of India’s rich intellectual and architectural heritage, rooted in the Vedic tradition of Sthapatya Veda — the traditional body of knowledge concerning architecture, construction, and the organization of space. Its principles developed over centuries and were transmitted through generations of scholars, architects, and master builders, finding expression in classical Sanskrit treatises.</p>
                    <p>Authoritative texts such as the Mānasāra and Mayamata explore the principles of land selection, building orientation, architectural proportions, measurements, planning, and the functional organization of structures.</p>
                    <p>At the heart of this tradition lies the understanding that a building does not exist independently of its surroundings. Its location, form, and internal structure should reflect natural conditions, the purpose of the space, and the traditional principles of cosmic harmony.</p>
                    <p>Vaastu Shastra therefore represents a comprehensive system of architectural knowledge in which the practical aspects of construction are inseparably connected with the traditional understanding of space and cosmic order.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-right">
                    <div class="av">
                        <?php $render_svg('heritage-timeline.svg'); ?>
                        <span class="av-cap">Manuscript → Blueprint</span>
                    </div>
                    <figcaption>Architecture shaped by place, purpose and tradition</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec rev" id="elements" aria-labelledby="rr-vaastu-elements-title">
        <div class="ab-wrap">
            <p class="eyebrow">02 / Elements</p>
            <h2 class="serif" id="rr-vaastu-elements-title">The Five Elements and Eight Directions</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>One of the fundamental principles of Vaastu Shastra is the concept of the Pancha Mahabhutas (Pañca Mahābhūtas) — the five great elements: Earth (Prithvi), Water (Jala), Fire (Agni), Air (Vayu), and Space (Akasha).</p>
                    <p>According to traditional Indian philosophy, these elements form the basis of the material world and influence the relationship between human beings and their environment.</p>
                    <p>Equally important are the eight principal directions: North, Northeast, East, Southeast, South, Southwest, West, and Northwest. Each direction possesses distinct traditional qualities and is associated with particular deities, natural forces, and types of activity.</p>
                    <p>Vaastu considers these relationships when determining building orientation, the placement of entrances, rooms, functional zones, and other architectural elements.</p>
                    <p>The harmonious integration of the five elements, directions, and the purpose of a space forms one of the essential foundations of traditional Vaastu planning.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-left">
                    <div class="av">
                        <?php $render_svg('elements-compass.svg'); ?>
                        <span class="av-cap">Elements · Directions</span>
                    </div>
                    <figcaption>Five elements · Eight directions</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec be" id="mandala" aria-labelledby="rr-vaastu-mandala-title">
        <div class="ab-wrap">
            <p class="eyebrow">03 / Mandala</p>
            <h2 class="serif" id="rr-vaastu-mandala-title">Vaastu Purusha Mandala and Spatial Order</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>At the centre of the traditional architectural system stands the Vaastu Purusha Mandala — a sacred geometric framework expressing the relationship between space, direction, proportion, and cosmic order.</p>
                    <p>The Mandala represents an ordered structure divided into a defined number of sectors, each carrying its own symbolic and functional significance. In the classical tradition, these sectors are associated with particular deities and principles of spatial organization.</p>
                    <p>The Vaastu Purusha Mandala serves as an important foundation for determining the spatial structure of a building, distributing functional areas, and aligning architectural design with traditional principles.</p>
                    <p>Particular importance is given to building orientation, proportions, the relationship between different spaces, and the central area known as the Brahmasthana.</p>
                    <p>This approach allows a building to be understood not as a collection of separate rooms, but as an interconnected whole in which every element occupies a particular position and serves a specific purpose.</p>
                    <p>India’s architectural heritage encompasses the sophisticated urban planning of the Indus Valley Civilisation as well as the rich architectural traditions preserved in classical Indian literature. Among these is the legendary city of Indraprastha, traditionally associated with Vishwakarma, the divine architect, and the age of the Pandavas.</p>
                    <p>For thousands of years, the principles of spatial harmony have held an important place in Indian architecture, shaping traditional approaches to the construction of temples, palaces, cities, and residences.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-right">
                    <div class="av">
                        <?php $render_svg('vaastu-purusha-mandala.svg'); ?>
                        <span class="av-cap r">Vaastu Purusha Mandala</span>
                    </div>
                    <figcaption>Spatial order and the relationship between architectural elements</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec rev" id="industry" aria-labelledby="rr-vaastu-industry-title">
        <div class="ab-wrap">
            <p class="eyebrow">04 / Modern Industry</p>
            <h2 class="serif" id="rr-vaastu-industry-title">Vaastu in Modern Architecture and Industry</h2>
            <div class="ab-grid">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>The principles of Vaastu Shastra extend far beyond traditional residential architecture. Today, they are applied to corporate headquarters, manufacturing plants, industrial campuses, commercial developments, hotels, healthcare facilities, and large infrastructure projects.</p>
                    <p>In the Vaastu tradition, every building is understood as an interconnected spatial system. Its orientation, proportions, entrances, internal divisions, and the placement of key functions are considered in relation to the purpose of the property and the activities carried out within it.</p>
                    <p>For industrial and corporate environments, this involves a comprehensive assessment of the site and its functional organization — from production areas, machinery, and utilities to administrative departments, executive offices, storage facilities, and circulation routes.</p>
                    <p>An important distinction lies in the way Vaastu approaches different types of buildings. A manufacturing facility, a corporate headquarters, and a residential property serve fundamentally different purposes. Their spatial requirements must therefore be assessed individually rather than through a universal set of recommendations.</p>
                    <p>When incorporated at the planning stage, Vaastu principles can inform site selection, master planning, architectural layouts, and the distribution of essential functions. For existing facilities, consultation focuses on understanding the present configuration and identifying adjustments that may be feasible within operational and technical constraints.</p>
                    <p>The professional application of Vaastu requires coordination with architects, engineers, and project teams, allowing traditional spatial principles to be integrated into contemporary planning alongside structural requirements, safety standards, and the practical needs of the enterprise.</p>
                </div>
                <figure class="ab-vis rr-reveal rr-reveal-left">
                    <div class="av">
                        <?php $render_svg('industrial-campus.svg'); ?>
                        <span class="av-cap">Tradition + Infrastructure</span>
                    </div>
                    <figcaption>Traditional principles considered alongside contemporary requirements</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="ab-sec ab-biz" id="business" aria-labelledby="rr-vaastu-business-title">
        <div class="ab-wrap">
            <p class="eyebrow">05 / Business</p>
            <h2 class="serif" id="rr-vaastu-business-title">Why Vaastu Matters for Business and Industry</h2>
            <div class="ab-biz-intro">
                <div class="ab-tx rr-reveal rr-reveal-up">
                    <p>For business owners and industrial leaders, a building is more than a physical asset. It is the environment in which people work, decisions are made, resources are managed, and operations take place. Its location, orientation, and internal organization are therefore important considerations in the long-term development of an enterprise.</p>
                    <p>Within the Indian architectural tradition, Vaastu Shastra provides a comprehensive approach to spatial planning, bringing together the principles of direction, proportion, functional organization, and harmony with the surrounding environment.</p>
                    <p>In corporate and industrial settings, these principles are applied according to the specific purpose, scale, and operational requirements of each property.</p>
                </div>
                <figure class="ab-env rr-reveal rr-reveal-right">
                    <?php $render_svg('business-building-plan.svg'); ?>
                </figure>
            </div>
            <div class="ab-cards">
                <?php foreach ($principles as [$title, $icon, $paragraphs]) : ?>
                    <article class="ab-card rr-reveal rr-reveal-up">
                        <span class="ico av-i" aria-hidden="true">
                            <?php $render_svg($icon); ?>
                        </span>
                        <h3><?php echo esc_html($title); ?></h3>
                        <?php foreach ($paragraphs as $paragraph) : ?>
                            <p><?php echo esc_html($paragraph); ?></p>
                        <?php endforeach; ?>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="ab-biz-cta">
                <a class="btn" href="<?php echo esc_url($corporate_url); ?>">Corporate &amp; Industrial Vaastu Consulting <span aria-hidden="true">→</span></a>
            </p>
        </div>
    </section>

    <section class="ab-cta" aria-labelledby="rr-vaastu-closing-title">
        <?php $render_svg('rose-blue.svg'); ?>
        <div class="ab-wrap">
            <p class="eyebrow">A timeless perspective</p>
            <h2 class="serif" id="rr-vaastu-closing-title">Ancient Wisdom.<br>Spatial Harmony.<em>Business Prosperity.</em></h2>
        </div>
    </section>
</main>
<?php get_footer(); ?>
