<?php
defined('ABSPATH') || exit;
get_header();
the_post();
$list = get_page_by_path('pl/aktualnosci');
rm_part('page-hero', ['kicker' => get_the_date('d.m.Y'), 'h1' => esc_html(get_the_title()), 'lead' => has_excerpt() ? get_the_excerpt() : 'Aktualności Rolmax', 'scene' => 'dusk',
    'photo' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'rm-hero') : '', 'crumbs' => [['Aktualności', $list ? get_permalink($list) : rm_url('pl/aktualnosci')], [get_the_title(), null]]]);
$recent = get_posts(['numberposts' => 8, 'post__not_in' => [get_the_ID()]]);
?>
<section class="sec light"><div class="wrap layout2">
  <aside class="subnav rv">
    <span class="kicker">Najnowsze</span>
    <ul><?php foreach ($recent as $p): ?><li><a href="<?= esc_url(get_permalink($p)) ?>"><span>›</span><?= rm_e(get_the_title($p)) ?></a></li><?php endforeach; ?></ul>
  </aside>
  <article class="prose rv">
    <?php the_content(); ?>
    <p><a class="btn dark" href="<?= esc_url($list ? get_permalink($list) : rm_url('pl/aktualnosci')) ?>">Wszystkie aktualności <span class="ar"></span></a></p>
  </article>
</div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
