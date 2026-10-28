<div class="fleet">
  <?php $n = count($args['terms']); foreach ($args['terms'] as $i => $t): ?>
  <a class="unit" href="<?= esc_url(get_term_link($t)) ?>"><span class="idx"><?= sprintf('%02d / %02d', $i + 1, $n) ?></span><span class="code"><?= rm_e(rm_term_meta($t, 'code')) ?></span><h3><?= rm_e($t->name) ?></h3><p><?= rm_e(wp_strip_all_tags($t->description)) ?></p><span class="go"><svg><use href="#i-ar"/></svg></span></a>
  <?php endforeach; ?>
</div>
