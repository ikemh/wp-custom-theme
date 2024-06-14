<?php get_header(***REMOVED***; ?>
<main>
    <div class="front-page-content">
        <section id="banner-slide">
            <div class="slide-container">
                <div class="slides">
                    <div class="slide fade">
                        <img src="<?php echo get_template_directory_uri(***REMOVED***; ?>/assets/images/slide1.png" alt="Slide 1">
                    </div>
                    <div class="slide fade">
                        <img src="<?php echo get_template_directory_uri(***REMOVED***; ?>/assets/images/slide2.png" alt="Slide 2">
                    </div>
                    <div class="slide fade">
                        <img src="<?php echo get_template_directory_uri(***REMOVED***; ?>/assets/images/slide3.png" alt="Slide 3">
                    </div>
                </div>
                <div class="dots">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section>

        <!-- Seções por Categorias -->
        <section id="categories">
            <div class="categories-container">
                <?php
                $product_categories = get_terms('product_cat', array('hide_empty' => true***REMOVED******REMOVED***;
                foreach ($product_categories as $category***REMOVED*** {
                    echo '<div class="category-block">';
                    echo '<h1>' . $category->name . '</h1>';
                    echo do_shortcode('[products category="' . $category->slug . '" columns="4"***REMOVED***'***REMOVED***;
                    echo '<div class="slider-buttons">';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>

        <!-- Banner Final -->
        <section id="final-banner">
            <div class="final-banner-container">
                <?php
                // Exemplo de banner final, adicione o seu código de banner aqui
                echo '<img src="' . get_template_directory_uri(***REMOVED*** . '/assets/images/main/final-banner.png" alt="Final Banner">';
                ?>
            </div>
        </section>
    </div>
</main>
<?php get_footer(***REMOVED***; ?>
