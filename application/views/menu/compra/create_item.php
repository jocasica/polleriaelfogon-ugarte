<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Compras</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Compras</a></li>
							<li class="breadcrumb-item active" aria-current="page">Registrar compra</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn">
				</div>
			</div>
		</div>
	</div>
	<div id="vm_agregar_articulo" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-primary">

					<h6 class="modal-title" style="color:white">Agregar Item</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="col-md-12">
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
							Agrega un item comprado, registrando la cantidad y el precio unitario por el que se compró.
						</div>
					</div>
					<form action="/" id="modal-frm" method="post" accept-charset="utf-8">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="producto_unidadmedida">Item</label>
								<select class="form-control valid" id="producto_id" required>
									<?php foreach($items->result() as $p){
									?>
									<option value="<?= $p->id ?>">
										<?= $p->nombre ?>
									</option>
									<?php 
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-12">
								<label for="producto_preciounidad">Precio Unidad (Incluido IGV)</label>
								<input type="number" class="form-control" value="" id="producto_precio_unidad" min="0.01" max="9999999" step=".01" required>
							</div>
							<div class="form-group col-md-12">
								<label for="producto_cantidad">Cantidad</label>
								<input type="number" class="form-control" value="" id="producto_cantidad" step=".01" min="0.01" max="9999999" required>
							</div>
							<div class="form-group col-md-12">
								<label for="producto_total">Total</label>
								<input type="number" class="form-control" value="" id="producto_total" disabled="disabled" step=".01" required>
							</div>

							<div class="form-group col-md-12">
								<button type="submit" class="btn btn-success" id="btn_add_producto">Agregar</button>
								<button type="button" style="float:right" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
			<!-- Column -->

			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-8 col-xlg-8 col-md-8">
				<div class="card">
					<div class="card-body">

						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Registrar Compra</h4>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
									<h4 class="m-b-0 font-16">Moneda: SOLES</h4>
								</div>
							</div>
						</div>
						<!-- title -->

						<form class="form-horizontal form-material" id="frm" method="post" action="<?= base_url('compra/post_item') ?>">
							
							<div class="form-group">
								<label class="col-md-12">Fecha</label>
								<div class="col-md-12">
									<input type="date" name="fecha" value="" class="form-control form-control-line" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									
									<button class="btn btn-info" style="float:right" data-toggle="modal" data-target="#vm_agregar_articulo" type="button">Agregar
										item</button>
								</div>
							</div>
							<div class="form-group">

								<br>

							</div>
							<div class="form-group">

								<div class="table-responsive">

									<table class="table v-middle">
										<thead class="thead-light">
											<tr class="bg-light ">
												<th class="border-top-0">Item</th>
												<th class="border-top-0">Precio Unidad</th>
												<th class="border-top-0">Cantidad</th>
												<th class="border-top-0">Total</th>
												<th class="border-top-0">Opciones</th>
											</tr>
										</thead>
										<tbody id="table_compra">


											


										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group">

								<h4 class="m-b-0 font-16" style="float:right">Moneda: SOLES</h4>

							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit">Guardar Compra</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
	</div>
