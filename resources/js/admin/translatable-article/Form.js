import AppForm from '../app-components/Form/AppForm';

Vue.component('translatable-article-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title:  this.getLocalizedFormDefaults() ,
                perex:  this.getLocalizedFormDefaults() ,
                published_at:  '' ,
                enabled:  false ,
                
            }
        }
    }

});