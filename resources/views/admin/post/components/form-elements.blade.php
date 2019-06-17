<div class="card">

    <div class="card-header">
        <i class="fa fa-plus"></i> {{ trans('admin.post.actions.create') }}
    </div>
    <div class="card-block">

        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid }">
            <label for="title" class="col-form-label text-md-right"
                   :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.post.columns.title') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)"
                       class="form-control"
                       :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid}"
                       id="title" name="title" placeholder="{{ trans('admin.post.columns.title') }}">
                <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('title')
                    }}
                </div>
            </div>
        </div>

        <div class="form-group row align-items-center"
             :class="{'has-danger': errors.has('perex'), 'has-success': this.fields.perex && this.fields.perex.valid }">
            <label for="perex" class="col-form-label text-md-right"
                   :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.post.columns.perex') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <div>
                    <wysiwyg v-model="form.perex" v-validate="''" id="perex" name="perex"
                             :config="mediaWysiwygConfig"></wysiwyg>
                </div>
                <div v-if="errors.has('perex')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('perex')
                    }}
                </div>
            </div>
        </div>

        <div class="form-check row"
             :class="{'has-danger': errors.has('enabled'), 'has-success': this.fields.enabled && this.fields.enabled.valid }">
            <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
                <input class="form-check-input" id="enabled" type="checkbox" v-model="form.enabled" v-validate="''"
                       data-vv-name="enabled" name="enabled_fake_element">
                <label class="form-check-label" for="enabled">
                    {{ trans('admin.post.columns.enabled') }}
                </label>
                <input type="hidden" name="enabled" :value="form.enabled">
                <div v-if="errors.has('enabled')" class="form-control-feedback form-text" v-cloak>@{{
                    errors.first('enabled') }}
                </div>
            </div>
        </div>

        @if ($mode === 'create')
            @include('brackets/admin-ui::admin.includes.media-uploader', [
                'mediaCollection' => app(App\Models\Post::class)->getMediaCollection('gallery'),
                'label' => 'Gallery of photos'
            ])
            @include('brackets/admin-ui::admin.includes.media-uploader', [
                'mediaCollection' => app(App\Models\Post::class)->getMediaCollection('pdf'),
                'label' => 'PDF appendix'
            ])
        @else
            @include('brackets/admin-ui::admin.includes.media-uploader', [
               'mediaCollection' => $post->getMediaCollection('gallery'),
               'media' => $post->getThumbs200ForCollection('gallery'),
               'label' => 'Gallery of photos'
           ])
            @include('brackets/admin-ui::admin.includes.media-uploader', [
                'mediaCollection' => $post->getMediaCollection('pdf'),
                'media' => $post->getThumbs200ForCollection('pdf'),
                'label' => 'PDF appendix'
            ])

        @endif
    </div>

</div>