<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Tyche
 */

get_header(); ?>
	<div id="primary" class="content-area container">
		<div class="row">
			<div class="">
				<main id="main" class="site-main" role="main">
					<div class="container">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Xin lỗi, trang bạn đang tìm kiếm không tồn tại!', 'tyche' ); ?></h1>
                        </header><!-- .page-header -->
                        <section class="error-404 not-found">
                            <div class="page-content">

                                <a href="<?php echo get_home_url(); ?>">
                                    <div class="me404">
                                        <div class="clouds"></div>
                                        <div class="the404"></div>
                                        <div class="monkey">
                                            <div class="monkey-eye-l"></div>
                                            <div class="monkey-eye-r"></div>
                                        </div>
                                        <div class="moon"></div>
                                        <div class="platform"></div>
                                        <div class="star1"></div>
                                        <div class="star2"></div>
                                        <div class="star3"></div>
                                        <div class="star4"></div>
                                        <div class="swirl"></div>
                                        <div class="sword">
                                            <div class="sword-shadow"></div>
                                        </div>
                                        <div class="tetris"></div>
                                        <div class="triforce"></div>
                                    </div>
                                </a>

<!--                                							<p>--><?php //esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'tyche' ); ?><!--</p>-->
<!---->
<!--                                							--><?php
//                                							get_search_form();
//
//                                							the_widget( 'Widget_Tyche_Recent_Posts' );
//                                							?>

                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->
                    </div>

				</main><!-- #main -->
			</div>
		</div>
	</div><!-- #primary -->

<?php
get_footer();
