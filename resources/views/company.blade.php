@extends('layouts.app')

@section('content')

<style>
	.page-item.active .page-link {
	    z-index: 3;
	    color: #fff;
	    background-color: #000!important;
	    border-color: #000!important;
	}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header"><a href="{{ url('/home') }}">Dashboard</a> > Companies</div>

                <div class="card-body">
                	<button class="btn btn-warning" style="float: right;" onclick="newcom()">Add new company</button>
                	<br><br>
                    <table class="table">
                    	<thead class="thead-dark">
                    		<tr>
                    			<th>#</th>
                    			<th>Name</th>
                    			<th>Email</th>
                    			<th>Logo</th>
                    			<th>Website</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($data as $dat)
                    		<tr>
                    			<td>{{ $dat['id'] }}</td>
                    			<td>{{ $dat['name'] }}</td>
                    			<td>{{ $dat['email'] }}</td>
                    			<td class="logo_col" style="background-image: url({{ asset('storage/'.$dat['logo']) }});"></td>
                    			<td>{{ $dat['website'] }}</td>
                    			<td>
                    				<button class="btn btn-secondary" type="button" onclick="editcompany('{{ $dat['id'] }}')">Edit</button>
                    				<button class="btn btn-danger" type="button" onclick="deletecompany('{{ $dat['id'] }}')" style="float: right;">Delete</button>
                    			</td>
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="new-form">
	<p>New Company</p>
	<form action="{{ url('company') }}" method="POST" enctype="multipart/form-data" id="newformsbmt">
		@csrf
		<span id="error_message"></span>
	<table class="table table-borderless">
		<tr>
			<td>Name</td><td><input type="text" name="company" class="form-control"></td>
		</tr>
		<tr>
			<td>Email</td><td><input type="text" name="email" class="form-control"></td>
		</tr>
		<tr>
			<td>Website</td><td><input type="text" name="website" class="form-control"></td>
		</tr>
		<tr>
			<td>Logo</td><td><input type="file" name="logo"></td>
		</tr>
		<tr>
			<td style="width: 50%;"><button class="btn btn-danger" style="width: 100%;" onclick="newcom()" type="button">Cancel</button></td>
			<td style="width: 50%;"><button class="btn btn-success" style="width: 100%;" onclick="submitform()" type="button">Add New</button></td>
		</tr>
	</table>
	</form>
</div>

<div class="edit-form">
	<p id="title"></p>
	
	<table class="table table-borderless">
		<tr>
			<td>Name</td><td><input type="text" name="company" id="icompany" class="form-control"></td>
		</tr>
		<tr>
			<td>Email</td><td><input type="text" name="email" id="iemail" class="form-control"></td>
		</tr>
		<tr>
			<td>Website</td><td><input type="text" name="website" id="iwebsite" class="form-control"></td>
		</tr>
		<tr>
			<td>Logo</td><td><input type="file" name="logo"></td>
		</tr>
		<tr>
			<td style="width: 50%;"><button class="btn btn-danger" style="width: 100%;" onclick="canceleditcom()" type="button">Cancel</button></td>
			<td style="width: 50%;"><button class="btn btn-success" style="width: 100%;" onclick="submiteditform()" type="button">Update</button></td>
		</tr>
	</table>

</div>


<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>

@if($errors->has('company'))
	<script>
		$('.new-form').show();

		$('#error_message').text('Company name is required');
	</script>
@endif

@if($errors->has('email'))
	<script>
		$('.new-form').show();

		$('#error_message').text('Email is required');
	</script>
@endif

@if($errors->has('website'))
	<script>
		$('.new-form').show();

		$('#error_message').text('Website is required');
	</script>
@endif

@if($errors->has('logo'))
	<script>
		$('.new-form').show();

		$('#error_message').text('Logo is required');
	</script>
@endif

<script>
	var editco;
	var vurl;

	function newcom(){
		
		$('.new-form').fadeToggle('fast');
	}

	function submitform(){

		$('#newformsbmt').submit();
	}

	function editcompany(company){

		vurl = "{{ url('/company') }}" + "/" + company;

		$.get(vurl, function(result){

			editco = result.id;
			$('#title').text(result.name);
			$('#icompany').val(result.name);
			$('#iemail').val(result.email);
			$('#iwebsite').val(result.website);
			$('#id').val(result.id);
			
			$('.edit-form').fadeToggle('fast');
		});
	}

	function submiteditform(){

		vurl = "{{ url('/company') }}" + "/" + editco;

		var name = $('#icompany').val();
		var email = $('#iemail').val();
		var website = $('#iwebsite').val();

		// use traditional ajax to use PUT/PATCH/DELETE request
		$.ajax({
		    url: vurl,
		    type: 'PUT',
		    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    data: {name:name,email:email,website:website},
		    success: function(result) {
		        location.reload();
		    }
		});
	}

	function deletecompany(company){

		vurl = "{{ url('/company') }}" + "/" + company;

		// use traditional ajax to use PUT/PATCH/DELETE request
		$.ajax({
		    url: vurl,
		    type: 'DELETE',
		    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    success: function(result) {
		        location.reload();
		    }
		});
	}

	function canceleditcom(){
		$('.edit-form').fadeToggle('fast');
	}
</script>

@endsection