<?php
/*
//Include connection db
include "connect.php";

//Query
$result = mysql_query( 'SELECT * FROM files' );

while ( $row = mysql_fetch_assoc( $result ) ) {
	//echo "<pre>"; print_r( $row );
}
*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/lib/formvalidation/dist/css/formValidation.min.css">
</head>
<body>

<!-- container -->
<div class="container">
  <div class="row">
    <div class="col-xs-12">

      <!-- form -->
      <form action="./inc/inc_upload.php" name="form" id="form" method="POST" enctype="multipart/form-data">
        <legend>Formulario para subir imagen y documentos al servidor al servidor</legend>
        <p><strong>Alcance:</strong> Crear varias aplicaciones funcionales, seguras y optimas para subir ficheros al servidor usando AJAX, PHP y MySQL, utilizaremos plugins especificos que iremos integrando a este proyecto base como ejemplos, luego de desarrollarlos todos chequearemos el rendimiento y requerimientos mínimos de detalles para integrarlos en todos los proyectos que desarrollemos. </p>

        <!-- row -->
        <div class="row">

          <!-- box -->
          <div class="col-xs-12 box box_1">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Información personal del usuario</h3>
              </div>
              <div class="panel-body">
                <div class="row">

                  <div class="col-xs-6 box_input">
                    <div class="form-group">
                      <label for="names">Nombres y apellidos:</label>
                      <input type="text" class="form-control" name="names" id="names" value="Luis">
                    </div><!--/ input file -->
                  </div><!--/ box_input -->

                  <div class="col-xs-6 box_input">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" name="email" id="email" value="1@1.com">
                    </div><!--/ input file -->
                  </div><!--/ box_input -->

                </div><!--/ row -->
              </div><!--/ panel-body -->
            </div><!--/ panel -->
          </div><!--/ box -->


          <!-- box -->
          <div class="col-xs-12 box box_1">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Imagen del usuario - 1 Max</h3>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <input type="file" class="form-control" name="image" id="image">
                </div><!--/ input file -->
              </div><!--/ panel-body -->
            </div><!--/ panel -->
          </div><!--/ box -->


          <!-- box -->
          <div class="col-xs-12 box box_2">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Documento de identidad del usuario - 2 Max</h3>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <input type="file" class="form-control" name="dni[]" id="dni" multiple>
                </div><!--/ input file -->
              </div><!--/ panel-body -->
            </div><!--/ panel -->
          </div><!--/ box -->



        </div>
        <!--/ row -->


        <div class="row">
          <div class="col-xs-6">
            <button type="submit" class="btn btn-primary">Enviar </button>
          </div>
        </div>

      </form>
      <!--/ form -->

    </div><!--/ col-xs-12 -->
  </div><!--/ row -->
</div><!--/ container -->

<script src="./assets/js/jquery-2.1.4.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/lib/formvalidation/dist/js/formValidation.min.js"></script>
<script src="./assets/lib/formvalidation/dist/js/framework/bootstrap.min.js"></script>

<script>
/**
 * Formvalidation
 * Validamos el formulario
 */
$(function() {
  $("#form")
	.formValidation({
      framework: 'bootstrap',
      icon: {
          valid: 'glyphicon glyphicon-ok',
          invalid: 'glyphicon glyphicon-remove',
          validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
          names: {
              validators: {
                  notEmpty: {
                      message: 'The name name is required'
                  }
              }
          },
          email: {
              validators: {
                  notEmpty: {
                      message: 'The email address is required'
                  },
                  emailAddress: {
                      message: 'The input is not a valid email address'
                  }
              }
          },
          image: {
              validators: {
                  notEmpty: {
                      message: 'The Image is required'
                  }
              }
          },
          'dni[]': {
              validators: {
                  notEmpty: {
                      message: 'The DNI is required'
                  }
              }
          }
      }
  })
  .on('success.form.fv', function(e) {
      // Prevent form submission
      e.preventDefault();

      var $form    = $(e.target),
          formData = new FormData($('#form')[0]);
          //params   = $form.serializeArray(),
          //files    = $form.find('[name="image"]')[0].files;
          //files    = $form.find('[name="dni"]')[0].files;
/*
      $.each(files, function(i, file) {
          // Prefix the name of uploaded files with "image-"
          // Of course, you can change it to any string
          formData.append('image-' + i, file);
          formData.append('dni-' + i, file);
      });

      $.each(params, function(i, val) {
          formData.append(val.name, val.value);
      });
*/
      //Ranom ID
      formData.append('id', Math.random());


      $.ajax({
          url: $form.attr('action'),
          dataType: 'json',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          success: function(response) {
            console.log('response', response);
          	alert( response.message );
          }

      });
  });
});

</script>
<!--/Code javascript and PHP-->
</script>

</body>
</html>
