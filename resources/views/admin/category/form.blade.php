@extends('admin.layouts.app')

@section('content')
@php
    $formTitle = !empty($category) ? 'Edit' : 'Add New';
@endphp
<div class="content">
    <div id="message"></div>
    <div class="breadcrumb-wrapper">
        <h1>Category</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="mdi mdi-home"></span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.categories') }}">
                        Category
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    {{ $formTitle }} Category
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>{{ $formTitle }} Category</h2>
                </div>
                <div class="card-body">
                    @if (!empty($category))
                        <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                            @method('PUT')
                    @else
                        <form action="{{ route('admin.categories.store') }}" method="POST">
                    @endif
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-sm" id="name" name="name" value="{{ old('name') ?? $category->name ?? '' }}" placeholder="Category Name">
                                @error('name')
                                    <div class="text-danger font-italic">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="parentId">Parent</label>
                                {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'selected' => (old('parent_id') ?? $category->parent_id ?? ''), 'placeholder' => 'Choose Category']) !!}
                                @error('parent_id')
                                    <div class="text-danger font-italic">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-footer pt-4 pt-5 mt-4 border-top">
                                <button type="submit" class="btn btn-success btn-sm">SAVE</button>
                                <a href="{{ route('admin.categories') }}" class="btn btn-secondary btn-sm">BACK</a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
