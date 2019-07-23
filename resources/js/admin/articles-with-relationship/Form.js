import AppForm from '../app-components/Form/AppForm';

Vue.component('articles-with-relationship-form', {
    mixins: [AppForm],
    props: ['authors'],
    data: function() {
        return {
            form: {
                title:  '' ,
                perex:  '' ,
                published_at:  '' ,
                enabled:  false ,
                author:  '' ,
            }
        }
    }

});