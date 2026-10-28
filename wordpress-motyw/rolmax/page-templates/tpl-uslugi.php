<?php
/* Template Name: Rolmax — lista usług (podstrony) */
defined('ABSPATH') || exit;
get_header();
the_post();
rm_part('page-hero', ['kicker' => get_post_meta(get_the_ID(), '_rm_kicker', true), 'h1' => esc_html(get_the_title()), 'lead' => get_the_excerpt(), 'scene' => 'workshop', 'crumbs' => [[get_the_title(), null]]]);
?>
<section class="sec light"><div class="wrap">
  <div class="jobs">
    <?php foreach (get_pages(['parent' => get_the_ID(), 'sort_column' => 'menu_order']) as $i => $p): ?>
    <a class="job" href="<?= esc_url(get_permalink($p)) ?>"><span class="n"><?= sprintf('%02d', $i + 1) ?></span><h3><?= rm_e(get_the_title($p)) ?> <?php if ($p->post_excerpt): ?><em class="s">— <?= rm_e($p->post_excerpt) ?></em><?php endif; ?></h3><span class="go"><svg><use href="#i-ar"/></svg></span></a>
    <?php endforeach; ?>
  </div>
  <?php if (trim(get_the_content()) !== ''): ?><div class="prose" style="margin-top:3rem"><?php the_content(); ?></div><?php endif; ?>
</div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
