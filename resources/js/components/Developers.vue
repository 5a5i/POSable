<template>
    <div>
        <h3 class="text-center">All Developers</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
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
                <td>{{ developer.id }}</td>
                <td>{{ developer.first_name }}</td>
                <td>{{ developer.last_name }}</td>
                <td>{{ developer.email }}</td>
                <td>{{ developer.created_at }}</td>
                <td>{{ developer.updated_at }}</td>
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
        <router-link to="/developer/add" class="btn btn-secondary float-right">Add Developer</router-link>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                developers: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/developer')
                .then(response => {
                    this.developers = response.data;
                });
        },
        methods: {
            deleteDeveloper(id) {
                this.axios
                    .delete(`http://localhost:8000/api/developer/delete/${id}`)
                    .then(response => {
                        let i = this.developers.map(item => item.id).indexOf(id); // find index of your object
                        this.developers.splice(i, 1)
                    });
            }
        }
    }
</script>
