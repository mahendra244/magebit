@extends('User.layouts.main')
@section('content')
    <div class="row m-t-70 admin-home  p-l-r-0">
        <div class="col-md-12 col-sm-12 col-xs-12 p-l-r-0">
            <div class="col-md-12 col-sm-12 col-xs-12 card-block">
                <div class="admin-card">
                    <a class="card-content" href="#">
                        <div class="card-row">
                            <div class="card-icon">
                                <img src="{{ asset('assets/images/ico-company.svg') }}" alt=""
                                    style="width: 88px; height: 88px;">
                            </div>
                            <p class="card-details">
                                <span class="card-title">Total Company</span>
                                <span class="card-title">{{ $company->count() }}</span>

                            </p>
                        </div>
                    </a>
                </div>
                <div class="admin-card">
                    <a class="card-content" href="#">
                        <div class="card-row">
                            <div class="card-icon">
                                <img src="{{ asset('assets/images/Email.png') }}" alt=""
                                    style="width: 88px; height: 88px;">
                            </div>
                            <p class="card-details">
                                <span class="card-title">Total Sendgrid Email ID</span>
                                <span class="card-title">{{$sendgrid->count()}}</span>

                            </p>
                        </div>
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script>
    <script  src="{{asset('assets/js/dashboard/admin/import/index.js')}}"></script>

@endpush
