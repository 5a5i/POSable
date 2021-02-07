<template>
    <div>
        <h3 class="text-center">Add Developer</h3>
            <form @submit.prevent="addDeveloper" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <input type="hidden" name="_token" :value="csrf">
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" v-model="developer.first_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" v-model="developer.last_name">
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control" v-model="developer.email">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" v-model="developer.phone_number">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" v-model="developer.address">
                </div>
                <button type="submit" class="btn btn-primary">Add Developer</button>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Avatar</label>
                      <input type="file" v-on:change="onImageChange" class="form-control">
                  </div>
                  <img v-bind:src="avatar" v-if="avatar" class="rounded" style="display: block;max-width: 100%;height: auto;">
                  <img src="/images/profile-dummy.png" v-else class="rounded" style="display: block;max-width: 100%;height: auto;">
              </div>
            </div>
            </form>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                developer: {},
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                avatar: ''
            }
        },
        methods: {
            addDeveloper() {
                this.axios
                    .post(`/api/developer/add`, this.developer)
                    .then(response => (
                        this.$router.push({name: 'home'})
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);

            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.avatar = e.target.result;
                    this.developer = Object.assign( {}, {avatar: this.avatar}, this.developer);
                    this.developer = Object.assign( {}, {'​_token': window.Laravel.csrfToken.csrfToken}, this.developer);
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
