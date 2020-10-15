<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Turnos</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Turnos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Crear nuevo turno</li>
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
								<h4 class="card-title">Crear nuevo turno</h4>
								<h5 class="card-subtitle" hidden >Overview of Top Selling Items</h5>
							</div>
						</div>
						<!-- title -->
					
            <form class="form-horizontal form-material" method="post" action="<?= base_url('turno/post') ?>">
            <input type="text" name="id" value="" class="form-control form-control-line" hidden>
							<div class="form-group">
								<label class="col-md-12">Dinero efectivo actual en físico</label>
								<div class="col-md-12">
									<input type="number" name="dinero_efectivo" value="" placeholder="Ejemplo: 1343.20" min="0.00" max="1000000.00" step="0.01" class="form-control form-control-line" required>
								</div>
							</div>
							<?php 
							if($turno == null){
							foreach($maquinas->result() as $m){
							?>
							<div class="form-group">
								<label for="example-email" class="col-md-12"><b>Producto:</b> <?php echo $m->nombre ?> <b>Isla:</b> <?php echo $m->isla ?> <b>Lado:</b> <?php echo $m->lado ?></label>
								<input type="text" name="maquina_id[]" value="<?php echo $m->id ?>" hidden/>
								<div class="col-md-12">
									<input type="number"
									<?php 
                if($turno != null){
                ?>
									readonly 
									value=""
									<?php 
                }
                ?>
									 class="form-control form-control-line" min="0.00" max="100000000.00" step="0.01" name="contometro_llegada[]"
									 id="example-email">
								</div>
							</div>
							<?php 
							}
							}
							?>
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
