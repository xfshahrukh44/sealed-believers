@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->


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


<section class="about-video-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="I-main text-center">
                    <figure>
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset($section[0]->value) }}" type="video/mp4">
                        </video>
                    </figure>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="I-main text-center">
                    <figure>
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset($section[1]->value) }}" type="video/mp4">
                        </video>
                    </figure>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="I-main text-center">
                    <figure>
                        <video width="100%" height="100%" controls>
                            <source src="{{ asset($section[2]->value) }}" type="video/mp4">
                        </video>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faith-sec israel-pg">
    <div class="container">
        <div class="row">
            @foreach ($ppt as $value)
                <div class="col-lg-6">
                    <div class="main-first aos-init aos-animate" data-aos="fade-down-right" data-aos-duration="2000">
                        <a href="{{ asset($value->ppt) }}" target="_blank">

                        <div class="I-G-content">
                            <h5>{{ $value->title }}</h5>
                        <h6>Download PPT</h6>
                        </div>
                        </a>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
</section>


@endsection
@section('css')
<style>
.for-israel {
    background-image: url({{ asset($page->image) }}) !important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
