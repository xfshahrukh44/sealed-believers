@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->


<section class="main-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading for-about">

                </div>
            </div>
        </div>
    </div>
</section>



 <section class="message_sec_pg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading">
                {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@section('css')
<style>
.for-about {
    background-image: url({{ asset($page->image) }}) !important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
