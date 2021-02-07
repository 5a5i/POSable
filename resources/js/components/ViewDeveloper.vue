<template>
    <div>
        <h3 class="text-center">View Developer Details</h3>
        <div class="row">
            <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                <img v-bind:src="'/images/'+developer.avatar" class="rounded" style="display: block;max-width: 100%;height: auto;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                    <label>First Name :  {{ developer.first_name }}</label>
            </div>
            <div class="col-md-6">
                    <label>Last Name :  {{ developer.last_name }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                    <label>E-mail :  {{ developer.email }}</label>
            </div>
            <div class="col-md-6">
                    <label>Phone Number :  {{ developer.phone_number }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                    <label>Address :  {{ developer.address }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center">
                <router-link :to="{name: 'editDeveloper', params: { id: developer.id }}" class="btn btn-primary">Edit Developer Details
                </router-link>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <button class="btn btn-danger" @click="deleteDeveloper(developer.id)">Delete Developer</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developer: {},
                avatar: ''
            }
        },
        created() {
            this.axios
                .get(`/api/developer/view/${this.$route.params.id}`)
                .then((response) => {
                    this.developer = response.data;
                });
        },
        methods: {
            deleteDeveloper(id) {
                this.axios
                    .delete(`/api/developer/delete/${id}`, this.developer)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>
