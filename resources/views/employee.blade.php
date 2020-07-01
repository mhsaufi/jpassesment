@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ url('/home') }}">Dashboard</a> > Employees</div>

                <div class="card-body">
                	<button class="btn btn-warning" style="float: right;" onclick="newcom()">Add new employee</button>
                	<br><br>
                    <table class="table">
                    	<thead class="thead-dark">
                    		<tr>
                    			<th>#</th>
                    			<th>First Name</th>
                    			<th>Last Name</th>
                    			<th>Company</th>
                    			<th>Email</th>
                    			<th>Phone</th>
                                <th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    		@foreach($data as $data)
                    		<tr>
                    			<td>{{ $data['id'] }}</td>
                    			<td>{{ $data['first_name'] }}</td>
                    			<td>{{ $data['last_name'] }}</td>
                    			<td>{{ $data['company']['name'] }}</td>
                    			<td>{{ $data['email'] }}</td>
                                <td>{{ $data['phone'] }}</td>
                    			<td>
                    				<button class="btn btn-secondary" style="margin-right: 5px;" type="button" onclick="editemployee('{{ $data['id'] }}')">Edit</button>
                    				<button class="btn btn-danger" type="button" onclick="deleteemployee('{{ $data['id'] }}')">Delete</button>
                    			</td>
                    		</tr>
                    		@endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="new-form" style="width: 30%!important;">
    <p>New Employee Form</p>
    <form action="{{ url('employee') }}" method="POST" enctype="multipart/form-data" id="newformsbmt">
        @csrf
        <span id="error_message"></span>
    <table class="table table-borderless">
        <tr>
            <td>First Name</td><td><input type="text" name="fn" class="form-control"></td>
        </tr>
        <tr>
            <td>Last Name</td><td><input type="text" name="ln" class="form-control"></td>
        </tr>
        <tr>
            <td>Email</td><td><input type="text" name="email" class="form-control"></td>
        </tr>
        <tr>
            <td>Phone</td><td><input type="text" name="phone" class="form-control"></td>
        </tr>
        <tr>
            <td>Company</td>
            <td>
                <select name="company" class="form-control">
                    <option></option>
                    @foreach($com as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </td>
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
            <td>First Name</td><td><input type="text" name="fn" id="ifn" class="form-control"></td>
        </tr>
        <tr>
            <td>Last Name</td><td><input type="text" name="ln" id="iln" class="form-control"></td>
        </tr>
        <tr>
            <td>Email</td><td><input type="text" name="email" id="iemail" class="form-control"></td>
        </tr>
        <tr>
            <td>Phone</td><td><input type="text" name="phone" id="iphone" class="form-control"></td>
        </tr>
        <tr>
            <td>Logo</td>
            <td>
                <select name="company" class="form-control" id="icompany">
                    <option></option>
                    @foreach($com as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;"><button class="btn btn-danger" style="width: 100%;" onclick="canceleditemp()" type="button">Cancel</button></td>
            <td style="width: 50%;"><button class="btn btn-success" style="width: 100%;" onclick="submiteditform()" type="button">Update</button></td>
        </tr>
    </table>
</div>

<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>

<script>

    var editem, vurl;

    function newcom(){
        
        $('.new-form').fadeToggle('fast');
    }

    function submitform(){

        $('#newformsbmt').submit();
    }

    function editemployee(employee){

        vurl = "{{ url('/employee') }}" + "/" + employee;

        $.get(vurl, function(result){

            console.log(result);

            editem = result.id;
            $('#title').text(result.first_name + ' ' + result.last_name);
            $('#ifn').val(result.first_name);
            $('#iln').val(result.last_name);
            $('#iemail').val(result.email);
            $('#iphone').val(result.phone);
            $('#icompany').val(result.company_id);
            
            $('.edit-form').fadeToggle('fast');
        });
    }


    function submiteditform(){

        vurl = "{{ url('/employee') }}" + "/" + editem;

        var fn = $('#ifn').val();
        var ln = $('#iln').val();
        var phone = $('#iphone').val();
        var email = $('#iemail').val();
        var company = $('#icompany').val();

        // use traditional ajax to use PUT/PATCH/DELETE request
        $.ajax({
            url: vurl,
            type: 'PUT',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {fn:fn,ln:ln,phone:phone,email:email,company:company},
            success: function(result) {
                location.reload();
            }
        });
    }

    function deleteemployee(employee){

        vurl = "{{ url('/employee') }}" + "/" + employee;

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

    function canceleditemp(){
        $('.edit-form').fadeToggle('fast');
    }
</script>

@if($errors->has('fn'))
    <script>
        $('.new-form').show();

        $('#error_message').text('First name is required');
    </script>
@endif

@if($errors->has('ln'))
    <script>
        $('.new-form').show();

        $('#error_message').text('Last name is required');
    </script>
@endif

@if($errors->has('email'))
    <script>
        $('.new-form').show();

        $('#error_message').text('Email is required');
    </script>
@endif

@if($errors->has('phone'))
    <script>
        $('.new-form').show();

        $('#error_message').text('Phone is required');
    </script>
@endif

@if($errors->has('company'))
    <script>
        $('.new-form').show();

        $('#error_message').text('Company is required');
    </script>
@endif

@endsection