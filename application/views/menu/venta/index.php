w<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div id="vm_registrar_pollo" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">

					<h6 class="modal-title" style="color:white">Registre la cantidad de pollos del día</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="col-md-12">
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
							Registre la cantidad de pollos del día.
						</div>
					</div>
					<form action="<?= base_url('venta/postRegistroPollo') ?>" id="" method="post" accept-charset="utf-8">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="producto_unidadmedida">Producto</label>
								<select class="form-control valid" value="1" name="item_id" hidden>
								<input class="form-control valid" value="Pollo" disabled/>
							</div>
							<div class="form-group col-md-12">
								<label for="producto_preciounidad">Cantidad</label>
								<input type="number" class="form-control" value="" name="cantidad_pollo" min="0" max="9999999" step="1" required>
							</div>
							<div class="form-group col-md-12">
								<label for="producto_preciounidad">Fecha</label>
								<input type="text" class="form-control" value="<?php echo date('d/m/Y') ?>" disabled>
							</div>

							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-success" id="">Guardar</button>
								<button type="button" style="float:right" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
    <div id="vm_pedido" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">

					<h6 class="modal-title" style="color:white">Está pidiendo </h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<form action="" id="frm-pedido" method="post" accept-charset="utf-8">
						<div class="row">
							<div class="form-group col-md-4">
								Pedido
							</div>
							<div class="form-group col-md-8">
								<input type="text" id="pedido" class="form-control" readonly>
								<input type="text" id="pedido_id" class="form-control" hidden>
							</div>
							<div class="form-group col-md-4">
								Cantidad
							</div>
							<div class="form-group col-md-8">
								<input type="number" id="cantidad" step=".01" min="1" max="999" class="form-control" required>
							</div>
						
							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-success" id="">Aceptar</button>
								<button type="button" style="float:right" class="btn btn-danger closes" data-dismiss="modal">Cancelar</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Ventas</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Nueva Venta</a></li>
							<li class="breadcrumb-item active" aria-current="page"></li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn">
				<a href="<?= base_url('venta/listado') ?>" class="btn btn-success text-white">Ver ventas</a>
				<?php if($registro_pollo){ ?>
				  <a href="" data-toggle="modal" data-target="#vm_registrar_pollo" class="btn btn-warning text-white">Registrar pollo del día</a>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
<?php foreach($prods->result() as $p){ ?>

			<div class="col-lg-2 col-xlg-3 col-md-4" >
				<div class="card" style="background-color:powderblue; border-radius: 20px;">
					<center class="m-t-30">
						<a href="" class="terminar-venta btn" data-id="<?php echo $p->id ?>" data-pedido="<?= $p->nombre ?>" data-toggle="modal" data-target="#vm_pedido">
					<img width="130" height="100" src="data:image/jpeg;base64,<?= base64_encode( $p->imagen )?>" class="rounded-circle" />
					</a>
					<div style="height: 65px;"><h4 class="card-title m-t-10"><?= $p->nombre ?></h4></div>
					
					<div class="row text-center justify-content-md-center">

								<div class="col-12">
										<font class="font-medium">S/<?= $p->precio ?></font>
									
								</div>
							</div>
					
					<div>
					</div>
					<a href="" style="width: 105px;" class="terminar-venta btn btn-danger" data-id="<?php echo $p->id ?>" data-pedido="<?= $p->nombre ?>" data-toggle="modal" data-target="#vm_pedido">
											ELEGIR
										</a>

				</div>
			</div>
<?php } ?>
		</div>

	</div>
</div>
<script src="<?= base_url() ?>panel/assets/libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
		function guardarVenta(id) {              
			console.log("wlp"+id);
		}
    jQuery(function($){
			$(document).on("click", ".terminar-venta", function () {
                      var id   = $(this).data('id');
					var pedido = $(this).data('pedido');
                    $(".modal-body #pedido_id").val( id );
					$(".modal-body #pedido").val( pedido );
					$(".modal-body #cantidad").val( 1 );
      });
			$("#dinero_recibido").on("input",function(){
				$("#dinero_vuelto").val(parseFloat($(this).val()-$("#total").val()).toFixed(2));
			});
			$("#frm-pedido").on("submit",function(e){
			    
				e.preventDefault();
				
				url_envio = "<?= base_url() ?>"+"venta/post?id="+$("#pedido_id").val()+"&cantidad="+$("#cantidad").val();
				
				//console.log(url);
				
				//alert(url);
		
				//$('.closes').click(); 
				
            
            $.ajax({
            
            url:url_envio,
            type:'GET',
            data:{},
            dataType:'JSON',
            beforeSend:function(){
            
            
            },
            success:function(data){
            
            cab  = data;
            
            
            swal({
  title: "Imprimir Ticket",
  text: "",
  //type: "warning",
  showCancelButton: false,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Imprimir",
  closeOnConfirm: false
},
function(){


 $.ajax({
  
  url:'http://localhost/api/print.php',
  type:'GET',
data:{'cab':JSON.stringify(cab)},
  beforeSend:function(){


     swal({

   title : 'Cargando',
   text  : 'Espere un momento',
   showConfirmButton:false
   });



  },
  success:function(data){

      swal({

   title : 'Impresión Exitosa',
   text  : '',
   type  : 'success',
   timer : 3000,
   showConfirmButton:false
   });

$('.close').click(); 

//$('#vm_pedido').modal('hide');


  /*
    setInterval(function(){


    location.reload();

    },3000);*/



}


 });





});
            
            
            
            
            }
            
            
            });
		
				
				
			
				
				
			});
    });

  </script>