@extends('layouts.app')

@section('css')
    <link href="{{ asset('assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Edit Post</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Post</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="formData" action="{{ route('posts.edit', ['slug' => $post->slug]) }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Post Title</label>
                                            <input type="text" name="title" value="{{ $post->title }}"
                                                id="simpleinput" class="form-control @error('title') is-invalid @enderror">
                                            @error('title')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Post Description</label>
                                            <div id="snowEditor" style="height: 300px;" class="ql-container ql-snow">
                                                <div class="ql-editor" data-gramm="false" contenteditable="true">
                                                    {{ $post->description }}
                                                </div>
                                                <div class="ql-clipboard" contenteditable="true" tabindex="-1">
                                                </div>
                                            </div>
                                            @error('description')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            {{-- <textarea id="description" name="description" hidden id="simpleinput" class="form-control"> --}}
                                            {{-- {{ $post->description }} --}}
                                            {{-- </textarea> --}}
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Post Image</label>
                                            <input id="image" type="file" accept="image/*" id="simpleinput"
                                                name="image" class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <p class="text-danger mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-xl-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <img id="imgShow" src="{{ Storage::url($post->image) }}"
                                                            alt="image" height="400" width="400"
                                                            class="img-fluid rounded" srcset="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col-->
                                        </div>


                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6 d-grid">
                                                    <button type="submit"
                                                        class="btn btn-success waves-effect waves-light">Save
                                                        Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row-->

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('js')
    <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>

    <script>
        $('document').ready(function() {
            $("#image").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgShow').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote', 'code-block'],

                [{
                    'header': 1
                }, {
                    'header': 2
                }], // custom button values
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],
                ['clean'], // remove formatting button
                ['link', 'image']
            ];

            var quill = new Quill('#snowEditor', {
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions,
                },
            });

            var realHtml = $('<textarea />').html('{{ $post->description }}').text();

            var initialContent = quill.clipboard.convert(realHtml);
            quill.setContents(initialContent, 'silent');
            console.log('success or failed');
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formData").on("submit", function() {
                var hvalue = $('.ql-editor').html();
                $(this).append("<textarea name='description' style='display:none'>" + hvalue +
                    "</textarea>");
            });
        });
    </script>
@endsection
