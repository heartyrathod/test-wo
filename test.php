<?php
/*
Plugin Name: Vietnam Hotels
Plugin URI: https://example.com/vietnam-hotels
Description: A plugin to display a list of hotels in Vietnam.
Version: 1.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Register Custom Post Type
function vhp_register_hotel_post_type() {
    $labels = array(
        'name'               => _x('Hotels', 'post type general name', 'vietnam-hotels'),
        'singular_name'      => _x('Hotel', 'post type singular name', 'vietnam-hotels'),
        'menu_name'          => _x('Hotels', 'admin menu', 'vietnam-hotels'),
        'name_admin_bar'     => _x('Hotel', 'add new on admin bar', 'vietnam-hotels'),
        'add_new'            => _x('Add New', 'hotel', 'vietnam-hotels'),
        'add_new_item'       => __('Add New Hotel', 'vietnam-hotels'),
        'new_item'           => __('New Hotel', 'vietnam-hotels'),
        'edit_item'          => __('Edit Hotel', 'vietnam-hotels'),
        'view_item'          => __('View Hotel', 'vietnam-hotels'),
        'all_items'          => __('All Hotels', 'vietnam-hotels'),
        'search_items'       => __('Search Hotels', 'vietnam-hotels'),
        'parent_item_colon'  => __('Parent Hotels:', 'vietnam-hotels'),
        'not_found'          => __('No hotels found.', 'vietnam-hotels'),
        'not_found_in_trash' => __('No hotels found in Trash.', 'vietnam-hotels')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'hotel'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail')
    );

    register_post_type('hotel', $args);
}
add_action('init', 'vhp_register_hotel_post_type');

// Add Meta Boxes
function vhp_add_custom_meta_boxes() {
    add_meta_box('hotel_details', __('Hotel Details', 'vietnam-hotels'), 'vhp_hotel_details_callback', 'hotel', 'normal', 'high');
}
add_action('add_meta_boxes', 'vhp_add_custom_meta_boxes');

function vhp_hotel_details_callback($post) {
    wp_nonce_field(basename(__FILE__), 'vhp_nonce');

    $hotel_price = get_post_meta($post->ID, '_hotel_price', true);
    $hotel_location = get_post_meta($post->ID, '_hotel_location', true);
    $hotel_rating = get_post_meta($post->ID, '_hotel_rating', true);

    echo '<p><label for="hotel_price">' . __('Price:', 'vietnam-hotels') . '</label>';
    echo '<input type="text" id="hotel_price" name="hotel_price" value="' . esc_attr($hotel_price) . '" /></p>';

    echo '<p><label for="hotel_location">' . __('Location:', 'vietnam-hotels') . '</label>';
    echo '<input type="text" id="hotel_location" name="hotel_location" value="' . esc_attr($hotel_location) . '" /></p>';

    echo '<p><label for="hotel_rating">' . __('Rating:', 'vietnam-hotels') . '</label>';
    echo '<input type="text" id="hotel_rating" name="hotel_rating" value="' . esc_attr($hotel_rating) . '" /></p>';
}

// Save Meta Box Data
function vhp_save_hotel_meta($post_id) {
    if (!isset($_POST['vhp_nonce']) || !wp_verify_nonce($_POST['vhp_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    $new_price = (isset($_POST['hotel_price']) ? sanitize_text_field($_POST['hotel_price']) : '');
    $new_location = (isset($_POST['hotel_location']) ? sanitize_text_field($_POST['hotel_location']) : '');
    $new_rating = (isset($_POST['hotel_rating']) ? sanitize_text_field($_POST['hotel_rating']) : '');

    update_post_meta($post_id, '_hotel_price', $new_price);
    update_post_meta($post_id, '_hotel_location', $new_location);
    update_post_meta($post_id, '_hotel_rating', $new_rating);
}
add_action('save_post', 'vhp_save_hotel_meta');

// Shortcode to display hotels
function vhp_display_hotels() {
    $args = array(
        'post_type' => 'hotel',
        'posts_per_page' => -1
    );
    $hotels = new WP_Query($args);

    if ($hotels->have_posts()) {
        $output = '<div class="vhp-hotels">';
        $output .= '<h2>' . __('Vietnam Hotels', 'vietnam-hotels') . '</h2>';
        $output .= '<ul>';
        while ($hotels->have_posts()) {
            $hotels->the_post();
            $price = get_post_meta(get_the_ID(), '_hotel_price', true);
            $location = get_post_meta(get_the_ID(), '_hotel_location', true);
            $rating = get_post_meta(get_the_ID(), '_hotel_rating', true);
            $output .= '<li>';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<p>' . __('Price:', 'vietnam-hotels') . ' ' . esc_html($price) . '</p>';
            $output .= '<p>' . __('Location:', 'vietnam-hotels') . ' ' . esc_html($location) . '</p>';
            $output .= '<p>' . __('Rating:', 'vietnam-hotels') . ' ' . esc_html($rating) . '</p>';
            $output .= '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';
        wp_reset_postdata();
    } else {
        $output = '<p>' . __('No hotels found.', 'vietnam-hotels') . '</p>';
    }

    return $output;
}
add_shortcode('vietnam_hotels', 'vhp_display_hotels');

// Enqueue styles
function vhp_enqueue_styles() {
    wp_enqueue_style('vhp-styles', plugin_dir_url(__FILE__) . 'css/styles.css');
}
add_action('wp_enqueue_scripts', 'vhp_enqueue_styles');
