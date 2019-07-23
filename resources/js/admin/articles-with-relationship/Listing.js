import AppListing from '../app-components/Listing/AppListing';

Vue.component('articles-with-relationship-listing', {
    mixins: [AppListing],

    data() {
        return {
            showAuthorsFilter: false,
            authorsMultiselect: {},

            filters: {
                authors: [],
            },
        }
    },

    watch: {
        showAuthorsFilter: function (newVal, oldVal) {
            this.authorsMultiselect = [];
        },
        authorsMultiselect: function(newVal, oldVal) {
            this.filters.authors = newVal.map(function(object) { return object['key']; });
            this.filter('authors', this.filters.authors);
        }
    }
});