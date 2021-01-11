import routes from "../../../router";

    const state = {
        userData: null,
        errors: {},
    };

    const getters = {
        userData: state => state.userData,
        errors: state => state.errors,
    };

    const actions = {
        getUserData({ commit }) {
            axios
                .get( "/my_projects/ToDoApp/public/api/user")
                .then(response => {
                    commit("setUserData", response.data);
                }).catch((error)=>{
                console.log('Error', error)
                });
        },
        sendLoginRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            axios.get('/my_projects/ToDoApp/public/sanctum/csrf-cookie').then(response => {
                axios.post(`/my_projects/ToDoApp/public/api/login`, data)
                    .then(response => {
                        console.log('response');
                        console.log(response);
                        if (response.data.status_code !== 500) {
                            commit("setUserData", response.data.user);
                            localStorage.setItem("authToken", response.data.auth_token);
                            routes.push({name: "front.task.index"})
                        } else {
                            // commit("setErrors", response.data.error);
                            console.log('sakra error');
                        }
                    }).catch((message) => {
                        console.log('Error', message);
                        // console.log('Error', error);
                     });
            })
        },
        sendRegisterRequest({ commit }, data) {
            commit("setErrors", {}, { root: true });
            axios.post(`/my_projects/ToDoApp/public/api/register`, data)
                .then(response => {
                    commit("setUserData", response.data.user);
                    localStorage.setItem("authToken", response.data.access_token);
                });
        },
        sendLogoutRequest({ commit }) {
            axios.post(`/my_projects/ToDoApp/public/api/logout`).then(() => {
                commit("setUserData", null);
                localStorage.removeItem("authToken");
                routes.push({name: "front.task.login"});
            }).catch(function (error) {
                console.log('Error', error);
            });
        },
    };

    const mutations = {
        setUserData(state, user) {
            state.userData = user;
        },
        setErrors(state, errors) {
            state.errors = errors;
        }
    };

export default {
    state, getters, actions, mutations
};
