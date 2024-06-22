<?php

/**
 * .
 * @link https://Career Craaft/
 * @package WordPress
 * @subpackage Career Craaft
 * @since Career Craaft 1.0.0
 */

get_header();

?>

<main>
  <header class="entry-header pt-xxl-20 pt-xl-20 pt-lg-18 pt-15 pb-xxl-5 pb-xl-5 pb-lg-5 pb-md-4 pb-3 bg-primary-100 position-relative overflow-hidden">
    <div class="cc-page-title-img position-absolute start-0 top-0 z-0 w-100 h-100">
      <div class="cc-page-title-overly w-100 h-100 position-absolute start-0 top-0 z-1"></div>
      <?php
      $image = get_field('countries_bg_image');
      if (!empty($image)) :
      ?>
        <img src="<?php echo esc_url($image['url']); ?>" width="1920" height="400" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid  w-100 h-100 object-fit-cover">
      <?php endif ?>
    </div>
    <div class="container position-relative z-1 d-flex flex-column align-items-start gap-2">
      <h1 class="text-white fw-bold display-5"><?php echo $post->post_title; ?></h1>
      <?php echo do_shortcode('[rank_math_breadcrumb]') ?>
    </div>
  </header>
  <?php  
      $args = array( 
          'post_type' => 'product',
          'posts_per_page' => 2, 
        );

        $loop = new WP_Query( $args );
                
      ?>
    <div class="entry-content my-xxl-5 my-xl-5 my-lg-5 my-md-5 my-sm-4 my-4">
      <div class="container">
     
        <div class="d-flex flex-column align-items-start gap-xxl-5 gap-xl-5 gap-lg-5 gap-sm-4 gap-4">          
          <div class="row col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">  
          <?php
          while ( $loop->have_posts() ) : $loop->the_post(); 
          global $product;
          $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0];
       ?>         
              <div class="col" data-aos="zoom-in" data-aos-delay="<?php echo $country_delay; ?>" data-aos-duration="400">
                <div class="cc-countries-item d-flex flex-column align-items-start gap-3">
                  <a href="<?php the_permalink(); ?>" class="cc-countries-img position-relative  overflow-hidden rounded-3 w-100">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" width="324" height="220" class="img-fluid position-relative z-0 w-100">
                    <div class="cc-flag position-absolute end-0 bottom-0 z-1 bg-white p-3 rounded-top-5 rounded-end-0">                      
                      <a href="<?php the_permalink(); ?>" class="text-body"><?php echo esc_attr($product->get_name()); ?></a>
                    </div>
                  </a>
                  <h2 class="h5 fw-semibold px-3">
                    <a href="<?php the_permalink(); ?>" class="text-body"><?php echo get_the_title(); ?></a>
                  </h2>
                  
                  <p><?php 
                          $product = wc_get_product($product_id);
                          $variations = $product->get_available_variations();
                          $variations_id = wp_list_pluck( $variations, 'variation_id' );
                      ?></p>
                  
                </div>
              </div>  
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>         
          </div>
          
        </div>
        <div id="related-products"></div>

       <?php
            global $post;
            $product_id = $post->ID;
            
            if ( class_exists( 'WooCommerce' ) && is_product() ) {
                $related_products = bbloomer_related_products_by_same_title( array(), $product_id, array() );
            
                if ( ! empty( $related_products ) ) {
                    echo '<h2>Related Products</h2>';
                    echo '<ul class="related-products">';
                    foreach ( $related_products as $related_product_id ) {
                        $product = wc_get_product( $related_product_id );
                        echo '<li>';
                        echo '<a href="' . get_permalink( $related_product_id ) . '">' . $product->get_name() . '</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No related products found.</p>';
                }
            } else {
                echo '<p>This is not a product page.</p>';
            }
       ?>
      </div>
    </div>
    
</main>

<?php
get_footer();
?>
