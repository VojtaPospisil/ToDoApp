<template>
    <div class="field-wrap">
        <label>
            Uživatel<span class="req">*</span>
        </label>
        <input name="user_id" v-bind:value="userId" type="hidden" required>
        <input id="name" type="text" v-model="search" @input="loadUsers()"
               required autocomplete="off" autofocus class="form_input">
        <div class="dropdown">
<!--            <input type="text" name="user" v-bind:value="userId" class="dropbtn">Dropdown</input>-->
            <div  v-bind:class="dropdown" v-for="user in users">
                <a href="#" @click.prevent="addUser(user.id, user.name)">{{ user.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                dropdown: 'dropdown-content',
                userId: '',
                users: [],
                search: ''
            }
        },
        methods: {
            loadUsers: function () {
                if (this.search.length > 2) {
                    axios.get(`/my_projects/ToDoApp/public/admin/user/search/${this.search}`)
                        .then((response) => {
                            this.users = response.data.data;
                            // this.dropdown = 'dropdown-content_display'
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    this.dropdown = 'dropdown-content'
                    this.userId = '';
                }
            },

            addUser(id, name) {
                this.userId = id;
                this.search = name;
                this.users = '';
            },
        }
    }
</script>
