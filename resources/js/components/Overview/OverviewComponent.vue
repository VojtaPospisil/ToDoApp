<template>
    <div class="artist__content">
        <div class="tab-content">
            <!-- Overview -->
            <div role="tabpanel" class="tab-pane active" id="artist-overview">
                <div class="overview">


                <div class="overview__related">

                    <div class="section-title">Related Artists</div>

                    <div class="related-artists">

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/hoodie.jpg" alt="Hoodie Allen" />

                    </span>

                            <span class="related-artist__name">Hoodie Allen</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/mikestud.jpg" alt="Mike Stud" />

                    </span>

                            <span class="related-artist__name">Mike Stud</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/drake.jpeg" alt="Drake" />

                    </span>

                            <span class="related-artist__name">Drake</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/jcole.jpg" alt="J. Cole" />

                    </span>

                            <span class="related-artist__name">J. Cole</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/bigsean.jpg" alt="Big Sean" />

                    </span>

                            <span class="related-artist__name">Big Sean</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/wiz.jpeg" alt="Wiz Khalifa" />

                    </span>

                            <span class="related-artist__name">Wiz Khalifa</span>

                        </a>

                        <a href="#" class="related-artist">

                    <span class="related-artist__img">

                      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/7022/yonas.jpg" alt="Yonas" />

                    </span>

                            <span class="related-artist__name">Yonas</span>

                        </a>

                    </div>

                </div>


                    <div class="overview__albums">
                        <div class="album">
                            <div class="album__tracks">
                                <div class="tracks">
                                    <div class="tracks__heading">
                                        <div class="tracks__heading__number">#</div>
                                        <div class="tracks__heading__title">Název</div>
                                        <div>POPIS</div>
                                        <div class="tracks__heading__length">
                                            <i class="ion-ios-stopwatch-outline"></i>
                                        </div>
                                        <div class="tracks__heading__popularity">
                                            <i class="ion-thumbsup"></i>
                                        </div>
                                    </div>

<!--                                    &lt;!&ndash; UNFINISHED TASKS &ndash;&gt;-->
<!--                                    <h3>Nesplněné úkoly</h3>-->
<!--                                    <div class="track" v-for="(task, index) in tasks" v-if="task.status.id === UNFINISHED">-->
<!--                                        <div class="track__number">{{ task.id }}</div>-->
<!--                                        <div class="track__title">-->
<!--                                            <input type="text" name="title" @keypress.enter="updateTask($event.target, task.id)"-->
<!--                                                required autocomplete="current-password" v-model="task.title">-->
<!--                                        </div>-->
<!--                                        <div class="track__explicit">-->
<!--                                            <input type="text" name="description" @keypress.enter="updateTask($event.target, task.id)"-->
<!--                                                   required autocomplete="current-password" v-model="task.description" class="input_description">-->
<!--                                        </div>-->
<!--                                        <div class="track__explicit">-->
<!--                                            <p>{{ task.due_date}}</p>-->
<!--                                        </div>-->
<!--                                        <div class="track__explicit">-->
<!--                                            <p>{{ task.status.name}}</p>-->
<!--                                        </div>-->
<!--&lt;!&ndash;                                        <div class="track__length pr-3">&ndash;&gt;-->
<!--&lt;!&ndash;                                            <a href="" @click.prevent="deleteTask(task.id, index)">X</a>&ndash;&gt;-->
<!--&lt;!&ndash;                                        </div>&ndash;&gt;-->
<!--                                    </div>-->

                                    <!-- PLANNED TASKS -->
<!--                                    <h3>Naplánované úkoly</h3>-->
<!--                                    <div class="track" v-for="(task, index) in tasks" v-if="task.status.id === PLANNED">-->
<!--                                        <div class="track__number">{{ task.id }}</div>-->
<!--                                        <div class="track__title">-->
<!--                                            <input type="text" name="title" @keypress.enter="updateTask($event.target, task.id)"-->
<!--                                                   required autocomplete="current-password" v-model="task.title">-->
<!--                                        </div>-->
<!--                                        <div class="track__explicit">-->
<!--                                            <input type="text" name="description" @keypress.enter="updateTask($event.target, task.id)"-->
<!--                                                   required autocomplete="current-password" v-model="task.description" class="input_description">-->
<!--                                        </div>-->
<!--                                        <div class="track__length pr-3">-->
<!--                                            <a href="" @click.prevent="deleteTask(task.id, index)">X</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <div class="container">
                                        <div class="row unfinished">
                                            <div class="col-md-12">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Nesplněné úkoly</h3>
                                                        <div class="pull-right">
                                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                                <i class="glyphicon glyphicon-filter"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover" id="task-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Název</th>
                                                            <th>Popis</th>
                                                            <th>datum splnění</th>
                                                            <th>status</th>
                                                            <th>vytvořeno</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(task, index) in tasks" v-if="task.status.id === UNFINISHED">
                                                            <td>{{ task.title }}</td>
                                                            <td>{{ task.description }}</td>
                                                            <td>{{ task.due_date }}</td>
                                                            <td>{{ task.status.name }}</td>
                                                            <td>{{ task.created_at }}</td>
                                                            <td class="col-md-2">
                                                                <div class="btn-group" role="group">
                                                                    <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=edit">Edit</a>
                                                                    <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=remove">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="container">
                                        <div class="row planned">
                                            <div class="col-md-12">
                                                <div class="panel panel-success">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Naplánované úkoly</h3>
                                                        <div class="pull-right">
                                                            <span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
                                                                <i class="glyphicon glyphicon-filter"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <table class="table table-hover" id="task-table">
                                                        <thead>
                                                        <tr>
                                                            <th>Název</th>
                                                            <th>Popis</th>
                                                            <th>datum splnění</th>
                                                            <th>status</th>
                                                            <th>vytvořeno</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="(task, index) in tasks" v-if="task.status.id === PLANNED">
                                                            <td>{{ task.title }}</td>
                                                            <td>{{ task.description }}</td>
                                                            <td>{{ task.due_date }}</td>
                                                            <td>{{ task.status.name }}</td>
                                                            <td>{{ task.created_at }}</td>
                                                            <td class="col-md-2">
                                                                <div class="btn-group" role="group">
                                                                    <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=edit">Edit</a>
                                                                    <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=remove">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                PLANNED: 1,
                INPROGRES: 2,
                FINISHED: 3,
                UNFINISHED: 4
            }
        },

        mounted() {
            console.log(baseUrl);
           this.$store.dispatch('getAllTask');
        },
        computed: {
            tasks(){
                return this.$store.getters.getAllTask;
            },
        },
        methods: {
            loadCategories: function () {
                this.$store.dispatch('getAllTask');
            },
            updateTask: function(e, id) {
                // var data = {id: id, attribute: e.name, newValue: e.value}
                // this.$store.dispatch('updateCategory', data)
                // .then(()=>{
                //     this.$store.dispatch('getAllCategory');
                // }).catch(error => {
                //     if (error.response.status === 422) {
                //         this.errors = error.response.data.errors;
                //     }
                // });
            },
            deleteTask: function(id, index) {
                // var data = {id: id, index: index}
                // this.$store.dispatch('deleteCategory', data)
                // .then((response)=>{
                //     this.$store.dispatch('getAllCategory');
                // }).catch(error => {
                //     if (error.response.status === 422) {
                //         this.errors = error.response.data.errors;
                //     }
                // });
            }
        }
    }
</script>

<div class="container">
    <h1>Click the filter icon <small>(<i class="glyphicon glyphicon-filter"></i>)</small></h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">REGISTRY SYSTEM</h3>
                    <div class="pull-right">
							<span class="clickable filter" data-toggle="tooltip" title="Toggle table filter" data-container="body">
								<i class="glyphicon glyphicon-filter"></i>
							</span>
                    </div>
                </div>
                <div class="panel-body">
                    <input type="text" class="form-control" id="task-table-filter" data-action="filter" data-filters="#task-table" placeholder="Filter Tasks" />
                </div>
                <table class="table table-hover" id="task-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>SUID</th>
                        <th>OKPO</th>
                        <th>SystemType</th>
                        <th>DefaultTarget</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Kogon shahri</td>
                        <td>ijro.505</td>
                        <td></td>
                        <td>4</td>
                        <td>true</td>
                        <td>true</td>
                        <td class="col-md-2">
                            <div class="btn-group" role="group">
                                <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=edit">Edit</a>
                                <a class="btn btn-default" href="/portal/admin/register-system-edit.htm?id=505&amp;action=remove">Delete</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
