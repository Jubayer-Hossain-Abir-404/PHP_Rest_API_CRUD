<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>REST API CRUD using PHP Mysql</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	
</head>
<body>
	<div class="container">
		<br>

		<h3 align="center">REST API CRUD using PHP Mysql</h3>
		<br>
		<div align="right" style="margin-bottom:5px;">
			<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>

	<div id="apicrudModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" id="api_crud_form">
				    <div class="modal-header">
				        <h4 class="modal-title">Add Data</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
				    <div class="modal-body">
				        <div class="form-group">
				            <label>Enter First Name</label>
				            <input type="text" name="first_name" id="first_name" class="form-control" />
				        </div>
				        <div class="form-group">
				            <label>Enter Last Name</label>
				            <input type="text" name="last_name" id="last_name" class="form-control" />
				        </div>
				    </div>
				    <div class="modal-footer">
				        <input type="hidden" name="hidden_id" id="hidden_id" />
				        <input type="hidden" name="action" id="action" value="insert" />
				        <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				    </div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		// alert("Success");
		$(document).ready(function(){
			// alert("Success");
			fetch_data();
			// alert("Success");
			function fetch_data(){
				$.ajax({
					url:"fetch.php",
					success: function(data){
						// alert("Success");
						$('tbody').html(data);
					}
				})
			}

			$('#add_button').click(function(){
				$('#action').val('insert');
			    $('#button_action').val('Insert');
			    $('.modal-title').text('Add Data');
			    $('#apicrudModal').modal('show');
			});

			$('#api_crud_form').on('submit', function(event){
				event.preventDefault();
				if($('#first_name').val() == ''){
					alert("Enter First Name");
				}else if($('#last_name').val() == ''){
					alert("Enter Last Name");
				}else{
					var form_data = $(this).serialize(); //this will convert form data to url encoded string
					$.ajax({
						url: "action.php",
						method: "POST",
						data: form_data,
						success: function(data){
							fetch_data();
							$('#api_crud_form')[0].reset();
							$('#apicrudModal').modal('hide');
							if(data == 'insert'){
								alert("Data Inserted using PHP API");
							}
							if(data == 'update'){
						      alert("Data Updated using PHP API");
						    }
						}
					});
				}
			});
			$(document).on('click', '.edit', function(){
				var id = $(this).attr('id');
				var action = 'fetch_single';
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id, action:action},
					dataType: "json",
					success:function(data){
						$('#hidden_id').val(id);
						$('first_name').val(data.first_name);
						$('last_name').val(data.last_name);
						$('#action').val('update');
						$('#button_action').val('Update');
						$('.modal-title').text('Edit Data');
						$('#apicrudModal').modal('show');
					}
				})
			});

		});
	</script>

</body>

</html>