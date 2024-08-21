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
			<div class="col-md-4 p-l-r-0">
				<h1 class="large-title">Sendgrid Data</h1>
			</div>
			@if(!Request::is('user/sendgrid-email-filter/'.$uniqueid))
			<div class="form-group col-md-2 f-left" >
				<a  {{$sendgrid_data->count()? '':'disabled'}} class="btn btn-primary btn-text" href="{{url('user/sendgrid-all-report/'.$uniqueid)}}">Download</a>
			</div>
			@endif
			<div class="col-md-4 p-l-r-0">
				{{ $sendgrid_data->appends(request()->input())->links() }}
			</div>
			@if(Request::is('user/sendgrid-email-filter/'.$uniqueid))
				<div class="form-group col-md-1 f-left">
						<a class="btn btn-primary reset-btn btn-text" href="{{url('user/sendgrid-data/'.$uniqueid)}}">Reset</a>
					</div>
			@endif
			@if(!Request::is('user/sendgrid-email-filter/'.$uniqueid))
			<div class="col-md-1 p-l-r-0">
				<a href="{{  url('user/sendgrid-data-import')}}"  class="btn gray-button" style="float: right;">Back</a>
			</div>
			@endif

		</div>
		
		<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
			<table class="table table-bordered career-table table-condensed table-striped cf ">
				<thead>
					<tr>
						<th>Sl.</th>
						<th>Email ID</th>
						<th>Created At</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					<td></td>
					<form action="{{url('user/sendgrid-email-filter/'.$uniqueid)}}" id="search"   method="get" accept-charset="utf-8">
					<td class="searchfiled">
						<input type="text"  id="query"  placeholder="Search" class="search form-control" name="email_id" >
						<i class="fa fa-search searchicon"></i>
					</td>
					</form>
					@forelse($sendgrid_data as $list)
					<tr>
						<td>{{$i}}</td>
						<td>{{$list->email_id}}</td>
						<td>{{$list->created_at}}</td>
                        <td>
                            <a  target="_blank" href="{{url('user/sendgrid-user-detail/'.$list->id)}}">More details</a>   
                        </td>

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
<script>
$('.search').change(function () {
    $('#search').submit();
});
</script>
@endpush