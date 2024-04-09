@extends('layouts.main')
@section('content')
    <!-- ============================================================== -->
    <!-- BODY START HERE -->
    <!-- ============================================================== -->


    <section class="main-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-heading">
                        <h2>{{ $faith->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faith-sec pt-5 pb-5">
        <div class="container">
            <div class="row">
                {!! $faith->description !!}
            </div>

        </div>
    </section>



@endsection
@section('css')
    <style>
        .main-heading {
            background-image: url({{ asset($faith->image) }}) !important;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
