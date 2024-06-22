<!DOCTYPE html>
<html lang="en">
<head>
<title><?php wp_title(''); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
<meta name="application-name" content="<?php wp_title(''); ?>">
<?php get_template_part( 'template-parts/content', 'favicons' );  ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header-location"><?php echo write_location_banner(); ?></div>
<div class="wrapper">
    <?php get_template_part( 'template-parts/content', 'header' );  ?>