<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bohn
 */

?>

<?php
    $args = array(
        'post_type' => 'post'
    );

    $post_query = new WP_Query($args);
if($post_query->have_posts() ) {
  while($post_query->have_posts() ) {
    $post_query->the_post();
    ?>

<p><?php 
        if ( has_post_format( 'image' )) {
        echo 'this is the gallery format';
        }
      
        if ( has_post_format( 'audio' )) {
        echo 'this is the audio format';
        }
      
    ?><p>

    <h2><?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?></h2>
    <div><?php the_post_thumbnail('thumbnail', $default_attr); ?></div>


    <?php
  }
}
?>
