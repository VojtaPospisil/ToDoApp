import routes from "../../router";

    const state = {
        categories:[],
        mainCategories:[],
        tasks: [],
        statuses: [],
        paginationData: {},
        comments: [],
    };

    const getters = {
        categories: state => state.categories,
        mainCategories: state => state.mainCategories,
        tasks: state => state.tasks,
        statuses: state => state.statuses,
        paginationData: state => state.paginationData,
        comments: state => state.comments,
    };

    const actions = {
        loadCategories(context){
            axios.get(`/my_projects/ToDoApp/public/admin/categories`)
                .then((response)=>{
                    context.commit('GET_CATEGORY',response.data.data)
                }).catch((error)=>{
                    console.log('Error', error)
                });
        },
        loadMainCategories(context){
            axios.get(`/my_projects/ToDoApp/public/admin/main_category`)
                .then((response)=>{
                    context.commit('GET_MAIN_CATEGORY',response.data.data)
                }).catch((error)=>{
                    console.log('Error', error)
                });
        },
        loadStatuses(context){
            axios.get(`/my_projects/ToDoApp/public/admin/status`)
                .then((response)=>{
                    context.commit('GET_STATUS',response.data.data)
                }).catch((error)=>{
                    console.log('Error', error)
                 });
        },
        loadTasks(context, data){
            axios.get(`/my_projects/ToDoApp/public/admin/jsonTask`, {
                params: data
            }).then((response)=>{
                const{data, ...pagination} = response.data;
                console.log(response.data);
                context.commit('SET_PAGINATION', pagination)
                    context.commit('GET_TASK', data)
                }).catch((error)=>{
                    console.log('Error', error)
                });
        },
        deleteTask(store, task) {
            axios.delete(`/my_projects/ToDoApp/public/admin/task/${task.id}`)
                .then((response) => {
                    if (response.status == 200) {
                        store.commit('DELETE_TASK', task);
                    }
                }).catch((response)=>{
                    console.log('Error', response)
                });
        },
        updateTask({commit}, data) {
            axios.put(`/my_projects/ToDoApp/public/admin/task/${data.id}`, data)
                .catch((response) => {
                    console.log('Error', response)
                });
        },
        addTask(store, data){
            axios.post(`/my_projects/ToDoApp/public/admin/task`, data)
                .then((response) => {
                    if (response.status == 201) {
                        store.commit('ADD_TASK', response.data);
                        // routes.push({name: 'task.index'});
                    }
                }).catch((error)=>{
                    console.log('Error', error)
                });
        },
        loadNewComments(context) {
            axios.get(`/my_projects/ToDoApp/public/admin/comments`)
                .then((response) => {
                    if (response.status == 200) {
                        context.commit('GET_COMMENTS', response.data.data);
                    }
                }).catch((error)=>{
                console.log('Error', error)
            });
        },
        setSeen(context, comment) {
            axios.get(`/my_projects/ToDoApp/public/admin/comment/${comment.id}`)
                .then((response) => {
                    if (response.status == 202) {
                        context.commit('SET_COMMENTS', comment);
                    }
                }).catch((error)=>{
                console.log('Error', error)
            });
        }
    };

    const mutations = {
        GET_CATEGORY(state,data){
            return state.categories = data
        },
        GET_MAIN_CATEGORY(state,data){
            return state.mainCategories = data
        },
        GET_TASK(state,data){
            state.tasks = data
        },
        DELETE_TASK(state, task){
            return state.tasks.splice(task, 1)
        },
        GET_STATUS(state, data){
            return state.statuses = data;
        },
        ADD_TASK(state, task){
            return state.tasks.push(task);
        },
        SET_PAGINATION(state, pagination){
            return state.paginationData = pagination;
        },
        GET_COMMENTS(state, comments){
            return state.comments = comments;
        },
        SET_COMMENTS(state, comment){
            return state.comments.splice(comment, 1);
        }
    };

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
