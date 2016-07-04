<address :user="user" :addresses="addresses" inline-template>
    <div>
        <div class="panel panel-default" v-if="addresses.length > 0">
            <div class="panel-heading">Addresses</div>

            <div class="panel-body">
                <table class="table table-borderless m-b-none">
                    <thead>
                    <th>Name</th>
                    <th>Address 1</th>
                    <th>Town</th>
                    <th>County</th>
                    <th>Post/Zip Code</th>
                    <th></th>
                    <th></th>
                    </thead>

                    <tbody>
                        <tr v-for="address in addresses">
                            <!-- Name -->
                            <td>
                                <div class="btn-table-align">
                                    @{{ address.name }}
                                </div>
                            </td>                       
                            <td>
                                <div class="btn-table-align">
                                    @{{ address.address_1 }}
                                </div>
                            </td>                       
                            <td>
                                <div class="btn-table-align">
                                    @{{ address.town }}
                                </div>
                            </td>                       
                            <td>
                                <div class="btn-table-align">
                                    @{{ address.country }}
                                </div>
                            </td>                       
                            <td>
                                <div class="btn-table-align">
                                    @{{ address.zip_code }}
                                </div>
                            </td>  
                            <!-- Edit Button -->
                            <td>
                                <button class="btn btn-primary" @click="editAddress(address)">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </td>
                            <!-- Delete Button -->
                            <td>
                                <button class="btn btn-danger-outline" @click="approveAddressDelete(address)">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Update Address Modal -->
        <div class="modal fade" id="modal-update-address" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="updatingAddress">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Address (@{{ updatingAddress.name }})
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Update Address Form -->
                        <form class="form-horizontal" role="form">
                            <!-- Address Name -->
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('name')}">
                                 <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" v-model="updateAddressForm.name">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('name')">
                                        @{{ updateAddressForm.errors.get('name') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('email')}">
                                 <label class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="email" v-model="updateAddressForm.email">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('email')">
                                        @{{ updateAddressForm.errors.get('email') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('mobile_number')}">
                                 <label class="col-md-4 control-label">Mobile Number</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="mobile_number" v-model="updateAddressForm.mobile_number">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('mobile_number')">
                                        @{{ updateAddressForm.errors.get('mobile_number') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('other_number')}">
                                 <label class="col-md-4 control-label">Other Number</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="other_number" v-model="updateAddressForm.other_number">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('other_number')">
                                        @{{ updateAddressForm.errors.get('other_number') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('address_1')}">
                                 <label class="col-md-4 control-label">Address 1</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address_1" v-model="updateAddressForm.address_1">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('address_1')">
                                        @{{ updateAddressForm.errors.get('address_1') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('address_2')}">
                                 <label class="col-md-4 control-label">Address 2</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address_2" v-model="updateAddressForm.address_2">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('address_2')">
                                        @{{ updateAddressForm.errors.get('address_2') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('address_3')}">
                                 <label class="col-md-4 control-label">Address 3</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="address_3" v-model="updateAddressForm.address_3">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('address_3')">
                                        @{{ updateAddressForm.errors.get('address_3') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('town')}">
                                 <label class="col-md-4 control-label">Town</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="town" v-model="updateAddressForm.town">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('town')">
                                        @{{ updateAddressForm.errors.get('town') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('country')}">
                                 <label class="col-md-4 control-label">County</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="country" v-model="updateAddressForm.country">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('country')">
                                        @{{ updateAddressForm.errors.get('country') }}
                                    </span>
                                </div>
                            </div>
                            <div class="form-group" :class="{'has-error': updateAddressForm.errors.has('zip_code')}">
                                 <label class="col-md-4 control-label">Post/Zip Code</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="zip_code" v-model="updateAddressForm.zip_code">

                                    <span class="help-block" v-show="updateAddressForm.errors.has('zip_code')">
                                        @{{ updateAddressForm.errors.get('zip_code') }}
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="updateAddress" :disabled="updateAddressForm.busy">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Address Modal -->
        <div class="modal fade" id="modal-delete-address" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="deletingAddress">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Delete Address (@{{ deletingAddress.name }})
                        </h4>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this address? 
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No, Go Back</button>

                        <button type="button" class="btn btn-danger" @click="deleteAddress" :disabled="deleteAddressForm.busy">
                            Yes, Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</address>