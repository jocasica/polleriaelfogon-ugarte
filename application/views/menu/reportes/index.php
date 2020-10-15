


<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Reportes</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Reportes</a></li>
							<li class="breadcrumb-item active" aria-current="page">Reportes</li>
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
			<div class="col-md-6">
			<div class="card">
					<div class="card-body">

						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Generar lista de ventas diarios</h4>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
								</div>
							</div>
						</div>
						<!-- title -->

						<form class="form-horizontal form-material" id="frm" method="post" action="">
						<label class="">Fecha</label>
						<input type="date" id="fecha" value="<?= date("Y-m-d") ?>" class="form-control" required>
						</br>
						<button class="btn btn-success" id="btn-venta-reporte" type="button">Generar Reporte</button>
                            <button class="btn btn-info" id="btn-venta-ticket" type="button">Generar ticket</button>

						</form>
					</div>
				</div>
			</div>

			<div class="col-sm-6">
			<div class="card">
					<div class="card-body">

						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Generar reporte de pollos</h4>
								<h5 class="card-subtitle" hidden>Overview of Top Selling Items</h5>
							</div>
							<div class="ml-auto">
								<div class="dl">
								
								</div>
							</div>
						</div>
						<!-- title -->

						<form class="form-horizontal form-material" id="frm" method="post" action="">
						<label class="">Fecha</label>
						<input type="date" id="fecha_p" value="<?= date("Y-m-d") ?>" class="form-control" required>
						</br>
						<button class="btn btn-success" id="btn-venta-reporte-pollo" type="button">Generar Reporte</button>
            

						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
