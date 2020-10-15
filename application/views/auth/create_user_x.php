<h1>CREAR USUARIO <?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_user");?>

      <p>
            Nombres <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            Apellidos <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
      
      <?php
      if($identity_column!=='email') {
          echo '<p>';
          echo lang('create_user_identity_label', 'identity');
          echo '<br />';
          echo form_error('identity');
          echo form_input($identity);
          echo '</p>';
      }
      ?>

      <p>
            Nombre de la Compañía <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            Correo electrónico <?php echo lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            Celular<?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            Contraseña <?php echo lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            Confirmar contraseña <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
      </p>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>
