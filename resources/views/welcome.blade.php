@extends('layouts.main')
@section('content')

<!-- ============================================================== -->
<!-- BODY START HERE -->
<!-- ============================================================== -->

<section class="home-banner">
    <div class="container-fluid">
         <div class="row">
              <div class="col-lg-12 p-0">
                   <!-- <div class="back-img">
                        <img src="images/Sea of Galilee.JPG" class="img-fluid" alt="">
                   </div> -->
                   <div class="banner-carousel" data-aos="fade-down" data-aos-duration="2000">
                        <div class="owl-carousel owl-theme">
                            @foreach($banner as $value)
                             <div class="item">
                                  <div class="discover-book sea_Galilee" style="background-image: url({{ asset($value->image) }});">
                                       <h1>{{ $value->title }}</h1>
                                       {!! $value->description !!}

                                  </div>
                             </div>
                             @endforeach
                             {{-- <div class="item">
                                  <div class="discover-book sealdimg">

                                       <p>Bringing together family and friends to deepen our understanding and faith in
                                            Jesus Christ.</p>
                                       <p><span>Ephesians 1:13</span> In him you also, when you heard the word of
                                            truth, the gospel of your salvation, and believed in him, were sealed with
                                            the promised Holy Spirit</p>
                                  </div>
                             </div>
                             <div class="item">
                                  <div class="discover-book fellowseald">
                                       <h1>Fellowship</h1>
                                       <p>Our community stands as a testament to our shared belief and commitment to
                                            grow together in our faith in Christ. Together, we will encourage each
                                            other, share Gods message of love and salvation with others, and prepare
                                            ourselves for the future. Jesus is coming, let’s be ready. </p>
                                  </div>
                             </div> --}}
                        </div>
                   </div>
              </div>
         </div>
    </div>
</section>


<section class="five-img">
    <div class="container">
         <div class="row">
              <div class="col-lg-12">
                   <div class="main-five">
                        <h2 class="animate__animated animate__bounce animate__slow animate__infinite infinite">
                             Video Links</h2>
                   </div>


              </div>
         </div>
         <div class="row">
            @foreach ($videoLink as $value)
                <div class="col-lg-4">
                    <div class="video-youtube">
                       {!! $value->video_iframe !!}
                    </div>
            </div>
            @endforeach


         </div>

    </div>
</section>

<section class="top-story">
    <div class="container">
         <div class="row">
              <div class="col-lg-12">
                   <div class="main-five"> </div>
              </div>
              <div class="col-lg-6">
                   <div class="main-first mid-img">
                        <div class="I-G-content">
                             <h2 class="animate__animated animate__bounce animate__slow animate__infinite infinite">
                                  Message for Believers</h2>
                             <h3>Video Links</h3>
                        </div>
                   </div>
              </div>
              <div class="col-lg-6">
                   <div class="main-first mid-img">
                        <div class="I-G-content">
                             <h2 class="animate__animated animate__bounce animate__slow animate__infinite infinite">
                                  Recent Videos</h2>

                        </div>
                   </div>
              </div>
              <div class="col-lg-3">
                   <div class="main-first" data-aos="fade-up-right" data-aos-duration="2000">
                        <div class="I-main">
                             <figure>
                                  <img src="{{ asset($section[0]->value) }}" class="img-fluid" alt="">
                             </figure>
                        </div>
                        <div class="I-G-content">
                             <h5>{!! $section[1]->value !!}</h5>
                        </div>
                   </div>
              </div>
              <div class="col-lg-3">
                   <div class="main-first" data-aos="fade-down" data-aos-duration="2000">
                        <div class="I-main">
                             <figure>
                                  <img src="{{ asset($section[2]->value) }}" class="img-fluid" alt="">
                             </figure>
                        </div>
                        <div class="I-G-content">
                             <h5>{!! $section[3]->value !!}</h5>
                        </div>
                   </div>
              </div>
              <div class="col-lg-3">
                   <div class="main-first" data-aos="fade-down" data-aos-duration="2000">
                        <div class="I-main">
                             <figure>
                                  <img src="{{ asset($section[4]->value) }}" class="img-fluid" alt="">
                             </figure>
                        </div>
                        <div class="I-G-content">
                             <h5>{!! $section[5]->value !!}</h5>
                        </div>
                   </div>
              </div>
              <div class="col-lg-3">
                   <div class="main-first" data-aos="fade-up-left" data-aos-duration="2000">
                        <div class="I-main">
                             <figure>
                                  <img src="{{ asset($section[6]->value) }}" class="img-fluid" alt="">
                             </figure>
                        </div>
                        <div class="I-G-content">
                             <h5>{!! $section[7]->value !!}</h5>
                        </div>
                   </div>
              </div>
         </div>
    </div>
</section>

<!--<section class="five-img">-->
<!--     <div class="container">-->
<!--          <div class="row">-->
<!--               <div class="col-lg-12">-->
<!--                    <div class="main-five">-->
<!--                         <h2 class="animate__animated animate__bounce animate__slow animate__infinite infinite">-->
<!--                              Upcoming Videos</h2>-->
<!--                    </div>-->
<!--               </div>-->
<!--          </div>-->
<!--          <div class="row">-->
<!--               <div class="col-lg-4">-->
<!--                    <div class="video-youtube">-->
<!--                         <iframe width="365" height="212" src="https://www.youtube.com/embed/Mk-Zq3jv4s8" title="The Perfect Red Heifer | Tipping Point Show | End Times Teaching | Jimmy Evans" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-4">-->
<!--                    <div class="video-youtube">-->
<!--                         <iframe width="365" height="212" src="https://www.youtube.com/embed/Oe1jKM1QN7Q" title="What I Saw in Hell: Bill Wiese Recounts Underworld Experience &amp; the Worst Thing He Saw" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-4">-->
<!--                    <div class="video-youtube">-->
<!--                         <iframe width="365" height="212" src="https://www.youtube.com/embed/U1lA4fy6mWk" title="JESUS TOLD US--KEEP YOUR EYE ON EVENTS HAPPENING IN ISRAEL!" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--               </div>-->
<!--          </div>-->
<!--          <div class="row">-->
<!--               <div class="col-lg-4">-->
<!--                    <div class="video-youtube">-->
<!--                         <iframe width="365" height="212" src="https://www.youtube.com/embed/J1bszCE8QEQ" title="Prophecy Update: The Cup of Trembling Has Begun | Perry Stone" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-4">-->
<!--                    <div class="video-youtube">-->
<!--                         <iframe width="365" height="212" src="https://www.youtube.com/embed/G1iCW5Lsd80" title="The Sign of The Statue | Jonathan Cahn Prophetic" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--               </div>-->
<!--          </div>-->
<!--     </div>-->
<!--</section>-->

<!--<section class="top-story youtube-sec">-->
<!--     <div class="container">-->
<!--          <div class="row align-items-center">-->
<!--               <div class="col-gl-12">-->
<!--                    <div class="col-lg-12">-->
<!--                         <div class="main-five"> </div>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-6">-->
<!--                    <div class="I-main" data-aos="flip-right" data-aos-duration="2000">-->
<!--                         <figure>-->
<!--                              <img src="images/13.png" class="img-fluid" alt="">-->
<!--                              <a href="#"><img src="images/14.png" class="img-fluid ps-img" alt=""></a>-->
<!--                         </figure>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-6">-->
<!--                    <div class="main-first mid-img">-->
<!--                         <div class="I-G-content">-->
<!--                              <h3>Lorem ipsum dolor sit amet, consectetur <span class="d-block">adipisicing elit,-->
<!--                                        sed do eiusmod tempor</span>incididunt ut labore et dolore magna-->
<!--                              </h3>-->
<!--                              <p class="p-nov">-->
<!--                                   (Nov. 7, 2021)-->
<!--                              </p>-->
<!--                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod-->
<!--                                   tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim-->
<!--                                   veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex-->
<!--                                   ea commodo consequat. Duis aute irure dolor in </p>-->
<!--                         </div>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-6">-->
<!--                    <div class="main-first" data-aos="fade-left" data-aos-duration="2000">-->
<!--                         <div class="I-main">-->
<!--                              <figure>-->
<!--                                   <img src="images/15.png" class="img-fluid" alt="">-->
<!--                                   <a href="#"><img src="images/14.png" class="img-fluid ps-img" alt=""></a>-->
<!--                              </figure>-->
<!--                         </div>-->
<!--                         <div class="I-G-content">-->
<!--                              <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <span class="d-block">eiusmod tempor incididunt ut </span></h5>-->

<!--                              <p class="p-nov">-->
<!--                                   (Berlin, Germany -- Nov. 25, 2021)-->
<!--                              </p>-->
<!--                         </div>-->
<!--                    </div>-->
<!--               </div>-->
<!--               <div class="col-lg-6">-->
<!--                    <div class="main-first" data-aos="fade-right" data-aos-duration="2000">-->
<!--                         <div class="I-main">-->
<!--                              <figure>-->
<!--                                   <img src="images/16.png" class="img-fluid" alt="">-->
<!--                                   <a href="#"><img src="images/14.png" class="img-fluid ps-img" alt=""></a>-->
<!--                              </figure>-->
<!--                         </div>-->
<!--                         <div class="I-G-content">-->
<!--                              <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do <span class="d-block">eiusmod tempor incididunt ut </span></h5>-->

<!--                              <p class="p-nov">-->
<!--                                   (Berlin, Germany -- Nov. 25, 2021)-->
<!--                              </p>-->
<!--                         </div>-->
<!--                    </div>-->
<!--               </div>-->
<!--          </div>-->
<!--     </div>-->
<!--</section>-->

@endsection
@section('css')
<style>

</style>
@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
