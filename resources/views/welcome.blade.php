<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">

    </head>
    <body>
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h2 align="center">Laravel 5.5 Datatable Serverside Processing</h2>
					
					<table id="example" class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Created at</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Created at</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
                </div>
            </div>
        </div>
		
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
		
		<script>
			$('#example').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url":"<?= route('dataProcessing') ?>",
					"dataType":"json",
					"type":"POST",
					"data":{"_token":"<?= csrf_token() ?>"}
				},
				"columns":[
					{"data":"name"},
					{"data":"email"},
					{"data":"created_at"},
					{"data":"action","searchable":false,"orderable":false}
				]
			} );
		</script>
    </body>
</html>
