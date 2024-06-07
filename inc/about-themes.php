<?php
/**
 * Floret Lite About Theme
 *
 * @package Floret Lite
 */

//about theme info
add_action( 'admin_menu', 'floret_lite_abouttheme' );
function floret_lite_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'floret-lite'), __('About Theme Info', 'floret-lite'), 'edit_theme_options', 'floret_lite_guide', 'floret_lite_mostrar_guide');   
} 

//Info of the theme
function floret_lite_mostrar_guide() { 	
?>

<h1><?php esc_html_e('About Theme Info', 'floret-lite'); ?></h1>
<hr />  

<p><?php esc_html_e('Floret Lite is a free florist WordPress theme and comes with a minimal and sleek representation. This theme is budget-friendly and can fit the needs of those people who want to start a website associated with flowers, florists, gifts, decoration and light services, online floral stores, and others. This theme is specially designed for flower shop owners, flower shop products, flower suppliers, online floral delivery services, eCommerce stores, gifts stores, subscription service providers, and a lot more. Being a free theme, this Floret Lite template can prove to be a perfect choice for you because it presents you with a powerful and array of features. In the first place, it is user-friendly, and secondly, it comes with tons of simplified functionalities and features. For developing a minimalistic site, this free florist WordPress theme can prove to be highly supportive of your long-term goal.', 'floret-lite'); ?></p>

<h2><?php esc_html_e('Theme Features', 'floret-lite'); ?></h2>
<hr />  
 
<h3><?php esc_html_e('Theme Customizer', 'floret-lite'); ?></h3>
<p><?php esc_html_e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'floret-lite'); ?></p>


<h3><?php esc_html_e('Responsive Ready', 'floret-lite'); ?></h3>
<p><?php esc_html_e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'floret-lite'); ?></p>


<h3><?php esc_html_e('Cross Browser Compatible', 'floret-lite'); ?></h3>
<p><?php esc_html_e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'floret-lite'); ?></p>


<h3><?php esc_html_e('E-commerce', 'floret-lite'); ?></h3>
<p><?php esc_html_e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'floret-lite'); ?></p>

<hr />  	
<p><a href="http://www.gracethemesdemo.com/documentation/floret/#homepage-lite" target="_blank"><?php esc_html_e('Documentation', 'floret-lite'); ?></a></p>

<?php } ?>