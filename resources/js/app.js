require("./bootstrap");
import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "./store/index"
import storeMessagerie from './store/store-messagerie'

import Messagerie from './components/MessagerieComponent'
import MessagesComponent from './components/MessagesComponent'

import Comments from './components/Comments'
import FormComment from './components/FormComment'

let $comment = document.querySelector('#comment')
let $messagerie = document.querySelector('#messagerie')

//Comment
if($comment){
    const app = new Vue({
        el: "#comment",
        components: {Comments, FormComment},
        store
    });
}

//Chat
if($messagerie){
    Vue.use(VueRouter)
    const routes = [
      {path: '/'},
      {path:'/:id', component: MessagesComponent, name: 'conversation'}
    ]
  
    const router = new VueRouter({
          mode: 'history',
          routes,
          base : $messagerie.getAttribute('data-base')
    });  
  
    new Vue({
          el: '#messagerie',
          components: { Messagerie},
          store : storeMessagerie,
          router
    }); 
}
