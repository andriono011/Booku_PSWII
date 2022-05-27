@extends('admin.layout')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>Kategori Buku</h2>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.flash')
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>    
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                                        <td>
                                            @can('edit_categories')
                                                <a href="{{ url('admin/categories/'. $category->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                                            @endcan

                                            @can('delete_categories')
                                                {!! Form::open(['url' => 'admin/categories/'. $category->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada catatan yang ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    </div>

                    @can('add_categories')
                        <div class="card-footer text-right">
                            <a href="{{ url('admin/categories/create') }}" class="btn btn-primary">Tambah Baru</a>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection