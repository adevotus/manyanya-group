<!DOCTYPE html>
<html lang="en">

<head>
    @include('assets.homecss')
</head>

<body>
    @include('sections.navbar')

    @include('sections.footer')

    <!-- Back to Top -->
    <a href="#" style="background-color: #51CFED !important; border:#51CFED;"
        class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>

    @include('assets.homejs')
</body>

</html>
