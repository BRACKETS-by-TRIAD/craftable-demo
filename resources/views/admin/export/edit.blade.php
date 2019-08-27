@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.export.actions.edit', ['name' => $export->title]))

@section('body')

    <div class="container-xl">

        <div class="card">

            <export-form
                :action="'{{ $export->resource_url }}'"
                :data="{{ $export->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="this.action" novalidate>

                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.export.actions.edit', ['name' => $export->title]) }}
                    </div>

                    <div class="card-body">

                        @include('admin.export.components.form-elements')

                    </div>

                    <div class="card-footer">
	                    <button type="submit" class="btn btn-primary" :disabled="submiting">
		                    <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
		                    {{ trans('brackets/admin-ui::admin.btn.save') }}
	                    </button>
                    </div>

                </form>

        </export-form>

    </div>

</div>

@endsection