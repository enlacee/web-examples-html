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
        <legend>Formulario </legend>
        <p><strong>Alcance:</strong> Crear varias aplicaciones funcionales, seguras y optimas para subir ficheros al servidor usando AJAX, PHP y MySQL, utilizaremos plugins especificos que iremos integrando a este proyecto base como ejemplos, luego de desarrollarlos todos chequearemos el rendimiento y requerimientos mínimos de detalles para integrarlos en todos los proyectos que desarrollemos. </p>

        <!-- row -->
        <div class="row">

          <!-- box -->
          <div class="col-xs-12 box box_1">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Selector de Regiones</h3>
              </div>
              <div class="panel-body">
                <div class="row">

                  <div class="col-xs-4 box_input">
					<select id="regions-list" class="form-control required" name="region" aria-required="true">

					</select>
                  </div><!--/ box_input -->

                  <div class="col-xs-4 box_input">
					<select id="provinces-list" class="form-control required" name="province" aria-required="true">

					</select>
                  </div><!--/ box_input -->

                  <div class="col-xs-4 box_input">
					<select id="districts-list" class="form-control required" name="district" aria-required="true">

					</select>
                  </div><!--/ box_input -->

                </div><!--/ row -->
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
var ubigeoPeru = {
	ubigeos: new Array()
};

document.addEventListener('DOMContentLoaded', function() {
	var request = new XMLHttpRequest;
	request.open('GET', './assets/js/ubigeo-peru.json', true);
	request.onload = onLoad_Request;
	request.send();

	function onLoad_Request() {
		if (request.status >= 200 && request.status < 400) {
			ubigeoPeru.ubigeos = JSON.parse(request.responseText);

			showRegionsList();
		}
	}
});

function showRegionsList() {
	var select = document.querySelector('#regions-list');
	select.appendChild(document.createElement("option"));
	select.addEventListener('change', onChange_Region, false);

	ubigeoPeru.ubigeos.forEach(function(ubigeo) {
		if (ubigeo.codprov === 0 && ubigeo.coddist === 0) {
			var option = document.createElement("option");
			var labelContent = ubigeo.coddpto + ' ' + ubigeo.codprov + ' ' + ubigeo.coddist + ' - ' + ubigeo.nombre;
			option.value = ubigeo.coddpto;
			option.text = labelContent;

			select.appendChild(option);
		}
	});
}

function onChange_Region() {
	document.querySelector('#provinces-list').innerHTML = '';
	document.querySelector('#districts-list').innerHTML = '';

	showProvincesList(this.value);
}

function showProvincesList(coddpto) {
	var select = document.querySelector('#provinces-list');
	select.appendChild(document.createElement("option"));
	select.addEventListener('change', onChange_Province, false);

	ubigeoPeru.ubigeos.forEach(function(ubigeo) {
		coddpto = parseInt(coddpto);
		if (ubigeo.coddpto === coddpto && ubigeo.codprov !== 0 && ubigeo.coddist === 0) {
			var option = document.createElement("option");
			var labelContent = ubigeo.coddpto + ' ' + ubigeo.codprov + ' ' + ubigeo.coddist + ' - ' + ubigeo.nombre;
			option.value = ubigeo.codprov;
			option.text = labelContent;

			select.appendChild(option);
		}
	});
}

function onChange_Province() {
	document.querySelector('#districts-list').innerHTML = '';

	var coddpto = document.querySelector('#regions-list option:checked').value;
	showDistrictsList(coddpto, this.value);
}

function showDistrictsList(coddpto, codprov) {
	var select = document.querySelector('#districts-list');
	select.appendChild(document.createElement("option"));

	ubigeoPeru.ubigeos.forEach(function(ubigeo) {
		coddpto = parseInt(coddpto);
		codprov = parseInt(codprov);

		if (ubigeo.coddpto === coddpto && ubigeo.codprov === codprov && ubigeo.coddist !== 0) {
			var option = document.createElement("option");
			var labelContent = ubigeo.coddpto + ' ' + ubigeo.codprov + ' ' + ubigeo.coddist + ' - ' + ubigeo.nombre;
			option.value = ubigeo.coddist;
			option.text = labelContent;

			select.appendChild(option);
		}
	});
}

</script>

</body>
</html>
