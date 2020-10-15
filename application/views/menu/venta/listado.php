<div class="page-wrapper">
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
	
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Ventas</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Ventas </a></li>
							<li class="breadcrumb-item active" aria-current="page">Lista de ventas </li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn">
				
				<?php if($registro_pollo==null){ ?>
				  <a href="" data-toggle="modal" data-target="#vm_registrar_pollo" class="btn btn-warning text-white">Registrar pollo del día</a>
				<?php } ?>
					<a href="<?= base_url('venta/index') ?>" class="btn btn-danger text-white">Registrar nueva venta</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid">
		<div class="row">
			<!-- column -->
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Lista de Ventas</h4>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
									<h4 class="m-b-0 font-16">Moneda: SOLES</h4>
								</div>
							</div>
						</div>
						<!-- title -->
					</div>
					<div class="table-responsive">
						<table class="table v-middle">
							<thead>
								<tr class="bg-light">
									<th class="border-top-0">N° de venta</th>
									<th class="border-top-0">Producto</th>
									<th class="border-top-0">Cantidad</th>
									<th class="border-top-0">Fecha</th>
									<th class="border-top-0">Monto total</th>
									<th class="border-top-0">Estado</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($ventas->result() as $v){
								
							?>
								<tr>
									<td>
										<h5 class="m-b-0"><?= $v->id ?></h5>
									</td>
									<td>
										<h5 class="m-b-0"><?= $v->nombre ?></h5>
									</td>
									<td>
										<?= $v->cantidad ?>
									</td>
									<td>
										<?= $v->created_at ?>
									</td>
									
									<td>
										<h5 class="m-b-0">S/<?= $v->total ?></h5>
									</td>
									<td>
										<label class="label label-warning">Activo</label>
									</td>
									<td>
									<!--<a href="<?= base_url('prueba?tipo=ticket&id='.$v->id) ?>">Ver ticket</a> ya no se visualizará los ticket--> 
									</td>
								</tr>
								<?php 
								}
							?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url() ?>panel/assets/libs/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
    jQuery(function($){
			$(document).on("click", ".terminar-venta", function () {
          var id = $(this).data('id');
					var total = $(this).data('monto');
          $(".modal-body #venta_id").val( id );
					$(".modal-body #total").val( total );
          // As pointed out in comments, 
          // it is superfluous to have to manually call the modal.
          // $('#addBookDialog').modal('show');
      });
			$("#dinero_recibido").on("input",function(){
				$("#dinero_vuelto").val(parseFloat($(this).val()-$("#total").val()).toFixed(2));
			});
			$("#frm-terminarventa").on("submit",function(e){
				
				if(parseFloat($("#dinero_recibido").val()) < parseFloat($("#total").val()))
				{
					e.preventDefault();
					alert("El dinero recibido no puede ser menor que el monto a pagar.");
				}
				
			});
    });

  </script>