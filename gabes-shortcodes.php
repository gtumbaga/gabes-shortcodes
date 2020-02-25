<?php
/*
Plugin Name: Gabe's Shortcodes
Description: Custom Shortcodes, for the post categories to work on a page
Version: 1.0
*/

//If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }



function gsc_jobs_shortcode() { 

  // the query
  $wpb_all_query = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'cat' => 4
    )
  );
  $finalHTML = "";

  if ( $wpb_all_query->have_posts() ) {



    while ( $wpb_all_query->have_posts() ) {
      $wpb_all_query->the_post();

      //$theLink = get_the_permalink();
      //$theTitle = get_the_title();
      $theBody = get_the_content();
      $theTags = get_the_tags(get_the_ID());

      $finalHTML .= "
        <div class='data'>
          {$theBody}
      ";

      $finalHTML .= "<div class='clearfix'>";
      $finalHTML .= "<ul class='skills'>";
      foreach($theTags as $tagKey => $tagObj) {
        $finalHTML .= "<li>{$tagObj->name}</li>";
      }
      $finalHTML .= "</ul>";
      $finalHTML .= "</div>";

      $finalHTML .= "</div>";
      $finalHTML .= "<hr />";
    }


    wp_reset_postdata();
  }
  else {
    $finalHTML .= "<p>" . _e( 'Sorry, no posts matched your criteria.' ) . "</p>";
  }



  //$message = 'This is the jobs listing.'; 
  return $finalHTML;
} 

function gsc_blog_shortcode() { 

  // the query
  $wpb_all_query = new WP_Query(
    array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'cat' => 3
    )
  );
  $finalHTML = "";

  if ( $wpb_all_query->have_posts() ) {



    while ( $wpb_all_query->have_posts() ) {
      $wpb_all_query->the_post();

      $theLink = get_the_permalink();
      $theTitle = get_the_title();
      $theBody = get_the_content();
      //$theTags = get_the_tags(get_the_ID());

      $finalHTML .= "
        <div class='data'>
          <a href='{$theLink}'>{$theTitle}</a>
      ";
      $finalHTML .= "</div>";
    }


    wp_reset_postdata();
  }
  else {
    $finalHTML .= "<p>" . _e( 'Sorry, no posts matched your criteria.' ) . "</p>";
  }



  //$message = 'This is the jobs listing.'; 
  return $finalHTML;
} 

// register shortcode
add_shortcode('jobs_listing', 'gsc_jobs_shortcode'); 
add_shortcode('blog_listing', 'gsc_blog_shortcode'); 
