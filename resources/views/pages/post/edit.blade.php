@extends('layouts.dashboard')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Edit Post</h3>
                </div>
                <form action="{{ route('post.update', $post->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                        </div>

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                placeholder="Masukkan Judul Berita"
                                class="form-control @error('title') is-invalid @enderror">


                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control select-category @error('category_id') is-invalid @enderror"
                                name="category_id">
                                <option value="">-- PILIH Category --</option>
                                @foreach ($categories as $category)
                                    @if($post->category_id == $category->id)
                                        <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content"
                                placeholder="Enter Content"
                                rows="10">{!! old('content', $post->content) !!}</textarea>
                            @error('content')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">TAGS</label>
                            <select class="form-control" name="tags[]"
                                multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{ in_array($tag->id, $post->tags()->pluck('id')->toArray()) ? 'selected' : '' }}> {{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>                        
</section>

@push('after-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
        var editor_config = {
            selector: "textarea.content",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);
    </script>
@endpush

@endsection