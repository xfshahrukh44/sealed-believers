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
                    {{-- <h2>{{ $page->name }}</h2> --}}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="para-content ">
    <div class="container">
         <div class="row">
         <div class="col-lg-12">
                   <div class="top-head join_pg">
                       {!! $page->content !!}
                       <form id="newForm">
                        @csrf
                        <input type="email" name="email" id="newemail" class="form-control" placeholder="Email" required="">
                            <button type="submit" class="btn head-btn">JOIN NOW</button>
                        </form>
                        <div id="newsresult" class="mt-2"></div>
                        {{-- <form>
                              <input type="email" name="email" class="form-control" placeholder="Email" required="">
                             <button type="submit" class="btn head-btn">JOIN NOW</button>
                        </form> --}}


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
