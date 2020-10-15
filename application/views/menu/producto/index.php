<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Productos</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Productos</a></li>
							<li class="breadcrumb-item active" aria-current="page">Lista de productos</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn" HIDDEN>
					<a href="" class="btn btn-danger text-white" target="_blank">Registrar nuevo producto</a>
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
					<img width="120" height="90" src="data:image/jpeg;base64,<?= base64_encode( $p->imagen )?>" class="rounded-circle" />
					<div style="height: 65px;"><h4 class="card-title m-t-10"><?= $p->nombre ?></h4></div>
					
					<div class="row text-center justify-content-md-center">

								<div class="col-12">
										<font class="font-medium">S/<?= $p->precio ?></font>
									
								</div>
							</div>
					
					<div>
					</div>
				</div>
			</div>
<?php } ?>
		</div>

	</div>

</div>
</div>
