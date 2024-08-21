@extends('User.layouts.main')
@section('content')
@php
$search = Request::get('search');
@endphp
<div class="col-md-12 text-left p-l-r-0"  style="margin-top:70px;">
<div class="col-md-12 form-group p-l-r-0 p-b-100">
      
	<div class="row hidden" id="createmessage" >
		<div class="col-sm-12 col-md-12 col-xs-12 pad-l-r-0">
			<div class="alert aspirant-alert alert-success btn-delete fade in alert-dismissible " style="margin-top:18px;">
				<a href="#" class="close" style="font:bold;" data-dismiss="alert" aria-label="close" title="close">×</a>
			Your form has been submitted! 
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
		 
   <div class="col-md-12 form-group p-l-r-0 m-b-15">     
		<div class="col-md-2 p-l-r-0">
			<h1 class="large-title">Updated Data</h1>
		</div>
		<div class="col-md-5">
		<div class="form-group col-md-2 f-left" >
			<a  {{$data->count()? '':'disabled'}} class="btn btn-primary btn-text" href="{{url('user/employee-updated-report/')}}">Download</a>
		</div>
		<div></div>
		</div>
		<div class="col-md-5 p-l-r-0">
            {{ $data->appends(request()->input())->links() }}
		</div>
	</div>

	<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
		<table class="table table-bordered career-table table-condensed table-striped cf ">
			<thead>
				<tr>
					
					<th>Sr. Num</th>
					<th>Name</th>
					<th>Email ID</th>
					<th>Contact Number</th>
					<th>Company</th>
					<th>PE ID</th>
					<th>ORG ID</th>
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
                    <td>{{$i}}</td>
					<td>{{$list->name}}</td>
					<td>{{$list->email}}</td>
					<td>{{$list->phone}}</td>
					<td>{{$list->company}}</td>
					<td>{{$list->org_id}}</td>
					<td>{{$list->pe_id}}</td>
					<td>{{$list->designation}}</td>
					<td>{{$list->city_name}}</td>
					<td>{{$list->industry  ? $list->industry : 'NA'}}</td>
					
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

@stop
@push('style')

@endpush
@push('script')
<script  src="{{asset('assets/js/dashboard/admin/import/index.js')}}"></script>

@endpush