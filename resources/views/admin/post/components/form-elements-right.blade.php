<div class="card">
    <div class="card-header" style="height: 62px">
        <i class="fa fa-check"></i> Publish</span>

    </div>

    <div class="card-block">
        <div class="form-check row"
             :class="{'has-danger': errors.has('is_published'), 'has-success': this.fields.is_published && this.fields.is_published.valid }">
            <div class="ml-md-auto col-md-12">
                <div class="row align-items-center">
                    <div class="col">
                        <input class="form-check-input" id="is_published" type="checkbox" v-model="form.is_published"
                               v-validate="''" data-vv-name="is_published" name="is_published_fake_element">

                        <label class="form-check-label" for="is_published" style="margin-bottom: 1rem;">
                            {{ trans('admin.post.columns.is_published') }}
                        </label>

                        <input type="hidden" name="is_published" :value="form.is_published">

                        <div v-if="errors.has('is_published')" class="form-control-feedback form-text" v-cloak>@{{
                            errors.first('is_published') }}
                        </div>
                    </div>
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
        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('author_id'), 'has-success': this.fields.author_id && this.fields.author_id.valid }">
            <label for="author_id" class="col-form-label text-center col-md-4">{{ trans('admin.post.columns.author_id') }}</label>
            <div class="col-md-8">
                <multiselect
                        v-model="mutableSelectedAuthor"
                        :options="avalaibleAuthors"
                        :close-on-select="true"
                        placeholder="No author"
                        label="full_name"
                        track-by="id">
                </multiselect>

                <div v-if="errors.has('author_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('author_id') }}</div>
            </div>
        </div>

    </div>
</div>

<div class="card">
    @include('brackets/admin-ui::admin.includes.media-uploader', [
        'mediaCollection' => app(App\Models\Post::class)->getMediaCollection('pdf'),
        'label' => 'PDF appendix'
    ])
</div>