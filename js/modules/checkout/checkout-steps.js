export function initCheckoutSteps() {
    jQuery(document).ready(function($) {
        // Step 1 - Handle email validation and field reveal
        $('#billing_email').on('blur', function() {
            if ($(this).val() !== '') {
                $('#additional-step-1-fields').show();
            }
        });

        $('#next-step-1').on('click', function() {
            if ($('#billing_email').val() === '') {
                alert(woocommerce_params.i18n_fill_email);
                return;
            }
            $('#step-1').removeClass('active').hide();
            $('#step-2').addClass('active').show();
        });

        // Step 2 - Handle postcode validation and field reveal
        $('#billing_postcode').on('blur', function() {
            if ($(this).val() !== '') {
                $('#additional-step-2-fields').show();

                // Fetch city and state based on postcode
                $.ajax({
                    url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/',
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.localidade && data.uf) {
                            $('#billing_city').val(data.localidade);
                            $('#billing_state').val(data.uf);
                        }
                    }
                });
            }
        });

        $('#next-step-2').on('click', function() {
            if ($('#billing_postcode').val() === '') {
                alert(woocommerce_params.i18n_fill_postcode);
                return;
            }
            $('#step-2').removeClass('active').hide();
            $('#step-3').addClass('active').show();
        });
    });
}


document.addEventListener('DOMContentLoaded', function() {
    const summaryTitle = document.querySelector('.order-summary h2');
    const cartItems = document.querySelector('.cart-items');
    const arrow = document.createElement('i');

    arrow.classList.add('fa-solid', 'fa-chevron-down', 'arrow');
    summaryTitle.appendChild(arrow);

    summaryTitle.addEventListener('click', function() {
        cartItems.classList.toggle('show');
        arrow.classList.toggle('collapsed');
    });
});