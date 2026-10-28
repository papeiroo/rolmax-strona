<?php
/* Template Name: Rolmax — kontakt (oddziały + formularz) */
defined('ABSPATH') || exit;
get_header();
the_post();
$here = trailingslashit(get_permalink());
$tabs = [['Oddziały i telefony', rm_url('pl/kontakt')], ['Zapytanie o maszynę', rm_url('pl/kontakt/order')], ['Zgłoszenie serwisowe', rm_url('pl/kontakt/support')]];
rm_part('page-hero', ['kicker' => get_post_meta(get_the_ID(), '_rm_kicker', true), 'h1' => esc_html(get_the_title()), 'lead' => get_the_excerpt(), 'scene' => 'dusk', 'crumbs' => [[get_the_title(), null]]]);
?>
<section class="sec"><div class="wrap">
  <div class="cnav rv">
    <?php foreach ($tabs as [$l, $u]): ?><a href="<?= esc_url($u) ?>"<?= trailingslashit($u) === $here ? ' aria-current="page"' : '' ?>><?= rm_e($l) ?></a><?php endforeach; ?>
  </div>
  <div class="cform rv">
    <?php the_content(); ?>
  </div>
</div></section>
<section class="sec navy"><div class="wrap"><?php rm_part('branches'); ?></div></section>
<?php get_footer(); ?>
