<template>
    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom card-stretch example example-compact">
                <div class="card-header">
                    <div class="card-title">
						<h3 class="card-label">Liste des contacts</h3>
					</div>
                </div>
                <div class="card-body">
                    <div class="card-scroll" style="height: 500px;">
                        <template v-for="conversation in conversations">
                            <router-link :to="{name: 'conversation', params: {id: conversation.id}}" :key="conversation.id">
                                <div class="d-flex align-items-center mb-6 mr-10">
                                    <div class="symbol symbol-35 flex-shrink-0 mr-3">
                                        <img alt="Pic" :src="image">
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                                        <div class="d-flex flex-column pr-5 flex-grow-1">
                                            <a class="text-dark text-hover-primary mb-1 font-weight-bolder font-size-lg">{{conversation.pseudo}}</a>
                                        </div>
                                        <span class="label label-danger pulse pulse-danger mr-10" v-if="conversation.unread">
                                            <span class="position-relative">
                                                {{conversation.unread}}
                                            </span>
                                            <span class="pulse-ring"></span>
                                        </span>
                                        <span  v-bind:class="[cssDefault, conversation.etat_user==1 ? Online : 'label-default']"></span>
                                    </div>
                                </div>
                            </router-link>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-custom card-stretch example example-compact">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
   
    export default {
        props : {
            user:Number
        },
        data(){
            return {
                image : basePath + '/template/media/users/user.jpg',
                cssDefault : 'label label-rounded',
                Online : 'label-success'
            }
        },
        computed: {
            ...mapGetters(['conversations'])
        },
        mounted () {
            this.$store.dispatch('loadConversations') 
            this.$store.dispatch('setUser', this.user)
        }
    }
</script>
