require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;


// vee-validate
import * as VeeValidate from 'vee-validate';



let AppLayout = require('./components/App').default;




// list all tasks
const TaskList = Vue.component('TaskList', require('./components/TaskList').default);

// create and update
const TaskCreateEdit = Vue.component('TaskCreateEdit', require('./components/TaskCreateEdit').default);

// show single task
const  TaskShow = Vue.component('TaskShow', require('./components/TaskShow').default);


// modules register
Vue.use(VueRouter, VueAxios, axios, VeeValidate);


const routes = [
    //list
    {name: 'TaskList', path: '/',  component: TaskList},
    // create and update
    {name: 'TaskCreateEdit', path: '/task-create_edit',  component: TaskCreateEdit},
    //show
    {name: 'TaskShow', path: '/show/:id',  component: TaskShow},

];


const router = new VueRouter({mode: 'history', routes: routes});

new Vue(
    Vue.util.extend(
        {router},
        AppLayout,
    )
).$mount('#app');