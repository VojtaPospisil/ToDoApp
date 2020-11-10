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
            axios.get(`/my_projects/ToDoApp/public/api/category`)
                .then((response)=>{
                    context.commit('categories',response.data.data)
                })
        },
        updateCategory({commit}, data) {
            axios.put(`/my_projects/ToDoApp/public/api/category/${data.id}`, data)
        },
        deleteCategory({commit}, id) {
            axios.delete(`/my_projects/ToDoApp/public/api/category/${id}`);
        }
    },
    mutations:{
        categories(state,data){
            return state.category = data
        }
    }
}
