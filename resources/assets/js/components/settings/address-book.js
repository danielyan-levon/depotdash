Vue.component('address-book', {
   props: ['user'],
   
   data() {
        return {
            addresses: []           
        };
    },

    ready() {     
        this.getAddresses();      
    },
    
    events: {
        /**
         * Broadcast that child components should update their tokens.
         */
        updateAddresses() {
            this.getAddresses();
        }
    },
    
    methods: {
        getAddresses() {
            this.$http.get('/settings/addresses')
                    .then(function(response) {
                        this.addresses = response.data;
                    });
        }
    }
});
