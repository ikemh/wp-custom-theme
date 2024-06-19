<?php get_header(); ?>

<div class="product-page-container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="breadcrumb">
        <?php woocommerce_breadcrumb(); // Exibir o breadcrumb ?>
    </div>
    <div class="product-content">
        <div class="product-block">
            <div class="product-gallery">
                <?php woocommerce_show_product_images(); ?>
            </div>
            <div class="product-details">
                <div class="card card--sticky">
                    <h1 class="product-title"><?php the_title(); ?> <span><i class="fas fa-check"></i></span></h1>
                    <table>
                        <tbody>
                            <tr>
                                <th rowspan="2" class="label">Preço</th>
                                <td class="value"><?php woocommerce_template_single_price(); ?></td>
                            <tr>
                                <td><p class="installments-price"></p></td>
                            </tr>
                        </tbody>
                    </table>
                        <!-- Placeholder para o valor parcelado -->
                    <?php woocommerce_template_single_add_to_cart(); ?>

                        <table class="installments-table">
                            <tbody>
                                <tr class="details-wrapper">
                                    <th>
                                        <details>
                                            <summary>
                                                <div class="summary-content">
                                                    <div class="installments-img">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/visa.png" alt="payment-methods">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/master.png" alt="payment-methods">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/amex.png" alt="payment-methods">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/diners.png" alt="payment-methods">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/elo.png" alt="payment-methods">
                                                    </div>
                                                    <div class="summary-title"><span>Ver parcelas <i class="fa-solid fa-caret-down"></i>
                                                    </div>
                                                </div>
                                            </summary>
                                            <div class="collapsible-content">
                                                <table class="installments-content">
                                                    <tbody>
                                                        <tr>
                                                            <td class="number-installments-left">1x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-1"></td>
                                                            <td class="fees-includes-left">sem juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-left">2x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-2"></td>
                                                            <td class="fees-includes-left">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-left">3x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-3"></td>
                                                            <td class="fees-includes-left">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-left">4x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-4"></td>
                                                            <td class="fees-includes-left">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-left">5x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-5"></td>
                                                            <td class="fees-includes-left">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-left">6x de</td>
                                                            <td class="valor-installments-left" id="valor-installments-6"></td>
                                                            <td class="fees-includes-left">com juros</td>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td class="number-installments-right">7x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-7"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-right">8x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-8"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-right">9x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-9"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-right">10x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-10"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-right">11x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-11"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="number-installments-right">12x de</td>
                                                            <td class="valor-installments-right" id="valor-installments-12"></td>
                                                            <td class="fees-includes-right">com juros</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </details>
                                        <div class="summary-final-content">
                                            <div class="installments-img">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/boleto.png" alt="payment-methods">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/pix.png" alt="payment-methods">
                                            </div>
                                            <?php
                                                global $product;

                                                if ( $product->is_on_sale() ) {
                                                    echo '<span id="final-price" class="woocommerce-Price-amount amount">' . wc_price( $product->get_sale_price() ) . '</span>';
                                                } else {
                                                    echo '<span id="final-price" class="woocommerce-Price-amount amount">' . wc_price( $product->get_regular_price() ) . '</span>';
                                                }
                                            ?>

                                        </div>
                                        <div class="tempofrete">
                                            <span class="custom-address tempofrete1">
                                                <i class="fas fa-shipping-fast"></i><p>Frete Grátis<span id="location"></span>.</p>
                                            </span>
                                            <span class="colorfretegeral">
                                                <i class="fas fa-medal"></i><p>Garantia de 30 dias direto em nossa loja.</p>
                                            </span>
                                            <span class="colorfretegeral">
                                                <i class="fas fa-undo-alt"></i><p>7 dias para trocas e devoluções.</p>
                                            </span>
                                        </div>
                                     </th>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
            
            <div class="product-description">
                <?php
                    // Exibir apenas a descrição do produto
                    $product = wc_get_product( get_the_ID() );
                    if ( $product->get_description() ) {
                        echo '<div class="woocommerce-product-details__short-description">';
                        echo wpautop( do_shortcode( $product->get_description() ) );
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>
</div>


<?php get_footer(); ?>
