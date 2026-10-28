<?php
defined('ABSPATH') || exit;
get_header();
rm_part('page-hero', ['kicker' => 'Zdjęcia i realizacje', 'h1' => 'Galeria', 'lead' => 'Pokazy, dni otwarte, targi i maszyny w pracy.', 'scene' => 'field', 'crumbs' => [['Galeria', null]]]);
$scenes = ['field', 'dusk', 'rows'];
?>
<section class="sec"><div class="wrap">
  <div class="news newsall gal">
    <?php $i = 0; while (have_posts()): the_post(); preg_match('/(20\d\d)/', get_the_title(), $y); ?>
    <a class="post" href="<?php the_permalink(); ?>"><div class="vis"><?php if (has_post_thumbnail()): the_post_thumbnail('rm-card', ['alt' => '']); else: ?><canvas data-scene="<?= $scenes[$i % 3] ?>"></canvas><span class="lab"><?= esc_html($y[1] ?? '') ?></span><?php endif; ?></div><time>Galeria</time><h3><?php the_title(); ?></h3></a>
    <?php $i++; endwhile; ?>
  </div>
  <?php global $wp_query; rm_part('pager', ['cur' => max(1, (int)get_query_var('paged')), 'pages' => (int)$wp_query->max_num_pages, 'url' => fn($n) => get_pagenum_link($n)]); ?>
</div></section>
<?php get_footer(); ?>
