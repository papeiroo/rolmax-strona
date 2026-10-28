<?php
defined('ABSPATH') || exit;
get_header();
the_post();
rm_part('page-hero', ['kicker' => 'Galeria', 'h1' => esc_html(get_the_title()), 'lead' => 'Zdjęcia z wydarzeń Rolmax.', 'scene' => 'field', 'photo' => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'rm-hero') : '', 'crumbs' => [['Galeria', get_post_type_archive_link('galeria')], [get_the_title(), null]]]);
?>
<section class="sec light"><div class="wrap"><article class="prose wide rv"><?php the_content(); ?></article>
  <p style="margin-top:2rem"><a class="btn dark" href="<?= esc_url(get_post_type_archive_link('galeria')) ?>">Wszystkie galerie <span class="ar"></span></a></p>
</div></section>
<?php get_footer(); ?>
