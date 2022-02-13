<template>
    <div class="container">
        <div class="card-header align-items-center px-4 py-3">
            <div class="row">
                    <div class="col-md-8">
                        <div class="text-dark-75 font-weight-bold font-size-h4">
                            {{pseudo}}
                        </div>
                        <div>
                            <span v-if="etat==1" class="label label-dot label-success"></span>
                            <span v-if="etat==1" class="font-weight-bold text-muted font-size-sm">En ligne</span>
                            <span v-if="etat==0" class="label label-dot label-default"></span>
                            <span v-if="etat==0" class="font-weight-bold text-muted font-size-sm">Hors ligne</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-right">
                            <span @click="referencement(idUser,pseudo)"  class="btn btn-danger btn-shadow font-weight-bold mb-1" style="cursor:pointer;">R&eacute;f&eacute;rencer ce cas</span>
                        </p>
                    </div>
            </div>
        </div>
        <div class="card-body card-scroll" style="height: 500px;" id="messagerie__body">
                <div class="messages">
                    <Message :message="message" v-for="message in messages" :user="user" :key="message.id"/>
                 </div>
        </div>
        <div class="overlay-block" v-bind:class="{overlay:loading}">
            <!--Footer-->
            <div class="card-footer align-items-center">
                <form class="form">
                    <textarea :class="{'form-control':true, 'is-invalid':errors['content']}" v-model="content" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" @keypress.enter="sendMessage" cols="30" rows="3" placeholder="Votre message"></textarea>
                    <div class="invalid-feedback" v-if="errors['content']">Ce champ est obligatoire </div>
                </form>
            </div>
            <div class="overlay-layer">
               <div class="spinner-lg spinner-danger" v-bind:class="{spinner:loading}"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Message from './MessageComponent'
    import {mapGetters} from 'vuex'
    export default {
        components:{
            Message
        },  
        data() {
            return {
                content: '',
                errors : {},
                loading : false
            }
        },
        computed: {
            ...mapGetters(['user']),
            messages: function () {
                return this.$store.getters.messages(this.$route.params.id)
            },
            lastMessages : function(){
                return this.messages[this.messages.length - 1]
            },
            pseudo:function () {
                return this.$store.getters.conversation(this.$route.params.id).pseudo
            },
            etat:function () {
                return this.$store.getters.conversation(this.$route.params.id).etat_user
            },
            idUser:function () {
                return this.$store.getters.conversation(this.$route.params.id).id
            },
            count:function () {
                return this.$store.getters.conversation(this.$route.params.id).count
            }
        },
        mounted () {
            this.loadMessages ()
            this.$messages = this.$el.querySelector('#messagerie__body')
            document.addEventListener('visibilitychange', this.onVisible)
        },
        destroyed(){
            document.removeEventListener('visibilitychange', this.onVisible)
        },
        watch: { 
            '$route.params.id': function () {
                this.loadMessages()
            },
            lastMessages(){
                this.scrollBot()
            }
        },
        methods:{
            onVisible(){
                if(document.hidden===false){
                   this.$store.dispatch('loadMessages', this.$route.params.id) 
                }
            },
            async loadMessages () {
                let response = await this.$store.dispatch('loadMessages', this.$route.params.id) 
                if(this.messages.length<this.count){
                        this.$messages.addEventListener('scroll', this.onScroll)
                     }
            },
            async onScroll() {
                  if(this.$messages.scrollTop === 0) {
                      this.loading=true
                      this.$messages.removeEventListener('scroll', this.onScroll)
                      let previousHeight = this.$messages.scrollHeight;
                     await this.$store.dispatch('loadPreviousMessages', this.$route.params.id)
                     this.$nextTick(function () {
                       this.$messages.scrollTop = this.$messages.scrollHeight - previousHeight;
                    });
                     if(this.messages.length<this.count){
                        this.$messages.addEventListener('scroll', this.onScroll)
                     }
                     this.loading=false
                  }
             },
            scrollBot() {
                this.$nextTick(()=>{
                    this.$messages.scrollTop = this.$messages.scrollHeight
                })
            },
            async sendMessage(e) {
                if(e.shiftKey === false) {
                    this.loading = true
                    this.errors = {} 
                    e.preventDefault()
                    try{
                       await this.$store.dispatch('sendMessage', {
                            content: this.content,
                            userId: this.$route.params.id
                        }) 
                        this.content=''
                    }catch(e){
                        if(e.errors){
                            this.errors = e.errors
                        }else{
                            console.error(e)
                        }
                    }
                    this.loading = false
                }
            },
            referencement(user_id,pseudo_jeune){
                $("#id_jeune").val(user_id);
                $("#pseudo").val(pseudo_jeune);
                $(".bs-modal-referencement").modal("show");
            }
        }
    }
</script>
