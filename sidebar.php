<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Your_Theme_Name
 * @since Your_Theme_Name 1.0
 */

if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
  <aside id="secondary" class="widget-area">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </aside><!-- #secondary -->
<?php endif; ?>
