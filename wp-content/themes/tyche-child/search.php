<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Tyche
 */

get_header();
$breadcrumbs_enabled = get_theme_mod( 'tyche_enable_post_breadcrumbs', true );
if ( $breadcrumbs_enabled ) { ?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php Tyche_Helper::add_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="container woocommerce search-page">
		<div class="row">
<!--            <div class="col-xs-12 col-md-4">-->
<!--                <div class="custom-sidebar">-->
<!--                    <div class="custom-clear-filter hidden-xs"><i class="fa fa-pencil" aria-hidden="true"></i>Clear filter</div>-->
<!--                    --><?php
//                    do_action( 'woocommerce_sidebar' );
//                    ?>
<!--                    <div class="custom-clear-filter visible-xs"><i class="fa fa-pencil" aria-hidden="true"></i>Clear filter</div>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-md-12 tyche-has-sidebar">
                <div id="primary" class="content-area <?php echo $class; ?>">
                    <main id="main" class="site-main" role="main">

                        <?php
                        if ( have_posts() ) :
                            ?>

                            <header class="page-header">
                                <h1 class="page-title"><?php printf( esc_html__( 'Kết quả tìm kiếm cho: %s', 'tyche' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                            </header><!-- .page-header -->

                            <ul class="products">

                                <?php
                                /* Start the Loop */
                                while ( have_posts() ) :the_post();


                                    wc_get_template_part( 'content', 'product' );
//                                get_template_part( 'template-parts/content', 'search' );
                                endwhile;

?>

                                </ul>

                        <?php
                            do_action( 'woocommerce_after_shop_loop' );
//                            the_posts_navigation();

                        else :

                            get_template_part( 'template-parts/content', 'none' );

                        endif;
                        ?>

                    </main><!-- #main -->
                </div><!-- #primary -->
            </div>

		</div>
	</div>

<?php
get_footer();
