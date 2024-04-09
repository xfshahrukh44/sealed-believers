@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->


<section class="main-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-heading for-bible">

                </div>
            </div>
        </div>
    </div>
</section>

<section class="para-content ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>




@endsection
@section('css')
<style>
.for-bible {
    background-image: url({{ asset($page->image) }}) !important;
}
</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
