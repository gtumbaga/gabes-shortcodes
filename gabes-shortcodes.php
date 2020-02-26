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
          <svg aria-hidden='true' focusable='false' data-prefix='fas' data-icon='arrow-circle-right' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' class='svg-inline--fa fa-arrow-circle-right fa-w-16 fa-3x'><path fill='currentColor' d='M256 8c137 0 248 111 248 248S393 504 256 504 8 393 8 256 119 8 256 8zm-28.9 143.6l75.5 72.4H120c-13.3 0-24 10.7-24 24v16c0 13.3 10.7 24 24 24h182.6l-75.5 72.4c-9.7 9.3-9.9 24.8-.4 34.3l11 10.9c9.4 9.4 24.6 9.4 33.9 0L404.3 273c9.4-9.4 9.4-24.6 0-33.9L271.6 106.3c-9.4-9.4-24.6-9.4-33.9 0l-11 10.9c-9.5 9.6-9.3 25.1.4 34.4z' class=''></path></svg>
          &nbsp;&nbsp;&nbsp;<a href='{$theLink}'>{$theTitle}</a>
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
