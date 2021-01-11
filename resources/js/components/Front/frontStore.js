import Vue from "vue";
import routes from "../../router";

    const state = {
        userTasks: [],
        task: {},
        comments: {}
    };

    const getters = {
        userTasks: state => state.userTasks,
        task: state => state.task,
        comments: comment => state.comments
    };

    const actions = {
        loadUserTasks(context, data) {
            axios.get(`/my_projects/ToDoApp/public/api/tasks/`, {
                params: data,
            }).then((response) => {
                context.commit('GET_TASKS', response.data);
            }).catch(function (error) {
                console.log('Error', error);
            });
        },
        loadTaskDetail(context, id) {
            axios.get(`/my_projects/ToDoApp/public/api/detail/${id}`)
                .then((response) => {
                    console.log(response.data.data);
                    console.log(response.data.data.comment);
                    // console.log(response.data.data.comment[0].child);
                    context.commit('GET_TASK', response.data.data);
                    context.commit('SET_COMMENT', response.data.data.comment);
                }).catch(function (error) {
                    // routes.push({name: 'front.task.index'});
                // routes.push({name: 'front.task.detail'});
                    console.log('Error', error);
                });
        },
        statusTaskEdit(context, id) {
            axios.get(`/my_projects/ToDoApp/public/api/edit/${id}`)
                .then((response) => {
                    context.commit('GET_TASK', response.data.task)
                }).catch(function (error) {
                    console.log('Error', error);
                });
        },
        createComment(context, data) {
            axios.post(`/my_projects/ToDoApp/public/api/comment`, data)
                .then((response) => {
                    console.log('comment');
                console.log(response)
                    context.commit('SET_COMMENT', response.data.data.comment);
                    // context.commit('ADD_COMMENT', response.data.comment)
                }).catch(function (error) {
                    console.log('Error', error);
                });
        }
    };

    const mutations = {
        GET_TASKS(state,data){
            state.userTasks = data
        },
        GET_TASK(state,data){
            state.task = data
        },
        UPDATE_TASK(state, data){
            Vue.set(state.task, 'status', data.status)
        },
        SET_COMMENT(state, data) {
            return state.comments = data;
            // return state.comments.push(data);
        }
    // }
    };

export default {
    state,
    getters,
    actions,
    mutations
};
