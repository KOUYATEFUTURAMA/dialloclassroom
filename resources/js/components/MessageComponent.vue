<template>
    <div>
        <!--begin::Message In-->
        <div class="d-flex flex-column mb-5 align-items-start" v-if="message.from_id!=user">
            <div class="d-flex align-items-center">
                <div class="symbol symbol-circle symbol-40 mr-3">
                    <img alt="Pic" :src="image">
                </div>
                <div>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">{{message.from.pseudo}}</a>
                    <span class="text-muted font-size-sm">{{ago}}</span>
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-warning font-weight-bold font-size-lg text-left max-w-400px">{{message.content}}</div>
        </div>
        <!--begin::Message Out-->
        <div class="d-flex flex-column mb-5 align-items-end" v-if="message.from_id==user">
            <div class="d-flex align-items-center">
                <div>
                    <span class="text-muted font-size-sm">{{ago}}</span>
                    <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">Vous</a>
                </div>
                <div class="symbol symbol-circle symbol-40 ml-3">
                    <img alt="Pic" :src="image">
                </div>
            </div>
            <div class="mt-2 rounded p-5 bg-success font-weight-bold font-size-lg text-right max-w-400px">{{message.content}}</div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    moment.locale('fr')
    export default {
        props :  {
            message:Object,
            user:Number
        },
        data(){
            return {
                image : basePath + '/template/media/users/user.jpg',
            }
        },
        computed : {
            isMe(){
              return this.message.from_id===this.user 
            },
            cls(){
                let cls = ['col-md-10']
                if(this.isMe){
                    cls.push('offset-md-2 text-right')
                }
                return cls
            },
            name(){
               return this.isMe ? 'Moi' : this.message.from.pseudo
            },
            ago(){
                return moment(this.message.created_at).format('DD-MM-YYYY à H:mm')
            }
        }
    }
</script>
