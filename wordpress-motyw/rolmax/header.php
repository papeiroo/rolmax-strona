<?php defined('ABSPATH') || exit; $rm_d = rm_dept(); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<link rel="icon" href="<?= esc_url(rm_asset('img/logo.png')) ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class($rm_d ? 'dept-' . $rm_d : 'is-intro'); ?>>
<?php wp_body_open(); ?>
<?php rm_part('icons'); ?>
<div class="grain" aria-hidden="true"></div>
<?php if (rm_opt('ribbon_on') === '1') rm_part('ribbon'); ?>
<?php if ($rm_d): rm_part('topbar', ['dept' => $rm_d]); rm_part('nav', ['dept' => $rm_d]); endif; ?>
