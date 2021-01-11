<template>
    <div class="overview__albums">
<!--        <router-link :to="{name: 'task.create'}">-->
<!--            <a class="btn btn-success mb-1">Vytvořit úkol</a>-->
<!--        </router-link>-->
        <div class="album">
            <div class="album__tracks">
                <div class="tracks">
                    <div class="container">
                        <div class="row planned">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Úkoly</h3>
                                        <div class="pull-right">
                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                <i class="glyphicon glyphicon-filter"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <table class="table table-hover" id="task-table">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Název
                                                <input @input="setSearchValues($event.target)" id="title" class="task_input" type="text">
                                            </th>
                                            <th>Popis
                                                <input @input="setSearchValues($event.target)" id="description" class="task_input" type="text">
                                            </th>
                                            <th>Halvní kategorie
                                                <select type="text" class="task_input"
                                                        name="main_category" value=""
                                                        v-model="searchParams.mainCategory"
                                                        required autocomplete="off"
                                                        autofocus
                                                >
                                                    <option :value="null"></option>
                                                    <option v-for="mainCategory in mainCategories"
                                                            :value="mainCategory.id">
                                                        {{ mainCategory.name }}
                                                    </option>
                                                </select>
                                            </th>
                                            <th>Kategorie</th>
                                            <th>datum splnění
                                                <input id="due_date_from" type="date" v-model="searchParams.dueDateFrom" class="task_input"
                                                       name="due_date_from" value="" required autocomplete="off" autofocus>
                                                <input id="due_date_to" type="date" v-model="searchParams.dueDateTo" class="task_input"
                                                       name="due_date_to" value="" required autocomplete="off" autofocus>
                                            </th>
                                            <th>status
                                                <select
                                                    type="text" class="task_input"
                                                    name="main_category" value=""
                                                    v-model="searchParams.status"
                                                    required autocomplete="off"
                                                    autofocus>
                                                    <option :value="null"></option>
                                                    <option v-for="status in statuses"
                                                            :value="status.id">
                                                        {{ status.name }}
                                                    </option>
                                                </select>
                                            </th>
                                            <th>Přiřazený uživatel
                                                <div class="dropdown">
                                                    <input type="text" @input="loadUsers($event.target)"
                                                           required autocomplete="off" autofocus class="task_input">
                                                    <div class="dropdown_content">
                                                        <div v-for="user in users">
                                                            <a href="#" @click.prevent="setSearchUser(user.id)">{{ user.name }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>vytvořeno</th>
                                            <th>Vytvořil</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(task, index) in tasks">
                                                <td><a @click.prevent="taskDetail(task.id)" prevent.default href="">{{task.id}}</a></td>
                                                <td>
                                                    <input :readonly="task.status.id !== 1"
                                                        class="task_input" type="text" name="title"
                                                        @keypress.enter="updateTasks($event.target, task.id)"
                                                        required v-model="task.title">
                                                </td>
                                                <td>
                                                    <input
                                                        class="task_input" type="text" name="description"
                                                        @keypress.enter="updateTasks($event.target, task.id)"
                                                        required v-model="task.description">
                                                </td>
                                                <td>
                                                    <select
                                                        type="text" class="task_input"
                                                        @input="updateTasks($event.target, task.id)"
                                                        :readonly="task.status.id !== 1"
                                                        name="main_category" value=""
                                                        required autocomplete="off"
                                                        autofocus>
                                                        <option
                                                            v-for="mainCategory in mainCategories"
                                                            :selected="task.main_category_id === mainCategory.id"
                                                            :value="mainCategory.id">
                                                            {{ mainCategory.name }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select type="text" class="task_input"
                                                            @input="updateTasks($event.target, task.id)"
                                                            :readonly="task.status.id !== 1"
                                                            name="category" required autocomplete="off" autofocus>
                                                        <option v-for="category in categories"
                                                                :selected="task.category_id === category.id"
                                                                :value="category.id">
                                                            {{ category.name }}
                                                        </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input
                                                        class="task_input" type="date" name="due_date" :readonly="task.status.id !== 1 || 4"
                                                        @keypress.enter="updateTasks($event.target, task.id)"
                                                        required autocomplete="current-password" v-model="task.due_date"
                                                    >
                                                </td>
                                                <td>{{ task.status.name }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                    <input type="text" @input="loadUsers($event.target)" v-model="task.user_assigned.name"
                                                           required autocomplete="off" autofocus class="task_input">
                                                        <div class="dropdown_content">
                                                            <div v-for="user in users">
                                                                <a href="#" @click.prevent="addUser(user.id, user.name)">{{ user.name }}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ task.created_at }}</td>
                                                <td>{{ task.user_created.name }}</td>
                                                <td class="col-md-2">
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-default" @click.prevent="deleteTask(task)" href="#">X</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <pagination-component :pagination-data="paginationData" @change-page="changePage"></pagination-component>
                        </div>
                    </div>
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
                currentPage: 1,
                searchParams: {
                    title: null,
                    description: null,
                    mainCategory: null,
                    category: null,
                    dueDateFrom: null,
                    dueDateTo: null,
                    status: null,
                    user: null,
                },
            }
        },
        mounted() {
            this.loadData();
            this.loadTask();
        },
        watch: {
            searchParams: {
                handler() {
                    this.loadTask(this.currentPage);
                },
                deep: true
            },
        },
        computed: {
            ...mapGetters ('adminStore', [
                'categories',
                'mainCategories',
                'statuses',
                'tasks',
                'paginationData',
            ]),
        },
        methods: {
            ...mapActions('adminStore', [
                'loadCategories',
                'loadMainCategories',
                'loadStatuses',
                'loadTasks',
                'taskDetail',
                'updateTask',
            ]),

            loadData: function() {
                this.loadCategories();
                this.loadMainCategories();
                this.loadStatuses();
            },
            loadTask: function(page = 1) {
                this.searchParams.page = page;
                this.currentPage = page;
                this.loadTasks(this.searchParams);
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

            updateTasks: function(e, id) {
                console.log(e.name, e.value);
                var attribute = e.name;
                var data = {id: id};
                data[attribute] = e.value;

                console.log(data);

                // var data = {id: id, [e.value: e.value]};
                // var data = {id: id, attribute: e.name, newValue: e.value}
                this.updateTask(data);
                // this.$store.dispatch('updateTask', data);
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
            },
            changePage: function (page) {
                this.loadTask(page);
            },
            taskDetail: function(id) {
                window.location.href = document.location.href + '/' + id;
            }
        },
    }
</script>
