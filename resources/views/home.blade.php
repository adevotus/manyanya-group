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

    @include('assets.homejs')
</body>

</html>
