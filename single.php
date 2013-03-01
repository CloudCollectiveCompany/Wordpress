<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 custom single post (single.php) by Rex Keal for Cloud Collective Co.
 I realize I have a lot to learn, but hey...
 */
?>

<?php
//unset($_SESSION['stack']);
$theTitleVar = get_the_title();//stuff the title into var
echo $_SESSION['stack'][0][4].'-------------<br>';//delete
if (!isset($_SESSION['stack']) or $theTitleVar != $_SESSION['stack'][0][4]){//check if there is a session or the title has changed
	unset($_SESSION['stack']);//kill the stack var if the title has changed
	global $machine;//make my machine
	global $currentView, $altView1, $altView2, $altView3, $theTitleVar;//get some globals ready
	$currentView = get_field('mask_main_view');//stuff the the main view from an ACF val
	$altView1 = get_field('mask_alt_view_1');//stuff the first alt view from ACF
	$altView2 = get_field('mask_alt_view_2');//stuff the second alt view from ACF
	$altView3 = get_field('mask_alt_view_3');//stuff the third alt view from ACF
	$theTitleVar = get_the_title();//stuff the title from WP
	$machine = array($currentView, $altView1, $altView2, $altView3, $theTitleVar);//build machine array
	//session_start;
	$_SESSION['stack'][]=$machine;
	echo $theTitleVar;//delete
	}else{
	echo "golden";//delete
	};
	var_dump($_SESSION['stack']);//delete
?>
<?php // WP page begins>?>
<?php get_header(); ?>

        <div id="content" class="grid col-620post singlePage">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			
		<?php echo do_shortcode('[magny image="'.$_SESSION['stack'][0][0].'" title="" description="" align="center" click="0" link_url="'.$_SESSION['stack'][0][0].'" scroll_zoom="1" scroll_size="1" small_image="" canvas_mode="1" maxwidth="500px" zoom="1" height="100%" dia="200px" skin="new-im-frame-simple,new-title-off,new-description-off,new-slider-off,new-im-magnifier-simple new-im-magnifier-square" ]'); //shortcode to display the main image ?>
				          
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                              
                <div class="post-entry">
                    <?php the_content(__('Read more &#8250;', 'responsive')); ?>
                    
                    <?php if ( get_the_author_meta('description') != '' ) : ?>
                    
                    <div id="author-meta">
                    <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '80' ); }?>
                        <div class="about-author"><?php _e('About','responsive'); ?> <?php the_author_posts_link(); ?></div>
                        <p><?php the_author_meta('description') ?></p>
                    </div><!-- end of #author-meta -->
                    
                    <?php endif; // no description, no author's meta ?>
                    
                    <?php wp_link_pages(array('before' => '<div class="pagination">' . __('Pages:', 'responsive'), 'after' => '</div>')); ?>
                </div><!-- end of .post-entry -->
                
                <div class="navigation">
		        </div><!-- end of .navigation -->
               

            <!--<div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div>   -->          
            </div><!-- end of #post-<?php the_ID(); ?> -->
            
		
            
        <?php endwhile; //end post while (The Loop)?> 

        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <div class="navigation">
		<?php echo "<h1 style='color:red;'>Here</h1>"; ?>
			<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ) ); ?></div>
            <div class="next"><?php //previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ) ); ?><?php previous_posts_link(); ?></div>
		</div><!-- end of .navigation -->
        <?php endif; ?>

	    <?php else : ?>

        <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
                    
        <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
                    
        <h6><?php printf( __('You can return %s or search for the page you were looking for.', 'responsive'),
	            sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
		            esc_url( get_home_url() ),
		            esc_attr__('Home', 'responsive'),
		            esc_attr__('&larr; Home', 'responsive')
	                )); 
			 ?></h6>
                    
        <?php get_search_form(); ?>

		<?php endif; ?>  
 
        </div><!-- end of #content -->
		
	<div id="rightContent">	
	
	<h1 class="post-title" style="display:block; text-align:center;"><?php echo $theTitleVar;?></h1>

		<div id="subtitle-ACF" style="display:block; text-align:center;"><?php the_field('subtitleACF'); ?></div>		
		
		<div id="maskDescription" style="display:block;"><p><?php the_field('maskDescription'); ?></p></div>	
	
	<?php  echo "<div id='thumbCont'><div id='thumbContWrapper'>";  ?>
		<?php
		$machineMinusMain = array($_SESSION['stack'][0][1], $_SESSION['stack'][0][2], $_SESSION['stack'][0][3]) ;//using session data, stuff the thumbs into an array (starting at index 1 to disclude main image)
		$iterCount= 1; //set up the counter
		foreach ($machineMinusMain as $iteration){//start foreach to iterate
			echo "<div id='relatedThumbNo-".$iterCount."' class='relatedThumbs' ><img src='".$iteration."'></div>";//make a numbered div id for styling
			echo '<script type="text/javascript">'; //start Jquery
			echo 'jQuery(document).ready(function(){';// check document ready
			echo 'jQuery("#relatedThumbNo-'.$iterCount.'").click(function(){';//on specific image click
			echo 'jQuery.post("http://maskspeak.com/wp-content/themes/responsiveChild/rexCludes/gallery-view-session.foo", { knockOut: "'.$iterCount++.'" })';//post to php the clicked image position
			echo '.done(function(data) {';//return to do...
			echo 'alert("Data Loaded: " + data);';//just a data checker
			echo 'location.reload("true");';//refresh the page
			echo '});';//close the script
			echo '});';//close the script
			echo '});';//close the script
			echo '</script>';//close the script
			
			
			};//the above code drops thumbs into the related thumbs 
			echo "</div><br>";
			echo '</div>';

		?>
  <?php $testVar=$_SESSION['stack'];
		//var_dump($testVar);
  ?>
  <div id="quote"><?php the_field('quote'); ?></div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(gallery); ?>