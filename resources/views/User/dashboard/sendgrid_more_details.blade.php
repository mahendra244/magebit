@extends('User.layouts.main')
@section('content')
@php
$search = Request::get('search');
@endphp
<div class="col-md-12 text-left p-l-r-0"  style="margin-top:70px;">
	<div class="col-md-12 form-group p-l-r-0 p-b-100">
		<div class="col-md-12 form-group p-l-r-0 m-b-15">     
			<div class="col-md-6 p-l-r-0">
				<h1 class="large-title">Sendgrid More Datails</h1>
			</div>
			<div class="form-group col-md-2 f-left" >
				<a  {{$details_list->count()? '':'disabled'}} class="btn btn-primary btn-text" href="{{url('user/email-details-report/'.$userid)}}">Download</a>
			</div>
			
			<div class="col-md-4 p-l-r-0">
				{{ $details_list->appends(request()->input())->links() }}
			</div>
			<div class="col-md-2 p-l-r-0">
				<a href="{{url()->previous()}}"  class="btn gray-button" style="float: right;">Back</a>
			</div>
		</div>
		
		<div class="content col-md-12 col-sm-12 col-xs-12 p-l-r-0">
			<table class="table table-bordered career-table table-condensed table-striped cf ">
				<thead>
					<tr>
						<th>Sl.</th>
						<th>Email ID</th>
						<th>Message ID</th>
						<th>Message status</th>
						<th>Click status</th>
                        <th>Subject</th>
						<th>Template ID</th>
						<th>Process date</th>

					</tr>
				</thead>
				<tbody>
					@php
						$i=1;
					@endphp
					@forelse($details_list as $det_list)
					<tr>
						<td>{{$i}}</td>
						<td>{{$det_list->email}}</td>
						<td>{{$det_list->msg_id}}</td>
						<td>{{$det_list->msg_status}}</td>
						<td>{{$det_list->clk_status ? $det_list->clk_status : "NA"}}</td>
						<td>{{$det_list->subject ? $det_list->subject : "NA"}}</td>
						<td>{{$det_list->temp_id}}</td>
						<td>{{$det_list->proc_date}}</td>
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