<template>
    <div>
        <h3 class="text-center">Edit Developer</h3>
                <form @submit.prevent="updateDeveloper" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
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
                        <input type="text" class="form-control" v-model="developer.email" disabled>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" class="form-control" v-model="developer.phone_number">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="developer.address">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Developer</button>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Avatar</label>
                          <input type="file" v-on:change="onImageChange" class="form-control">
                      </div>
                      <img v-bind:src="avatar" v-if="avatar" class="rounded" style="display: block;max-width: 100%;height: auto;">
                      <img src="/images/profile-dummy.png" v-else-if="developer.avatar === null" class="rounded" style="display: block;max-width: 100%;height: auto;">
                      <img v-bind:src="'/images/'+developer.avatar" v-else class="rounded" style="display: block;max-width: 100%;height: auto;">
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
        created() {
            this.axios
                .get(`/api/developer/view/${this.$route.params.id}`)
                .then((response) => {
                    this.developer = response.data
                });
        },
        methods: {
            updateDeveloper() {
                this.axios
                    .post(`/api/developer/update/${this.$route.params.id}`, this.developer)
                    .then((response) => {
                        this.$router.push({name: 'home'})
                    })
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
                    vm.avatar = e.target.result
                    this.developer.avatar = vm.avatar
                };
                reader.readAsDataURL(file);
            }
        }
    }
</script>
