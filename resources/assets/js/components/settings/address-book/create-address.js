Vue.component('create-address', {
 props: ['user'],

    data() {
        return {            
            form: new SparkForm({
                name: '',
                email: '',
                mobile_number: '',
                other_number: '',
                address_1: '',
                address_2: '',
                address_3: '',
                town: '',
                country: '',
                zip_code: ''            
            })
        };
    },

    ready() {
       
    },

    methods: {       
        create() {
            Spark.put('/settings/address-book', this.form)
                .then(response => {
                    this.resetForm();
                    this.$dispatch('updateAddresses');
                });
        },       
        resetForm() {
            this.form.name = '';
            this.form.email = '';
            this.form.mobile_number = '';
            this.form.other_number = '';
            this.form.address_1 = '';
            this.form.address_2 = '';
            this.form.address_3 = '';
            this.form.town = '';
            this.form.country = '';
            this.form.zip_code = '';          
        }
    }
});