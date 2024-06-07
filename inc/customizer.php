<?php    
/**
 *floret-lite Theme Customizer
 *
 * @package Floret Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function floret_lite_customize_register( $wp_customize ) {	
	
	function floret_lite_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function floret_lite_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	} 
	
	function floret_lite_sanitize_phone_number( $phone ) {
		// sanitize phone
		return preg_replace( '/[^\d+]/', '', $phone );
	} 
	
	
	function floret_lite_sanitize_excerptrange( $number, $setting ) {	
		// Ensure input is an absolute integer.
		$number = absint( $number );	
		// Get the input attributes associated with the setting.
		$atts = $setting->manager->get_control( $setting->id )->input_attrs;	
		// Get minimum number in the range.
		$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );	
		// Get maximum number in the range.
		$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );	
		// Get step.
		$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );	
		// If the number is within the valid range, return it; otherwise, return the default
		return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
	}

	function floret_lite_sanitize_number_absint( $number, $setting ) {
		// Ensure $number is an absolute integer (whole number, zero or greater).
		$number = absint( $number );		
		// If the input is an absolute integer, return it; otherwise, return the default
		return ( $number ? $number : $setting->default );
	}
	
	// Ensure is an absolute integer
	function floret_lite_sanitize_choices( $input, $setting ) {
		global $wp_customize; 
		$control = $wp_customize->get_control( $setting->id ); 
		if ( array_key_exists( $input, $control->choices ) ) {
			return $input;
		} else {
			return $setting->default;
		}
	}
	
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo h1 a',
		'render_callback' => 'floret_lite_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.logo p',
		'render_callback' => 'floret_lite_customize_partial_blogdescription',
	) );
		
	 	
	//Panel for section & control
	$wp_customize->add_panel( 'floret_lite_theme_optionspanel', array(
		'priority' => 4,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Floret Lite Theme Settings', 'floret-lite' ),		
	) );

	$wp_customize->add_section('floret_lite_sitelayout',array(
		'title' => __('Layout Style','floret-lite'),			
		'priority' => 1,
		'panel' => 	'floret_lite_theme_optionspanel',          
	));		
	
	$wp_customize->add_setting('floret_lite_layoutoption',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_layoutoption', array(
    	'section'   => 'floret_lite_sitelayout',    	 
		'label' => __('Check to Show Box Layout','floret-lite'),
		'description' => __('check for box layout','floret-lite'),
    	'type'      => 'checkbox'
     )); //Box Layout Options 
	
	$wp_customize->add_setting('floret_lite_colorscheme',array(
		'default' => '#ef7a86',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'floret_lite_colorscheme',array(
			'label' => __('Color Scheme','floret-lite'),			
			'section' => 'colors',
			'settings' => 'floret_lite_colorscheme'
		))
	);
	
	$wp_customize->add_setting('floret_lite_menufontcolor',array(
		'default' => '#333333',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'floret_lite_menufontcolor',array(
			'label' => __('Navigation font Color','floret-lite'),			
			'section' => 'colors',
			'settings' => 'floret_lite_menufontcolor'
		))
	);
	
	
	$wp_customize->add_setting('floret_lite_menufontactivecolor',array(
		'default' => '#ef7a86',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'floret_lite_menufontactivecolor',array(
			'label' => __('Navigation Hover/Active Color','floret-lite'),			
			'section' => 'colors',
			'settings' => 'floret_lite_menufontactivecolor'
		))
	);
	
	 //Header Contact details
	$wp_customize->add_section('floret_lite_hdrinfooptions',array(
		'title' => __('Header Contact Info','floret-lite'),				
		'priority' => null,
		'panel' => 	'floret_lite_theme_optionspanel',
	));	
	
	$wp_customize->add_setting('floret_lite_officehours',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('floret_lite_officehours',array(	
		'type' => 'text',
		'label' => __('enter office hours','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_officehours'
	)); //Office hours
	
	
	$wp_customize->add_setting('floret_lite_emailid',array(
		'sanitize_callback' => 'sanitize_email'
	));
	
	$wp_customize->add_control('floret_lite_emailid',array(
		'type' => 'email',
		'label' => __('enter email id here.','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions'
	));	
	
	$wp_customize->add_setting('floret_lite_phoneno',array(
		'default' => null,
		'sanitize_callback' => 'floret_lite_sanitize_phone_number'	
	));
	
	$wp_customize->add_control('floret_lite_phoneno',array(	
		'type' => 'text',
		'label' => __('Enter phone number here','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_phoneno'
	));		
	
			
	$wp_customize->add_setting('floret_lite_facebooklink',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'	
	));
	
	$wp_customize->add_control('floret_lite_facebooklink',array(
		'label' => __('Add facebook link here','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_facebooklink'
	));	
	
	$wp_customize->add_setting('floret_lite_twitterlink',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('floret_lite_twitterlink',array(
		'label' => __('Add twitter link here','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_twitterlink'
	));

	
	$wp_customize->add_setting('floret_lite_linkedinlink',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('floret_lite_linkedinlink',array(
		'label' => __('Add linkedin link here','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_linkedinlink'
	));
	
	$wp_customize->add_setting('floret_lite_instagramlink',array(
		'default' => null,
		'sanitize_callback' => 'esc_url_raw'
	));
	
	$wp_customize->add_control('floret_lite_instagramlink',array(
		'label' => __('Add instagram link here','floret-lite'),
		'section' => 'floret_lite_hdrinfooptions',
		'setting' => 'floret_lite_instagramlink'
	));
	
	
	$wp_customize->add_setting('floret_lite_show_hdrinfooptions',array(
		'default' => false,
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'floret_lite_show_hdrinfooptions', array(
	   'settings' => 'floret_lite_show_hdrinfooptions',
	   'section'   => 'floret_lite_hdrinfooptions',
	   'label'     => __('Check To show Header contact Section','floret-lite'),
	   'type'      => 'checkbox'
	 ));//Show Header info Sections
	 
	
	 	
	//Frontpage Slide Section		
	$wp_customize->add_section( 'floret_lite_frontslide_settings', array(
		'title' => __('Frontpage Slider Sections', 'floret-lite'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 894 pixel.','floret-lite'), 
		'panel' => 	'floret_lite_theme_optionspanel',           			
    ));
	
	$wp_customize->add_setting('floret_lite_frontsldr1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('floret_lite_frontsldr1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 1:','floret-lite'),
		'section' => 'floret_lite_frontslide_settings'
	));	
	
	$wp_customize->add_setting('floret_lite_frontsldr2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('floret_lite_frontsldr2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 2:','floret-lite'),
		'section' => 'floret_lite_frontslide_settings'
	));	
	
	$wp_customize->add_setting('floret_lite_frontsldr3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('floret_lite_frontsldr3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide 3:','floret-lite'),
		'section' => 'floret_lite_frontslide_settings'
	));	//frontpage Slider Section	
	
	//Slider Excerpt Length
	$wp_customize->add_setting( 'floret_lite_excerpt_length_frontsldr', array(
		'default'              => 0,
		'type'                 => 'theme_mod',		
		'sanitize_callback'    => 'floret_lite_sanitize_excerptrange',		
	) );
	$wp_customize->add_control( 'floret_lite_excerpt_length_frontsldr', array(
		'label'       => __( 'Slider Excerpt length','floret-lite' ),
		'section'     => 'floret_lite_frontslide_settings',
		'type'        => 'range',
		'settings'    => 'floret_lite_excerpt_length_frontsldr','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );	
	
	$wp_customize->add_setting('floret_lite_frontsldr_btntext',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('floret_lite_frontsldr_btntext',array(	
		'type' => 'text',
		'label' => __('enter button name here','floret-lite'),
		'section' => 'floret_lite_frontslide_settings',
		'setting' => 'floret_lite_frontsldr_btntext'
	)); // slider read more button text
	
	$wp_customize->add_setting('floret_lite_show_frontslide_settings',array(
		'default' => false,
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'floret_lite_show_frontslide_settings', array(
	    'settings' => 'floret_lite_show_frontslide_settings',
	    'section'   => 'floret_lite_frontslide_settings',
	    'label'     => __('Check To Show This Section','floret-lite'),
	   'type'      => 'checkbox'
	 ));//Show Front Slider Settings	
	 
	 //Three Column Services Sections
	$wp_customize->add_section('floret_lite_three_column_settings', array(
		'title' => __('Three Column Services Sections','floret-lite'),
		'description' => __('Select pages from the dropdown for three column sections','floret-lite'),
		'priority' => null,
		'panel' => 	'floret_lite_theme_optionspanel',          
	));
		
	$wp_customize->add_setting('floret_lite_3pgcol1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'floret_lite_3pgcol1',array(
		'type' => 'dropdown-pages',			
		'section' => 'floret_lite_three_column_settings',
	));		
	
	$wp_customize->add_setting('floret_lite_3pgcol2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'floret_lite_3pgcol2',array(
		'type' => 'dropdown-pages',			
		'section' => 'floret_lite_three_column_settings',
	));
	
	$wp_customize->add_setting('floret_lite_3pgcol3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'floret_lite_3pgcol3',array(
		'type' => 'dropdown-pages',			
		'section' => 'floret_lite_three_column_settings',
	));		
	
	$wp_customize->add_setting( 'floret_lite_excerpt_length_3pgcol', array(
		'default'              => 10,
		'type'                 => 'theme_mod',		
		'sanitize_callback'    => 'floret_lite_sanitize_excerptrange',		
	) );
	$wp_customize->add_control( 'floret_lite_excerpt_length_3pgcol', array(
		'label'       => __( 'four page box excerpt length','floret-lite' ),
		'section'     => 'floret_lite_three_column_settings',
		'type'        => 'range',
		'settings'    => 'floret_lite_excerpt_length_3pgcol','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );	
	
	$wp_customize->add_setting('floret_lite_show_three_column_settings',array(
		'default' => false,
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));		
	
	$wp_customize->add_control( 'floret_lite_show_three_column_settings', array(
	   'settings' => 'floret_lite_show_three_column_settings',
	   'section'   => 'floret_lite_three_column_settings',
	   'label'     => __('Check To Show This Section','floret-lite'),
	   'type'      => 'checkbox'
	 ));//Show three page column sections
	 
	 
	 //Welcome Sections
	$wp_customize->add_section('floret_lite_welcome_settings', array(
		'title' => __('Welcome Sections','floret-lite'),
		'description' => __('Select pages from the dropdown for Welcome Section','floret-lite'),
		'priority' => null,
		'panel' => 	'floret_lite_theme_optionspanel',          
	));	
		
	$wp_customize->add_setting('floret_lite_welcomepage',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'floret_lite_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'floret_lite_welcomepage',array(
		'type' => 'dropdown-pages',			
		'section' => 'floret_lite_welcome_settings',
	));
	
	$wp_customize->add_setting('floret_lite_secondtitle',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('floret_lite_secondtitle',array(	
		'type' => 'text',
		'label' => __('Enter second title  text here','floret-lite'),
		'section' => 'floret_lite_welcome_settings',
		'setting' => 'floret_lite_secondtitle'
	));	
		

	$wp_customize->add_setting( 'floret_lite_welcomepage_excerpt_length', array(
		'default'              => 30,
		'type'                 => 'theme_mod',		
		'sanitize_callback'    => 'floret_lite_sanitize_excerptrange',		
	) );
	$wp_customize->add_control( 'floret_lite_welcomepage_excerpt_length', array(
		'label'       => __( 'page excerpt length','floret-lite' ),
		'section'     => 'floret_lite_welcome_settings',
		'type'        => 'range',
		'settings'    => 'floret_lite_welcomepage_excerpt_length','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );
	
	$wp_customize->add_setting('floret_lite_show_welcome_settings',array(
		'default' => false,
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));		
	
	$wp_customize->add_control( 'floret_lite_show_welcome_settings', array(
	   'settings' => 'floret_lite_show_welcome_settings',
	   'section'   => 'floret_lite_welcome_settings',
	   'label'     => __('Check To Show This Section','floret-lite'),
	   'type'      => 'checkbox'
	 ));//Show Welcome Sections
	 	 
	 //Blog Posts Settings
	$wp_customize->add_panel( 'floret_lite_blogsettings_panel', array(
		'priority' => 3,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Blog Posts Settings', 'floret-lite' ),		
	) );
	
	$wp_customize->add_section('floret_lite_blogmeta_options',array(
		'title' => __('Blog Meta Options','floret-lite'),			
		'priority' => null,
		'panel' => 	'floret_lite_blogsettings_panel', 	         
	));		
	
	$wp_customize->add_setting('floret_lite_hide_blogdate',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_hide_blogdate', array(
    	'label' => __('Check to hide post date','floret-lite'),	
		'section'   => 'floret_lite_blogmeta_options', 
		'setting' => 'floret_lite_hide_blogdate',		
    	'type'      => 'checkbox'
     )); //Blog Post Date
	 
	 
	 $wp_customize->add_setting('floret_lite_hide_postcats',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_hide_postcats', array(
		'label' => __('Check to hide post category','floret-lite'),	
    	'section'   => 'floret_lite_blogmeta_options',		
		'setting' => 'floret_lite_hide_postcats',		
    	'type'      => 'checkbox'
     )); //blog Posts category	 
	 
	 
	 $wp_customize->add_section('floret_lite_postfeatured_image',array(
		'title' => __('Posts Featured image','floret-lite'),			
		'priority' => null,
		'panel' => 	'floret_lite_blogsettings_panel', 	         
	));		
	
	$wp_customize->add_setting('floret_lite_hide_postfeatured_image',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_hide_postfeatured_image', array(
		'label' => __('Check to hide post featured image','floret-lite'),
    	'section'   => 'floret_lite_postfeatured_image',		
		'setting' => 'floret_lite_hide_postfeatured_image',	
    	'type'      => 'checkbox'
     )); //Posts featured image
	
	$wp_customize->add_section('floret_lite_blogpost_content_settings',array(
		'title' => __('Posts Excerpt Options','floret-lite'),			
		'priority' => null,
		'panel' => 	'floret_lite_blogsettings_panel', 	         
	 ));	 
	 
	$wp_customize->add_setting( 'floret_lite_blogexcerptrange', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'floret_lite_sanitize_excerptrange',		
	) );
	
	$wp_customize->add_control( 'floret_lite_blogexcerptrange', array(
		'label'       => __( 'Excerpt length','floret-lite' ),
		'section'     => 'floret_lite_blogpost_content_settings',
		'type'        => 'range',
		'settings'    => 'floret_lite_blogexcerptrange','input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('floret_lite_blogfullcontent',array(
        'default' => 'Excerpt',     
        'sanitize_callback' => 'floret_lite_sanitize_choices'
	));
	
	$wp_customize->add_control('floret_lite_blogfullcontent',array(
        'type' => 'select',
        'label' => __('Posts Content','floret-lite'),
        'section' => 'floret_lite_blogpost_content_settings',
        'choices' => array(
        	'Content' => __('Content','floret-lite'),
            'Excerpt' => __('Excerpt','floret-lite'),
            'No Content' => __('No Excerpt','floret-lite')
        ),
	) ); 
	
	
	$wp_customize->add_section('floret_lite_postsinglemeta',array(
		'title' => __('Posts Single Settings','floret-lite'),			
		'priority' => null,
		'panel' => 	'floret_lite_blogsettings_panel', 	         
	));	
	
	$wp_customize->add_setting('floret_lite_hide_postdate_fromsingle',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_hide_postdate_fromsingle', array(
    	'label' => __('Check to hide post date from single','floret-lite'),	
		'section'   => 'floret_lite_postsinglemeta', 
		'setting' => 'floret_lite_hide_postdate_fromsingle',		
    	'type'      => 'checkbox'
     )); //Hide Posts date from single
	 
	 
	 $wp_customize->add_setting('floret_lite_hide_postcats_fromsingle',array(
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'floret_lite_hide_postcats_fromsingle', array(
		'label' => __('Check to hide post category from single','floret-lite'),	
    	'section'   => 'floret_lite_postsinglemeta',		
		'setting' => 'floret_lite_hide_postcats_fromsingle',		
    	'type'      => 'checkbox'
     )); //Hide blogposts category single
	 
	 
	 //Sidebar Settings
	$wp_customize->add_section('floret_lite_sidebarsettings', array(
		'title' => __('Sidebar Settings','floret-lite'),		
		'priority' => null,
		'panel' => 	'floret_lite_blogsettings_panel',          
	));		
	 
	$wp_customize->add_setting('floret_lite_hidesidebar_blogposts',array(
		'default' => false,
		'sanitize_callback' => 'floret_lite_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'floret_lite_hidesidebar_blogposts', array(
	   'settings' => 'floret_lite_hidesidebar_blogposts',
	   'section'   => 'floret_lite_sidebarsettings',
	   'label'     => __('Check to show sidebar from homepage','floret-lite'),
	   'type'      => 'checkbox'
	 ));//show sidebar blog posts 
	
		 
}
add_action( 'customize_register', 'floret_lite_customize_register' );

function floret_lite_custom_css(){ 
?>
	<style type="text/css"> 					
        a,
        #sidebar ul li a:hover,
		#sidebar ol li a:hover,							
        .BlogPostList h3 a:hover,
		.site-footer ul li a:hover, 
		.site-footer ul li.current_page_item a,		
        .postmeta a:hover,
		.welcome-rightBX h3,
		.Flbx-33:hover h4 a,			 			
        .button:hover,
		h2.services_title span,			
		.blog-postmeta a:hover,
		.blog-postmeta a:focus,
		blockquote::before	
            { color:<?php echo esc_html( get_theme_mod('floret_lite_colorscheme','#ef7a86')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,
		.Flbx-33 .Flbx-thumb,
        .nivo-controlNav a.active,
		.sd-search input, .sd-top-bar-nav .sd-search input,			
		a.blogreadmore,
		.hdr-topstrip,
		.Flbx-33 a.Flbx-morebtn,
		a.ReadMoreBtn,
		.copyrigh-wrapper:before,										
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,		
		.morebutton,	
		.nivo-directionNav a:hover,	
		.nivo-caption .slidermorebtn:hover		
            { background-color:<?php echo esc_html( get_theme_mod('floret_lite_colorscheme','#ef7a86')); ?>;}
			

		
		.tagcloud a:hover,
		.logo::after,
		blockquote
            { border-color:<?php echo esc_html( get_theme_mod('floret_lite_colorscheme','#ef7a86')); ?>;}
			
		#SiteWrapper a:focus,
		input[type="date"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="button"]:focus,
		input[type="month"]:focus,
		button:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="range"]:focus,		
		input[type="password"]:focus,
		input[type="datetime"]:focus,
		input[type="week"]:focus,
		input[type="submit"]:focus,
		input[type="datetime-local"]:focus,		
		input[type="url"]:focus,
		input[type="time"]:focus,
		input[type="reset"]:focus,
		input[type="color"]:focus,
		textarea:focus
            { outline:1px solid <?php echo esc_html( get_theme_mod('floret_lite_colorscheme','#ef7a86')); ?>;}	
			
		
		.site-navigation a,
		.site-navigation ul li.current_page_parent ul.sub-menu li a,
		.site-navigation ul li.current_page_parent ul.sub-menu li.current_page_item ul.sub-menu li a,
		.site-navigation ul li.current-menu-ancestor ul.sub-menu li.current-menu-item ul.sub-menu li a  			
            { color:<?php echo esc_html( get_theme_mod('floret_lite_menufontcolor','#333333')); ?>;}	
			
		
		.site-navigation ul.nav-menu .current_page_item > a,
		.site-navigation ul.nav-menu .current-menu-item > a,
		.site-navigation ul.nav-menu .current_page_ancestor > a,
		.site-navigation ul.nav-menu .current-menu-ancestor > a, 
		.site-navigation .nav-menu a:hover,
		.site-navigation .nav-menu a:focus,
		.site-navigation .nav-menu ul a:hover,
		.site-navigation .nav-menu ul a:focus,
		.site-navigation ul li a:hover, 
		.site-navigation ul li.current-menu-item a,			
		.site-navigation ul li.current_page_parent ul.sub-menu li.current-menu-item a,
		.site-navigation ul li.current_page_parent ul.sub-menu li a:hover,
		.site-navigation ul li.current-menu-item ul.sub-menu li a:hover,
		.site-navigation ul li.current-menu-ancestor ul.sub-menu li.current-menu-item ul.sub-menu li a:hover 		 			
            { color:<?php echo esc_html( get_theme_mod('floret_lite_menufontactivecolor','#ef7a86')); ?>;}
			
		.hdrtopcart .cart-count
            { background-color:<?php echo esc_html( get_theme_mod('floret_lite_menufontactivecolor','#ef7a86')); ?>;}		
			
		#SiteWrapper .site-navigation a:focus		 			
            { outline:1px solid <?php echo esc_html( get_theme_mod('floret_lite_menufontactivecolor','#ef7a86')); ?>;}	
	
    </style> 
<?php                                                                                                                                                                                              
}
         
add_action('wp_head','floret_lite_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function floret_lite_customize_preview_js() {
	wp_enqueue_script( 'floret_lite_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '19062019', true );
}
add_action( 'customize_preview_init', 'floret_lite_customize_preview_js' );