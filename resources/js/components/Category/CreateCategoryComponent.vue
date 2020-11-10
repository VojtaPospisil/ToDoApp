<template>
    <div id="register">
        <form role="form" @submit.prevent="createCategory()" enctype="multipart/form-data">
            <div class="field-wrap">
                <label>
                    Název<span class="req">*</span>
                </label>
                <input id="name" type="text" v-model="form.name"
                    name="name" value="" required autocomplete="off" autofocus>
            </div>
            <div class="field-wrap">
                <label>
                    Popis<span class="req">*</span>
                </label>
                <textarea id="description" type="text" v-model="form.description"
                    name="description" value="" required autocomplete="description"></textarea>
            </div>
            <button type="submit" class="button button-block">Vytvořit</button>
        </form>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                form: new Form({
                    name: '',
                    description: '',
                    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                })
            }
        },
        methods: {
            createCategory: function() {
                this.$store.dispatch('addCategory', this.form)
                    .then((response) => {
                        this.$router.push({name: 'category.index'});
                        // this.$router.replace({name: 'category.index'})
                    });
            }
        }
    }
</script>
