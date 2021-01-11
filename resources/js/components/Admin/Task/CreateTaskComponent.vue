<template>
    <div id="register">
        <form role="form" @submit.prevent="createTask()" enctype="multipart/form-data">
            <div class="field-wrap">
                <label>
                    Název<span class="req">*</span>
                </label>
                <input id="title" type="text" v-model="form.title" class="form_input"
                    name="title" value="" required autocomplete="off" autofocus>
            </div>
            <div class="field-wrap">
                <label>
                    Popis<span class="req">*</span>
                </label>
                <textarea id="description" type="text" v-model="form.description" class="form_input"
                    name="description" value="" required autocomplete="description"></textarea>
            </div>
            <div class="field-wrap">
                <label>
                    Hlavní kategorie<span class="req">*</span>
                </label>
                <select id="main_category" type="text" v-model="form.main_category" class="form_input"
                       name="main_category" value="" required autocomplete="off" autofocus>
                    <option v-for="mainCategory in mainCategories" v-bind:value="mainCategory.id">
                        {{ mainCategory.name }}
                    </option>
                </select>
            </div>
            <div class="field-wrap">
                <label>
                    Kategorie<span class="req">*</span>
                </label>
                <select id="category" type="text" v-model="form.category" class="form_input"
                       name="category" value="" required autocomplete="off" autofocus>
                    <option v-for="category in categories" v-bind:value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>
            <div class="field-wrap">
                <label>
                    Do data<span class="req">*</span>
                </label>
                <input id="due_date" type="date" v-model="form.due_date" class="form_input"
                       name="due_date" value="" required autocomplete="off" autofocus>
            </div>
            <form-user-search-bar ref="search_bar"></form-user-search-bar>
            <button type="submit" class="button button-block">Vytvořit</button>
        </form>
    </div>
</template>

<script>
    import FormUserSearchBar from "../formUserSearchBar";
    import {mapActions, mapGetters} from "vuex";

    export default {
        components: {
            FormUserSearchBar
        },
        data: function () {
            return {
                form: new Form({
                    user_id: '',
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
            }
        },
        mounted() {
            this.loadData();
        },
        computed: {
            ...mapGetters ('adminStore', [
                'categories',
                'mainCategories',
            ]),
        },
        methods: {
            ...mapActions('adminStore', [
                'loadCategories',
                'loadMainCategories',
                'addTask',
            ]),

            loadData: function(){
                this.loadCategories();
                this.loadMainCategories();
            },

            createTask: function() {
                this.form.user_id = this.$refs['search_bar'].userId;
                this.addTask(this.form);
                // console.log(document.location.origin + '/my_projects/ToDoApp/public/admin/task');
                window.location.href = document.location.origin + '/my_projects/ToDoApp/public/admin/task';
                // this.$store.dispatch('addTask', this.form);
            }
        },
    }
</script>
