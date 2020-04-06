	<div class="row">
		<div class="col-lg-12">
			<div class="card-box">
				<div class="card-widgets">
					<form class="form-inline">
						<div class="form-group">
							<div class="input-group input-group-sm">
								<select class="form-control" data-toggle="select2" style="width:100%" id="list_year"></select>
							</div>
							<div class="input-group input-group-sm">
								<select class="form-control" data-toggle="select2" style="width:100%" id="list_month"></select>
							</div>
						</div>
						<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
							<i class="mdi mdi-filter-variant"></i>
						</a>
						<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-2">
							<i class="mdi mdi-autorenew"></i>
						</a>
						<a href="javascript: void(0);" class="btn btn-blue btn-sm ml-1">
							<i class="mdi mdi-download"></i>
						</a>
					</form>
				</div>
				<h4 class="header-title">Inverse table</h4>
				<p class="sub-header">asdadas</p>

				<div class="table-responsive">
					<table class="table table-dark mb-0">
						<thead>
							<tr>
								<th>#</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Username</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td>@mdo</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Jacob</td>
								<td>Thornton</td>
								<td>@fat</td>
							</tr>
							<tr>
								<th scope="row">3</th>
								<td>Larry</td>
								<td>the Bird</td>
								<td>@twitter</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div> <!-- end card-box -->
		</div> <!-- end col -->
	</div>
	<!-- Plugins JS -->
	<script src="<?php echo base_url(); ?>assets/libs/select2/select2.min.js"></script>
	<script type="text/javascript">
		$("select").select2({
			placeholder: "Please select option"
		});
	</script>