<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.homecss')
</head>

<body>
    @include('sections.navbar')

    <!-- Carousel Start -->
    @include('sections.kasel')
    <!-- Carousel End -->

    @include('sections.about')

    @include('sections.service')


    <!-- Fact Start -->
    @include('sections.fact')
    <!-- Fact End -->



    <!-- blog start -->
    @include('sections.blog')
    <!-- blog end End -->



    <!-- Quote Start -->
    @include('sections.quote')
    <!-- Quote End -->

    <!-- Footer Start -->
    @include('sections.footer')
    <!-- Footer End -->



    <!-- Back to Top -->
    <a href="#" style="background-color: #51CFED !important; border:#51CFED;"
        class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('assets.homejs')
</body>

</html>
