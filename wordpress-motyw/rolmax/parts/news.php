<?php
$args = wp_parse_args($args, ['count' => 3, 'cat' => '']);
$q = new WP_Query(['post_type' => 'post', 'posts_per_page' => $args['count'], 'category_name' => $args['cat'], 'ignore_sticky_posts' => true, 'no_found_rows' => true]);
$scenes = ['field', 'dusk', 'gears'];
if (!$q->have_posts()) return;
?>
<div class="news">
  <?php $i = 0; while ($q->have_posts()): $q->the_post(); ?>
  <a class="post<?= $i === 0 ? ' feat' : '' ?>" href="<?php the_permalink(); ?>">
    <div class="vis"><?php if (has_post_thumbnail()): the_post_thumbnail('rm-card', ['alt' => '']); else: ?><canvas data-scene="<?= $scenes[$i % 3] ?>"></canvas><span class="lab"><?= esc_html(get_the_date('d.m')) ?></span><?php endif; ?></div>
    <time datetime="<?= esc_attr(get_the_date('c')) ?>"><?= esc_html(get_the_date('d.m.Y')) ?></time><h3><?php the_title(); ?></h3>
    <?php if (has_excerpt()): ?><p><?= esc_html(get_the_excerpt()) ?></p><?php endif; ?>
  </a>
  <?php $i++; endwhile; wp_reset_postdata(); ?>
</div>
