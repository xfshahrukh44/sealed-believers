@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->


<section class="main-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading for-contact">
                    {{-- <h2>{{ $page->name }}</h2> --}}
                </div>
            </div>
        </div>
    </div>
</section>


<section class="contact-info">
    <div class="container">
        <div class="row">

            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <div class="main-cont-info">
                    <div class="phone-call">
                        <figure>
                            <img src="images/22.png" class="img-fluid" alt="">
                        </figure>
                    </div>
                    <div class="call-main">
                        <div class="num-one">
                            <h5>Email</h5>
                            <a href="mailto:{!! App\Http\Traits\HelperTrait::returnFlag(218) !!}">{!! App\Http\Traits\HelperTrait::returnFlag(218) !!}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
            <div class="col-lg-6">
                <div class="we-here">
                    {!! $page->content !!}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="we-here">
                    <form id="contactform">
                        @csrf
                        <input type="hidden" name="form_name" value="Contact Form">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="fname" class="form-control" placeholder="Full Name"
                                        required="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email Address"
                                        required="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea name="notes" class="form-control" id="textarea" cols="30" rows="8"
                                        placeholder="Write a message" required=""></textarea>
                                </div>
                                <div class="btn-last">
                                    <button type="submit" class="btn blue-btn">SEND MESSAGE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div id="contactformsresult" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('css')
<style>
.for-contact {
    background-image: url({{ asset($page->image) }}) !important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
