<?php
defined('ABSPATH') || exit;
get_header();
the_post();
rm_part('page-hero', ['kicker' => 'Kariera' . (has_excerpt() ? ' · ' . get_the_excerpt() : ''), 'h1' => esc_html(get_the_title()), 'lead' => 'Dołącz do zespołu Rolmax.', 'scene' => 'workshop', 'crumbs' => [['Praca', get_post_type_archive_link('praca')], [get_the_title(), null]]]);
?>
<section class="sec light"><div class="wrap"><article class="prose rv">
  <?php the_content(); ?>
  <p><a class="btn dark" href="<?= esc_url(rm_url('pl/kontakt')) ?>">Aplikuj <span class="ar"></span></a></p>
</article></div></section>
<?php get_footer(); ?>
