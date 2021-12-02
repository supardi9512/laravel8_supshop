@extends('admin.layouts.app')

@section('content')
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
                <li class="breadcrumb-item" aria-current="page">
                    Category
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Data Category</h2>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm text-uppercase">
                        <i class=" mdi mdi-plus mr-1"></i> Add New
                    </a>
                </div>
                <div class="card-body">
                    <div class="basic-data-table">
                        <table id="all-table" class="table nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-warning btn-sm">EDIT</a>
                                            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $category->id }}" data-action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" data-toggle="modal" data-target="#deleteCategory">DELETE</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modal untuk konfirmasi proses delete --}}
<div id="deleteCategory" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('custom-scripts')
    <script>
        $('.btn-delete').click(function() {
            let id = $(this).attr('data-id');
            let action = $(this).attr('data-action');
            $('#deleteForm').attr('action', action);
        })

        $('#deleteForm [type="submit"]').click(function() {
            $('#deleteForm').submit();
        })
    </script>
@endpush
