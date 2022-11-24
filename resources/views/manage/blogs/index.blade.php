<?php
/* @var \App\Entities\Enquiries\Enquiry $enquiry */

?>
@extends('oxygen::layouts.master-dashboard')

@section('breadcrumbs')
    {{ lotus()->breadcrumbs([
        ['Home', route('dashboard')],
        // ['Change The Resource Name', route('<change here>')],
        [$pageTitle, null, true]
    ]) }}
@stop

@section('pageMainActions')
    @include('oxygen::dashboard.partials.searchField') 

    <a href="{{ entity_resource_path() . '/create' }}" class="btn btn-success"><em class="fas fa-plus-circle"></em> Add New</a>
@stop


@section('content')
    @include('oxygen::dashboard.partials.table-allItems', [
        'tableHeader' => [
            'Blog ID','Title', 'Actions|text-right'
        ]
    ])

    @foreach ($allItems as $enquiry)
        <tr>
            <td>{{ $enquiry->id }}</td>
            <td>
                {{ $enquiry->title }}
            </td>
            
            <td class="text-right">
                <div class="btn-spaced" >

                    <a href="{{ entity_resource_path() . '/' . $enquiry->id . '/edit' }}" class="btn btn-warning"><em
                        class="fa fa-edit"></em>Edit</a>

                    <a href="{{ entity_resource_path() . '/' . $enquiry->id  }}"
                       class="btn btn-success js-tooltip"
                       title="View"><em class="fa fa-eye"></em> View</a>
                
                        <form action="{{ entity_resource_path() . '/' . $enquiry->id }}"
                              method="POST" class="form form-inline js-confirm-delete">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger js-tooltip"
                                    title="Delete"><em class="fa fa-times"></em> Delete
                            </button>
                        </form>
                </div>
            </td>
        </tr>
    @endforeach
@stop
