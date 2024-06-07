<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Floret Lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#tabber-BX">
<?php esc_html_e('Skip to content', 'floret-lite' ); ?>
</a>
<?php
$floret_lite_show_hdrinfooptions 	   			= esc_attr( get_theme_mod('floret_lite_show_hdrinfooptions', false) );  
$floret_lite_show_frontslide_settings 	  		= esc_attr( get_theme_mod('floret_lite_show_frontslide_settings', false) );
$floret_lite_show_three_column_settings      	= esc_attr( get_theme_mod('floret_lite_show_three_column_settings', false) );
$floret_lite_show_welcome_settings      		= esc_attr( get_theme_mod('floret_lite_show_welcome_settings', false) );
?>
<div id="SiteWrapper" <?php if( get_theme_mod( 'floret_lite_layoutoption' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($floret_lite_show_frontslide_settings)) {
	 	$innerpage_cls = '';
	}
	else {
		$innerpage_cls = 'innerpage_header';
	}
}
else {
$innerpage_cls = 'innerpage_header';
}
?>

<div id="masthead" class="site-header <?php echo esc_attr($innerpage_cls); ?> "> 
       <div class="container"> 
        <div class="HeadFix">
             
        <?php if( $floret_lite_show_hdrinfooptions != ''){ ?> 
        <div class="hdr-topstrip"> 
					<?php $floret_lite_officehours = get_theme_mod('floret_lite_officehours');
						if( !empty($floret_lite_officehours) ){ ?>              
						<div class="hdrtop-Info">
							<?php echo esc_html($floret_lite_officehours); ?>
						</div>       
                    <?php } ?>
                    
					<?php $email = get_theme_mod('floret_lite_emailid');
                        if( !empty($email) ){ ?>                
                        <div class="hdrtop-Info">
                            <i class="far fa-envelope"></i>
                            <a href="<?php echo esc_url('mailto:'.sanitize_email($email)); ?>"><?php echo sanitize_email($email); ?></a>
                        </div>            
                    <?php } ?>
                    
                    <?php $floret_lite_phoneno = get_theme_mod('floret_lite_phoneno');
						if( !empty($floret_lite_phoneno) ){ ?>              
						<div class="hdrtop-Info">
							<i class="fas fa-phone fa-rotate-90"></i>
							<?php echo esc_html($floret_lite_phoneno); ?>
						</div>       
                   <?php } ?>
                    
                  <div class="hdrtop-Info last">
                    <div class="hdrsocial">                                                
					   <?php $floret_lite_facebooklink = get_theme_mod('floret_lite_facebooklink');
                        if( !empty($floret_lite_facebooklink) ){ ?>
                        <a class="fab fa-facebook-f" target="_blank" href="<?php echo esc_url($floret_lite_facebooklink); ?>"></a>
                       <?php } ?>
                    
                       <?php $floret_lite_twitterlink = get_theme_mod('floret_lite_twitterlink');
                        if( !empty($floret_lite_twitterlink) ){ ?>
                        <a class="fab fa-twitter" target="_blank" href="<?php echo esc_url($floret_lite_twitterlink); ?>"></a>
                       <?php } ?>
                
                      <?php $floret_lite_linkedinlink = get_theme_mod('floret_lite_linkedinlink');
                        if( !empty($floret_lite_linkedinlink) ){ ?>
                        <a class="fab fa-linkedin" target="_blank" href="<?php echo esc_url($floret_lite_linkedinlink); ?>"></a>
                      <?php } ?> 
                      
                      <?php $floret_lite_instagramlink = get_theme_mod('floret_lite_instagramlink');
                        if( !empty($floret_lite_instagramlink) ){ ?>
                        <a class="fab fa-instagram" target="_blank" href="<?php echo esc_url($floret_lite_instagramlink); ?>"></a>
                      <?php } ?> 
                  </div><!--end .hdrsocial-->
               </div><!--end .hdrtop-Info-->  
            <div class="clear"></div>              
        </div><!-- .hdr-topstrip --> 
      <?php } ?>
        
        <div class="logo">
           <?php floret_lite_the_custom_logo(); ?>
            <div class="site_branding">
                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) : ?>
                    <p><?php echo esc_html($description); ?></p>
                <?php endif; ?>
            </div>
         </div><!-- logo --> 
         
          <div class="RightNavMenu"> 
             <div id="navigationpanel"> 
                 <nav id="main-navigation" class="site-navigation <?php if( esc_attr( get_theme_mod( 'floret_lite_show_hdrinfooptions' )) ) { ?>Nopad<?php } ?>" role="navigation" aria-label="Primary Menu">
                    <button type="button" class="menu-toggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                    	wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                    ) );
                    ?>
                </nav><!-- #main-navigation -->  
            </div><!-- #navigationpanel -->   
          </div><!-- .RightNavMenu --> 
         <div class="clear"></div>
         </div><!--End HeadFix-->   
      </div><!-- .container -->           
 <div class="clear"></div> 
</div><!--.site-header --> 
 
<?php 
if ( is_front_page() && !is_home() ) {
if($floret_lite_show_frontslide_settings != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('floret_lite_frontsldr'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('floret_lite_frontsldr'.$i,true));
	  }
	}
?> 
<div class="HomepageSlider">              
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">         
     <h2><?php the_title(); ?></h2>
     <p><?php $excerpt = get_the_excerpt(); echo esc_html( floret_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('floret_lite_excerpt_length_frontsldr','0')))); ?></p>
		<?php
        $floret_lite_frontsldr_btntext = get_theme_mod('floret_lite_frontsldr_btntext');
        if( !empty($floret_lite_frontsldr_btntext) ){ ?>
            <a class="slidermorebtn" href="<?php the_permalink(); ?>"><?php echo esc_html($floret_lite_frontsldr_btntext); ?></a>
        <?php } ?>                  
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>   
<?php } ?>
</div><!-- .HomepageSlider -->    
<?php } } ?> 

<?php if ( is_front_page() && ! is_home() ) { ?> 
     
 <?php if( $floret_lite_show_three_column_settings != ''){ ?> 
   <section id="ThreeColumn-Section-1">
     <div class="container"> 
          <?php 
                for($n=1; $n<=3; $n++) {    
                if( get_theme_mod('floret_lite_3pgcol'.$n,false)) {      
                    $queryvar = new WP_Query('page_id='.absint(get_theme_mod('floret_lite_3pgcol'.$n,true)) );		
                    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>     
                     <div class="Flbx-33 <?php if($n % 3 == 0) { echo "last_column"; } ?>">   
                         <div class="fldecobx">
							  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4> 
							  <?php if(has_post_thumbnail() ) { ?>
                                <div class="Flbx-thumb">
                                  <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>                                
                                </div>        
                               <?php } ?>
                               
                               <p><?php $excerpt = get_the_excerpt(); echo esc_html( floret_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('floret_lite_excerpt_length_3pgcol','10')))); ?></p> 
                                <a class="Flbx-morebtn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'floret-lite'); ?></a>
                        </div>
                     </div>
                    <?php endwhile;
                    wp_reset_postdata();                                  
                } } ?>                                 
               <div class="clear"></div>  
      </div><!-- .container -->
    </section><!-- #ThreeColumn-Section-1 -->
  <?php } ?> 
  
  
    <?php if( $floret_lite_show_welcome_settings != ''){ ?>  
    <section id="WelcomeSection-2">
    <div class="container">                               
		<?php 
        if( get_theme_mod('floret_lite_welcomepage',false)) {     
        $queryvar = new WP_Query('page_id='.absint(get_theme_mod('floret_lite_welcomepage',true)) );			
            while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>            
              <div class="welcome-leftBX">
                <?php the_post_thumbnail();?>   
              </div>              
              <div class="welcome-rightBX">
			    <h3><?php the_title(); ?></h3>
                <?php
					$floret_lite_secondtitle = get_theme_mod('floret_lite_secondtitle');
					if( !empty($floret_lite_secondtitle) ){ ?>
					<h2 class="sub_title"><?php echo esc_html($floret_lite_secondtitle); ?></h2>
                <?php } ?>
              <p><?php $excerpt = get_the_excerpt(); echo esc_html( floret_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('floret_lite_welcomepage_excerpt_length','40')))); ?></p>    			<a class="ReadMoreBtn" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'floret-lite'); ?></a>
            </div>                                          
            <?php endwhile;
             wp_reset_postdata(); ?>                                    
            <?php } ?>                                 
      <div class="clear"></div>                       
     </div><!-- .container -->
    </section><!-- #welcome_section-->
 <?php } ?>    

<?php } ?>