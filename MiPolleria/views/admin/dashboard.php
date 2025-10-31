<?php require_once APPROOT . '/views/layouts/admin_header.php'; ?>

<!-- Contenido específico del Dashboard -->
<div class="dashboard-cards">
    <div class="card">
        <h3>Productos Totales</h3>
        <p>12</p> <!-- Dato de ejemplo -->
    </div>
    <div class="card">
        <h3>Pedidos Recientes</h3>
        <p>5</p> <!-- Dato de ejemplo -->
    </div>
    <div class="card">
        <h3>Usuarios Registrados</h3>
        <p>4</p> <!-- Dato de ejemplo -->
    </div>
</div>

<style>
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    .dashboard-cards .card {
        background-color: var(--primary-color);
        color: white;
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
    }
    .dashboard-cards .card h3 { font-size: 1.2rem; }
    .dashboard-cards .card p { font-size: 2.5rem; font-weight: 700; margin-top: 0.5rem; }
</style>

<?php require_once APPROOT . '/views/layouts/admin_footer.php'; ?>
