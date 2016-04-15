<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bohn
 */

get_header(); ?>


    <?php  

    if ( in_category('privado') ) {

    echo 'Hello '.($_COOKIE['__cfcage']!='' ? $_COOKIE['__cfcage'] : 'Guest');
        
    $val = $_COOKIE['__cfcage'];  
        
    echo var_dump($val);    
        
        if ($val!=='1')   

        {    

        include 'template-parts/single-age.php';    

        exit;   

        }    
        
    }

    ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
