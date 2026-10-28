<?php
defined('ABSPATH') || exit;
get_header();
rm_part('page-hero', ['kicker' => 'Praca w Rolmax', 'h1' => 'Kariera', 'lead' => 'Dołącz do zespołu, który od 30 lat pracuje dla rolników.', 'scene' => 'workshop', 'crumbs' => [['Praca', null]]]);
?>
<section class="sec light"><div class="wrap"><div class="jobs rv">
  <?php $i = 0; while (have_posts()): the_post(); $i++; ?>
  <a class="job" href="<?php the_permalink(); ?>"><span class="n"><?= sprintf('%02d', $i) ?></span><h3><?php the_title(); ?><?php if (has_excerpt()): ?> <em class="s">— <?= esc_html(get_the_excerpt()) ?></em><?php endif; ?></h3><span class="go"><svg><use href="#i-ar"/></svg></span></a>
  <?php endwhile; if (!$i): ?><p>Obecnie nie prowadzimy rekrutacji. Zapraszamy do kontaktu.</p><?php endif; ?>
</div></div></section>
<?php rm_part('cta-strip'); get_footer(); ?>
