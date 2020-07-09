<div class="card">
    <div class="card-header" style="height: 62px">
        <i class="fa fa-check"></i> Publish</span>

    </div>

    <div class="card-block">
        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('published_at'), 'has-success': this.fields.published_at && this.fields.published_at.valid }">
            <label for="published_at" class="col-form-label text-md-right"
                   :class="isFormLocalized ? 'col-md-4' : 'col-md-2 col-lg-3'">{{ trans('admin.post.columns.published_at') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8 col-lg-9'">
                <div class="input-group input-group--custom">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <datetime v-model="form.published_at" :config="datePickerConfig"
                              v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr"
                              :class="{'form-control-danger': errors.has('published_at'), 'form-control-success': this.fields.published_at && this.fields.published_at.valid}"
                              id="published_at" name="published_at"
                              placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
                </div>
                <div v-if="errors.has('published_at')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('published_at') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="fa fa-user"></i> Author </span>
    </div>

    <div class="card-block">
        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('author_id'), 'has-success': this.fields.author_id && this.fields.author_id.valid }">
            <label for="author_id"
                   class="col-form-label text-center col-md-4 col-lg-3">{{ trans('admin.post.columns.author_id') }}</label>
            <div class="col-md-8 col-lg-9">

                <multiselect
                        v-model="form.author"
                        :options="authors"
                        :multiple="false"
                        track-by="id"
                        label="full_name"
                        tag-placeholder="{{ __('Select Author') }}"
                        placeholder="{{ __('Author') }}">
                </multiselect>

                <div v-if="errors.has('author_id')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('author_id') }}
                </div>
            </div>
        </div>

    </div>
</div>


<div class="card">
    <div class="card-header">
       <span><i class="fa fa-tags"></i> {{ trans('admin.articles-with-relationship.columns.tags') }} </span>
    </div>

    <div class="card-block">
        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('tags'), 'has-success': this.fields.tags && this.fields.tags.valid }">
            <label for="author_id"
                   class="col-form-label text-center col-md-4 col-lg-3">{{ trans('admin.articles-with-relationship.columns.tags') }}</label>
            <div class="col-md-8 col-lg-9">

                <multiselect
                        v-model="form.tags"
                        :options="availableTags"
                        :multiple="true"
                        track-by="id"
                        label="name"
                        tag-placeholder="{{ __('Select Tags') }}"
                        placeholder="{{ __('Tags') }}">
                </multiselect>

                <div v-if="errors.has('tags')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('tags') }}
                </div>
            </div>
        </div>

    </div>
</div>
