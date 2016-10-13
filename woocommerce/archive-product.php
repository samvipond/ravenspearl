<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 
get_template_part('content', 'header'); ?>
	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<!-- no title -->
			<!-- <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>  -->

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>

		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				//do_action( 'woocommerce_before_shop_loop' );
				// ^ this is the sorting / showing products bit
			?>


			<!-- This is the loop that displays the products -->
			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>
				<!-- ^THIS IS WHAT IS DISPLAYING THE THUMBS, VIA content-product_cat.php -->

				<?php while ( have_posts() ) : the_post(); ?>

					<?php //wc_get_template_part( 'content', 'product' ); ?>
					
				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		//do_action( 'woocommerce_sidebar' );
	?>



	<div class="show-me hide"></div>
</div>
<div class="center col-md-12">
	<i class="fa fa-chevron-up to-top" id="chevy1"></i>
</div>   
<?php //get_template_part('content', 'footer'); ?>
 <script>
   $(document).ready(function(){

        $.ajaxSetup({cache:false});
        $(".post-link").click(function(){
            $(".show-me").addClass("min-height hide");
            var prod_cat = $(this).find('img').attr('alt').toLowerCase();
            var post_link = '<?php echo esc_url( home_url( '/' ) ); ?>' + prod_cat;
            $(".show-me").fadeIn(1900).removeClass("hide");
            $(".show-me").html("");
            $(".show-me").load(post_link);
            $('html, body').animate({ scrollTop: 700 }, 650).promise().done(function(){
            	setTimeout(
							  function() 
							  {
							    $('i.to-top').removeClass('hide');
							  }, 1000);            	
            });
            
        return false;
        });

        var referred = '<?php 


$ref=@$_SERVER[HTTP_REFERER];
	if (preg_match("/tiles/", $ref)) {
    $referer = "tiles";
    echo $referer;
	} else if (preg_match("/sculpture/", $ref)){
		$referer = "sculpture";
    echo $referer;
	} else if (preg_match("/ceramic/", $ref)){
		$referer = "ceramics";
    echo $referer;
	} else {
		$referer = "elsewhere";
    echo $referer;
	}
?>';

				if(referred != 'elsewhere'){
					$.ajaxSetup({cache:false});
        
            
            var post_link = '<?php echo esc_url( home_url( '/' ) ); ?>' + referred;
            $(".show-me").addClass("min-height");
            $(".show-me").fadeIn(700).removeClass("hide");
            $(".show-me").html("");
            $(".show-me").load(post_link);
            $('html, body').animate({ scrollTop: 700 }, 200);
            console.log('archive-product.php script triggered');
        return false;
				}
				
 
    });
</script>
<?php get_footer( 'shop' ); ?>