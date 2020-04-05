@if (session('error'))
	<div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
		<strong>Error!</strong> {{ session('error') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif