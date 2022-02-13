<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12" v-if="comments.total == 0">
        <div class="card card-custom gutter-b">
          <div class="p-6 text-center">
            <h3 class="d-block font-weight-bold">Aucun commentaire trouv&eacute; !</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" v-if="comments.total > 0">
        <div class="card card-custom gutter-b">
          <div class="p-6 text-left">
            <h3 class="d-block font-weight-bold">Commentaire(s)</h3>
          </div>
          <div class="p-6 text-left">
                    <div class="timeline timeline-3 mb-5" v-for="comment in comments.rows" :key="comment.id">

                        <div class="timeline-items">
                            <div class="timeline-item">
                                <div class="timeline-media">
                                    <img alt="Pic" :src="avatar"/>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="mr-2">
                                            <a class="text-dark-75 h6 font-weight-bold">
                                                {{comment.user.id != user ? comment.user.pseudo : 'Vous'}}
                                            </a>
                                            <span class="text-dark-75 ml-2">
                                              {{moment(comment.created_at).format('DD-MM-YYYY à H:mm')}}
                                            </span>
                                            <span class="label label-light-danger font-weight-bolder label-inline ml-2" style="cursor: pointer;" @click="supprimerComment(comment.id,comment.content)">Suprimmer</span>
                                            <span class="label label-light-primary font-weight-bolder label-inline ml-2" style="cursor: pointer;"  v-if="comment.user_id==user && postouvert=='1'" @click="modifierComment(comment.id,comment.content)">Modifier</span>
                                        </div>
                                    </div>
                                    <p class="p-0 font-size-h5 font-weight-boldest">
                                          {{comment.content}}
                                    </p>
                                    <span v-if="role == 'Animateur' && postouvert=='1'" class="label label-xl label-warning label-pill label-inline mr-2 ml-2" style="cursor: pointer;" @click="repondComment(comment.id)">R&eacute;pondre</span>
                                    <div class="col-md-12 mt-2 d-none" :id="'form-content-' + comment.id">
                                      <div class="card card-custom">
                                        <div class="overlay-block" v-bind:class="{overlay:loader}">
                                          <form @keyup.enter="postForm($event,comment.id)" :id="'formeAjout-' + comment.id">
                                              <div class="card-body">
                                                  <div class="form-group">
                                                      <input type="hidden" v-model="comment.id" :id="'idComment-' + comment.id">
                                                      <p class="text-right"><span @click="fermerForm(comment.id)" class="label label-xl label-danger label-pill label-inline" style="cursor: pointer;"><i aria-hidden="true" class="ki ki-close"></i></span></p>
                                                      <textarea :class="{'form-control':true, 'is-invalid':errors['content']}" v-model="commentAnsw.content" :id="'content-' + comment.id" rows="4" placeholder="Votre réponse à ce commentaire..."></textarea>
                                                      <div class="invalid-feedback" v-if="errors['content']">Ce champ est obligatoire !</div>
                                                  </div>
                                              </div>
                                          </form>
                                          <div class="overlay-layer">
                                            <div class="spinner-lg spinner-danger" v-bind:class="{spinner:loader}"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Reponse de commentaire-->
                        <div class="timeline timeline-3 mt-5 mb-5 ml-25" v-for="commentansw in comment.commentaires" :key="commentansw.id">
                            <div class="timeline-items">
                                <div class="timeline-item">
                                    <div class="timeline-media">
                                        <img alt="Pic" :src="avatar"/>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="mr-2">
                                                <a class="text-dark-75 h6 font-weight-bold">
                                                    {{commentansw.user.id != user ? commentansw.user.pseudo : 'Vous'}}
                                                </a>
                                                <span class="text-dark-75 ml-2">
                                                    {{moment(commentansw.created_at).format('DD-MM-YYYY à H:mm')}}
                                                </span>
                                                <span class="label label-light-danger font-weight-bolder label-inline ml-2" style="cursor: pointer;" @click="supprimerComment(commentansw.id,commentansw.content)">Suprimmer</span>
                                                <span class="label label-light-primary font-weight-bolder label-inline ml-2" style="cursor: pointer;"  v-if="commentansw.user_id==user && postouvert=='1'" @click="modifierComment(commentansw.id,commentansw.content)">Modifier</span>
                                            </div>
                                        </div>
                                        <p class="p-0 font-size-h5 font-weight-boldest">
                                            {{commentansw.content}}
                                        </p>
                                        <div class="col-md-12 mt-2 d-none" :id="'form-content-' + commentansw.id">
                                      <div class="card card-custom">
                                        <div class="overlay-block" v-bind:class="{overlay:loader}">
                                          <form @keyup.enter="postForm($event,commentansw.id)" :id="'formeAjout-' + commentansw.id">
                                              <div class="card-body">
                                                  <div class="form-group">
                                                      <input type="hidden" v-model="commentansw.id" :id="'idComment-' + commentansw.id">
                                                      <p class="text-right"><span @click="fermerForm(commentansw.id)" class="label label-xl label-danger label-pill label-inline" style="cursor: pointer;"><i aria-hidden="true" class="ki ki-close"></i></span></p>
                                                      <textarea :class="{'form-control':true, 'is-invalid':errors['content']}" v-model="commentAnsw.content" :id="'content-' + commentansw.id" rows="4" placeholder="Répondre à ce commentaire..."></textarea>
                                                      <div class="invalid-feedback" v-if="errors['content']">Ce champ est obligatoire !</div>
                                                  </div>
                                              </div>
                                          </form>
                                          <div class="overlay-layer">
                                            <div class="spinner-lg spinner-danger" v-bind:class="{spinner:loader}"></div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'

    export default {
        name: "Comments",
        components: {Comment},
        props : {
            user : Number,
            post : Number,
            role : String,
            postouvert : String
        },
        data: () => ({
            moment : moment,
            loader : false,
            errors : {},
            submit : false,
            reponse : false,
            commentAnsw : {
              content : '',
              idComment : '',
              id : ''
            },
            sound : "https://assets.mixkit.co/sfx/preview/mixkit-correct-answer-reward-952.mp3"
        }),
        mounted() {
            this.$store.dispatch('GET_COMMENTS', this.post)

            // Enable pusher logging - don't include this in production
            //Pusher.logToConsole = true; 

            //use your own credentials you get from Pusher 
            let pusher = new Pusher('dc5808d55b4f3a477406', {
                cluster: 'ap1',
            });

            //Subscribe to the channel we specified in our Adonis Application
            let channel = pusher.subscribe('comment-channel')

            channel.bind('newComment', (data) => {
               this.$store.dispatch('GET_COMMENTS', this.post)
                if(document.hidden){
                   this.playSound();
                }else{
                    this.$store.dispatch('MARK_AS_RED_COMMENT', data.comment)
                }
            })
        },
        computed: {
          ...mapGetters([
            'comments'
          ]),
          avatar() {
            return basePath + '/template/media/users/user.jpg'
          }
        },
        methods: {
            postForm(e,id){
                if(e.shiftKey === false) {
                    this.errors = {};
                    this.submit = true;
                    this.loader = true;
                    e.preventDefault();
                    var element = document.getElementById("formeAjout-"+id);

                    if(this.reponse == true){
                        this.commentAnsw.idComment = $("#idComment-" + id).val();
                        this.commentAnsw.content = $("#content-" + id).val();
                        this.commentAnsw.id = '';
                    }else{
                        this.commentAnsw.idComment = '';
                        this.commentAnsw.content = $("#content-" + id).val();
                        this.commentAnsw.id = $("#idComment-" + id).val();
                    }

                    this.$store.dispatch('ADD_COMMENT', this.commentAnsw)
                    .then(response => {
                        this.submit = false;
                        if(response.data.code === 1 && this.reponse == true){
                            //this.$store.dispatch('GET_COMMENTS', this.post)
                            this.loader = false;
                            this.commentAnsw.content = '';
                            $(element).addClass('d-none');
                        }
                        if(response.data.code === 1 && this.reponse == false){
                            //this.$store.dispatch('GET_COMMENTS', this.post)
                            this.loader = false;
                            $(element).addClass('d-none');
                            //this.$store.dispatch('GET_COMMENTS', this.post)
                        }
                        if(response.data.code === 0){
                            this.errors['content'] = response.data.msg
                            this.loader = false;
                            this.commentAnsw.content = '';
                        }
                    }).catch(err => {
                        this.submit = false;
                        this.loader = false;
                    })
                }
            },
            repondComment(id){
                var forms = document.getElementsByTagName('form');
                if(forms){
                    $(forms).each(function(index, form) {
                        if(form.id != "formeAjout-"+id && form.id != "logout-form" && form.id != "formSupprimer" && form.id != "formAjoutCommentSynthese"){
                            var element = document.getElementById(form.id);
                            $(element).addClass('d-none');
                        }else{
                            var element = document.getElementById(form.id);
                            $(element).removeClass('d-none');
                        }
                    });
                }

                this.reponse = true;
                $("#content-" + id).val("");
                $("#form-content-" + id).removeClass('d-none');
            },
            modifierComment(id,comment){
                var forms = document.getElementsByTagName('form');
                if(forms){
                    $(forms).each(function(index, form) {
                        if(form.id != "formeAjout-"+id && form.id != "logout-form" && form.id != "formSupprimer" && form.id != "formAjoutCommentSynthese"){
                            var element = document.getElementById(form.id);
                            $(element).addClass('d-none');
                        }else{
                            var element = document.getElementById(form.id);
                            $(element).removeClass('d-none');
                        }
                    });
                }
                this.reponse = false;
                $("#content-" + id).val(comment);
                $("#form-content-" + id).removeClass('d-none');
            },
            fermerForm(id){
                this.reponse = false;
                $("#form-content-" + id).addClass('d-none');
            },
            supprimerComment(id,comment){
                $("#idCommentDelete").val(id);
                $(".commentaire").html(comment);
                $(".bs-modal-supprimer").modal("show");
            },
            playSound(){
                let alert = new Audio(this.sound);
                alert.play();
            }
        }
    }
</script>

