<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Floret Lite
 */

get_header(); ?>

<div class="container">
    <div id="tabber-BX">
        <div class="LayoutContent-70">
           <div class="BlogPostList">
            <div class="blogin-bx"> 
             <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'floret-lite' ); ?></h1>                
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn....Dont worry... it happens to the best of us.', 'floret-lite' ); ?></p>  
            </div><!-- .page-content -->
           </div><!--.blogin-bx-->
          </div><!--.BlogPostList-->      
       </div><!-- LayoutContent-70-->   
        <?php get_sidebar();?>       
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>