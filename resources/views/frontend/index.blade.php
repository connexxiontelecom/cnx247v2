@extends('layouts.frontend-layout')

@section('title')
    Home
@endsection

@section('content')

<section class="swiper-slider-hero position-relative d-block vh-100" id="home">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide d-flex align-items-center overflow-hidden">
                <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="images/corporate/1.jpg">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="title-heading text-center">
                                    <h1 class="heading text-white title-dark mb-4">Discover the world of <br> business</h1>
                                    <p class="para-desc mx-auto text-white-50">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap4 html page.</p>
                                    
                                    <div class="mt-4 pt-2">
                                        <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="swiper-slide d-flex align-items-center overflow-hidden">
                <div class="slide-inner slide-bg-image d-flex align-items-center" style="background: center center;" data-background="images/corporate/2.jpg">
                    <div class="bg-overlay"></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="title-heading text-center">
                                    <h1 class="heading text-white title-dark mb-4">Meet our brand <br> new solution</h1>
                                    <p class="para-desc mx-auto text-white-50">Launch your campaign and benefit from our expertise on designing and managing conversion centered bootstrap4 html page.</p>
                                    
                                    <div class="mt-4 pt-2">
                                        <a href="{{route('pricing')}}" class="btn btn-primary">Get Started</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="swiper-button-next border rounded-circle text-center"></div>
        <div class="swiper-button-prev border rounded-circle text-center"></div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="features">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('/frontend/images/icon/user.svg')}}" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">Easy To Use</h4>
                        <p class="text-muted mb-0">Nisi aenean vulputate eleifend tellus vitae eleifend enim a Aliquam eleifend aenean elementum semper.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-12 mt-5 mt-sm-0">
                <div class="features">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('/frontend/images/icon/calendar.svg')}}" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">Daily Reports</h4>
                        <p class="text-muted mb-0">Allegedly, a Latin scholar established the origin of the established text by compiling unusual word.</p>
                    </div>
                </div>
            </div><!--end col-->

            <div class="col-md-4 col-12 mt-5 mt-sm-0">
                <div class="features">
                    <div class="image position-relative d-inline-block">
                        <img src="{{asset('/frontend/images/icon/sand-clock.svg')}}" class="avatar avatar-small" alt="">
                    </div>

                    <div class="content mt-4">
                        <h4 class="title-2">Real Time Zone</h4>
                        <p class="text-muted mb-0">It seems that only fragments of the original text remain in only fragments the Lorem Ipsum texts used today.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <img src="{{asset('/frontend/images/saas/1.png')}}" class="img-fluid shadow rounded" alt="">
            </div><!--end col-->

            <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title ml-lg-5">
                    <h4 class="title mb-4">Great Product Analytics With Real Problem</h4>
                    <p class="text-muted">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception is tuned to recognize certain patterns and repetitions in texts. If the distribution of letters visual impact.</p>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Digital Marketing Solutions for Tomorrow</li>
                        <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Create your own skin to match your brand</li>
                    </ul>
                    <a href="javascript:void(0)" class="mt-3 h6 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

    <div class="container mt-100 mt-60">
        <div class="row align-items-center">
            <div class="col-lg-7 col-md-6 order-2 order-md-1 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title mr-lg-5">
                    <h4 class="title mb-4">Get Notified About Importent Email</h4>
                    <p class="text-muted">This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic.</p>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Digital Marketing Solutions for Tomorrow</li>
                        <li class="mb-0"><span class="text-primary h5 mr-2"><i class="uim uim-check-circle"></i></span>Create your own skin to match your brand</li>
                    </ul>
                    <a href="javascript:void(0)" class="mt-3 h6 text-primary">Find Out More <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div>

            <div class="col-lg-5 col-md-6 order-1 order-md-2">
                <img src="{{asset('/frontend/images/illustrator/app_development_SVG.svg')}}" alt="">
            </div>
        </div>
    </div>

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title mb-4 pb-2">
                    <h4 class="title mb-4">Satisfied  <span class="text-primary">Clients</span></h4>
                    <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4">
                <div id="customer-testi" class="owl-carousel owl-theme">
                    <div class="media customer-testi m-2">
                        <img src="{{asset('/frontend/images/client/01.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" It seems that only fragments of the original text remain in the Lorem Ipsum texts used today. "</p>
                            <h6 class="text-primary">- Thomas Israel <small class="text-muted">C.E.O</small></h6>
                        </div>
                    </div>

                    <div class="media customer-testi m-2">
                        <img src="{{asset('/frontend/images/client/02.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star-half text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others. "</p>
                            <h6 class="text-primary">- Barbara McIntosh <small class="text-muted">M.D</small></h6>
                        </div>
                    </div>

                    <div class="media customer-testi m-2">
                        <img src="images/client/03.jpg" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" The most well-known dummy text is the 'Lorem Ipsum', which is said to have originated in the 16th century. "</p>
                            <h6 class="text-primary">- Carl Oliver <small class="text-muted">P.A</small></h6>
                        </div>
                    </div>

                    <div class="media customer-testi m-2">
                        <img src="{{asset('/frontend/images/client/04.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" According to most sources, Lorum Ipsum can be traced back to a text composed by Cicero. "</p>
                            <h6 class="text-primary">- Christa Smith <small class="text-muted">Manager</small></h6>
                        </div>
                    </div>

                    <div class="media customer-testi m-2">
                        <img src="{{asset('/frontend/images/client/05.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" There is now an abundance of readable dummy texts. These are usually used when a text is required. "</p>
                            <h6 class="text-primary">- Dean Tolle <small class="text-muted">Developer</small></h6>
                        </div>
                    </div>

                    <div class="media customer-testi m-2">
                        <img src="{{asset('/frontend/images/client/06.jpg')}}" class="avatar avatar-small mr-3 rounded shadow" alt="">
                        <div class="media-body content p-3 shadow rounded bg-white position-relative">
                            <ul class="list-unstyled mb-0">
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                                <li class="list-inline-item"><i class="mdi mdi-star text-warning"></i></li>
                            </ul>
                            <p class="text-muted mt-2">" Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts. "</p>
                            <h6 class="text-primary">- Jill Webb <small class="text-muted">Designer</small></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pb-lg-4 mb-md-5 mb-4 mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="section-title">
                    <h4 class="title mb-4">See everything about your employee in one place.</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">{{config('app.name')}}</span>. The application provides everything you need to keep tabs on your staff or colleagues, get update on recent happenings and much more.</p>

                    <div class="mt-4">
                        <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mr-2">Get Started Now</a>
                        <a href="{{route('faqs')}}" class="btn btn-outline-primary mt-2">Learn more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="position-relative">
    <div class="shape overflow-hidden text-footer">
        <svg viewBox="0 0 2880 250" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
        </svg>
    </div>
</div>
@endsection
