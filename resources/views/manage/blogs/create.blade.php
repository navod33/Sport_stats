@extends('oxygen::layouts.master-dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section ('content')
{{ lotus()->pageHeadline("Blog") }}
{{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Blog',  entity_resource_path()],
        ['Add New', null, true]
    ]) }}

<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form id="app" action="{{ entity_resource_path() }}" name="add_name" id="add_name" method="post" class="form-horizontal"
                    enctype="multipart/form-data" style="max-width: 100%;">
                    {{ csrf_field() }}


                    {{-- <div class="form-group row">
                        <label for="id" class="col-sm-2 col-form-label">Blog Id</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id"
                                    name="id" placeholder="id" readonly
                                    value="{{ $entity }}">
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title"
                                    name="title"
                                    value="">
                        </div>
                    </div>

                    <!-- <div class="form-group row">
                        <label for="sub_title" class="col-sm-2 col-form-label">Sub Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="sub_title"
                                    name="sub_title"
                                    value="">
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label for="content" class="col-sm-2 col-form-label">Content</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>


                    {{-- <div class="form-group row">
                        <label for="author" class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="author"
                                    name="author"
                                    value="">
                        </div>
                    </div> --}}
{{-- 
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date"
                                    name="blog_date"
                                    value="">
                        </div>
                    </div> --}}
{{-- 
                    <div class="form-group row">
                        <label for="sponsored" class="col-sm-2 col-form-label">Sponsored</label>
                        <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sponsored" id="inlineRadio1" value="1">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sponsored" id="inlineRadio2" value="0">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                        </div>
                    </div> --}}

                    <div class="form-group row">
                        <label for="profile_image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <img id="preview_img" src="https://w3adda.com/wp-content/uploads/2019/09/No_Image-128.png" class="col-form-label col-sm-3" /> 
                            <div class="col-sm-7"> 
                                <input type="file" fileFieldName="profile_image" name="profile_image" id="profile_image" onchange="loadPreview(this);" class="form-control">
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn btn-success btn-lg btn-wide">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

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
                  }
               }
              </script>

@endpush