<?php
/*
Template Name: Clients & Sectors
Template Post Type: page
*/
if (!defined('ABSPATH')) {
    exit;
}

$client_logo_groups = [
    'all' => range(1, 56),
    'india' => [2, 3, 4, 6, 7, 8, 9, 10, 11, 12, 14, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 52, 54, 55],
    'overseas' => [1, 5, 13, 15, 34, 51, 53, 56],
];

$client_logo_group_labels = [
    'all' => 'All clients',
    'india' => 'India clients',
    'overseas' => 'Overseas clients',
];

$client_sectors = [
    [
        'id' => 'textile',
        'title' => 'Textile industry',
        'items' => [
            'Served as consultant for major textile plants nationwide',
            'Guided process improvement, plant layout & efficiency',
            'Helped optimize production and labor management',
        ],
        'metrics' => [
            ['₹11,280 Cr+', 'Total sales (clients)'],
            ['20,000+', 'Employees'],
        ],
    ],
    [
        'id' => 'plastics',
        'title' => 'Plastics',
        'items' => [
            'Advised on sustainable manufacturing',
            'Improved plant safety and regulatory compliance',
            'Enhanced monthly production capacity',
        ],
        'metrics' => [
            ['50,000', 'Tonnes per month capacity'],
        ],
    ],
    [
        'id' => 'pharma',
        'title' => 'Pharmaceuticals',
        'items' => [
            'Consulted for top pharma manufacturing units',
            'Guided facility design for efficiency and compliance',
            'Supported talent and resource management',
        ],
        'metrics' => [
            ['₹2,500 Cr+', 'Total sales (clients)'],
            ['11,000+', 'Employees'],
        ],
    ],
    [
        'id' => 'chemical',
        'title' => 'Chemical & hospitals',
        'items' => [
            'Enabled hospital expansions (1,000+ beds setup)',
            'Advised on chemical plant optimization',
            'Assisted with large workforce integration',
        ],
        'metrics' => [
            ['2,000+', 'Employees (chemical sector)'],
        ],
    ],
    [
        'id' => 'hotel',
        'title' => 'Hotel & infrastructure',
        'items' => [
            'Consulted for major hotel chains and infrastructure firms',
            'Improved asset utilization and space planning',
            'Managed workforce for large projects',
        ],
        'metrics' => [
            ['7,000+', 'Employees'],
            ['2,000+', 'Rooms'],
        ],
    ],
    [
        'id' => 'sugar',
        'title' => 'Sugar manufacturing',
        'items' => [
            'Guided modernization of sugar plants',
            'Optimized daily production and logistics',
        ],
        'metrics' => [
            ['1,500', 'Tonnes per day capacity'],
        ],
    ],
    [
        'id' => 'power',
        'title' => 'Power & solar',
        'items' => [
            'Consulted for solar and thermal power plants',
            'Advised on installation and capacity expansion',
            'Helped manage large-scale workforce',
        ],
        'metrics' => [
            ['4,00,000+', 'PV solar modules'],
            ['4,000+', 'Employees'],
        ],
    ],
    [
        'id' => 'realestate',
        'title' => 'Real estate',
        'items' => [
            'Provided Vaastu and site selection for 2,00,000+ properties',
            'Advised on efficient land use and compliance',
            'Helped streamline property development teams',
        ],
        'metrics' => [
            ['2,00,000+', 'Properties consulted'],
            ['1,000+', 'Employees'],
        ],
    ],
];

$client_industries = [
    'Manufacturing',
    'Automotive',
    'Pharma',
    'Food processing',
    'Paper & packaging',
    'Logistics',
    'Corporate office',
    'IT / Digital',
    'Finance',
    'Healthcare',
    'Hospitality',
    'Retail',
    'Entertainment',
    'Real estate',
    'Construction',
];

get_header();
?>
<div class="rr-client-page" id="top">
    <section class="rr-client-hero" aria-labelledby="rr-client-title">
        <svg class="rr-client-hero-dial" viewBox="0 0 400 400" aria-hidden="true" focusable="false">
            <circle cx="200" cy="200" r="190" fill="none" stroke="#fff" stroke-opacity=".4" stroke-width="10" stroke-dasharray="1.5 13"/>
            <circle cx="200" cy="200" r="170" fill="none" stroke="#fff" stroke-opacity=".55"/>
            <circle cx="200" cy="200" r="120" fill="none" stroke="#fff" stroke-opacity=".35"/>
            <circle cx="200" cy="200" r="64" fill="none" stroke="#fff" stroke-opacity=".35"/>
            <path d="M200 30v340M30 200h340M80 80l240 240M320 80L80 320" stroke="#fff" stroke-opacity=".3"/>
            <path class="rr-client-fill-coral" d="M200 46l11 154-11 14-11-14z"/>
            <path d="M200 354l-11-154 11-14 11 14z" fill="#fff" fill-opacity=".5"/>
            <text x="200" y="26" text-anchor="middle">N</text>
            <text x="380" y="205" text-anchor="middle">E</text>
            <text x="200" y="388" text-anchor="middle">S</text>
            <text x="20" y="205" text-anchor="middle">W</text>
        </svg>
        <div class="rr-client-hero-inner">
            <div class="rr-client-hero-copy">
                <p class="rr-client-breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span aria-hidden="true"> / </span>
                    <span class="rr-client-breadcrumb-current" aria-current="page">Clients</span>
                </p>
                <p class="rr-client-hero-eyebrow"><span aria-hidden="true"></span>Clients across India and overseas</p>
                <h1 class="serif" id="rr-client-title">Boundaries are <em>no bar</em> for Vaastu</h1>
                <p class="rr-client-hero-description">Dr. Ravi Rao proves that Vaastu is universally applicable. Clients from around the world consult him on properties in any country and any city.</p>
                <div class="rr-client-hero-actions">
                    <a class="rr-client-primary-link" href="#business-enquiry">Request a Consultation</a>
                    <a class="rr-client-secondary-link" href="#sectors">Explore sectors</a>
                </div>
            </div>

            <aside class="rr-client-spread" aria-label="Global client spread">
                <p class="rr-client-spread-title">Global client spread</p>
                <div class="rr-client-spread-stats">
                    <div>
                        <p class="rr-client-spread-number serif">54%</p>
                        <p class="rr-client-spread-label">India</p>
                    </div>
                    <div>
                        <p class="rr-client-spread-number rr-client-spread-number-overseas serif">46%</p>
                        <p class="rr-client-spread-label">Overseas</p>
                    </div>
                </div>
                <div class="rr-client-spread-bar" role="img" aria-label="54 percent of clients in India, 46 percent overseas">
                    <span></span>
                    <span></span>
                </div>
            </aside>
        </div>
    </section>

    <section class="rr-client-logos" aria-labelledby="rr-client-logos-title">
        <div class="rr-client-section-inner">
            <div class="rr-client-section-heading">
                <div class="rr-client-section-heading-copy">
                    <p class="rr-client-eyebrow">01 / Client logos</p>
                    <h2 class="serif" id="rr-client-logos-title">Trusted by leading brands</h2>
                    <p>Organizations across industries have placed their trust in Dr. Ravi Rao’s Vaastu expertise.</p>
                </div>
                <div class="rr-client-logo-tabs rr-brand-tabs" role="tablist" aria-label="Filter clients by location">
                    <?php foreach ($client_logo_groups as $region => $logos) : ?>
                        <button
                            class="rr-client-logo-tab rr-brand-tab<?php echo $region === 'all' ? ' is-active' : ''; ?>"
                            type="button"
                            role="tab"
                            aria-selected="<?php echo $region === 'all' ? 'true' : 'false'; ?>"
                            aria-controls="rr-client-logo-panel-<?php echo esc_attr($region); ?>"
                            data-tab="<?php echo esc_attr($region); ?>"
                            tabindex="<?php echo $region === 'all' ? '0' : '-1'; ?>">
                            <?php echo esc_html(ucfirst($region)); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="rr-client-logo-panels">
                <?php foreach ($client_logo_groups as $region => $logos) : ?>
                    <div
                        class="rr-client-logo-grid rr-brand-logos-grid"
                        id="rr-client-logo-panel-<?php echo esc_attr($region); ?>"
                        data-panel="<?php echo esc_attr($region); ?>"
                        role="tabpanel"
                        aria-label="<?php echo esc_attr($client_logo_group_labels[$region]); ?>"
                        <?php echo $region === 'all' ? '' : 'hidden'; ?>>
                        <?php foreach ($logos as $logo) : ?>
                            <figure class="rr-client-logo">
                                <img
                                    src="<?php echo esc_url(content_url('/uploads/2025/07/' . $logo . '.png')); ?>"
                                    alt="Logo <?php echo esc_attr((string) $logo); ?>"
                                    loading="lazy">
                            </figure>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="rr-client-industries" id="industries" aria-labelledby="rr-client-industries-title">
        <div class="rr-client-section-inner">
            <div class="rr-client-sheet">
                <div class="rr-client-sheet-head">
                    <div class="rr-client-sheet-title">
                        <p class="rr-client-eyebrow rr-client-eyebrow-gold">02 / Across industries</p>
                        <h2 class="serif" id="rr-client-industries-title">Industries thriving with Vaastu guidance</h2>
                        <p>Vaastu guidance for businesses across a wide range of industries.</p>
                    </div>
                    <div class="rr-client-sheet-block">
                        <svg class="rr-client-sheet-compass" viewBox="0 0 160 160" aria-hidden="true" focusable="false">
                            <circle class="rr-client-stroke-gold" cx="80" cy="80" r="62" fill="none" stroke-width="1.5"/>
                            <circle class="rr-client-dial-ring" cx="80" cy="80" r="54" fill="none" stroke="#fff" stroke-opacity=".5" stroke-width="5" stroke-dasharray="1 7.2"/>
                            <circle cx="80" cy="80" r="40" fill="none" stroke="#fff" stroke-opacity=".3"/>
                            <path d="M80 18v124M18 80h124M36 36l88 88M124 36L36 124" stroke="#fff" stroke-opacity=".2"/>
                            <g class="rr-client-needle">
                                <path class="rr-client-fill-coral" d="M80 28L88 80H72z"/>
                                <path d="M80 132L72 80H88z" fill="#fff" fill-opacity=".6"/>
                            </g>
                            <circle class="rr-client-compass-hub" cx="80" cy="80" r="5" stroke="#fff" stroke-width="1.5"/>
                            <text class="rr-client-compass-north" x="80" y="13" text-anchor="middle">N</text>
                            <text x="147" y="84" text-anchor="middle">E</text>
                            <text x="80" y="155" text-anchor="middle">S</text>
                            <text x="13" y="84" text-anchor="middle">W</text>
                        </svg>
                    </div>
                </div>
                <div class="rr-client-plan">
                    <svg class="rr-client-mandala" viewBox="0 0 90 90" aria-hidden="true" focusable="false">
                        <rect class="rr-client-fill-coral" x="30.33" y="30.33" width="29.33" height="29.33" fill-opacity=".16"/>
                        <g fill="none" stroke="#fff" stroke-opacity=".1" stroke-width=".35">
                            <rect x="1" y="1" width="88" height="88"/>
                            <path d="M10.78 1V89M1 10.78H89M20.56 1V89M1 20.56H89M30.33 1V89M1 30.33H89M40.11 1V89M1 40.11H89M49.89 1V89M1 49.89H89M59.67 1V89M1 59.67H89M69.44 1V89M1 69.44H89M79.22 1V89M1 79.22H89"/>
                            <path d="M1 1L89 89M89 1L1 89"/>
                        </g>
                        <circle class="rr-client-stroke-gold" cx="45" cy="45" r="44" fill="none" stroke-opacity=".3" stroke-width=".35" stroke-dasharray="1 1.4"/>
                        <rect class="rr-client-stroke-coral" x="30.33" y="30.33" width="29.33" height="29.33" fill="none" stroke-opacity=".55" stroke-width=".4"/>
                    </svg>
                    <ol class="rr-client-industry-list">
                        <?php foreach ($client_industries as $index => $industry) : ?>
                            <li>
                                <span class="rr-client-industry-number"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                                <span class="rr-client-industry-name serif"><?php echo esc_html($industry); ?></span>
                                <span class="rr-client-industry-tick" aria-hidden="true"></span>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="rr-client-sectors" id="sectors" aria-labelledby="rr-client-sectors-title">
        <div class="rr-client-section-inner">
            <div class="rr-client-section-heading">
                <div class="rr-client-section-heading-copy">
                    <p class="rr-client-eyebrow">03 / Sectors</p>
                    <h2 class="serif" id="rr-client-sectors-title">Our core sectors</h2>
                    <p>Specialized consulting and implementation across multiple industries and domains.</p>
                </div>
                <a class="rr-client-text-link" href="<?php echo esc_url(home_url('/services/')); ?>">Browse services by property type <span aria-hidden="true">&#8594;</span></a>
            </div>

            <div class="rr-client-sector-grid">
                <?php foreach ($client_sectors as $sector_index => $sector) : ?>
                    <article class="rr-client-sector" id="<?php echo esc_attr($sector['id']); ?>">
                        <div class="rr-client-sector-heading">
                            <span class="rr-client-sector-number serif"><?php echo esc_html(str_pad((string) ($sector_index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                            <h3 class="serif"><?php echo esc_html($sector['title']); ?></h3>
                        </div>
                        <ul>
                            <?php foreach ($sector['items'] as $item) : ?>
                                <li><span aria-hidden="true"></span><?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="rr-client-sector-metrics">
                            <?php foreach ($sector['metrics'] as [$value, $label]) : ?>
                                <div>
                                    <p class="rr-client-sector-value serif"><?php echo esc_html($value); ?></p>
                                    <p class="rr-client-sector-label"><?php echo esc_html($label); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>
<?php get_footer(); ?>
