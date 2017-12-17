<?php
/**
 * Created by PhpStorm.
 * User: gumidung
 * Date: 8/28/17
 * Time: 10:55 AM
 */

function theme_enqueue_styles() {
//    wp_enqueue_style( 'css-bootstrap', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' );
//    wp_enqueue_style( 'css-fontaresome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css' );
//    wp_enqueue_style( 'bx-slider', get_stylesheet_directory_uri() . '/assets/css/jquery.bxslider.css' );
//    wp_enqueue_style( 'animation-css', get_stylesheet_directory_uri() . '/assets/css/animate.css' );
    wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function gmv_js() {
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/jquery-2.2.4.min.js', array( 'jquery' ));
//    wp_enqueue_script('custom-script_1', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ));
//    wp_enqueue_script('bx-slider', get_stylesheet_directory_uri() . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ));
//    wp_enqueue_script('custom-script_2', get_stylesheet_directory_uri() . '/assets/js/skrollr.min.js', array( 'jquery' ));
//    wp_enqueue_script('animation-js', get_stylesheet_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ));
    wp_enqueue_script('custom-script_4', get_stylesheet_directory_uri() . '/assets/js/gmv-js.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'gmv_js' );

if ( ! function_exists( 'gmv_categories_top' ) ) {
    function gmv_categories_top() {
        $args = array(
            'taxonomy' => 'product_cat',
            'parent' => 0,
            'hide_empty' => 1,
        );
        $getAllCategory = get_categories($args);
        ?>
        <div class="container category-top">
            <div class="clearfix">
                <?php

                foreach ($getAllCategory as $singleCate) :

                    $cateName = $singleCate->name;
                    $cateID = $singleCate->term_id;

                    $thumbnail_id = get_woocommerce_term_meta( $cateID, 'thumbnail_id', true );
                    $image = wp_get_attachment_url( $thumbnail_id );

                    ?>

                    <a href="<?php echo get_term_link($cateID); ?>" class="item">
                        <img class="img-responsive" src="<?php echo $image; ?>" alt="">
                        <div class="title"><?php echo $cateName; ?></div>
                    </a>
                    <?php

                endforeach;
                ?>
            </div>

        </div>
    <?php }
}

if( ! function_exists( 'gmv_hot_item_top')) {
    function gmv_hot_item_top() {
        ?>
        <div class="container">
            <div class="suggestion-item">
                <h3 class="widget-title"><span>Sản phẩm được yêu thích</span></h3>
                <div class="clearfix">
                    <?php
                    $meta_query  = WC()->query->get_meta_query();
                    $tax_query   = WC()->query->get_tax_query();
                    $tax_query[] = array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN',
                    );

                    $args = array(
                        'post_type'           => 'product',
                        'post_status'         => 'publish',
                        'ignore_sticky_posts' => 1,
                        'posts_per_page'      => 12,
                        'order' => 'ASC',
                        'meta_query'          => $meta_query,
                        'tax_query'           => $tax_query,
                    );

                    $loop = new WP_Query( $args );
                    ?>

                    <div class="owl-carousel suggestion-slide">
                        <?php

                        while ( $loop->have_posts() ) : $loop->the_post(); global $product;

                            ?>

                            <div class="item">
                                <a  href="<?php echo get_the_permalink(); ?>" class="">
                                    <div class="tyche-product primary">
                                        <div class="tyche-product-image">
                                            <?php if ( $product->is_on_sale() ) : ?>

                                                <span class="onsale">Sale!</span>

                                            <?php endif; ?>
                                            <?php

                                            if ( has_post_thumbnail( $loop->post->ID ) )
                                                echo get_the_post_thumbnail( $loop->post->ID, 'shop_catalog' );
                                            else
                                                echo '<img src="' . wc_placeholder_img_src() . '" alt="Placeholder" width="65px" height="115px" />';
                                            ?>
                                        </div>
                                        <div class="tyche-product-body">
                                            <h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a> </h3>
                                            <span class="price"><?php  echo $product->get_price_html(); ?></span>
                                            <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>


                            <?php
                        endwhile;
                        wp_reset_query();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

if( ! function_exists('gmv_custom_description')) {
    function gmv_custom_description() {
        $getText = get_field('size_of_product');
        if($getText !="") {
            ?>
            <div class="custom-text-desc">
                <?php echo $getText; ?>
            </div>

            <?php
        }
    }
}

if( ! function_exists('gmv_group_product')) {
    function gmv_group_product() {
        $posts = get_field('group_product');

        if( $posts ): ?>
            <div class="group-product">
                <div class="group-product-title">Complete the set</div>
                <div class="group-product-slider owl-carousel">
                    <?php foreach( $posts as $p ):
                        $product = wc_get_product( $p->ID );
                        ?>

                        <div class="item clearfix">
                            <div class="col-xs-4">
                                <?php
                                if ( has_post_thumbnail( $p->ID ) )
                                    echo get_the_post_thumbnail( $p->ID, 'shop_catalog' );
                                else
                                    echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="65px" height="115px" />';
                                ?>
                            </div>
                            <div class="col-xs-8">

                                <?php
                                if ( $product->is_type( 'variable' ) ):

                                    custom_woocommerce_variable_add_to_cart($p->ID);

                                else :

                                    custom_woocommerce_simple_add_to_cart($p->ID);
                                endif;

                                ?>
                            </div>
                        </div>

                        <?php
                    endforeach; ?>
                </div>
            </div>
        <?php endif;
    }
}

if ( ! function_exists( 'custom_woocommerce_variable_add_to_cart' ) ) {

    /**
     * Output the variable product add to cart area.
     *
     * @subpackage	Product
     */

    function custom_woocommerce_variable_add_to_cart($id) {

        $tickets = new WC_Product_Variable( $id);

        $attributes = $tickets->get_variation_attributes();
        $avaiable_variation = $tickets->get_available_variations();


        $product = wc_get_product( $id );

        ?>

        <form class="custom-form-variable " method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>">

            <div class="">
                <a class="item-title" href="<?php echo get_the_permalink($id);?>"><?php echo get_the_title($id); ?></a>
                <div class="variations" cellspacing="0">
                    <?php foreach ( $attributes as $attribute_name => $options ) :?>
                        <div class="variations-item">
                            <span class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></span>
                            <span class="value">
                            <select id="<?php echo $attribute_name; ?>" name="attribute_<?php echo $attribute_name;?>" data-attribute_name="attribute_<?php echo $attribute_name;?>">
                                <?php foreach ($options as $option) :
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                endforeach; ?>
                            </select>
                        </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="cart">
                <p class="custom-price price"></p>

                <div class="quantity">
                    <div class="styled-number">
                        <a href="#" class="arrow-down incrementor" data-increment="down">
                            <span class="dashicons dashicons-minus"></span>
                        </a>
                        <input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                        <a href="#" class="arrow-up incrementor" data-increment="up"><span class="dashicons dashicons-plus"></span></a>
                    </div>
                </div>
                <button type="submit" class="single_add_to_cart_button button alt"><span class="fa fa-shopping-cart"></span> Add to cart	</button>
                <input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>">
                <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>">
                <input type="hidden" name="variation_id" class="variation_id" value="">
            </div>
            <?php

            foreach ($avaiable_variation as $variation) :?>
                <div class="hidden attribute-info">
                    <?php
                    foreach ($variation['attributes'] as $single_attributes):
                        echo '<span class="attribute-type">'.$single_attributes.'</span>';
                    endforeach;
                    echo '<span class="attribute-id">'.$variation['variation_id'].'</span>';
                    echo $variation['price_html'];
                    ?>
                </div>

                <?php endforeach; ?>

            <?php
//            $array_merge = [];
//            foreach ($avaiable_variation as $variation) :
//                $array_merge[] = array(
//                        'attributes' => $variation['attributes'],
//                        'variation_id' => $variation['variation_id'],
//                );
//            endforeach;

            ?>
        </form>

        <script>

//            var ar = <?php //echo json_encode($array_merge)?>//;
//            console.log(ar);



        </script>

        <?php
    }
}

if( ! function_exists( 'custom_woocommerce_simple_add_to_cart' )) {
    function custom_woocommerce_simple_add_to_cart($id) {

        $product = wc_get_product( $id );

        $salePrice = $product->get_sale_price();
        $regularPrice = $product->get_regular_price();

        ?>

        <form class="cart custom-form-variable" method="post" enctype='multipart/form-data'>
            <div class="">
                <a class="item-title" href="<?php echo get_the_permalink($id);?>"><?php echo get_the_title($id); ?></a>
            </div>
            <div class="">
                <p class="price">
                    <?php

                    if($salePrice != null) :
                        ?>
                        <del>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>
                        <?php echo $regularPrice; ?></span>
                        </del>
                        <ins>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>
                        <?php echo $salePrice; ?></span>
                        </ins>

                        <?php

                    else:
                        ?>
                        <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>
                            <?php echo $regularPrice; ?></span>
                        <?php
                    endif;

                    ?>


                </p>

                <div class="quantity">
                    <div class="styled-number">
                        <a href="#" class="arrow-down incrementor" data-increment="down">
                            <span class="dashicons dashicons-minus"></span>
                        </a>
                        <input type="number" class="input-text qty text" step="1" min="1" max="" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">
                        <a href="#" class="arrow-up incrementor" data-increment="up"><span class="dashicons dashicons-plus"></span></a>
                    </div>
                </div>
                <button type="submit" name="add-to-cart" value="<?php echo $id; ?>" class="single_add_to_cart_button button alt"><span class="fa fa-shopping-cart"></span>Add to cart</button>
            </div>



        </form>

        <?php
    }
}



/* ==================== configure woocommerce setting ================ */

/* === hide dimension == */

//add_filter( 'wc_product_enable_dimensions_display', '__return_false' );
//
//add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 98 );
//
//function bbloomer_remove_product_tabs( $tabs ) {
//    unset( $tabs['additional_information'] );
//    return $tabs;
//}

/* ======= */



add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );

function iconic_cart_count_fragments( $fragments ) {

    $fragments['span.get-header-cart'] = '<span class="get-header-cart"> ' . number_format(WC()->cart->cart_contents_total) . '</span> ';

    return $fragments;

}

function my_woocommerce_custom_breadcrumbs() {
    if(is_checkout() || is_cart()){
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    }
}
add_filter('woocommerce_before_main_content','my_woocommerce_custom_breadcrumbs');