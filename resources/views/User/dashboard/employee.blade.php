
@extends('User.layouts.main')
@section('content')
@php
$search = Request::get('search');
@endphp
<div class="col-md-12 text-left p-l-r-0"  style="margin-top:110px;">
	<div class="col-md-12 form-group  ">
		
		<div class="row hidden" id="createmessage" >
			<div class="col-sm-12 col-md-12 col-xs-12 pad-l-r-0">
				<div class="alert aspirant-alert alert-success btn-delete fade in alert-dismissible " style="margin-top:18px;">
					<a href="#" class="close" style="font:bold;" data-dismiss="alert" aria-label="close" title="close">×</a>
					<span id="msg_text">Your form has been submitted! </span>
				</div>
			</div>
		</div>
		@if(session()->has('message'))
		<div class="row" >
			<div class="col-sm-12 col-md-12 col-xs-12 pad-l-r-0">
				<div class="alert alert-success alert-dismissible successMessage">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
				{{ session()->get('message') }}
				</div>
			</div>
		</div>
		@endif
		<div class="col-md-12 p-l-r-0">
				<h1 class="large-title">Employee Data</h1>
				<br>
			</div> 
		<div class="col-md-5 pad-right form-group p-l-r-0 m-b-15">  
			
			<div class="col-md-12 p-l-r-0">	
				<form method="post" id="employee_filter_company" class="employee_filter_company" action="{{url('user/employee-data/'.$unique_code)}}">
				{{ csrf_field() }}
			<input type="hidden" name="search_text" value="{{$search}}" > 
				<div class="col-md-8 p-l-r-0 form-group">
					<select name="companys[]" id="companys" multiple="multiple" class="form-control chosen-select ">
						@foreach($different_company as $keys =>$values)
							<option value="{{$values->company}}" <?php if (in_array($values->company, $companyslected)){ echo 'selected';} ?> >{{$values->company}}</option>
						@endforeach
					</select>
				
				</div>
				<div class="form-group col-md-2 f-left">
					<a class="btn btn-primary btn-text" id="btn-filter">Submit</a>
				</div>
				@if(!empty($companyslected))
				<div class="form-group col-md-2 f-left">
						<a class="btn btn-primary reset-btn btn-text" href="{{url('user/employee-data/'.$unique_code)}}">Reset</a>
					</div>
				@endif
				</form>
			</div>
		</div>	 
		
	<div class="col-md-5 pad-left form-group p-l-r-0 m-b-15">     
			<div class="col-md-12 p-l-r-0">	
				<form method="get" id="employee_filter" class="employee_filter">
					<div class="col-md-8 p-l-r-0 form-group">
						<input type="text" class="form-control" id="search" name="search" value="{{$search}}" placeholder="Search Company Name">
					</div>
					<div class="form-group col-md-2  f-left" style="text-align: center;">
						<a class="btn btn-primary gmf-btn" id="btn-search">Search</a>
					</div>
					@if($search!="")
					<div class="form-group col-md-2 p-l-r-0 f-left">
						<a class="btn btn-primary reset-btn btn-text" href="{{url('user/employee-data/'.$unique_code)}}">Reset</a>
					</div>
					@endif
				</form>
			</div>
			
		</div>
		<div class="col-md-2 p-l-r-0 hidden">
			<a class="btn gmf-btn btn-text reset-btn close" href="#" style="float:right">Close</a>
		</div>
		<input type="hidden" value="{{$company_id}}" id="search_suggestion">
		@if($search!="" || !empty($companyslected))
		<div class="col-md-12  form-group p-l-r-0 m-b-15">     
			<div class="col-md-5 pad-right p-l-r-0 ">	
				<div class="col-md-8  p-l-r-0 form-group">
					<select name="company" id="company" class="form-control chosen-select">
						<option value="">Select</option>
						@foreach($companylist as $key =>$value)
							<option value="{{$value->id}}" <?php if($company_id==$value->id){echo 'selected'; } ?> >{{$value->pe_name1}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group col-md-2 f-left">
					<a class="btn btn-primary btn-text" id="btn-update">Submit</a>
				</div>
				@endif
			</div>
			
			<div class="col-md-12 p-l-r-0">
				{{ $data->appends(request()->input())->links() }}
			</div>
		</div>
		
		<form  method="post" enctype='multipart/form-data' id="update-status">
				{{ csrf_field() }}
			<input type="hidden" name="list" value="" class="list">
			<input type="hidden" name="company_id" value="" id="company_id">
			<input type="hidden" name="company_lists" value="" id="company_lists">
			<input type="hidden" name="search_text" value="{{$search}}" id="search_text">
		</form>
		<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
			<table class="table table-bordered career-table table-condensed table-striped cf ">
				<thead>
					<tr>
						@if($data->count()  > 0)
							<th scope="col"><input type="checkbox" id="checkbox0"  name="select_all" class="selectall"></th>
						@endif
						<th>Name</th>
						<th>Email ID</th>
						<th>Contact Number</th>
						<th>Company</th>
						<th>Designation</th>
						<th>City name</th>
						<th>Industry</th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					@forelse($data as $list)
					<tr>
						<td >
						<input type="checkbox" class="checkSingle records" value="{{$list->id}}" name="update_status[]"  id="checkbox1" data-id="{{$list->id}}">
						</td>
						<td>{{$list->name}}</td>
						<td>{{$list->email}}</td>
						<td>{{$list->phone}}</td>
						<td>{{$list->company}}</td>
						<td>{{$list->designation}}</td>
						<td>{{$list->city_name}}</td>
						<td>{{$list->industry}}</td>
						
					</tr>
					@php $i++; @endphp
					@empty
					<tr>
						<td colspan="12" rowspan="" headers="" align="center">No Data Found</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop
@push('style')
<link rel="stylesheet" href="{{asset('assets/css/choosen.css')}}">
@endpush
@push('script')
<script src="{{asset('assets/js/choosen.js')}}"></script>
<script src="{{asset('assets/js/employee.js')}}"></script>
<script>
	$(".chosen-select").chosen({rtl: true}); 

</script>

@endpush