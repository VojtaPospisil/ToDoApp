<template>
    <div class="container">
        <div class="row planned">
            <div class="col-md-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Nové Komentáře</h3>
                        <div class="pull-right">
                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                <i class="glyphicon glyphicon-filter"></i>
                            </span>
                        </div>
                    </div>
                    <table class="table table-hover" id="task-table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Název úkolu</th>
                            <th>Komentář</th>
                            <th>Přidáno</th>
                            <th>Akce</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="comment in comments">
                            <td><a @click.prevent="taskDetail(comment.task_id)" prevent.default href="">{{ comment.task_id }}</a></td>
                            <td>{{ comment.task.title}}</td>
                            <td>{{ comment.comment }}</td>
                            <td>{{ comment.created_at }}</td>
                            <td class="col-md-2">
                                <div class="btn-group" role="group">
                                    <input @click="setIsSeen(comment)" type="checkbox">Přečteno
                                    <a href="" @click.prevent="answerComment( comment.task_id, comment.id)">Odpovědět</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";

    export default {
        mounted() {
            this.loadData();
        },
        computed: {
            ...mapGetters ('adminStore', [
                'comments'
            ]
        )},
        methods: {
            ...mapActions('adminStore', [
                'loadNewComments',
                'setSeen'
            ]),
            loadData: function() {
                this.loadNewComments();
            },
            setIsSeen: function (comment) {
                this.setSeen(comment)
            },
            answerComment: function(taskId, commentId) {
                window.location.href = document.location.href + '/task/' + taskId + '/' + commentId;
            },
            taskDetail: function(id) {
                window.location.href = document.location.href + '/task/' + id;
            }
        },
    }
</script>
