<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="header-container">
            <div class="main-menu">
            <div class="header-left">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>">
                </a>
            </div>
            <div class="header-center">
                <span class="menu-toggle">&#9776;</span>
                <?php wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => 'nav',
                    'container_class' => 'main-menu',
                )); ?>
            </div>
            <div class="header-right">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <label>
                        <input type="search" class="search-field" placeholder="Procurando por…" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                </form>
                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-button">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    <span>Carrinho</span>
                </a>
                </div>
            </div>
        </div>
    </header>
</body>
</html>
