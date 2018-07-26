<?php
   require_once 'Paginator.class.php';

   $conn = new mysqli( 'localhost', 'root', '', 'rampmart' );

   $limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 12;
   $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
   $links = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 4;

   $query = "SELECT * FROM tbl_categories";

   $Paginator = new Paginator( $conn, $query );

   $results = $Paginator->getData( $limit, $page );
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>PHP Pagination</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	</head>
	<body>

		<div class="container">
			<div class="col-md-10 col-md-offset-1">

				<h1>PHP Pagination</h1>
				<table class="table table-striped table-condensed table-bordered table-rounded">

					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="30%">Category</th>
							<th width="60%">Sub Category</th>
						</tr>
					</thead>

				<tbody>
               <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
               <tr>
                  <td><?php echo $results->data[$i]['category_id']; ?></td>
                  <td><?php echo $results->data[$i]['category_name']; ?></td>
                  <td><?php echo $results->data[$i]['sub_categories']; ?></td>
               </tr>
               <?php endfor; ?>
				</tbody>

			</table>

         <?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?>

		</div>
	</div>

</body>
</html>