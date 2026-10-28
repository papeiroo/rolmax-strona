<?php
/* Template Name: Rolmax — lista aktualności */
defined('ABSPATH') || exit;
get_header();
the_post();
$cat = $args['cat'] ?? ($GLOBALS['rm_news_cat'] ?? '');
$paged = max(1, (int)get_query_var('page'));
$q = new WP_Query(['post_type' => 'post', 'posts_per_page' => 12, 'paged' => $paged, 'category_name' => $cat, 'ignore_sticky_posts' => true]);
$scenes = ['field', 'dusk', 'gears', 'rows'];
rm_part('page-hero', ['kicker' => get_post_meta(get_the_ID(), '_rm_kicker', true), 'h1' => esc_html(get_the_title()), 'lead' => get_the_excerpt(), 'scene' => 'dusk', 'crumbs' => [[get_the_title(), null]]]);
?>
<section class="sec"><div class="wrap">
  <div class="news newsall">
    <?php $i = 0; while ($q->have_posts()): $q->the_post(); ?>
    <a class="post" href="<?php the_permalink(); ?>">
      <div class="vis"><?php if (has_post_thumbnail()): the_post_thumbnail('rm-card', ['alt' => '']); else: ?><canvas data-scene="<?= $scenes[$i % 4] ?>"></canvas><span class="lab"><?= esc_html(get_the_date('m.Y')) ?></span><?php endif; ?></div>
      <time datetime="<?= esc_attr(get_the_date('c')) ?>"><?= esc_html(get_the_date('d.m.Y')) ?></time><h3><?php the_title(); ?></h3>
    </a>
    <?php $i++; endwhile; ?>
  </div>
  <?php if (!$i): ?><p>Brak wpisów.</p><?php endif; ?>
  <?php $base = get_permalink(get_queried_object_id()); rm_part('pager', ['cur' => $paged, 'pages' => (int)$q->max_num_pages, 'url' => fn($n) => $n > 1 ? add_query_arg('page', $n, $base) : $base]); wp_reset_postdata(); ?>
</div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
