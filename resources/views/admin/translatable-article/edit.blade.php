@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.translatable-article.actions.edit', ['name' => $translatableArticle->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <translatable-article-form
                :action="'{{ $translatableArticle->resource_url }}'"
                :data="{{ $translatableArticle->toJsonAllLocales() }}"
                :locales="{{ json_encode($locales) }}"
                :send-empty-locales="false"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.translatable-article.actions.edit', ['name' => $translatableArticle->title]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.translatable-article.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </translatable-article-form>

    </div>

</div>

@endsection