<template>
    <div>
        <div class="row">
            <div class="col-md-4">
                <div class="avatar avatar-large avatar-changer" @click="changeAvatar" :style="'background-image:url('+avatar+');'"></div>
            </div><!--.col-md-4-->
            <div class="col-md-8">
                <form @submit.prevent="saveUser">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label>First Name</label>
                                <input type="text" class="form-control" required v-model="fname">
                            </div>
                            <div class="col-md-4">
                                <label>Last Name</label>
                                <input type="text" class="form-control" required v-model="lname">
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="email" class="form-control" required v-model="email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Password <em>(leave blank to not change)</em></label>
                                <input type="password" class="form-control" v-model="password">
                            </div>
                            <div class="col-md-6">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" v-model="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Save Changes</button>
                    </div>
                </form>
            </div><!--.col-md-8-->
        </div><!--.row-->

        <div class="modal" tabindex="-1" role="dialog" id="change-avatar-modal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Change Your Profile Avatar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Modal body text goes here.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-times"></span> Cancel</button>
                <button type="button" class="btn btn-primary"><span class="fa fa-check"></span> Save</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
export default {
    ready() {
        this.prepare();
    },
    mounted() {
        this.prepare();
    },
    data() {
        return {
            fname: "",
            lname: "",
            email: "",
            avatar: "",
            password: "",
            password_confirmation: ""
        };
    },
    methods: {
        prepare() {
            this.getUser();
        },

        getUser() {
            var url = window.Laravel.url + '/api/v1/current-user';
            axios.get(url).then(response => {
                this.fname = response.data.fname;
                this.lname = response.data.lname;
                this.email = response.data.email;
                this.avatar = response.data.avatar_url;
            });
        },

        saveUser() {
            if((this.password != "" && this.password_confirmation != "") && this.password != this.password_confirmation) {
                window.showMessage(2, 'Your new passwords did not match. Please try again.', 0);
            } else {
                var url = window.Laravel.url + '/api/v1/edit-current-user';
                axios.post(url, {
                    fname:this.fname,
                    lname:this.lname,
                    email:this.email,
                    password:this.password
                }).then(response => {
                    window.showMessage(1, 'Your profile was saved successfully!', 5);
                    this.getUser();
                    this.password = "";
                    this.password_confirmation = "";
                });
            }
        },

        changeAvatar() {
            $("#change-avatar-modal").modal();
        }
    }
}
</script>
