@extends('layouts.main')
@section('title', 'Order')
@section('content')

<?php $segment = Request::segments(); ?>



<section class="main-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading for-israel">

                </div>
            </div>
        </div>
    </div>
</section>


<main class="my-cart">

 <!-- my account wrapper start -->
    <div class="my-account-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            @include('account.sidebar')
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show active" id="orders" role="#">
                                        <div class="myaccount-content">
                                            <div class="section-heading">
                                                <h2>Previous Request</h2>
                                                <!--<button id="requestInterviewBtn" class="btn top-btn">Request an interview</button>-->
                                            </div>
                                            <div class="row" id="requestInterviewBox">
                                                <div class="col-md-12 form-box">
                                                    <h3 class="mb-2">Request Interview</h3>
                                                    <form action="{{ route('requestinterview') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                                                        <div class="form-group mb-3">
                                                            {{-- <label for="">Subject</label> --}}
                                                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                                                        </div>

                                                        <button type="submit" class="btn top-btn">Submit Request</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Subject</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    @if($requestinterview)
                                                    @php
                                                        $count = 1;
                                                    @endphp
                                                        @foreach($requestinterview as $value)
                                                            <tr>
                                                              <td>{{ $count }}</td>

                                                              <td>{{ $value->subject }}</td>
                                                              <td>{{ Carbon\Carbon::parse($value->created_at)->format('d, M y') }}</td>
                                                              <td>{!!  ($value->is_approved == 1) ? '<span class="badge bg-success">Approved</span>' : '<span class="badge bg-danger">Pending</span>'  !!}</td>
                                                              @if($value->details != null)
                                                              <td class="viewbtn"><a href="{{ route('interviewdetail', ['id' => $value->id, 'subject' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $value->subject)))]) }}">View</a></td>
                                                              @else
                                                              <td><span class="badge bg-danger">Link not Given</span></td>
                                                              @endif

                                                            </tr>
                                                            @php
                                                            $count++;
                                                            @endphp
                                                        @endforeach
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->


                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


<!-- main content end -->
</main
>

@endsection
@section('css')
<style type="text/css">
.section-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0px;
}

.form-box {
    padding: 30px 20px;
}

#requestInterviewBox{
    display: none;
}

div#requestInterviewBox {
    border: 2px solid #dee2e6;
    border-radius: 10px;
    margin: 0;
    margin-bottom: 20px;
}

input#subject {
    background: #f6f4f0;
}

td.viewbtn a {
    background: #000;
    padding: 5px  10px;
    color: #fff;
    border-radius: 5px;
}
</style>
@endsection
@section('js')
<script type="text/javascript">
     $(document).on('click', ".btn1", function(e){
            // alert('it works');
            $('.loginForm').submit();
     });
     $('#requestInterviewBtn').click(function(){
        $('#requestInterviewBox').slideToggle();
     })
</script>
@endsection
