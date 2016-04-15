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

$int = 36000;

//setcookie("__cfcage","0", time()+$int, "/", "beethoven.ml", true, true);
//setcookie(    $name, $value, $expire, $path, $domain, $secure, $httponly )
//bool setcookie ( string $name [, string $value [, int $expire = 0 [, string $path [, string $domain [, bool $secure = false [, bool $httponly = false ]]]]]] )

?>




<div id="demo"></div>

<div id="confirm_age" class="center" style="<?php 
echo $_COOKIE["__cfcage"];
?>"><h1 class="entry_confirm">Please confirm you are 18 or older</h1> 
    <div class="piratAgeGraphicBox"> 
        <div class="piratBoy"> 
            <button type="submit" id="hide" class="siteButton bigButton"><span>NOT</span></button> 
        </div> 
        <div class="piratMan"> 
            <button type="submit" id="show" class="siteButton bigButton"><span>YES</span></button> 
        </div> 
    </div> 
</div>



<script>
    
    
function set_cookie ( name, value, days, path, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );
    
    
   

    
if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                cookie_string +=  "; expires=" + date.toGMTString();
            }    

  if ( path )
        cookie_string += "; path=" + escape ( path );

  if ( domain )
        cookie_string += "; domain=" + escape ( domain );
  
  if ( secure )
        cookie_string += "; secure";
    
    
alert (document + cookie_string);    
  
  document.cookie = cookie_string;
}    
    
    
$(document).ready(function() {

    //alert ("piratAgeGraphicBox");
});   
    
$("#hide").click(function(){
    
    //alert ("hide piratAgeGraphicBox");    
    
    //$("#demo").hide();
    //$("#confirm_age").hide();
    //$("#s01").show();
    
    window.location.href = "https://beethoven.ml";
    
});    

    
    
$("#show").click(function(){
    
    //alert ("hide piratAgeGraphicBox"); 
    
    set_cookie ( "__cfcage", "1", 3, "/", "beethoven.ml", "secure" );
        
    
    $("#demo").hide();
    $("#confirm_age").hide();
    $("#s01").show();
    
});     
    
    
document.getElementById("demo").innerHTML = "Hello JavaScript!";
    
    
    
</script>



<div id ="s01" class="entry_hide">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->




</div>
    


<?php
get_footer();
