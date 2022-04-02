require("./bootstrap");
import Vue from 'vue' 
import VueRouter from 'vue-router'
import CoursComponent from './components/CoursComponent'

Vue.use(VueRouter)
const routes = [
    {path:'/details-cours/:id', component: CoursComponent, name: 'cours-details'}
]

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    components : {CoursComponent},
    router
});
