@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.article.actions.edit', ['name' => $article->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <article-form
                :action="'{{ $article->resource_url }}'"
                :data="{{ $article->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.article.actions.edit', ['name' => $article->title]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.article.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </article-form>

    </div>

</div>

@endsection