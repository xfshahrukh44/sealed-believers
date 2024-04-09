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
                        {{-- <h2>{{ $page->name }}</h2> --}}
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
    {{-- <section class="faith-sec">
        <div class="container">
            <div class="row">
                @foreach ($faith as $value)
                    <div class="col-lg-6">
                        <a href="{{ route('faith-detail', ['id' => $value->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $value->name)))]) }}">
                            <div class="main-first aos-init aos-animate" data-aos="fade-down-right" data-aos-duration="2000">
                                <div class="I-main">
                                    <figure>
                                        <img src="{{ asset($value->image) }}" class="img-fluid" alt="">
                                    </figure>
                                </div>
                                <div class="I-G-content">
                                    <h5>{{ $value->name }}</h5>
                                    {!! $value->short_desc !!}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
            </div>

        </div>
    </section> --}}


    {{-- <section class="top-story p-0">
        <div class="container">
            <div class="row">
                @foreach ($faithall as $value)
                <div class="col-lg-3">
                    <a href="{{ route('faith-detail', ['id' => $value->id, 'name' => preg_replace('/[^A-Za-z0-9\-]/', '', strtolower(str_replace(' ', '-', $value->name)))]) }}">
                        <div class="main-first aos-init aos-animate" data-aos="fade-up-right" data-aos-duration="2000">
                            <div class="I-main">
                                <figure>
                                    <img src="{{ asset($value->image) }}" class="img-fluid" alt="">
                                </figure>
                            </div>
                            <div class="I-G-content">
                                <h5>{{ $value->name }}</h5>

                                <p class="p-nov">
                                    ({{ $value->users->name }} -- {{ Carbon\Carbon::parse($value->created_at)->format('M. d, Y') }})
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
        </div>
    </section> --}}
@endsection
@section('css')
    <style>
        .main-heading {
            background-image: url({{ asset($page->image) }}) !important;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript"></script>
@endsection
