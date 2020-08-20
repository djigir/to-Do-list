require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;



let AppLayout = require('./components/App').default;




// list all tasks
const TaskList = Vue.component('TaskList', require('./components/TaskList').default);

// add task
const TaskCreate = Vue.component('TaskCreate', require('./components/TaskCreate').default);

// edit task
const  TaskEdit = Vue.component('TaskEdit', require('./components/TaskEdit').default);

// delete task
const TaskDelete = Vue.component('TaskDelete', require('./components/TaskDelete').default);

// show single task
const  TaskShow = Vue.component('TaskShow', require('./components/TaskShow').default);


//pagination
Vue.component('pagination', require('laravel-vue-pagination'));


// modules register
Vue.use(VueRouter, VueAxios, axios);



const routes = [
    //list
    {name: 'TaskList', path: '/',  component: TaskList},
    //create
    {name: 'TaskCreate', path: '/task-create',  component: TaskCreate},
    //edit
    {name: 'TaskEdit', path: '/edit/:id',  component: TaskEdit},
    //delete
    {name: 'TaskDelete', path: '/task-delete',  component: TaskDelete},
    //show
    {name: 'TaskShow', path: '/show/:id',  component: TaskShow},

];


const router = new VueRouter({mode: 'history', routes: routes});

new Vue(
    Vue.util.extend(
        {router},
        AppLayout
    )
).$mount('#app');