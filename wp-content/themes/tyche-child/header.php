<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tyche
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<?php
	/**
	 * Enable / Disable the top bar
	 */
	if ( get_theme_mod( 'tyche_enable_top_bar', true ) ) :
		get_template_part( 'template-parts/top-header' );
	endif;
	?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<div class="row">
				<div class="col-sm-4 header-logo">
					<?php
					if ( has_custom_logo() ) :
						the_custom_logo();
					else :
						?>
						<div class="site-title-description">
							<?php
							$header_textcolor = get_theme_mod( 'header_textcolor' );
							if ( 'blank' !== $header_textcolor ) :
								?>
								<a class="site-title" href="<?php echo esc_url( get_home_url() ); ?>">
									<?php Tyche_Helper::customize_partial_blogname(); ?>
								</a>
								<?php
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) :
									?>
									<p class="site-description"> <?php Tyche_Helper::customize_partial_blogdescription(); ?> </p>
								<?php endif; ?>

							<?php endif; ?>
						</div>
						<?php
					endif;
					?>
				</div>

				<?php if ( get_theme_mod( 'tyche_show_banner', false ) ) : ?>
					<div class="col-sm-8 header-banner">
						<?php
						$banner = get_theme_mod( 'tyche_banner_type', 'image' );
						get_template_part( 'template-parts/banner/banner', $banner );
						?>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- .site-branding -->

        <div class="top-header-bar-container zen-custom-top-header-bar">
            <ul class="top-header-bar visible-xs clearfix">
                <!-- Email -->
                <li class="top-email hidden-xs">
                    <i class="fa fa-envelope-o"></i> <?php echo esc_html( get_theme_mod( 'tyche_top_bar_email', get_option( 'admin_email' ) ) ); ?>
                </li>
                <!-- / Email -->
                <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                    <!-- Cart -->
                    <li class="top-cart">
                        <a href="<?php echo esc_url( Tyche_Helper::get_woocommerge_page( 'cart' ) ); ?>"><i class="fa fa-shopping-cart"></i>
                            <?php echo esc_html__( 'My Cart', 'tyche' ); ?>
                            -
                            <span class="get-header-cart"> <?php echo number_format(WC()->cart->cart_contents_total) ?></span>
                            <?php echo esc_html( get_woocommerce_currency_symbol( get_woocommerce_currency() ) ); ?>
                        </a>
                    </li> <!-- / Cart -->
                <?php endif; ?>

                <?php if ( class_exists( 'WooCommerce' ) ) : ?>
                    <!-- Account -->
                    <li class="top-account">
                        <a href="<?php echo esc_url( Tyche_Helper::get_woocommerge_page( 'account' ) ); ?>"><i class="fa fa-user"></i> <?php echo esc_html__( 'Account', 'tyche' ); ?>
                        </a>
                    </li><!-- / Account -->
                <?php endif; ?>

                <?php if ( function_exists( 'pll_the_languages' ) ) : ?>
                    <!-- Multi language picker -->
                    <li class="top-multilang">
                        <?php
                        $current_lang = pll_current_language( 'name' );
                        $current_flag = pll_current_language( 'flag' );
                        ?>
                        <a href="#" class="multilang-toggle" id="multilang-toggle"> <?php echo $current_flag . esc_html( $current_lang ); ?> </a>
                        <ul class="tyche-multilang-menu" data-menu data-menu-toggle="#multilang-toggle">
                            <?php
                            $args = array(
                                'show_flags' => 1,
                                'show_names' => 1,
                            );

                            pll_the_languages( $args );
                            ?>
                        </ul>
                    </li><!-- / Multi language picker -->
                <?php endif; ?>
            </ul>
        </div>


		<nav id="site-navigation" class="zen-navigation" role="navigation">
            <div class="container">
                <div class="navigation-wrap">
                    <p class="lbl  hidden-xs">
                        <i class="fa fa-bars"></i>
                        <span class="text-uppercase">Tất cả DANH MỤC</span>
                        <i class="angle fa fa-angle-down"></i>
                    </p>
                    <?php
                    wp_nav_menu(
                        array(
                            'menu'           => 'primary',
                            'theme_location' => 'primary',
                            'depth'          => 3,
                            'container'      => '',
                            'menu_id'        => 'desktop-menu',
                            'menu_class'     => 'custom-menu  hidden-xs',
                            'fallback_cb'    => 'Tyche_Navwalker::fallback',
                            'walker'         => new Tyche_Navwalker(),
                        )
                    );
                    ?>
                    <div class="row visible-xs mobile-menu-wrap">
                        <div class="col-md-12">

                            <!-- /// Mobile Menu Trigger //////// -->
                            						<a href="#" id="mobile-menu-trigger"> <i class="fa fa-bars"></i> </a>
                            <!-- end #mobile-menu-trigger -->
                            <?php
                            $enable_search_bar = get_theme_mod( 'tyche_enable_top_bar_search', 'enabled' );
                            ?>
                            <?php if ( 'enabled' === $enable_search_bar ) : ?>
                                <!-- Top Search -->
                                <div class="top-search top-search-xs">
                                    <!-- Search Form -->
                                    <form role="search" method="get" class="pull-right" id="searchform_topbar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <label>
                                            <span class="screen-reader-text"><?php esc_html__( 'Search for:', 'tyche' ); ?></span>
                                            <input class="search-field-top-bar" id="search-field-top-bar" placeholder="<?php echo esc_attr__( 'Search ...', 'tyche' ); ?>" value="" name="s" type="search">
                                        </label>
                                        <button id="search-top-bar-submit" type="submit" class="search-top-bar-submit">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </form>
                                </div><!-- / Top Search -->
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="main-slider-bar hidden-xs">
                    <ul class="main-slider-info clearfix">
                        <li class="hidden-xs hidden-sm">
                            <div class="main-slider-info-cell">
                                <div class="cell-icon">
                                    <?php
                                    $icon = get_theme_mod( 'info_section_one_icon', 'fa fa-automobile' );
                                    if ( 'fa fa-automobile' !== $icon ) {
                                        $icon = 'dashicons dashicons-' . get_theme_mod( 'info_section_one_icon' );
                                    }
                                    ?>
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                <div class="cell-content">
                                    <span class="cell-caption">
                                        <?php echo wp_kses_post( get_theme_mod( 'info_section_one_text', 'FREE SHIPPING' ) ); ?>
                                    </span> <span class="cell-subcaption">
                                        <?php echo wp_kses_post( get_theme_mod( 'info_section_one_subtext', 'On all orders over 90$' ) ); ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li class="">
                            <div class="main-slider-info-cell">
                                <div class="cell-icon">
                                    <?php
                                    $icon = get_theme_mod( 'info_section_two_icon', 'fa fa-mobile-phone' );
                                    if ( 'fa fa-mobile-phone' !== $icon ) {
                                        $icon = 'dashicons dashicons-' . get_theme_mod( 'info_section_two_icon' );
                                    }
                                    ?>
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                <div class="cell-content">
							<span class="cell-caption">
								<?php echo wp_kses_post( get_theme_mod( 'info_section_two_text', 'CALL US ANYTIME' ) ); ?>
							</span> <span class="cell-subcaption">
								<?php echo wp_kses_post( get_theme_mod( 'info_section_two_subtext', '+04786445953' ) ); ?>
							</span>
                                </div>

                            </div>
                        </li>
                        <li class="">
                            <div class="main-slider-info-cell">
                                <div class="cell-icon">
                                    <?php
                                    $icon = get_theme_mod( 'info_section_three_icon', 'fa fa-map-marker' );
                                    if ( 'fa fa-map-marker' !== $icon ) {
                                        $icon = 'dashicons dashicons-' . get_theme_mod( 'info_section_three_icon' );
                                    }
                                    ?>
                                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                                </div>
                                <div class="cell-content">
						<span class="cell-caption">
							<?php echo wp_kses_post( get_theme_mod( 'info_section_three_text', 'OUR LOCATION' ) ); ?>
						</span> <span class="cell-subcaption">
							<?php echo wp_kses_post( get_theme_mod( 'info_section_three_subtext', '557-6308 Lacinia Road. NYC' ) ); ?>
						</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

		</nav><!-- #site-navigation -->

	</header><!-- #masthead -->
	<?php
	/**
	 * Enable / Disable the main slider
	 */
	$show_on_front = get_option( 'show_on_front' );
	if ( get_theme_mod( 'tyche_enable_main_slider', true ) && is_front_page() && 'posts' !== $show_on_front ) :
		get_template_part( 'template-parts/main-slider' );
	endif;
	?>

	<div class="site-content">
