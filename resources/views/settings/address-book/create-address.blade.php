<create-address :user="user" inline-template>
    <div class="panel panel-default">
        <div class="panel-heading">Address</div>

        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <!-- Age -->
                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                     <label class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" v-model="form.name">

                        <span class="help-block" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('email')}">
                     <label class="col-md-4 control-label">Email</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" v-model="form.email">

                        <span class="help-block" v-show="form.errors.has('email')">
                            @{{ form.errors.get('email') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('mobile_number')}">
                     <label class="col-md-4 control-label">Mobile Number</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="age" v-model="form.mobile_number">

                        <span class="help-block" v-show="form.errors.has('mobile_number')">
                            @{{ form.errors.get('mobile_number') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('other_number')}">
                     <label class="col-md-4 control-label">Other Number</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="other_number" v-model="form.other_number">

                        <span class="help-block" v-show="form.errors.has('other_number')">
                            @{{ form.errors.get('other_number') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('address_1')}">
                     <label class="col-md-4 control-label">Address 1</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address_1" v-model="form.address_1">

                        <span class="help-block" v-show="form.errors.has('address_1')">
                            @{{ form.errors.get('address_1') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('address_2')}">
                     <label class="col-md-4 control-label">Address 2</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address_2" v-model="form.address_2">

                        <span class="help-block" v-show="form.errors.has('address_2')">
                            @{{ form.errors.get('address_2') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('address_3')}">
                     <label class="col-md-4 control-label">Address 3</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address_3" v-model="form.address_3">

                        <span class="help-block" v-show="form.errors.has('address_3')">
                            @{{ form.errors.get('address_3') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('town')}">
                     <label class="col-md-4 control-label">Town</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="town" v-model="form.town">

                        <span class="help-block" v-show="form.errors.has('town')">
                            @{{ form.errors.get('town') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('country')}">
                     <label class="col-md-4 control-label">County</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="country" v-model="form.country">

                        <span class="help-block" v-show="form.errors.has('country')">
                            @{{ form.errors.get('country') }}
                        </span>
                    </div>
                </div>
                <div class="form-group" :class="{'has-error': form.errors.has('zip_code')}">
                     <label class="col-md-4 control-label">Post/Zip Code</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="zip_code" v-model="form.zip_code">

                        <span class="help-block" v-show="form.errors.has('zip_code')">
                            @{{ form.errors.get('zip_code') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary"
                                @click.prevent="create"
                                :disabled="form.busy">

                            Create
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</create-address>