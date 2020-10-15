<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Insumos</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Insumos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Registrar insumo</li>
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
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<!-- Row -->
		<div class="row">
			<!-- Column -->

			<!-- Column -->
			<!-- Column -->
			<div class="col-lg-7 col-xlg-7 col-md-7">
				<div class="card">
					<div class="card-body">
          
						<!-- title -->
						<div class="d-md-flex align-items-center">
							<div>
								<h4 class="card-title">Registrar insumo</h4>
								<h5 class="card-subtitle" hidden >Overview of Top Selling Items</h5>
							</div>
						</div>
						<!-- title -->
					
            <form class="form-horizontal form-material" method="post" action="<?= base_url('insumo/post') ?>">
            <input type="text" name="id" value="" class="form-control form-control-line" hidden>
							<div class="form-group">
								<label class="col-md-12">Nombre</label>
								<div class="col-md-12">
									<input type="text" name="nombre" value="" class="form-control form-control-line" required>
								</div>
							</div>
							<div class="form-group" >
								<label class="col-md-12">Unidad de medida</label>
								<div class="col-md-12">
									<select type="text" name="unidad_medida" value="" class="form-control form-control-line" required>
                  <option value="">(SELECCIONAR)</option>
                  <option value="UNIDAD">Und.</option>
                  <option value="KILOGRAMO">Kg.</option>
                  <option value="LITRO">Lt.</option>
                  <option value="CAJA">Caja</option>
                  </select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit">Guardar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- Column -->
		</div>
	</div>
