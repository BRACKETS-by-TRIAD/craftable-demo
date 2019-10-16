<div class="card">
    <div class="card-header">
        <i class="fa fa-check"></i>{{ trans('brackets/admin-ui::admin.forms.publish') }}
    </div>
    <div class="card-block">

        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('published_at'), 'has-success': this.fields.published_at && this.fields.published_at.valid }">
            <label for="published_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-2' : 'col-md-4'">{{ trans('admin.article.columns.published_at') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
                <div class="input-group input-group--custom">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <datetime v-model="form.published_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('published_at'), 'form-control-success': this.fields.published_at && this.fields.published_at.valid}" id="published_at" name="published_at" placeholder="Select date and time"></datetime>
                </div>
                <div v-if="errors.has('published_at')" class="form-control-feedback form-text" v-cloak>@{{errors.first('published_at') }}</div>
            </div>
        </div>
    </div>
</div>


