<!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mundwerk Patientenliste</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <style>
      body {
        font-family: 'Open Sans', regular;
        font-size: 12px;
        max-height: 100vh;
      }
    </style>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
		<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" language="javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	
  </head>
  <body>
  	<img src="sticky.png" alt="Mundwerk" width="50px" align="left">
  	<h1>Mundwerk Patientenliste</h1>

	  <table id='telefonliste' data-order='[[ 0, "asc" ]]' data-page-length='25' class="stripe compact">
	    <thead>
	        <tr>
	            <th>Name</th>
	            <th>Vorname</th>
				<th>Namenszusatz / Einrichtung</th>
	            <th>Str</th>
	            <th>Ort</th>
	            <th>Tel</th>
				<th>nÃ¤chster Termin</th>
				<th>von</th>
				<th>bis</th>
				<th>Behandler Name</th>
				<th>Behandler Vorname</th>
	        </tr>
	    </thead>
		<tbody>
			<?php
			$pdo = new PDO('mysql:host=localhost;dbname=openphysio', .$_ENV["DB_USER"], .$_ENV["DB_PASSWORD"]);
			$sql = 'SELECT p.id, p.surname, p.forename, p.street, p.city, p.tel, DATE_FORMAT(nd.Termin,\'%d %b %y\') as Termin, nd.d_start as von, nd.d_end as bis, nd.surname as bh_name, nd.forename as bh_vname, nd.shortname FROM patients as p LEFT JOIN next_date as nd ON (p.id = nd.pid)';
			
			foreach ($pdo->query($sql) as $row) {
			   echo '<tr>';
			   echo '<td data-search="'.$row['surname'].'" >'.$row['surname'].'</td> ';
			   echo '<td data-search="'.$row['forename'].'" >'.$row['forename'].'</td> ';
			   echo '<td data-search="'.$row['addname'].'" >'.$row['addname'].'</td> ';
			   echo '<td data-search="'.$row['street'].'" >'.$row['street'].'</td> ';
			   echo '<td data-search="'.$row['city'].'" >'.$row['city'].'</td> ';
			   echo '<td data-search="'.$row['tel'].'" >'.$row['tel'].'</td> ';
			   echo '<td>'.$row['Termin'].'</td> ';
			   echo '<td>'.$row['von'].'</td> ';
			   echo '<td>'.$row['bis'].'</td> ';
			   echo '<td data-search="'.$row['bh_name'].'" >'.$row['bh_name'].'</td> ';
			   echo '<td data-search="'.$row['bh_vname'].'" >'.$row['bh_vname'].'</td> ';
			   echo '</td>';
			}
			?>
			</tbody>
		</table>
			<script type="text/javascript" class="init">
		
			$(document).ready(function() {
				$('#telefonliste').DataTable();
			} );
		</script>
  </body>
</html>




