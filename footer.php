<footer>
    <div class="footer-container">
        <div class="footer-content">
        <div class="footer-up">
        <div class="footer-column">
        </div>
        <div class="footer-column">
            <h4>INSTITUCIONAL</h5>
            <ul>
                <li><a href="#">Aviso Legal</a></li>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Política de Reembolso</a></li>
                <li><a href="#">Política de Trocas e Devoluções</a></li>
                <li><a href="#">Política de Frete</a></li>
                <li><a href="#">Política de Pagamento</a></li>
                <li><a href="#">Termos de Serviço</a></li>
            </ul>
        </div>
        <div class="footer-column">
        <h4>CATEGORIAS</h5>
            <ul>
                <li><a href="#"></a></li>
                <li><a href="#">Brinquedos</a></li>
                <li><a href="#">Cama, Mesa e Banho</a></li>
                <li><a href="#">Decoração</a></li>
                <li><a href="#">Espaço Pet</a></li>
                <li><a href="#">Utilidades</a></li>
            </ul>
        </div>
        <div class="footer-column">
        <h4>CENTRAL DE ATENDIMENTO</h4>
            <p>Atendimentos: seg. à sáb. 09 às 18h</p>
            <p>E-mail: <?php echo $GLOBALS['storeEmail']; ?></p>
            <p>Telefone: <?php echo $GLOBALS['storePhone']; ?></p>
        </div>
</div>
        <div class="footer-down">
            <h5>Formas de Pagamento</h3>
            <div class="footer-img">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/visa.png" alt="payment-methods">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/master.png" alt="payment-methods">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/amex.png" alt="payment-methods">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/diners.png" alt="payment-methods">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/elo.png" alt="payment-methods">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer/pix.png" alt="payment-methods">
            </div>
            <p>©2024 <?php echo $GLOBALS['storeName']; ?> | CNPJ <?php echo $GLOBALS['storeCnpj']; ?></p>
        </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>
