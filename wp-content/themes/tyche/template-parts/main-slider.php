<?php
/**
 * Template part for displaying main slider
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tyche
 */

$images = get_theme_mod( 'tyche_slider_bg', array() );

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

?>
<!-- Main Slider -->
<section class="main-slider">
	<?php if ( empty( $images ) ) : ?>
		<div class="owl-carousel owl-theme" id="main-slider">
			<div class="item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero.jpg"/>
				<div class="hero-caption left hidden-xs hidden-sm">
					<span class="year"><?php echo esc_html( date( 'Y' ) ); ?></span>
					<span class="caption"><?php echo esc_html__( 'Autumn Collection', 'tyche' ); ?></span>
					<div class="btn-group">
						<a href="#"><?php echo esc_html__( 'Shop Now', 'tyche' ); ?></a>
						<a href="#"><?php echo esc_html__( 'Learn More', 'tyche' ); ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php else : ?>
		<div class="owl-carousel owl-theme" id="main-slider">
			<?php foreach ( $images as $image ) : ?>
				<div class="item">
					<?php echo wp_get_attachment_image( $image['image_bg'], 'tyche-slider-image' ); ?>
					<div class="hero-caption <?php echo esc_attr( get_theme_mod( 'tyche_slider_layout', 'left' ) ); ?> hidden-xs hidden-sm">
						<?php if ( ! empty( $image['cta_text'] ) ) : ?>
							<span class="year"><?php echo esc_html( $image['cta_text'] ); ?></span>
						<?php endif; ?>
						<?php if ( ! empty( $image['cta_subtext'] ) ) : ?>
							<span class="caption"><?php echo esc_html( $image['cta_subtext'] ); ?></span>
						<?php endif; ?>
						<div class="btn-group">
							<?php if ( ! empty( $image['button_one_text'] ) && ! empty( $image['button_one_url'] ) ) : ?>
								<a href="<?php echo esc_html( $image['button_one_url'] ); ?>"><?php echo esc_html( $image['button_one_text'] ); ?></a>
							<?php endif; ?>
							<?php if ( ! empty( $image['button_two_text'] ) && ! empty( $image['button_two_url'] ) ) : ?>
								<a href="<?php echo esc_html( $image['button_two_url'] ); ?>"><?php echo esc_html( $image['button_two_text'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

</section><!-- / Main Slider -->
