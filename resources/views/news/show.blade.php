<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.homecss')

    <style>
        .service-item-prev a.btn-slide,
        .service-item-prev a.btn-slide span {
            position: relative;
            height: 40px;
            padding: 0 15px;
            display: inline-flex;
            float: right;
            align-items: center;
            font-size: 16px;
            color: #FFFFFF;

            background: var(--secondary);
            border-radius: 35px 0 0 35px;
            transition: .5s;
            z-index: 2;
        }

        .service-item-next a.btn-slide,
        .service-item-next a.btn-slide span {
            position: relative;
            height: 40px;
            padding: 0 15px;
            display: inline-flex;
            align-items: center;
            font-size: 16px;
            color: #FFFFFF;
            background: var(--secondary);
            border-radius: 0 35px 35px 0;
            transition: .5s;
            z-index: 2;
        }
    </style>
</head>

<body>
    @include('sections.navbar')

    <div class="container page-header py-5">
        <div class="container py-5">
            <h3 style="font-size: 40px !important;" class="display-3 text-white text-center animated slideInDown">
                {{ $post->title }}
            </h3>
            <p class="text-center text-white animated slideInDown">
                <span style="margin-right:4px;"><i class="fas fa-calendar-alt mr-3"></i></span>
                {{ date('Y-m-d', strtotime($post->updated_at)) }}
            </p>
        </div>
    </div>

    <div class="container py-5">
        <div class="container">
            {!! $post->description !!}
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="row g-4">
                @if (!is_null($prev))
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp; box-shadow: red;">
                        <div class="service-item-prev p-4">
                            <h4 class="mb-3">{{ Str::limit($prev->title, $limit = 40, $end = '...') }}</h4>
                            <a class="btn-slide mt-2" href="{{ route('posts.show', ['slug' => $prev->slug]) }}"><i
                                    class="fa fa-arrow-left"></i></a>
                        </div>
                    </div>
                @else
                @endif
                <div class="col-md-6 col-lg-4 wow fadeInUp">
                </div>
                @if (!is_null($next))
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s"
                        style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                        <div class="service-item-next p-4">
                            <a href="{{ route('posts.show', ['slug' => $prev->slug]) }}">
                                <h4 class="mb-3">{{ Str::limit($next->title, $limit = 40, $end = '...') }}</h4>
                            </a>
                            <a class="btn-slide mt-2" href="{{ route('posts.show', ['slug' => $prev->slug]) }}"><i
                                    class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                @else
                @endif
            </div>
        </div>
    </div>

    @include('sections.footer')

    <!-- Back to Top -->
    <a href="#" style="background-color: #51CFED !important; border:#51CFED;"
        class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('assets.homejs')
</body>

</html>
