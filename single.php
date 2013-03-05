<?php session_start();?>
<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 custom single post (single.php) by Rex Keal for Cloud Collective Co.
 I realize I have a lot to learn, but hey...
 */
?>
<?php
	
	header("Cache-Control: no-cache, must-revalidate");
	global $machine;//make my machine
	global $machineRelatedThumbs;//for later
	global $currentView, $altView1, $altView2, $altView3, $theTitleVar;//get some globals ready	
	
	if (!isset($_SESSION['looper']) or get_the_title() != $_SESSION['looper'][0]){
	
		$currentView = get_field('mask_main_view');//stuff the the main view from an ACF val
		$altView1 = get_field('mask_alt_view_1');//stuff the first alt view from ACF
		$altView2 = get_field('mask_alt_view_2');//stuff the second alt view from ACF
		$altView3 = get_field('mask_alt_view_3');//stuff the third alt view from ACF
		$theTitleVar = get_the_title();//stuff the title from WP
		$machine = array( $theTitleVar, $altView1, $altView2, $altView3, $currentView);//build machine array
		$_SESSION['looper']=$machine;
		
		}else{
			
			$machine=$_SESSION['looper'];
		};
?>
<?php // WP page begins>?>
<?php get_header(); ?>

        <div id="content" class="grid col-620post singlePage">
        
<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>
			
		<?php echo do_shortcode('[magny image="'.$machine[4].'" title="" description="" align="center" click="0" link_url="'.$machine[4].'" scroll_zoom="1" scroll_size="1" small_image="" canvas_mode="1" maxwidth="500px" zoom="1" height="100%" dia="200px" skin="new-im-frame-simple,new-title-off,new-description-off,new-slider-off,new-im-magnifier-simple new-im-magnifier-square" ]'); //shortcode to display the main image;?>
				          
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
<?php			
//Nav for cycling through masks
				echo "<span style='color:#cfc4b5;'>";
						echo "<div class='previous'>";
						//echo previous_post_link('%link', '&#8249;&#8249;', TRUE, '16');
						//the following functions ending in 'plus' make use of the previous/next post plus plugin...do not remove this plugin as it allows for meta values to sort the next/previous links
						previous_post_link_plus(array('order_by' => 'custom', 'meta_key' => 'post_order', 'link'=>'&laquo', 'format'=>'%link') );
						echo "</div>";
						echo "<div class='next'>";
						//echo next_post_link('%link', '&#8250;&#8250;', TRUE, '16');
						next_post_link_plus(array('order_by' => 'custom', 'meta_key' => 'post_order', 'link'=>'&raquo', 'format'=>'%link') );
						echo "</div>";
						echo "</span>";
// End Nav for cycling through masks
?>				
				
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
<?php //start related thumbs loop - REX
	$machineRelatedThumbs = array($machine[1],$machine[2],$machine[3]);
	$i=1;
	?>
	<?php foreach ($machineRelatedThumbs as $related){	?>
		<?php if ($related == false){
		}else{?>
		
			<?php $vtimage= vt_resize('',$related,141,900,false);//using the vt_resize script added at the end of functions.php to dynamically resize image saving bandwidth and page load time?>
			
		<?php echo '<div id="relatedThumbNo-'.$i.'" class="relatedThumbs" ><a href="#"><image src="'.$vtimage['url'].'"></a></div>';//iterate Thumbs?>
		<script type="text/javascript">
	  jQuery(document).ready(function(){
		  jQuery("#relatedThumbNo-<?php echo $i ;?>").click(function(){
			  jQuery.post("/wp-content/themes/responsiveChild/rexCludes/gallery-view-session.foo", { knockOut: "<?php echo $i++;?>" })
				  .done(function(data) {
					  <!--alert("Data Loaded: " + data);-->
					  location.reload();
				});
			});
		}); 
		</script>

		

  <?php };};//end Related Thumbs loop?> 
	  <?php echo "</div></div>";?>

	  
  <div id="quote"><?php the_field('quote'); //eran's quote insert ?></div>
</div>
<?php //end eran's quote?>
<?php //get_sidebar(); ?>
<?php get_footer(gallery); ?>