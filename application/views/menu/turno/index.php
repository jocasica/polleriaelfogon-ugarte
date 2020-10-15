<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	
	<div class="page-breadcrumb">
		<div class="row align-items-center">
			<div class="col-5">
				<h4 class="page-title">Turno</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="#">Turno</a></li>
							<li class="breadcrumb-item active" aria-current="page">Turno actual</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-7">
				<div class="text-right upgrade-btn">
					<a href="<?= base_url('turno/create/') ?>" class="btn btn-danger text-white 
          <?php if($turno !=null)
								{
                ?>
                disabled
                <?php 
                }
                ?>
                ">Registrar nuevo turno</a>
				</div>
			</div>
		</div>
	</div>
	<div id="vm_add_companero" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="turno/post_companero/" id="" method="post" accept-charset="utf-8">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
			<h6 class="modal-title" style="color:white">Agregar compañero de turno</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
				<div class="col-md-12">
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
							Agrega al compañero que tiene en este turno.
						</div>
					</div>
					
						<div class="row">
							<div class="form-group col-md-12">
								<label for="producto_unidadmedida">Usuario</label>
								<select class="form-control valid" name="usuario_id">
									<?php foreach($usuarios->result() as $p){
									?>
									<option value="<?= $p->id ?>">
										<?= $p->last_name.' '.$p->first_name ?>
									</option>
									<?php 
									}
									?>
								</select>
							</div>
							<div class="form-group col-md-12" hidden>
								<label for="producto_unidadmedida">Hora llegada</label>
								<input class="form-control valid" name="turno_id" value="<?= $turno->id ?>" />
								<input class="form-control valid" name="hora_llegada" value="<?= $turno->hora_llegada ?>" />
							</div>
						</div>
					
      </div>
      <div class="modal-footer">
				<button type="submit" class="btn btn-success" >Agregar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
			</form>
    </div>

  </div>
</div>
<div id="vm_terminar_turno" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="turno/post_terminar_turno/" id="" method="post" accept-charset="utf-8">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
			<h6 class="modal-title" style="color:white">¿Está seguro de terminar su turno?</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
				<div class="col-md-12">
						<div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
						¿Está seguro de terminar su turno?
						</div>
					</div>
						<div class="row">
							<div class="form-group col-md-12" hidden>
								<label for="producto_unidadmedida">Hora llegada</label>
								<input class="form-control valid" name="turno_id" value="<?= $turno->id ?>" />
							</div>
							<?php 
							foreach($maquinas->result() as $m){
							?>
							<div class="form-group">
								<label for="example-email" class="col-md-12"><b>Producto:</b> <?php echo $m->nombre ?> <b>Isla:</b> <?php echo $m->isla ?> <b>Lado:</b> <?php echo $m->lado ?></label>
								<input type="text" name="maquina_id[]" value="<?php echo $m->id ?>" hidden/>
								<div class="col-md-12">
									<input type="number"
									
									 class="form-control form-control-line" min="0.00" max="100000000.00" step="0.01" name="contometro_salida[]"
									 id="example-email">
								</div>
							</div>
							<?php 
							
							}
							?>
						</div>
					
      </div>
      <div class="modal-footer">
				<button type="submit" class="btn btn-success" >SÍ</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
      </div>
			</form>
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
								<h4 class="card-title">TURNO ACTUAL</h4>
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
									<th class="border-top-0">Encargado</th>
									<th class="border-top-0">Hora llegada</th>
									<th class="border-top-0">Estado</th>
								</tr>
							</thead>
							<tbody>
							<?php if($turno !=null)
								{
                ?>
								<tr>
									<td>
										<div class="d-flex align-items-center">
											<div class="m-r-10">
											<a class="btn btn-circle text-white" style="background-color:#0000ff">GA</a>
											
											    </div>
											<div class="">
												<h4 class="m-b-0 font-16"><?= $turno->last_name.' '.$turno->first_name ?></h4>
											</div>
										</div>
									</td>
									<td><?= $turno->hora_llegada ?></td>
									<td>
										<label class="label label-info"><?php if($turno->estado){echo("ACTIVO");}else{echo("INACTIVO");} ?></label>
									</td>
									<td>
									<?php 
									if($this->ion_auth->user()->row()->id == $turno->usuario_id)
									{
									?>
									<a data-toggle="modal" data-target="#vm_add_companero" type="button">
									
										<u>Agregar compañero</u>
									</a>||
									<a data-toggle="modal" data-target="#vm_terminar_turno" type="button">
										<u>Terminar turno</u>
									</a>
									<?php
									}
									?>
									</td>
								</tr>
								<?php 
                } else{
                ?>
                <tr>
                <td colspan="4"><center>NO HAY TURNO ACTIVO<center/></td>
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
