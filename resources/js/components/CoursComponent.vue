<template>
    <div class="row">
        <div v-for="cour in cours" :key="cour.id" class="col-lg-4 col-md-6">
            <div class="single-course">
                <figure class="course-thumb">
                    <img :src="cour.image_descriptive" alt="">
                    <div class="info-area">
                        <ul></ul>
                    </div>
                </figure>
                <div class="course-content">
                    <h3>
                        <router-link :to="{name: 'cours-details', params: {id: cour.id}}" :key="cour.id">
                            <a> 
                                {{cour.libelle_cours.length > 50 ? cour.libelle_cours.substring(0, 50) : cour.libelle_cours}}
                            </a>
                        </router-link>
                    </h3>
                    <hr class="my-2">
                    <dl class="row m-0">
                        <dt class="product-item-part col-xs-5">Dur&eacute;e</dt>
                        <dd class="col-xs-7">{{cour.duree}} H</dd>
                        <dt class="product-item-part col-xs-5">Prix</dt>
                        <dd class="col-xs-7">
                                    {{cour.prix}} F CFA </dd>
                        <dt class="product-item-part col-xs-5">Place disponible</dt>
                        <dd class="col-xs-7">
                            {{cour.nombre_place}}
                        </dd>
                        <dt class="product-item-part col-xs-5">Date</dt>
                        <dd class="col-xs-7">
                            {{cour.date_cours ? moment(cour.date_cours).format('DD-MM-YYYY') : "Date non indiquée"}}
                        </dd>
                        <dt class="product-item-part col-xs-5">Type</dt>
                        <dd class="col-xs-7">{{ cour.mode.libelle_mode }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import moment from 'moment'
    moment.locale('fr')
    export default {
        data() {
            return {
                cours: {},
                moment : moment,
            }
        },
        methods: {
            fetchingAllCours() {
                axios.get("api/liste-cours")
                    .then( (data) => {this.cours = data.data.rows})
                    .catch(function(error){
                        console.log(error);
                    });
            },
            link(slug,id){
                let url = "{{route('web.cours-details',':id') }}";
                url = url.replace(':id', id);
                document.location.href=url;
            },
        },
        mounted(){
            this.fetchingAllCours();
        },
    }
</script>