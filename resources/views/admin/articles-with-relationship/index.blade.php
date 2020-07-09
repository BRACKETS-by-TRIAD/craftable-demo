@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.articles-with-relationship.actions.index'))

@section('body')

    <articles-with-relationship-listing
        :data="{{ $data->toJson() }}"
        :url="'{{ url('admin/articles-with-relationships') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> {{ trans('admin.articles-with-relationship.actions.index') }}
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/articles-with-relationships/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.articles-with-relationship.actions.create') }}</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-start">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="{{ trans('brackets/admin-ui::admin.placeholder.search') }}" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; {{ trans('brackets/admin-ui::admin.btn.search') }}</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col form-group deadline-checkbox-col">
                                    <div class="switch-filter-wrap">
                                        <label class="switch switch-3d switch-primary">
                                            <input type="checkbox" class="switch-input" v-model="showAuthorsFilter" >
                                            <span class="switch-slider"></span>
                                        </label>
                                        <span class="authors-filter">&nbsp;{{ __('Authors filter') }}</span>
                                    </div>
                                </div>

                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row" v-if="showAuthorsFilter">
                                <div class="col-sm-auto form-group" style="margin-bottom: 0;">
                                    <p style="line-height: 40px; margin:0;">{{ __('Select author/s') }}</p>
                                </div>
                                <div class="col col-lg-12 col-xl-12 form-group" style="max-width: 590px; ">
                                    <multiselect v-model="authorsMultiselect"
                                                 :options="{{ $authors->map(function($author) { return ['key' => $author->id, 'label' =>  $author->title]; })->toJson() }}"
                                                 label="label"
                                                 track-by="key"
                                                 placeholder="{{ __('Type to search a author/s') }}"
                                                 :limit="2"
                                                 :multiple="true">
                                    </multiselect>
                                </div>
                            </div>
                        </form>

                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">{{ trans('admin.articles-with-relationship.columns.id') }}</th>
                                    <th is='sortable' :column="'title'">{{ trans('admin.articles-with-relationship.columns.title') }}</th>
                                    <th is='sortable' :column="'published_at'">{{ trans('admin.articles-with-relationship.columns.published_at') }}</th>
                                    <th is='sortable' :column="'enabled'">{{ trans('admin.articles-with-relationship.columns.enabled') }}</th>
                                    <th :column="'author_id'">{{ trans('admin.articles-with-relationship.columns.author_id') }}</th>
                                    <th :column="'tags'">{{ trans('admin.articles-with-relationship.columns.tags') }}</th>
                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.title }}</td>
                                    <td>@{{ item.published_at | date }}</td>
                                    <td>
                                        <label class="switch switch-3d switch-success">
                                            <input type="checkbox" class="switch-input" v-model="collection[index].enabled" @change="toggleSwitch(item.resource_url, 'enabled', collection[index])">
                                            <span class="switch-slider"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <user-detail-tooltip :user="item.author" v-if="item.author">
                                        </user-detail-tooltip>
                                    </td>
                                    <td>
                                        <div v-for="tag in item.tags">
                                            <span class="badge badge-success text-white">@{{ tag.name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-info" :href="item.resource_url + '/edit'" title="{{ trans('brackets/admin-ui::admin.btn.edit') }}" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <form class="col" @submit.prevent="deleteItem(item.resource_url)">
                                                <button type="submit" class="btn btn-sm btn-danger" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                                <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>

	                    <div class="no-items-found" v-if="!collection.length > 0">
		                    <i class="icon-magnifier"></i>
		                    <h3>{{ trans('brackets/admin-ui::admin.index.no_items') }}</h3>
		                    <p>{{ trans('brackets/admin-ui::admin.index.try_changing_items') }}</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/articles-with-relationships/create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; {{ trans('admin.articles-with-relationship.actions.create') }}</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </articles-with-relationship-listing>

@endsection