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
            <div class="col-md-12">
                <h1 class="mt-3 mb-3 text-center">{{ $page->name }}</h1>
            </div>
        </div>
        <div class="row">

             @foreach ($jesusreturn as $value)
                <div class="col-lg-4">
                    <div class="video-youtube">
                       {!! $value->video_iframe !!}
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
