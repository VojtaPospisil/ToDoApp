<template>
    <div>
        <router-link :to="{name: 'front.task.index' }">
            <a class="btn btn-success mb-1">Zpět na přehled úkolů </a>
        </router-link>
        <div class="card-container">
            <div class="card planned">
                <div class="card-info">
                    <div class="card-title">{{ task.title }}</div>
                    <div class="card-detail">
                        <p>Pospis: {{ task.description }}</p>
                        <p v-if="task.main_category">Hlavní kategorie: {{ task.main_category.id }}</p>
                        <p v-if="task.category">Kategorie: {{ task.category[0].name }}</p>
                        <p v-if="task.user_created">Zadavatel: {{ task.user_created.name }}</p>
                        <p v-if="task.status">Status: {{ task.status.name }}</p>
                        <p>Datum splnění: {{ task.due_date }}</p>
                    </div>
                </div>
                <div class="card-social">
                    <ul v-if="task.status">
                        <a @click.prevent="statusEdit()" class="btn btn-success mb-1" v-if="task.status.id === 1">Začít pracovat na úkolu</a>
                        <a @click.prevent="statusEdit()" class="btn btn-success mb-1" v-if="task.status.id === 2">Dokončit</a>
                        <a @click.prevent="makeRequest()" class="btn btn-success mb-1" v-if="task.status.id !== 3">Poslat žádost</a>
                        <a @click.prevent="makeComment()" class="btn btn-success mb-1" v-if="task.status.id !== 3">Přidat komentář</a>
                    </ul>
                </div>
            </div>
        </div>
        <div v-if="request === true" class="card-container">
            <div class="card planned">
                <textarea></textarea>
                <button type="submit" class="button button-block">Vytvořit</button>
            </div>
        </div>
        <div v-if="comment === true" class="card-container">
            <div class="card planned">
                <textarea v-model="commentInput"></textarea>
                <button @click.prevent="addComment()" type="submit" class="button button-block">Vytvořit</button>
            </div>
        </div>
        <div id="comments">
            <div>
                <div class="comment" v-for="comment in comments">
                    <p>{{comment.comment }}</p>
                    <div v-for="child in comment.child">
                        <p>{{ child.comment }}</p>
                    </div>
                </div>
            </div>
        </div>


<!--        <div id="comments" v-if="task.comment">-->
<!--            <div>-->
<!--                <div class="comment" v-for="comment in task.comment">-->
<!--                    <p>{{comment.comment }}</p>-->
<!--                    <div v-for="child in comment.child">-->
<!--                        <p>{{ child.comment }}</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>

</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        data: function () {
            return {
                id: this.$route.params.id,
                comment: false,
                request: false,
                commentInput: '',
                requestInput: '',
            }
        },

        mounted() {
            this.loadTask();
        },
        computed: {
            ...mapGetters ([
                'task',
                'comments'
            ]),
        },
        methods: {
            ...mapActions([
                'loadTaskDetail',
                'statusTaskEdit',
                'createComment',
            ]),
            loadTask: function() {
                this.loadTaskDetail(this.$route.params.id);
            },
            statusEdit: function () {
                this.statusTaskEdit(this.id)
                .then((response) => {
                    this.loadTask();
                });
            },
            makeRequest: function() {
                this.request = !this.request;
            },
            makeComment: function() {
                this.comment = !this.comment;
            },
            addComment: function() {
                var data = {taskId: this.id, comment: this.commentInput};
                this.createComment(data)
                    .then((response) => {
                    this.comment = false;
                    // this.loadTask();
                });
            }
        }
    }
</script>
