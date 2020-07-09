@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.articles-with-relationship.actions.create'))

@section('body')

    <div class="container-xl">

            <articles-with-relationship-form
                :action="'{{ url('admin/articles-with-relationships') }}'"
                :authors="{{$authors->toJson()}}"
                :available-tags="{{ $tags->toJson() }}"
                v-cloak
                inline-template>

                <form class="form-horizontal form-create" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="row">
                        <div class="col">
                            @include('admin.articles-with-relationship.components.form-elements')
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-5 col-xxl-4">
                            @include('admin.articles-with-relationship.components.form-elements-right')
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary fixed-cta-button" :disabled="submiting">
                        <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-save'"></i>
                        {{ trans('brackets/admin-ui::admin.btn.save') }}
                    </button>

                </form>

            </articles-with-relationship-form>

    </div>

@endsection