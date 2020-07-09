import AppForm from '../app-components/Form/AppForm';

Vue.component('tag-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});