<template>
<div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul v-if="userData" class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ userData.name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"  href="" @click.prevent="logout()">Odhlásit</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Task</h1>
    <div class="flex-container">
        <div class="planned p-5" >
            Naplánované
            <div v-for="planned in userTasks.planned">
                <h5 class="pb-2">
                    <router-link :to="{name: 'front.task.detail', params: {id: planned.id} }">{{ planned.title }} - {{ planned.due_date }}</router-link>
                </h5>
            </div>
        </div>
        <div class="in_progress p-5">
            V procesu
            <div v-for="progress in userTasks.inProgress">
                <h5 class="pb-2">
                    <router-link :to="{name: 'front.task.detail', params: {id: progress.id} }">{{ progress.title }} - {{ progress.due_date }}</router-link>
                </h5>
            </div>
        </div>
        <div class="unfinished p-5">
            Nedokončené
            <div v-for="unfinished in userTasks.unfinished">
                <h5 class="pb-2">
                    <router-link :to="{name: 'front.task.detail', params: {id: unfinished.id} }">{{ unfinished.title }} - {{ unfinished.due_date }}</router-link>
                </h5>
            </div>
        </div>
        <div class="finished p-5">
            Dokončené
            <div v-for="finished in userTasks.finished">
                <h5 class="pb-2">
                    <router-link :to="{name: 'front.task.detail', params: {id: finished.id} }">{{ finished.title }} - {{ finished.due_date }}</router-link>
                </h5>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        data: function () {
            return {
                users: [],
                title: '',
                searchParams: {
                    title: null,
                    description: null,
                    mainCategory: null,
                    category: null,
                    dueDateFrom: null,
                    dueDateTo: null,
                    status: null,
                    user: null,
                }
            }
        },
        mounted() {
            this.loadData();
        },
        computed: {
            ...mapGetters ([
                'userTasks',
                'userData',
            ]),
        },
        methods: {
            ...mapActions([
                'loadUserTasks',
                'sendLogoutRequest',
                'getUserData',
            ]),

            loadData: function() {
                this.loadUserTasks();
                this.getUserData();
            },
            logout: function() {
                this.sendLogoutRequest();
            },

            loadUsers: function (e) {
                var search = e.value;
                if (search.length > 2) {
                    axios.get(`/my_projects/ToDoApp/public/admin/user/search/${search}`)
                        .then((response) => {
                            this.users = response.data.data;
                            $(e).parent().children('.dropdown_content').attr('style', 'display:block');
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                } else {
                    this.users = '';
                    this.searchParams.user = null;
                }
            },

            updateTask: function(e, id) {
                var data = {id: id, attribute: e.name, newValue: e.value}
                this.$store.dispatch('updateTask', data);
            },
            deleteTask: function(task) {
                this.$store.dispatch('deleteTask', task)

            },
            setSearchValues(e) {
                if (e.value.length >= 1) {
                    this.searchParams[e.id] = e.value;
                } else {
                    this.searchParams[e.id] = null;
                }
            },
            setSearchUser(id) {
                this.searchParams.user = id;
                this.users = '';
            }
        },
    }
</script>
