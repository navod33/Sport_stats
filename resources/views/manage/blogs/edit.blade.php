@extends('oxygen::layouts.master-dashboard')
@push('stylesheets')
@endpush
@section ('content')
    {{ lotus()->pageHeadline($pageTitle) }}

    {{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Blog',  url('/blogs') ],
        ['Edit', null, true]
    ]) }}

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
            <form action="{{ entity_resource_path()}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                @if ($entity->id)
                {{ method_field('put') }}
                @csrf
            @endif

            {{-- <div class="form-group row">
                <label for="id" class="col-sm-2 col-form-label">Blog Id</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="id"
                            name="id" placeholder="id" readonly
                            value="{{ old('name', $entity->id) }}">
                </div>
         </div> --}}

         <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title"
                        name="title"
                        value="{{ old('title', $entity->title) }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="content" class="col-sm-2 col-form-label">Content</label>
            <div class="col-sm-10">
                <textarea name="content" id="content" cols="30" rows="10" class="form-control" >{{ old('content', $entity->description) }}</textarea>
            </div>
        </div>



            <div class="form-group row">
                <label for="profile_image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                @if ($entity->file)
                <img id="preview_img1" src="{{ $entity->file->permalink }}" class="col-form-label col-sm-3" alt="organisation image"/>   
                @else
                <img id="preview_img" src="https://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class="col-form-label col-sm-3" />
                @endif
                 
                <div class="col-sm-9"> 
                    <input type="file" fileFieldName="profile_image" name="profile_image" id="profile_image" onchange="loadPreview(this);" class="form-control">
                </div>
            </div>
            </div>

                
                <div class="form-group row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn btn-success btn-lg btn-wide float-right">
                            Edit Post
                        </button>
                    </div>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('stylesheets')

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <style>
        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 100%;
        }

        .btn-light {
            color: #212529;
            background-color: #f8f9fa;
            border-color: #ced4da;
        }

        #geomap {
            width: 100%;
            height: 250px;
        }
    </style>

@endpush
@push('js')
<script type="text/javascript" src="{{url('js/location.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script type='text/javascript'
            src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
<script>
        function loadPreview(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $(id)
                            .attr('src', e.target.result)
                            .width()
                            ;
                };
        
                reader.readAsDataURL(input.files[0]);

                var reader1 = new FileReader();
        
                reader1.onload = function (e) {
                    $('#preview_img1')
                            .attr('src', e.target.result)
                            .width()
                            ;
                };
        
                reader1.readAsDataURL(input.files[0]);
            }
        }
        </script>
@endpush
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.place_api_key') }}&libraries=places"
            async defer></script>
@endpush
