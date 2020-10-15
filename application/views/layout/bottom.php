
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>panel/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>panel/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>panel/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>panel/dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>panel/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>panel/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>panel/dist/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="<?= base_url() ?>panel/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="<?= base_url() ?>panel/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="<?= base_url() ?>panel/dist/js/pages/dashboards/dashboard1.js"></script>
    <script type="text/javascript">
    jQuery(function($){
        
        $('#producto_cantidad').on('input',function(){
            var cantidad = $('#producto_cantidad').val();
            var precio = $('#producto_precio_unidad').val();
            $('#producto_total').val(parseFloat(cantidad*precio).toFixed(2));
            
        });
        $('#btn-venta-reporte-pollo').on('click',function(e){
            var fecha = $("#fecha_p").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=pollo_diario&id=2&fecha="+fecha , "_blank");
        });
        $('#btn-dbf').on('click',function(e){
            var mes = $("#mes_concar").val();
            var ano = $("#ano_concar").val();
            var doc = $("#doc_concar").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=dbf&id=1&mes="+mes+"&ano="+ano+"&doc="+doc , "_blank");
        });
        $('#btn-kardex').on('click',function(e){
            var id = $("#producto_kardex").val();
            var mes = $("#mes_kardex").val();
            var ano = $("#ano_kardex").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=kardex&id="+id+"&mes="+mes+"&ano="+ano , "_blank");
        });
        $('#btn-venta-reporte').on('click',function(e){
            var fecha = $("#fecha").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=venta_diaria&id=2&fecha="+fecha , "_blank");
        });
        $('#btn-venta-ticket').on('click',function(e){
            var fecha = $("#fecha").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=ticket_diario&id=2&fecha="+fecha , "_blank");
        });
        $('#btn-concar').on('click',function(e){
            var mes = $("#mes_concar").val();
            var ano = $("#ano_concar").val();
            var doc = $("#doc_concar").val();
            window.open("<?= base_url() ?>"+"prueba?tipo=concar&id=1&mes="+mes+"&ano="+ano+"&doc="+doc , "_blank");
        });
        $('#table_compra').on('click','.delete',function(e){
            e.preventDefault();
            $(this).parents('tr').remove();
        });
        $('#frms').on('submit',function(e){
            e.preventDefault();
            console.log($(this).serialize());
        });
        $('#modal-frm').on('submit',function(e){
            e.preventDefault();
            $('#table_compra').append(
            '<tr>'+
                '<td>'+
                    '<div class="d-flex align-items-center">'+
                        
                        '<h4 class="m-b-0 font-16">'+$("#producto_id option:selected").text().trim()+'</h4>'+
                    '</div>'+
                '</td>'+
                '<td>'+$("#producto_precio_unidad").val()+'</td>'+
                '<td>'+$("#producto_cantidad").val()+'</td>'+
                '<td>'+
                    '<h5 class="m-b-0" >'+($("#producto_cantidad").val()*$("#producto_precio_unidad").val()).toFixed(2)+'</h5>'+
                '<td>'+
                    '<a href="" class="delete"> Eliminar</a>'+
                    '<input name="producto_id[]" value="'+$('#producto_id').val()+'" hidden>'+
                    '<input name="precio_unidad[]" value="'+$('#producto_precio_unidad').val()+'" hidden>'+
                    '<input name="cantidad[]" value="'+$('#producto_cantidad').val()+'" hidden>'+
                    '<input name="total[]" value="'+($("#producto_cantidad").val()*$("#producto_precio_unidad").val()).toFixed(2)+'" hidden>'+
                '</td>'+
            '</tr>');
            $('#producto_precio_unidad').val("");
            $('#producto_cantidad').val("");
            $('#vm_agregar_articulo').modal('toggle');
        });
    });
    
    </script>
    
<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</body>

</html>