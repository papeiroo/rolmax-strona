<?php
/* Szablon zapasowy (archiwa kategorii, wyszukiwanie). */
defined('ABSPATH') || exit;
get_header();
rm_part('page-hero', ['kicker' => 'Rolmax', 'h1' => esc_html(wp_strip_all_tags(get_the_archive_title() ?: 'Aktualności')), 'lead' => '', 'scene' => 'dusk', 'crumbs' => []]);
?>
<section class="sec"><div class="wrap"><div class="news newsall">
  <?php while (have_posts()): the_post(); ?>
  <a class="post" href="<?php the_permalink(); ?>"><div class="vis"><?php if (has_post_thumbnail()) the_post_thumbnail('rm-card', ['alt' => '']); else echo '<canvas data-scene="field"></canvas>'; ?></div><time><?= esc_html(get_the_date('d.m.Y')) ?></time><h3><?php the_title(); ?></h3></a>
  <?php endwhile; ?>
</div>
<?php global $wp_query; rm_part('pager', ['cur' => max(1, (int)get_query_var('paged')), 'pages' => (int)$wp_query->max_num_pages, 'url' => fn($n) => get_pagenum_link($n)]); ?>
</div></section>
<?php get_footer(); ?>
