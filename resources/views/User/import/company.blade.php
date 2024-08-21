@extends('User.layouts.main')
@section('content')
<div class="row m-t-70 admin-home  p-l-r-0">
	<div class="col-md-12 col-sm-12 col-xs-12 p-l-r-0">
    	<div class="col-md-12 col-sm-12 col-xs-12 card-block">
            <div class="row mar-50">
                <div  class="col-md-3"></div>
                <div class="col-md-6">
                    @if(session()->has('message'))
                    <div class="row" id="success_alert">
                        <div class="col-sm-12 col-md-12 col-xs-12 pad-l-r-0">
                            <div class="alert alert-success alert-dismissible successMessage">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {{ session()->get('message') }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-md-3"></div>
            </div>
            <form action="{{ url('user/post-company-data') }}" method="POST" id="importform" name="importform" enctype="multipart/form-data">
            {!!csrf_field()!!}
                <div class="row ">
                    <div class="col-sm-4 col-md-4 col-xs-12"></div>
                    <div class="col-sm-4 col-md-4 col-xs-12">
                        <div class="box">
                            <div class="download-text">
                                <p class="select-file">Import company data</p>
                                <img src="{{asset('assets/images/dashboard/dropicon.png')}}" class="img-responsive dropicon-img">
                                <div class="upload-btn-wrapper">
                                    <button class="btn btn-primary"> Browse File</button>
                                    @if ($errors->has('excel_input'))
                                    <p class="error">{{ $errors->first('excel_input') }}</p>
                                    @endif
                                    <input type="file" name="excel_input" data-url="{{ url('user/post-import-company-data') }}" id="excel_input" />
                                    {!!csrf_field()!!}
                                </div>
                                <p class="m-t-10 no_file">No file Selected</p>
                                <p class="m-t-10 show_file hidden"></p>
                                <p> (Comma delimited)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-sm-4 col-md-4 col-xs-12"></div>
                    <div class="col-sm-4 col-md-4 col-xs-12 text-center">
                        <button class="btn btn-primary sub-btn btn-import" id="btn-import-btn-import-company">Submit</button>
                        <button type="button" class="btn btn-default sub-btn reset-btn">Clear</button>
                    </div>
                </div>
            </form>
	    </div>
        
	</div>
    <div class="col-md-12 col-sm-12 col-xs-12 p-l-r-0">
        <div class="col-md-5 p-l-r-0">
            {{ $uploadtrack->appends(request()->input())->links() }}
        </div>
    <div class="col-md-12 col-sm-12 col-xs-12 card-block">
            @forelse ($uploadtrack as $key => $value )
            <div class="admin-card">
			    <a class="card-content" href="#">
	            	<div class="">
		                <div class="">
							<!-- <img src="{{asset('assets/img/icons/ico-company.svg')}}" alt="" style="width: 88px; height: 88px;"> -->
                            <h5>{{date('d-m-Y h:i:s a', strtotime($value->created_at))}}</h5>
                        </div>
		                <p class="card-details">
                            <a download href="{{asset('reports/company_reports/'.$value->file_name)}}">Download</a> |
							<a  href="{{url('user/company-data/'.$value->unique_code)}}">View</a>
						</p>
		            </div>
	            </a>
	        </div>
            @empty
            @endforelse
        </div>
    </div>
</div>



@endsection
@push('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
<script  src="{{asset('assets/js/dashboard/admin/import/index.js')}}"></script>
@endpush


