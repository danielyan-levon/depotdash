Vue.component('address', {
   props: ['user', 'addresses'],
   
    data() {
        return {   
            updatingAddress: null,
            deletingAddress: null,
            updateAddressForm: new SparkForm({
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
                
            }),
            deleteAddressForm: new SparkForm({})
        }
    },
 
    methods: {
        
        /**
         * Show the edit token modal.
         */
        editAddress(address) {
            this.updatingAddress = address;

            this.initializeUpdateFormWith(address);

            $('#modal-update-address').modal('show');
        },


        /**
         * Initialize the edit form with the given token.
         */
        initializeUpdateFormWith(address) {
            this.updateAddressForm.name = address.name;            
            this.updateAddressForm.email = address.email;            
            this.updateAddressForm.mobile_number = address.mobile_number;            
            this.updateAddressForm.other_number = address.other_number;            
            this.updateAddressForm.address_1 = address.address_1;            
            this.updateAddressForm.address_2 = address.address_2;            
            this.updateAddressForm.address_3 = address.address_3;            
            this.updateAddressForm.town = address.town;            
            this.updateAddressForm.country = address.country;            
            this.updateAddressForm.zip_code = address.zip_code;            
        },
        
       /**
         * Get user confirmation that the address should be deleted.
         */
        approveAddressDelete(address) {
            this.deletingAddress = address;
            $('#modal-delete-address').modal('show');
        },
        
         /**
         * Update the token being edited.
         */
        updateAddress() {
            Spark.put(`/settings/address/${this.updatingAddress.id}`, this.updateAddressForm)
                .then(response => {
                    this.$dispatch('updateAddresses');

                    $('#modal-update-address').modal('hide');
                })
        },

        /**
         * Delete the specified address.
         */
        deleteAddress() {
            Spark.delete(`/settings/address/${this.deletingAddress.id}`, this.deleteAddressForm)
                .then(() => {
                    this.$dispatch('updateAddresses');

                    $('#modal-delete-address').modal('hide');
                });
        }
    }
});
