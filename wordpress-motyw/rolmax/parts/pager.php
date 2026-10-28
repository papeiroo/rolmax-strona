<?php
/** $args: cur, pages, url (callable int → URL) */
[$cur, $pages, $u] = [$args['cur'], $args['pages'], $args['url']];
if ($pages < 2) return;
?>
<nav class="pager" aria-label="Strony">
  <?php if ($cur > 1): ?><a href="<?= esc_url($u($cur - 1)) ?>" rel="prev">← Nowsze</a><?php endif; ?>
  <?php for ($i = 1; $i <= $pages; $i++): ?>
    <?php if ($i === 1 || $i === $pages || abs($i - $cur) <= 1): ?><a href="<?= esc_url($u($i)) ?>"<?= $i === $cur ? ' aria-current="page"' : '' ?>><?= $i ?></a>
    <?php elseif (abs($i - $cur) === 2): ?><span>…</span><?php endif; ?>
  <?php endfor; ?>
  <?php if ($cur < $pages): ?><a href="<?= esc_url($u($cur + 1)) ?>" rel="next">Starsze →</a><?php endif; ?>
</nav>
