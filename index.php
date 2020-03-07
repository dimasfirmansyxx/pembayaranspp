<?php 

include 'config/functions.php';

$myfunc = new functions();
$myfunc->set_title("Beranda");
$myfunc->set_subtitle("");
$myfunc->set_breadcrumbs("HOME /");

include 'templates/head.php';
include 'templates/nav.php';
?>

<div class="content-section mt-5">
	<div class="card">
		<div class="card-header bg-warning text-white">
			{CARD TITLE}
		</div>
		<div class="card-body">
			<h3>Button</h3>
			<button class="btn btn-primary">Primary</button>
			<button class="btn btn-danger">Danger</button>
			<button class="btn btn-warning">Warning</button>
			<button class="btn btn-success">Success</button>

			<h3 class="mt-5">Table</h3>
			<div class="table-responsive">
				<table class="table">
					<thead class="bg-warning text-white">
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Age</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>John Doe</td>
							<td>34</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jane Doe</td>
							<td>32</td>
						</tr>
					</tbody>
				</table>
			</div>

			<h3 class="mt-5">Forms</h3>
			<div class="form-group">
				<label>Input</label>
				<input type="text" class="form-control" value="value">
			</div>
			<div class="form-group">
				<label>Combobox</label>
				<select class="form-control">
					<option>Option 1</option>
					<option>Option 2</option>
					<option>Option 3</option>
				</select>
			</div>
			<div class="form-group">
				<label>Textarea</label>
				<textarea class="form-control"></textarea>
			</div>

			<h3 class="mt-5">Alert</h3>
			<div class="alert bg-primary text-white">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="alert bg-danger text-white">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="alert bg-warning text-white">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>
			<div class="alert bg-success text-white">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
			</div>

		</div>
	</div>
</div>

<?php
	include 'templates/footer.php';
?>