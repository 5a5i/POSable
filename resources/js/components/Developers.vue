<template>
    <div>
        <h3 class="text-center">All Developers</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="15">
                    <input type="checkbox" @click="select_all_via_check_box" v-model="all_select">
                    <span> {{ all_select == true ? 'Uncheck All' : "Select All" }} </span></th>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-mail</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="developer in developers" :key="developer.id">
                <td width="15"><input type="checkbox" v-model="deleteItems" :value="developer.id"></td>
                <td>{{ developer.id }}</td>
                <td>{{ developer.first_name }}</td>
                <td>{{ developer.last_name }}</td>
                <td>{{ developer.email }}</td>
                <td>{{ developer.created_at | formatDate }}</td>
                <td>{{ developer.updated_at | formatDate }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'viewDeveloper', params: { id: developer.id }}" class="btn btn-success">View
                        </router-link>
                        <router-link :to="{name: 'editDeveloper', params: { id: developer.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteDeveloper(developer.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-3 offset-md-7 d-flex justify-content-right">
                <button class="btn btn-danger float-right" @click="deleteDevelopers()" :disabled='isDisabled'>Delete Selected Developers</button>
            </div>
            <div class="col-md-2 d-flex justify-content-right">
                <router-link to="/developer/add" class="btn btn-secondary float-right">Add Developer</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developers: {},
                deleteItems: [],
                select: '',
                all_select: false,
                isDeleteDisabled: true
            }
        },
        created() {
                this.getDeveloper()
        },
        computed: {
          	isDisabled: function(){
          	return !this.deleteItems.length;
          }
        },
        methods: {
            getDeveloper(){
                this.axios
                    .get(`/api/developer`)
                    .then(response => {
                        this.developers = response.data;
                    })
            },
            deleteDeveloper(id) {
                this.axios
                    .delete(`/api/developer/delete/${id}`)
                    .then(response => {
                        let i = this.developers.map(item => item.id).indexOf(id); // find index of your object
                        this.developers.splice(i, 1)
                    });
            },
            deleteDevelopers() {
                axios.post('/api/developer/multiple/delete',{ ids: this.deleteItems })
                     .then((response) => {
                        this.getDeveloper()
                        this.deleteItems = []
                        this.all_select == true ? this.all_select = false : (this.all_select == false ? this.all_select = false : this.all_select = true);
                             console.log(this.deleteItems);
                     })
            },
            select_all_via_check_box(){
                if(this.all_select == false){
                    this.all_select = true
                    this.developers.forEach(developers => {
                      this.deleteItems.push(developers.id)
                    });
                }else{
                    this.all_select = false
                    this.deleteItems = []
                }
                console.log(this.deleteItems);
            }
        },
    }
</script>
