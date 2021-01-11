import Vue from 'vue'
import VueRouter from 'vue-router';

//Task

//Category
import CategoryComponent from './components/Category/CategoryComponent';
import CreateCategoryComponent from './components/Category/CreateCategoryComponent';

// Task
import TaskComponent from "./components/Admin/Task/TaskComponent";
import CreateTaskComponent from "./components/Admin/Task/CreateTaskComponent";

// Overview
import OverviewComponent from "./components/Overview/OverviewComponent";

import FrontTaskOverview from "./components/Front/Task/TaskComponent";
import FrontTaskDetail from "./components/Front/Task/TaskDetailComponent";
import FrontLogin from "./components/Front/Auth/AuthComponent";

Vue.use(VueRouter);

const auth = (to, from, next) => {
    if (localStorage.getItem("authToken")) {
        if(localStorage.getItem("authToken") !== 'undefined') {
            return next();
        }
    } else {
        return next("/login");
    }
};

const admin = (to, from, next) => {
    if (localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/login");
    }
};

const routes = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path:'/my_projects/ToDoApp/public/admin/task',
        //     name: 'task.index',
        //     component:TaskComponent
        // },
        // {
        //     path:'/my_projects/ToDoApp/public/admin/task/create',
        //     name: 'task.create',
        //     component:CreateTaskComponent
        // },
        {
            path:'/my_projects/ToDoApp/public',
            name: 'front.task.index',
            beforeEnter: auth,
            component:FrontTaskOverview
        },
        {
            path:'/my_projects/ToDoApp/public/detail/:id',
            name: 'front.task.detail',
            beforeEnter: auth,
            component:FrontTaskDetail
        },
        {
            path:'/my_projects/ToDoApp/public/login',
            name: 'front.task.login',
            component:FrontLogin
        },
    ]
});

export default routes
