import Vue from 'vue'
import VueRouter from 'vue-router';

//Category
import CategoryComponent from './components/Category/CategoryComponent';
import CreateCategoryComponent from './components/Category/CreateCategoryComponent';

Vue.use(VueRouter);

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path:'/my_projects/ToDoApp/public/category',
            name: 'category.index',
            component:CategoryComponent
        },
        {
            path:'/my_projects/ToDoApp/public/category/create',
            name: 'category.create',
            component:CreateCategoryComponent
        }
    ]
});

export default routes
