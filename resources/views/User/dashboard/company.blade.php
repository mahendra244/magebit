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
		 
		<div class="col-md-12 form-group p-l-r-0 m-b-15">     
			<div class="col-md-6 p-l-r-0">
				<h1 class="large-title">Company Data</h1>
			</div>
			
			<div class="col-md-4 p-l-r-0">
				{{ $data->appends(request()->input())->links() }}
			</div>
			<div class="col-md-2 p-l-r-0">
				<a href="{{  url('user/company-data-import')}}"  class="btn gray-button" style="float: right;">Back</a>
			</div>
		</div>
		
		<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
			<table class="table table-bordered career-table table-condensed table-striped cf ">
				<thead>
					<tr>
						@if($data->count()  > 0)
						<th scope="col"><input type="checkbox" id="checkbox0"  name="select_all" class="selectall"></th>
						@endif
						<th>PE_NAME1</th>
						<th>ORG_ID</th>
						<th>CP_NAME</th>
						<th>SAP_TOP_VIEW_NAME1</th>
						<th>COUNTRY1</th>
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
						<td>{{$list->pe_name1}}</td>
						<td>{{$list->org_id}}</td>
						<td>{{$list->cp_name}}</td>
						<td>{{$list->sap_top_view_name1}}</td>
						<td>{{$list->country1 }}</td>
						
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
@endpush
@push('script')
<script  src="{{asset('assets/js/dashboard/admin/import/index.js')}}"></script>

@endpush