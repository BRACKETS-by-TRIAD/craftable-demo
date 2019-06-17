@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.post.actions.create'))

@section('body')
    <post-form
            :action="'{{ url('admin/posts') }}'"

            inline-template>

        <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action"
              novalidate>
            <div class="row">
                <div class="col">
                    @include('admin.post.components.form-elements')
                </div>

                <div class="col-md-12 col-lg-12 col-xl-5 col-xxl-4">
                    @include('admin.post.components.form-elements-right')
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" :disabled="submiting">
                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                    {{ trans('brackets/admin-ui::admin.btn.save') }}
                </button>
            </div>

        </form>

    </post-form>


@endsection
