@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.post.actions.edit', ['name' => $post->title]))

@section('body')

    <div class="container-xl">

        <post-form
                :action="'{{ $post->resource_url }}'"
                :data="{{ $post->toJson() }}"
                v-cloak
                inline-template>

            <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action"
                  novalidate>

                <div class="row">
                    <div class="col">
                        @include('admin.post.components.form-elements')
                    </div>

                    <div class="col-md-12 col-lg-12 col-xl-5 col-xxl-4">
                        @include('admin.post.components.form-elements-right')
                    </div>
                </div>

                <button type="submit" class="btn btn-primary fixed-cta-button" :disabled="submiting">
                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-save'"></i>
                    {{ trans('brackets/admin-ui::admin.btn.save') }}
                </button>


            </form>

        </post-form>

    </div>

@endsection
