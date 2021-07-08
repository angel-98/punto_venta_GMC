<?php
    //session_start();
    $productos = $_SESSION['products'];
?>

<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <div class="input-group">
                    <h6 class="modal-title">Carrito de compras</h6>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="mi-tabla" class="table table-responsive-lg table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Presentación</th>
                            <th scope="col">Precio</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id='content'>
                    </tbody>
                </table>
                <a href="<?= base_url(); ?>/register_sale/" class="btn btn-success btn-sm btn-block p-2">PROCESAR VENTA</a>
                <a href="#" class="btn btn-danger btn-sm btn-block p-2" onclick="cleanCart()">VACIAR CARRITO</a>
            </div>
        </div>
    </div>
</div>