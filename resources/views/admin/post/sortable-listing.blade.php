@extends('brackets/admin-ui::admin.layout.default')

@section('body')
    <div class="posts-sortable-listing">
        <sortable :data="{{$data}}"
                  :post-url="'{{ route('admin/posts/sort/update') }}'"
                  :cancel-url="'{{ url('/admin/posts') }}'"
        ></sortable>
    </div>
@endsection