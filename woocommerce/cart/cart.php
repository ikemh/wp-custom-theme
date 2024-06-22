<?php
defined('ABSPATH') || exit;

/**
 * WooCommerce Custom Cart Template
 *
 * Based on the provided structure from the uploaded HTML file.
 */

get_header(); ?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="shop-cart-container">
                <header class="woocommerce-cart-header">
                    <h1 class="cart-title">Meu Carrinho</h1>
                </header>
                <div class="cart-content">
                    <div class="table-content">
                        <form action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                            <?php do_action('woocommerce_before_cart_table'); ?>

                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                                        <th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
                                        <th class="product-subtotal"><?php esc_html_e('Total', 'woocommerce'); ?></th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php do_action('woocommerce_before_cart_contents'); ?>

                                    <?php
                                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                            ?>
<tr class="woocommerce-cart-form__cart-item cart-item-<?php echo esc_attr($cart_item_key); ?> <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">

                                                <td class="product-thumbnail">
                                                    <?php
                                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                    if (!$product_permalink) {
                                                        echo $thumbnail; // PHPCS: XSS ok.
                                                    } else {
                                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                                    }
                                                    ?>
                                                </td>

                                                <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                                    <?php
                                                    if (!$product_permalink) {
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                    } else {
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                    }

                                                    // Meta data.
                                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                    // Backorder notification.
                                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                    }
                                                    ?>
                                                    <p> 
                                                        <?php
                                                        $regular_price = $_product->get_regular_price();
                                                        $sale_price = $_product->get_sale_price();
                                                        $price_html = '';

                                                        if ($_product->is_on_sale()) {
                                                            $price_html = '<del>' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . '</ins>';
                                                        } else {
                                                            $price_html = wc_price($regular_price);
                                                        }

                                                        echo apply_filters('woocommerce_cart_item_price', $price_html, $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                        ?>
                                                    </p>
                                                    <p class="in_stock">Em estoque</p>
                                                    <p class="free_freight">Elegivel para <span class="freight-span">frete grátis <i class="fa-solid fa-bolt"></i></span></p>
                                                </td>


                                                <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                                                    <?php
                                                    if ($_product->is_sold_individually()) {
                                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                                    } else {
                                                        $product_quantity = woocommerce_quantity_input(
                                                            array(
                                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                                'input_value'  => $cart_item['quantity'],
                                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                                'min_value'    => '0',
                                                                'product_name' => $_product->get_name(),
                                                            ),
                                                            $_product,
                                                            false
                                                        );
                                                    }

                                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                                    ?>
                                                </td>

                                                <td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'); ?>">
                                                    <?php
                                                    echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                    ?>
                                                </td>

                                                <td class="product-remove">
                                                    <?php
                                                    echo apply_filters(
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                            esc_html__('Remove this item', 'woocommerce'),
                                                            esc_attr($product_id),
                                                            esc_attr($_product->get_sku())
                                                        ),
                                                        $cart_item_key
                                                    );
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                    <?php do_action('woocommerce_cart_contents'); ?>

                                    <tr>
                                        <td colspan="6" class="actions">

                                            <?php if (wc_coupons_enabled()) { ?>
                                                <div class="coupon">
                                                    <label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
                                                    <?php do_action('woocommerce_cart_coupon'); ?>
                                                </div>
                                            <?php } ?>

                                            <?php do_action('woocommerce_cart_actions'); ?>

                                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                                        </td>
                                    </tr>

                                    <?php do_action('woocommerce_after_cart_contents'); ?>
                                </tbody>
                            </table>

                            <?php do_action('woocommerce_after_cart_table'); ?>
                        </form>
                    </div>
                    <div class="cart-collaterals">
                        <?php do_action('woocommerce_cart_collaterals'); ?>
                    </div>
                </div>
            </div>

        </main><!-- .site-main -->
    </div><!-- .content-area -->
</div><!-- .main-content -->

<?php
get_footer();
