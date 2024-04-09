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
                                                <h2>Subject: {{ $requestinterview->subject }}</h2>
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
                                            <div class="myaccount-table table-responsive">
                                                
                                                
                                                @if($requestinterview->is_approved  == 1)
                                                <div class="details">
                                                    <h3>Interview Details</h3>
                                                    <div class="details-box mt-3">
                                                
                                                    {!! $requestinterview->details !!}
                                                
                                                </div>
                                                </div>
                                                @else
                                                <form action="{{ route('requestinterview') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" id="user_id" value="{{ $requestinterview->user_id }}">
                                                    <input type="hidden" name="interview_id" id="interview_id" value="{{ $requestinterview->id }}">
                                                    <div class="form-group mb-3">
                                                        <label for="subject">Subject</label>
                                                        <input type="text" name="subject" id="subject" class="form-control" value="{{ $requestinterview->subject }}" readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="is_approved">Status</label>
                                                        <select class="form-control" name="is_approved" id="is_approved">
                                                            <option value="1" {{ ($requestinterview->is_approved == 1) ? 'selected' : '' }} >Approve</option>
                                                            <option value="0" {{ ($requestinterview->is_approved == 0) ? 'selected' : '' }} >Reject</option>
                                                        </select>
                                                    </div>
                                                    <!--<div class="form-group mb-3">-->
                                                    <!--    <label for="is_approved">Details</label>-->
                                                    <!--    <textarea class="form-control" name="details" id="details">{!! $requestinterview->details !!}</textarea>-->
                                                    <!--</div>-->

                                                    <button type="submit" class="btn top-btn">Submit</button>
                                                </form>
                                                @endif
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

.details {
    padding: 20px 10px;
    border: 2px solid #ced4da;
    border-radius: 10px;
    margin-top: 20px;
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
