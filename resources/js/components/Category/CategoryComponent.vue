<template>
    <div class="artist__content">
        <div class="tab-content">
            <!-- Overview -->
            <div role="tabpanel" class="tab-pane active" id="artist-overview">
                <div class="overview">
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
                                    <div class="track" v-for="category in categories">
                                        <div class="track__number">{{ category.id}}</div>
                                        <div class="track__title">
                                            <input type="text" name="name" @keypress.enter="updateCategory($event.target, category.id)"
                                                required autocomplete="current-password" v-model="category.name">
                                        </div>
                                        <div class="track__explicit">
                                            <input type="text" name="description" @keypress.enter="updateCategory($event.target, category.id)"
                                                   required autocomplete="current-password" v-model="category.description" class="input_description">
                                        </div>
                                        <div class="track__length pr-3">
                                            <a href="" @click.prevent="deleteCategory(category.id)">X</a>
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
        mounted() {
           this.$store.dispatch('getAllCategory');
        },
        computed: {
            categories(){
                return this.$store.getters.getAllCategory;
            }
        },
        methods: {
            loadCategories: function () {
                this.$store.dispatch('getAllCategory');
            },
            updateCategory: function(e, id) {
                var data = {id: id, attribute: e.name, newValue: e.value}
                this.$store.dispatch('updateCategory', data)
                .then(()=>{
                    this.$store.dispatch('getAllCategory');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            },
            deleteCategory: function(id) {
                this.$store.dispatch('deleteCategory', id)
                .then((response)=>{
                    this.$store.dispatch('getAllCategory');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            }
        }
    }
</script>
