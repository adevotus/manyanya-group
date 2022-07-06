<div class="container-xxl py-5" id="blogs">
    <div class="container py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-secondary text-uppercase">Blogs & Event and News</h6>
            <h1 class="mb-5">Explore Our event that are accour to us</h1>
        </div>
        <div class="row g-4">
            @if ($posts && $posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ Storage::url($post->image) }}" alt="post">
                            </div>
                            <h4 class="mb-3">{{ Str::limit($post->title, $limit = 24, $end = '...') }}</h4>
                            <p>
                                {!! Str::limit($post->description, 200, '...') !!}
                            </p>
                            <a class="btn btn-secondary text-center mt-2"
                                href="{{ route('posts.show', ['slug' => $post->slug]) }}">
                                <span>Read More</span>
                                <i class="fa fa-arrow-right"></i>

                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
