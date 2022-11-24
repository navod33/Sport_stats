@extends('oxygen::layouts.master-dashboard')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section ('content')
{{ lotus()->pageHeadline("Blog") }}
{{ lotus()->breadcrumbs([
        ['Dashboard', route('dashboard')],
        ['Blog', url('/blogs')],
        ['View', null, true]
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
        
        <input type="hidden" class="form-control" id="id"
        name="id" readonly
        value="{{ old('id', $entity->id) }}">

     <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title"
                    name="title" readonly
                    value="{{ old('title', $entity->title) }}">
        </div>
    </div>

    <div class="form-group row">
        <label for="content" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
            <textarea name="content" id="content" cols="30" rows="10" class="form-control" readonly>{{ old('content', $entity->description) }}</textarea>
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
            
        </div>
        </div>
        </form>
        </div>
        </div>
    </div>
</div>

@stop

