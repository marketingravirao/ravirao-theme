<?php
if (!defined('ABSPATH')) { exit; }

$seminars = [
    [
        'title' => 'Furniture and Interiors Designers Association Seminar 1997',
        'description' => "Seminar focused on Vaastu's role in furniture and interior design, exploring how spatial orientation and placement impact productivity and harmony within spaces.",
    ],
    [
        'title' => 'London Speech 2002, ISBA Meeting',
        'description' => 'Invited to London to present breakthrough research in modern predictive astrology to an international audience of scholars.',
    ],
    [
        'title' => 'AFA USA: Modern Astrology Techniques',
        'description' => 'Delivered an acclaimed paper at the AFA Conference, USA, sharing practical new methods in astrology and predictive science.',
    ],
    [
        'title' => 'ICAS Workshop on Predictive Astrology, Ahmedabad',
        'description' => 'Hands-on workshop for students and practitioners covering practical application of predictive astrology techniques.',
    ],
    [
        'title' => 'JKR Astro Research Foundation: 5th Annual and National Astrological Conference',
        'description' => 'Presented on the evolving trends in astrology and the integration of numerology for better business and personal guidance.',
    ],
    [
        'title' => 'Predicting Natural Disasters, Bangalore',
        'description' => 'Spoke on astrological signals of natural disasters and the power of chart analysis in forewarning major events.',
    ],
    [
        'title' => 'PLAST India: Impact of Business Logos in Day-to-Day Business',
        'description' => 'Session for industry leaders on how logos and business branding, when aligned with Vaastu and astrology, can improve business outcomes.',
    ],
    [
        'title' => 'CII and Rotary Clubs: Vaastu in Day-to-Day Life',
        'description' => 'Regularly invited by leading business and civic groups to deliver talks on practical Vaastu applications for well-being and prosperity.',
    ],
    [
        'title' => 'Plast Asia Conference 2004, Bangalore',
        'description' => 'Conference panelist, presenting a case study on Vaastu-based architecture in modern industrial and commercial projects.',
    ],
];

get_header();
?>
<main class="ravirao-homepage rr-about-workshops-page">
  <section class="rr-workshops-section rr-section-soft" aria-labelledby="rr-workshops-title">
    <div class="rr-workshops-inner rr-container">
      <header class="rr-workshops-heading rr-reveal rr-reveal-up">
        <p class="rr-about-dr-eyebrow">Seminars &amp; workshops</p>
        <h1 id="rr-workshops-title">Snapshots of Dr. Rao’s Worldwide Seminars</h1>
        <p>Explore selected talks, conferences, and workshops from Dr. Rao’s academic journey.</p>
        <p class="rr-workshops-count"><?php echo esc_html(count($seminars)); ?> selected events</p>
      </header>
      <div class="rr-workshops-list" aria-label="Seminars and workshops">
        <?php foreach ($seminars as $index => $seminar) : ?>
          <details class="rr-workshop-item rr-reveal rr-reveal-up">
            <summary>
              <span class="rr-workshop-number" aria-hidden="true"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
              <span class="rr-workshop-title"><?php echo esc_html($seminar['title']); ?></span>
              <span class="rr-workshop-toggle" aria-hidden="true">+</span>
            </summary>
            <div class="rr-workshop-description">
              <p><?php echo esc_html($seminar['description']); ?></p>
            </div>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<?php get_footer(); ?>