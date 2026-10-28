<?php
defined('ABSPATH') || exit;
get_header();
the_post();
$scene = rm_dept() === 'czesci' ? 'workshop' : 'field';
rm_part('page-hero', ['kicker' => get_post_meta(get_the_ID(), '_rm_kicker', true), 'h1' => esc_html(get_the_title()), 'lead' => has_excerpt() ? get_the_excerpt() : '', 'scene' => $scene,
    'photo' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'rm-hero') : '',
    'crumbs' => array_merge(array_map(fn($id) => [get_the_title($id), get_permalink($id)], array_slice(array_reverse(get_post_ancestors(get_the_ID())), 1)), [[get_the_title(), null]])]);
$sib = rm_sibling_pages(get_the_ID());
?>
<section class="sec light"><div class="wrap<?= $sib ? ' layout2' : '' ?>">
  <?php if ($sib): ?>
  <aside class="subnav rv">
    <span class="kicker"><?= rm_e(get_the_title(wp_get_post_parent_id(get_the_ID()))) ?></span>
    <ul><?php foreach ($sib as $p): ?><li><a href="<?= esc_url(get_permalink($p)) ?>"<?= $p->ID === get_the_ID() ? ' aria-current="page"' : '' ?>><span>›</span><?= rm_e(get_the_title($p)) ?></a></li><?php endforeach; ?></ul>
  </aside>
  <?php endif; ?>
  <article class="prose rv"><?php the_content(); ?></article>
</div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
