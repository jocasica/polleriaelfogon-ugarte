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
							<li class="breadcrumb-item active" aria-current="page">Lista de compras</li>
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
	<div class="container-fluid">
		<div class="row">
			<!-- column -->
			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Lista de Compras de insumos</h4>
					<form action="<?= base_url('venta/imprimir') ?>">
					    <button type="submit" class="btn btn-link">aa</button>
					</form>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
									<a href="<?= base_url('compra/create_insumo') ?>" class="btn btn-danger text-white">Registrar compra</a>
								</div>
							</div>
						</div>
						<!-- title -->
					</div>
					<div class="table-responsive">
						<table class="table v-middle">
							<thead>
								<tr class="bg-light">
									<th class="border-top-0">N°</th>
									<th class="border-top-0">Fecha</th>
									<th class="border-top-0">Monto total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($compras_insumos->result() as $c){
								
							?>
								<tr>
									<td>
										<?= $c->id ?>
									</td>
									<td>
										<?= $c->fecha ?>
									</td>
									<td>
										<h5 class="m-b-0">S/<?= $c->total ?></h5>
									</td>
									<td>
										<a href="<?= base_url('compra/edit/'.$c->id) ?>" hidden>
											<i class="ti-pencil-alt"></i> Editar
										</a>
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

			<div class="col-6">
				<div class="card">
					<div class="card-body">
						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Lista de Compras de Gaseosas</h4>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
								<a href="<?= base_url('compra/create_item') ?>" class="btn btn-danger text-white">Registrar compra</a>
								</div>
							</div>
						</div>
						<!-- title -->
					</div>
					<div class="table-responsive">
						<table class="table v-middle">
							<thead>
								<tr class="bg-light">
									<th class="border-top-0">N°</th>
									<th class="border-top-0">Fecha</th>
									<th class="border-top-0">Monto total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($compras_items->result() as $c){
								
							?>
								<tr>
									<td>
										<?= $c->id ?>
									</td>
									<td>
										<?= $c->fecha ?>
									</td>
									<td>
										<h5 class="m-b-0">S/<?= $c->total ?></h5>
									</td>
									<td>
										<a href="<?= base_url('compra/edit/'.$c->id) ?>" hidden>
											<i class="ti-pencil-alt"></i> Editar
										</a>
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
