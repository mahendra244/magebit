@extends('User.layouts.main')
@section('content')
@php
$search = Request::get('search');
@endphp
<div class="col-md-12 text-left p-l-r-0"  style="margin-top:70px;">
	<div class="col-md-12 form-group p-l-r-0 p-b-100">
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
				<h1 class="large-title">Preview Dashboard</h1>
			</div>
            <div class="col-md-2 p-l-r-0">
			<a  href="{{url('user/emp_match_update/'.$unique_code)}}" class="btn btn-primary">Update </a>
			</div>
		
            <div class="col-md-5  p-l-r-0">
				{{ $previewlist->appends(request()->input())->links() }}
			</div>
            <div class="col-md-1 p-l-r-0">
				<a href="{{  url('user/employee-data-import')}}"  class="btn gray-button" style="float: right;">Back</a>
			</div>
		</div>
		
		<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
			<table class="table table-bordered career-table table-condensed table-striped cf ">
				<thead>
					<tr>
                        <th>Sr. Num</th>
						<th>Email ID	</th>
						<th>Phone</th>
						<th>Company</th>
						<th>Unique code</th>
						<th>cp_name</th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					@forelse($previewlist as $list)
					<tr>
						<td>{{$i}}</td>
						<td>{{$list->email}}</td>
						<td>{{$list->phone}}</td>
						<td>{{$list->company}}</td>
						<td>{{$list->company_updated}}</td>
						<td>{{$list->cp_name }}</td>
						
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