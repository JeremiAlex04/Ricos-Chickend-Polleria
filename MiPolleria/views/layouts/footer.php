    </main>

    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3>Ricos Chicken</h3>
                <p>Sabor que une familias desde 2015.</p>
            </div>
            <div>
                <ul>
                    <li><a href="<?php echo URLROOT; ?>/">Inicio</a></li>
                    <li><a href="<?php echo URLROOT; ?>/producto/menu">Menú</a></li>
                    <li><a href="<?php echo URLROOT; ?>/producto/ofertas">Ofertas</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/delivery">Delivery</a></li>
                    <li><a href="<?php echo URLROOT; ?>/pages/contacto">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h4>Contacto</h4>
                <p>📍 Av. Delicias #123, Lima</p>
                <p>📞 (01) 123-4567</p>
                <p>📧 pedidos@ricoschicken.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?php echo date('Y'); ?> Ricos Chicken. Todos los derechos reservados.
        </div>
    </footer>

    <div id="logoutModal" class="modal">
        <div class="modal-contenido">
            <span id="closeLogoutModal" class="cerrar">&times;</span>
            <h2>Sesión Cerrada</h2>
            <p>Has cerrado sesión correctamente.</p>
        </div>
    </div>

    <script>
        const URLROOT = "<?php echo URLROOT; ?>";
    </script>
    <script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/carrito.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const logoutModal = document.getElementById('logoutModal');
            const closeLogoutModal = document.getElementById('closeLogoutModal');
            
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('logout_success')) {
                if(logoutModal) {

                    logoutModal.style.display = 'flex'; 
                }

                history.replaceState(null, '', '<?php echo URLROOT; ?>/');
            }

            if(closeLogoutModal) {
                closeLogoutModal.onclick = () => {
                    if(logoutModal) logoutModal.style.display = 'none';
                };
            }
            window.onclick = (event) => {
                if (event.target === logoutModal) {
                    if(logoutModal) logoutModal.style.display = 'none';
                }
            };
        });
    </script>
</body>
</html>
