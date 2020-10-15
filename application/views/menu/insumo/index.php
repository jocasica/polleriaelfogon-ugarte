<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Items</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Items</a></li>
							<li class="breadcrumb-item active" aria-current="page">Lista de Items</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn">
					<a href="insumo/create" class="btn btn-danger text-white">Registrar nuevo insumo</a>
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
								<h4 class="card-title">Lista de Items</h4>
								<h5 class="card-subtitle" hidden >Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto" >
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
									<th class="border-top-0">Nombre</th>
									<th class="border-top-0">Unidad de medida</th>
									<th class="border-top-0">Stock</th>
									<th class="border-top-0">Estado</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($insumos->result() as $p){
								
							?>
								<tr>
									<td>
                    <h5 class="m-b-0"><?= $p->nombre ?></h5>
									</td>
									<td><?= $p->unidad_medida ?></td>
									<td>
										<?= $p->stock ?>
									</td>
									<td>
										<label class="label label-info">Habilitado</label>
									</td>
									
									<td>
									
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
