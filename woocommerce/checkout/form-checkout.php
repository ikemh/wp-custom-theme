<?php
/**
 * Template Name: Custom Checkout
 */

defined( 'ABSPATH' ) || exit;

$checkout = WC()->checkout();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div id="custom-checkout">
    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div id="checkout-steps">
            <div id="step-1" class="checkout-step active">
                <h2><?php _e('Personal Information', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    // Display billing fields for personal information
                    woocommerce_form_field( 'billing_first_name', array(
                        'type'        => 'text',
                        'class'       => array('form-row-wide'),
                        'label'       => __('First Name', 'woocommerce'),
                        'required'    => true,
                    ), $checkout->get_value('billing_first_name'));

                    woocommerce_form_field( 'billing_last_name', array(
                        'type'        => 'text',
                        'class'       => array('form-row-wide'),
                        'label'       => __('Last Name', 'woocommerce'),
                        'required'    => true,
                    ), $checkout->get_value('billing_last_name'));

                    woocommerce_form_field( 'billing_phone', array(
                        'type'        => 'tel',
                        'class'       => array('form-row-wide'),
                        'label'       => __('Phone', 'woocommerce'),
                        'required'    => true,
                    ), $checkout->get_value('billing_phone'));

                    woocommerce_form_field( 'billing_email', array(
                        'type'        => 'email',
                        'class'       => array('form-row-wide'),
                        'label'       => __('Email', 'woocommerce'),
                        'required'    => true,
                    ), $checkout->get_value('billing_email'));
                    ?>
                    <button type="button" id="next-step-1" class="button"><?php _e('Next', 'woocommerce'); ?></button>
                </div>
            </div>

            <div id="step-2" class="checkout-step">
                <h2><?php _e('Billing Information', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    // Display billing address fields
                    foreach ($checkout->get_checkout_fields('billing') as $key => $field) {
                        woocommerce_form_field( $key, $field, $checkout->get_value($key));
                    }
                    ?>
                    <button type="button" id="next-step-2" class="button"><?php _e('Next', 'woocommerce'); ?></button>
                </div>
            </div>

            <div id="step-3" class="checkout-step">
                <h2><?php _e('Payment Information', 'woocommerce'); ?></h2>
                <div class="checkout-content">
                    <?php
                    // Display payment methods
                    if ( WC()->cart->needs_payment() ) {
                        ?>
                        <div id="payment" class="woocommerce-checkout-payment">
                            <?php if ( ! empty( $available_gateways ) ) : ?>
                                <ul class="wc_payment_methods payment_methods methods">
                                    <?php
                                    if ( sizeof( $available_gateways ) ) {
                                        current( $available_gateways )->set_current();
                                    }
                                    foreach ( $available_gateways as $gateway ) {
                                        wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                                    }
                                    ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order"><?php _e('Place Order', 'woocommerce'); ?></button>
                </div>
            </div>
        </div>

        <div id="order-summary" class="checkout-summary">
            <h2><?php _e('Order Summary', 'woocommerce'); ?></h2>
            <?php do_action('woocommerce_checkout_order_review'); ?>
        </div>
    </form>
</div>

<style>
.checkout-step {
    display: none;
}
.checkout-step.active {
    display: block;
}
#order-summary {
    position: sticky;
    top: 20px;
    margin-left: 20px;
}
#custom-checkout {
    display: flex;
    justify-content: space-between;
}
#checkout-steps {
    flex-grow: 1;
    max-width: 70%;
}
.checkout-summary {
    max-width: 28%;
}
</style>

<script>
jQuery(document).ready(function($) {
    $('#next-step-1').on('click', function() {
        $('#step-1').removeClass('active').hide();
        $('#step-2').addClass('active').show();
    });

    $('#next-step-2').on('click', function() {
        $('#step-2').removeClass('active').hide();
        $('#step-3').addClass('active').show();
    });
});
</script>