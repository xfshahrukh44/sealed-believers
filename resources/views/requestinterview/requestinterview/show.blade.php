@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-white mt-5">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box card">
                <div class="card-body">
                    <h3 class="box-title pull-left">Requestinterview {{ $requestinterview->id }}</h3>
                    
                        <a class="btn btn-success pull-right" href="{{ url('/requestinterview/requestinterview') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $requestinterview->id }}</td>
                            </tr>
                            <tr><th> Subject </th><td> {{ $requestinterview->subject }} </td></tr><tr><th> User Id </th><td> {{ $requestinterview->user_id }} </td></tr><tr><th> Is Approved </th><td> {{ $requestinterview->is_approved }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.footer')
</div>
@endsection

