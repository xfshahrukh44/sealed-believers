<?php $segment = Request::segments();?>
<header>
    <div class="container">
         <div class="row">

              <div class="col-lg-12">
                   <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset($logo->img_path) }}" class="img-fluid" alt=""></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                             <ul class="navbar-nav me-auto">
                                  <li class="nav-item">
                                       <a class="nav-link" aria-current="page" href="{{ route('home') }}"> Home </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('faith') }}">Faith </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('israel') }}"> Israel </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('bible') }}"> Bible </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('about') }}"> About </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('contact') }}"> Contact Us </a>
                                  </li>
                                  <li class="nav-item">
                                       <a class="nav-link" href="{{ route('join') }}"> Join </a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="{{ route('interviews') }}"> Interview </a>
                               </li>
                             </ul>
                             <form class="d-flex side-bar-top">
                                 
                                @if(Auth::check())
                                  <a href="{{ route('account') }}" class="btn top-btn">{{ Auth::user()->name }}</a>
                                @else
                                  <a href="{{ route('signin') }}" class="btn top-btn"> Log In</a>
                                @endif
                                
                                  <a download href="{{ asset('apk/Sealed-Believers-APK.zip') }}" class="btn top-btn"> Download</a>
                                  
                                  <!--<div class="mian-top">-->
                                  <!--     <input class="form-control" type="search" placeholder="Search" aria-label="Search">-->
                                  <!--     <i class="fa-solid fa-magnifying-glass"></i>-->
                                  <!--</div>-->
                                  
                             </form>
                        </div>
                   </nav>
              </div>
         </div>
    </div>
</header>
