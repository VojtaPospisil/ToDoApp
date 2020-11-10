export default {
    state:{
        category:[],
    },
    getters:{
        getAllCategory(state){
            return state.category
        }
    },
    actions:{
        addCategory({commit}, data){
            axios.post(`/my_projects/ToDoApp/public/api/category`, data)
        },
        getAllCategory(context){
            console.log('getALlCategory');
            axios.get(`/my_projects/ToDoApp/public/api/category`)
                .then((response)=>{
                    context.commit('categories',response.data.data)
                })
        },
        updateCategory({commit}, data) {
            axios.put(`/my_projects/ToDoApp/public/api/category/${data.id}`, data)
        },
        deleteCategory({commit}, data) {
            axios.delete(`/my_projects/ToDoApp/public/api/category/${data.id}`)
                .then(() => {
                    commit('categoriesDelete', data.index);
                })
        }
    },
    mutations:{
        categories(state,data){
            return state.category = data
        },
        categoriesDelete(state, index){
            state.category.splice(index, 1)
        }
    }
}
