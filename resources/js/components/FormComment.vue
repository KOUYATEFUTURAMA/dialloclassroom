<template>
    <div class="col-md-12">
        <div class="card card-custom" v-if="postouvert=='1'">
          <div class="overlay-block" v-bind:class="{overlay:loader}">
            <form @keyup.enter="postComment">
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" v-model="post">
                        <p class="text-right"><span @click="commentSynthese(post)" class="btn btn-danger btn-shadow font-weight-bold mb-1" style="cursor:pointer;"><span class="flaticon-refresh"></span> Commentaire de synth&egrave;se</span></p>
                        <textarea :class="{'form-control':true, 'is-invalid':errors['content']}" v-model="comment.content" rows="4" placeholder="Votre commentaire..."></textarea>
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
</template>
<script>
    export default {
        name: "FormComment",
        props : {
            user : Number,
            post : Number,
            postouvert : String
        },
        data() {
            return {
                errors : {},
                submit: false,
                loader : false,
                comment: {
                    content : '',
                    idPost : this.post
                }
            }
        },
        methods: {
            postComment(e) {
                if(e.shiftKey === false) {

                this.errors = {};
                this.submit = true;
                this.loader = true;
                e.preventDefault();

                this.$store.dispatch('ADD_COMMENT', this.comment)
                    .then(response => {
                    this.submit = false;
                    if(response.data.code === 1){
                       // this.$store.dispatch('GET_COMMENTS', this.post)
                        this.loader = false;
                        this.comment.content = '';
                    }
                    if(response.data.code === 0){
                        this.errors['content'] = response.data.msg
                        this.loader = false;
                        this.comment.content = '';
                    }
                    }).catch(err => {
                        this.submit = false;
                        this.loader = false;
                    })
                }
            },

            commentSynthese(id){
                $("#idPostCommentSynthese").val(id);
                $("#commentaire_synthese").val("");
                $(".bs-modal-comment-synthese").modal("show");
            },
        }
    }
</script>
