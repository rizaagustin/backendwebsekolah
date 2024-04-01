
@extends('layouts.dashboard')

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Add Event</h3>
                </div>
                <form action="{{ route('event.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        <div class="form-group">
                            <label>Titel</label>
                            <input type="text" name="title" value="{{ old('title', $event->title) }}" placeholder="Enter Title" class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" value="{{ old('location', $event->location) }}" placeholder="Enter Location" class="form-control @error('location') is-invalid @enderror">

                            @error('location')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ old('date', $event->date) }}" class="form-control @error('date') is-invalid @enderror">

                            @error('date')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Content Agenda</label>
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content" placeholder="Enter Content" rows="10">{!! old('content', $event->content) !!}</textarea>
                            @error('content')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
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