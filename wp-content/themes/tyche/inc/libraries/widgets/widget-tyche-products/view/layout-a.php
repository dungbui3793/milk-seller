<?php

wp_enqueue_script( 'owlCarousel' );
wp_enqueue_style( 'owlCarousel' );
wp_enqueue_style( 'owlCarousel-theme' );

$posts = Tyche_Helper::get_products( $params ); ?>

<div class="zen-homepage-block-product">

    <div class="row">
        <?php


        $cateObject = get_term_by( 'name', $params['cats'], 'product_cat' );
        $cateId = $cateObject->term_id;

        $children = get_terms( 'product_cat', array(
            'parent'    => $cateId,
            'hide_empty' => false,
            'number' => 6
        ) );


        if($children) {
            ?>

            <div class="custom-category-block">
                <div class="clearfix">
                    <div class="col-xs-12 col-sm-5">
                        <?php

                        $thumbnail_id = get_woocommerce_term_meta( $cateId, 'thumbnail_id', true );
                        $image = wp_get_attachment_url( $thumbnail_id );

                        ?>
                        <a href="<?php echo get_term_link($cateId); ?>" class="parent-cate">
                            <img class="img-responsive" src="<?php echo $image; ?>" alt="">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-7">
                        <div class="row top-cate-wrap">

                            <?php
                            foreach ($children as $eachChildCate) {
                                $cateID = $eachChildCate->term_id;
                                $thumbnail_id = get_woocommerce_term_meta( $cateID, 'thumbnail_id', true );
                                $image = wp_get_attachment_url( $thumbnail_id );
                                ?>

                                <div class="col-xs-6 col-sm-4 top-cate">
                                    <a href="<?php echo get_term_link($cateID); ?>" class="item">
                                        <div class="img-hover">
                                            <img class="img-responsive" src="<?php echo $image; ?>" alt="">
                                        </div>
                                        <p><?php echo $eachChildCate->name; ?></p>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                    </div>

                </div>
            </div>


            <?php
        }



        ?>


    </div>


    <div class="block-slide-product-wrap">
        <a href="<?php echo get_term_link($cateId); ?>">
            <h3><?php
                echo $params['title'] . ' mới về';
                ?>
            </h3>
        </a>

        <div class="block-slide-product owl-carousel">

            <?php while ( $posts->have_posts() ) : $posts->the_post();
                global $product;
                global $post; ?>
                <div class="item">
                    <div class="tyche-product <?php echo ! empty( $params['color'] ) ? esc_attr( $params['color'] ) : '' ?>">
                        <?php woocommerce_template_loop_product_link_open() ?>
                        <div class="tyche-product-image">
                            <?php
                            $regularPrice = $product->get_regular_price();
                            $salePrice = $product->get_sale_price();
                            ?>
                            <?php if ( $product->is_on_sale() ) : ?>
                                <span class="onsale">
                                                    <span class="hidden-xs hidden-md">Sale!</span>
                                    <?php
                                    echo '<span class="sale-percent visible-xs visible-md">';
                                    echo '- ' . round(100 - ($salePrice / $regularPrice) * 100) . '%';
                                    echo '</span>';

                                    ?>
                                                </span>

                            <?php endif; ?>

                            <?php
                            $image = '<img src="' . get_template_directory_uri() . '/assets/images/product-placeholder.jpg" />';

                            if ( has_post_thumbnail() ) {
                                $image = woocommerce_get_product_thumbnail( 'shop_catalog' );
                            };

                            $max_size = get_the_post_thumbnail_url( get_the_ID(), 'shop_single' );
                            $image = str_replace( ' class=', ' data-src="' . $max_size . '" class=', $image );

                            $allowed_tags = array(
                                'img'      => array(
                                    'data-srcset' => true,
                                    'data-src'    => true,
                                    'srcset'      => true,
                                    'sizes'       => true,
                                    'src'         => true,
                                    'class'       => true,
                                    'alt'         => true,
                                    'width'       => true,
                                    'height'      => true,
                                ),
                                'noscript' => array(),
                            );
                            echo wp_kses( $image, $allowed_tags );
                            ?>
                        </div>
                        <?php woocommerce_template_loop_product_link_close() ?>
                        <div class="tyche-product-body">
                            <h3><?php woocommerce_template_loop_product_link_open() ?><?php explore_name(get_the_title()) ?><?php woocommerce_template_loop_product_link_close() ?></h3>
                            <?php $rating_html = wc_get_rating_html( $product->get_average_rating() ); ?>
                            <?php if ( 'yes' === $params['show_rating'] && $rating_html ) : ?><?php echo $rating_html; ?><?php endif; ?>

                            <?php
                            $price_html = $product->get_price_html() ;
                            ?>
                            <?php if ( $price_html ) : ?>
                                <span class="price"><?php echo $price_html;
                                    if($product->is_on_sale()) {
                                        echo '<span class="sale-percent  hidden-xs hidden-md">';
                                        echo '- ' . round(100 - ($salePrice / $regularPrice) * 100) . '%';
                                        echo '</span>';
                                    }
                                ?></span>
                            <?php endif; ?>

                            <?php
                            echo apply_filters(
                                'woocommerce_loop_add_to_cart_link',
                                sprintf(
                                    '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><span class="fa fa-shopping-cart"></span> %s</a>',
                                    esc_url( $product->add_to_cart_url() ),
                                    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                    esc_attr( $product->get_id() ),
                                    esc_attr( $product->get_sku() ),
                                    esc_attr( ! empty( $params['color'] ) ? 'ajax_add_to_cart add_to_cart_button button ' . $params['color'] : 'ajax_add_to_cart add_to_cart_button button' ),
                                    esc_html( $product->add_to_cart_text() )
                                ),
                                $product
                            );
                            ?>
                        </div>

                    </div>
                </div>
            <?php endwhile; ?>

        </div>
    </div>
</div>