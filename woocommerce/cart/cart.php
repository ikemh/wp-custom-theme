<?php
defined('ABSPATH'***REMOVED*** || exit;

/**
 * WooCommerce Custom Cart Template
 *
 * Based on the provided structure from the uploaded HTML file.
 */

get_header(***REMOVED***; ?>

<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="shop-cart-container">
                <header class="woocommerce-cart-header">
                    <h1 class="cart-title">Meu Carrinho</h1>
                    <nav class="woocommerce-breadcrumb">
                        <a href="<?php echo esc_url(home_url('/'***REMOVED******REMOVED***; ?>">Home</a> &gt; Carrinho
                    </nav>
                </header>

                <form action="<?php echo esc_url(wc_get_cart_url(***REMOVED******REMOVED***; ?>" method="post">
                    <?php do_action('woocommerce_before_cart_table'***REMOVED***; ?>

                    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">&nbsp;</th>
                                <th class="product-name"><?php esc_html_e('Product', 'woocommerce'***REMOVED***; ?></th>
                                <th class="product-price"><?php esc_html_e('Price', 'woocommerce'***REMOVED***; ?></th>
                                <th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'***REMOVED***; ?></th>
                                <th class="product-subtotal"><?php esc_html_e('Total', 'woocommerce'***REMOVED***; ?></th>
                                <th class="product-remove">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php do_action('woocommerce_before_cart_contents'***REMOVED***; ?>

                            <?php
                            foreach (WC(***REMOVED***->cart->get_cart(***REMOVED*** as $cart_item_key => $cart_item***REMOVED*** {
                                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'***REMOVED***, $cart_item, $cart_item_key***REMOVED***;
                                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'***REMOVED***, $cart_item, $cart_item_key***REMOVED***;

                                if ($_product && $_product->exists(***REMOVED*** && $cart_item['quantity'***REMOVED*** > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key***REMOVED******REMOVED*** {
                                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible(***REMOVED*** ? $_product->get_permalink($cart_item***REMOVED*** : '', $cart_item, $cart_item_key***REMOVED***;
                                    ?>
                                    <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key***REMOVED******REMOVED***; ?>">

                                        <td class="product-thumbnail">
                                            <?php
                                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(***REMOVED***, $cart_item, $cart_item_key***REMOVED***;

                                            if (!$product_permalink***REMOVED*** {
                                                echo $thumbnail; // PHPCS: XSS ok.
                                            } else {
                                                printf('<a href="%s">%s</a>', esc_url($product_permalink***REMOVED***, $thumbnail***REMOVED***; // PHPCS: XSS ok.
                                            }
                                            ?>
                                        </td>

                                        <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'***REMOVED***; ?>">
                                            <?php
                                            if (!$product_permalink***REMOVED*** {
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(***REMOVED***, $cart_item, $cart_item_key***REMOVED*** . '&nbsp;'***REMOVED***;
                                            } else {
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink***REMOVED***, $_product->get_name(***REMOVED******REMOVED***, $cart_item, $cart_item_key***REMOVED******REMOVED***;
                                            }

                                            // Meta data.
                                            echo wc_get_formatted_cart_item_data($cart_item***REMOVED***; // PHPCS: XSS ok.

                                            // Backorder notification.
                                            if ($_product->backorders_require_notification(***REMOVED*** && $_product->is_on_backorder($cart_item['quantity'***REMOVED******REMOVED******REMOVED*** {
                                                echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce'***REMOVED*** . '</p>', $product_id***REMOVED******REMOVED***;
                                            }
                                            ?>
                                        </td>

                                        <td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'***REMOVED***; ?>">
                                            <?php
                                            echo apply_filters('woocommerce_cart_item_price', WC(***REMOVED***->cart->get_product_price($_product***REMOVED***, $cart_item, $cart_item_key***REMOVED***; // PHPCS: XSS ok.
                                            ?>
                                        </td>

                                        <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'***REMOVED***; ?>">
                                            <?php
                                            if ($_product->is_sold_individually(***REMOVED******REMOVED*** {
                                                $product_quantity = sprintf('1 <input type="hidden" name="cart[%s***REMOVED***[qty***REMOVED***" value="1" />', $cart_item_key***REMOVED***;
                                            } else {
                                                $product_quantity = '<div class="quantity-wrapper">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <th class="label" style="width: 116px;">
                                                                    <span class="quantity-label">Quantidade</span>
                                                                </th>
                                                                <td class="quantity-td">
                                                                    <button type="button" class="qtyminus">-</button>
                                                                    <span class="quantity-display">' . $cart_item['quantity'***REMOVED*** . '</span>
                                                                    <button type="button" class="qtyplus">+</button>
                                                                    <input type="number" id="quantity_' . esc_attr($cart_item_key***REMOVED*** . '" class="input-text qty text" name="cart[' . $cart_item_key . '***REMOVED***[qty***REMOVED***" value="' . esc_attr($cart_item['quantity'***REMOVED******REMOVED*** . '" aria-label="' . esc_attr__('Product quantity', 'woocommerce'***REMOVED*** . '" size="4" min="0" max="' . esc_attr($_product->get_max_purchase_quantity(***REMOVED******REMOVED*** . '" step="1" placeholder="" inputmode="numeric" autocomplete="off" style="display: none;">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>';
                                            }

                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item***REMOVED***; // PHPCS: XSS ok.
                                            ?>
                                        </td>

                                        <td class="product-subtotal" data-title="<?php esc_attr_e('Total', 'woocommerce'***REMOVED***; ?>">
                                            <?php
                                            echo apply_filters('woocommerce_cart_item_subtotal', WC(***REMOVED***->cart->get_product_subtotal($_product, $cart_item['quantity'***REMOVED******REMOVED***, $cart_item, $cart_item_key***REMOVED***; // PHPCS: XSS ok.
                                            ?>
                                        </td>

                                        <td class="product-remove">
                                            <?php
                                            echo apply_filters(
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key***REMOVED******REMOVED***,
                                                    esc_html__('Remove this item', 'woocommerce'***REMOVED***,
                                                    esc_attr($product_id***REMOVED***,
                                                    esc_attr($_product->get_sku(***REMOVED******REMOVED***
                                            ***REMOVED***,
                                                $cart_item_key
                                        ***REMOVED***;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action('woocommerce_cart_contents'***REMOVED***; ?>

                            <tr>
                                <td colspan="6" class="actions">

                                    <?php if (wc_coupons_enabled(***REMOVED******REMOVED*** { ?>
                                        <div class="coupon">
                                            <label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'***REMOVED***; ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'***REMOVED***; ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'***REMOVED***; ?>"><?php esc_html_e('Apply coupon', 'woocommerce'***REMOVED***; ?></button>
                                            <?php do_action('woocommerce_cart_coupon'***REMOVED***; ?>
                                        </div>
                                    <?php } ?>

                                    <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'***REMOVED***; ?>"><?php esc_html_e('Update cart', 'woocommerce'***REMOVED***; ?></button>

                                    <?php do_action('woocommerce_cart_actions'***REMOVED***; ?>

                                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'***REMOVED***; ?>
                                </td>
                            </tr>

                            <?php do_action('woocommerce_after_cart_contents'***REMOVED***; ?>
                        </tbody>
                    </table>

                    <?php do_action('woocommerce_after_cart_table'***REMOVED***; ?>
                </form>

                <div class="cart-collaterals">
                    <?php do_action('woocommerce_cart_collaterals'***REMOVED***; ?>
                </div>
            </div>

        </main><!-- .site-main -->
    </div><!-- .content-area -->
</div><!-- .main-content -->

<?php
get_footer(***REMOVED***;
?>
