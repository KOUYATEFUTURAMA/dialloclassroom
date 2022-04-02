@extends('layouts.app')
@section('content')

<script src="{{asset('js/crud.js')}}"></script>
<script src="{{asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js')}}"></script>
<script src="{{asset('plugins/js/underscore-min.js')}}"></script>

<link href="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet">
<div class="card-body">
    <div class="bg-white rounded shadow-sm py-10 px-10 px-lg-20">
        <div class="row">
            <div class="col-xl-4">
                <div class="form-group">
                    <label for="libelle_cours">Recherche par titre</label>
                    <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control"  id="searcheByLibelle"  placeholder="Rechercher..." >
                </div>
            </div>
            <div class="col-xl-3">
                <div class="form-group">
                    <label for="mode_id">Recherche par mode</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control" id="searchByMode">
                            <option value="0"> Tous les modes de cours</option>
                            @foreach($modes as $mode)
                            <option value="{{$mode->id}}"> {{$mode->libelle_mode}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="form-group">
                    <label for="categorie_id">Recherche par cat&eacute;gorie</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control" id="searchByCategorie">
                            <option value="0"> Toutes les cat&eacute;gories</option>
                            @foreach($categories as $categorie)
                            <option value="{{$categorie->id}}"> {{$categorie->libelle_categorie}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <!--div class="col-xl-2">
                <p class="text-right">
                    <a href="" class="btn btn-outline-success mr-4 text-right"><i class="la la-file-excel icon-lg"></i> Exporter</a>
                </p>
            </div-->
        </div>
        <div class="row">
            <div class="col-xl-12">
                    <div class="bg-white rounded shadow-sm py-5 px-10 px-lg-20">
                        <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                                data-pagination="true"
                                data-search="false"
                                data-toggle="table"
                                data-url="{{ url('education', ['action' => 'liste-cours']) }}"
                                data-unique-id="id"
                                data-show-toggle="false"
                                data-show-columns="true">
                                <thead>
                                    <tr role="row">
                                        <th data-field="libelle_cours" data-searchable="true" data-sortable="true">Titre</th>
                                        <th data-field="categorie.libelle_categorie">Cat&eacute;gorie</th>
                                        <th data-field="mode.libelle_mode">Mode</th>
                                        <th data-field="duree">Dur&eacute;r</th>
                                        <th data-field="prix" data-formatter="prixFormatter">Prix</th>
                                        <th data-field="enseignant.name">Enseignant</th>
                                        <th data-field="nombre_place" data-align="center">Place dsipo.</th>
                                        <th data-field="dates_cours" data-visible="false">Date du cours</th>
                                        <th data-formatter="publieFormatter" >Publi&eacute;</th>
                                        <th data-formatter="vedetteFormatter" data-visible="false">En vedette</th>
                                        <th data-field="id" data-formatter="optionFormatter" data-width="150px" data-align="center"><i class="ki ki-wrench"></i></th>
                                    </tr>
                                </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- modal ajout et modification -->
    <div class="modal fade bs-modal-ajout" data-backdrop="static" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="overlay overlay-block">
                    <form id="formAjout" ng-controller="formAjoutCtrl" action="#" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title">Gestion des enseignants</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="cours.id">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Titre du cours *</label>
                                        <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="libelle_cours" id="libelle_cours" ng-model="cours.libelle_cours" placeholder="Titre du cours" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranches">Enseignant </label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="enseignant_id" name="enseignant_id">
                                                <option value=""> Selectionner l'enseignant</option>
                                                @foreach($enseignants as $enseignant)
                                                    <option value="{{$enseignant->id}}"> {{$enseignant->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranches">Cat&eacute;gorie *</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="categorie_id" name="categorie_id" required>
                                                <option value=""> Selectionner la cat&eacute;gorie</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{$categorie->id}}"> {{$categorie->libelle_categorie}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tranches">Mode *</label>
                                        <div class="input-group input-group-sm">
                                            <select class="form-control" id="mode_id" name="mode_id" required>
                                                <option value=""> Selectionner le mode</option>
                                                @foreach($modes as $mode)
                                                    <option value="{{$mode->id}}"> {{$mode->libelle_mode}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Image descriptive</label>
                                        <input type="file" class="form-control" name="image_descriptive" id="image_descriptive">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vid&eacute;o descriptive (100 Mo maxi)</label>
                                        <input type="file" class="form-control" name="video_descriptive" id="video_descriptive" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vid&eacute;o cours (Fichier zip ou rar)</label>
                                        <input type="file" class="form-control" name="video_cours" id="video_cours" accept="zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description du cours *</label>
                                        <textarea class="form-control" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" minlength="5" name="description" id="description" ng-model="cours.description" rows="7" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Dur&eacute;e du cours en heure *</label>
                                        <input type="number" class="form-control" name="duree" id="duree" min="1" ng-model="cours.duree" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Prix *</label>
                                        <input type="number" class="form-control" name="prix" min="0" id="prix" ng-model="cours.prix" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Place disponible (Cours pr&eacute;ntiel)</label>
                                        <input type="number" class="form-control" name="nombre_place" min="0" id="nombre_place" ng-model="cours.nombre_place">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="switch switch-outline switch-icon switch-success mt-8">
                                            <label>
                                                <input type="checkbox" name="en_vedette" id="en_vedette" ng-model="cours.en_vedette" ng-checked="cours.en_vedette==1"/><span></span>
                                            </label>
                                            <label for="en_vedette">&nbsp;Cours en vedette</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="switch switch-outline switch-icon switch-success mt-8">
                                            <label>
                                                <input type="checkbox" name="publier" id="publier" ng-model="cours.publier" ng-checked="cours.publier==1"/><span></span>
                                            </label>
                                            <label for="publier">&nbsp;Valider la publication</label>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Date du cours</label>
                                    <div class="input-group date" id="date_cours" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" placeholder="Date et heure" name="date_cours" data-target="#date_cours" ng-model="cours.dates_cours">
                                        <div class="input-group-append" data-target="#date_cours" data-toggle="datetimepicker">
                                            <span class="input-group-text">
                                                <i class="ki ki-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary font-weight-bold">Valider</button>
                        </div>
                    </form>
                    <div class="overlay-layer">
                        <div class="spinner spinner-lg spinner-danger"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal content-->
<div class="modal fade bs-modal-detail" id="formDetail" ng-controller="formDetailCtrl" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Titre : @{{ cours.libelle_cours }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Description du cours</h5>
                        <p class="font-size-h5 font-weight-boldest mb-4">
                            @{{cours.description}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Descriptive (image ou vid&eacute;o)</h5>
                        <img ng-if="cours.image_descriptive && !cours.video_descriptive" alt="média" src="@{{ cours.image_descriptive_slider }}" class="w-100 rounded"/>
                        <video ng-if="cours.video_descriptive" src="@{{ cours.video_descriptive }}" controls class="w-100 rounded"></video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal supprimer-->
<div class="modal fade bs-modal-supprimer" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="overlay overlay-block">
                    <form id="formSupprimer" ng-controller="formSupprimerCtrl" action="#">
                        <div class="modal-body">
                            <input type="text" ng-hide="true" id="idCoursDelete" value="@{{ cours.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer ce cours ?</p>
                            <p class="text-center h4">@{{ cours.libelle_cours }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger font-weight-bold">Confirmer</button>
                        </div>
                    </form>
                    <div class="overlay-layer">
                        <div class="spinner spinner-lg spinner-danger"></div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
     var add = true;
     var $table = jQuery("#table"), rows = [];

    smartApp.controller('formAjoutCtrl', function ($scope) {
        $scope.populateForm = function (cours) {
            $scope.cours = cours;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.cours = {};
        };
    });

    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (cours) {
            $scope.cours = cours;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.cours = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (cours) {
            $scope.cours = cours;
        };
        $scope.initForm = function () {
            $scope.cours = {};
        };
    });

    $(function () {
        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
        
        $('#searchByMode, #searchByCategorie, #mode_id, #categorie_id, #enseignant_id').select2({width: '100%'});

        $('#date_cours').datetimepicker({
            locale: 'fr',
            defaultDate: new Date(),
            formatTime: 'H:mm',
            formatDate: 'DD-MM-yyyy',
            format: 'DD-MM-yyyy H:mm',
            minDate : new Date()
        });

        $("#btnModalAjout").on("click", function () {
            $("#mode_id,#categorie_id,#enseignant_id").val('').trigger('change');
        });

        $("#searcheByLibelle").keyup(function (e) {
            var libelle = $("#searcheByLibelle").val();
            if(libelle == ""){
                $table.bootstrapTable('refreshOptions', {url: "{{url('education', ['action' => 'liste-cours'])}}"});
            }else{
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours/' + libelle});
            }
        });

        $("#searchByMode").change(function (e) {
            var mode = $("#searchByMode").val();
            var categorie = $("#searchByCategorie").val();
            
            if(mode == 0 && categorie==0){
                $table.bootstrapTable('refreshOptions', {url: "{{url('education', ['action' => 'liste-cours'])}}"});
            }
            if(mode != 0 && categorie==0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-mode/'+ mode});
            }
            if(mode == 0 && categorie!=0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-categorie/'+ categorie});
            }
            if(mode != 0 && categorie!=0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-mode-categorie/'+ mode + '/' + categorie});
            }
        });

        $("#searchByCategorie").change(function (e) {
            var mode = $("#searchByMode").val();
            var categorie = $("#searchByCategorie").val();
            
            if(mode == 0 && categorie==0){
                $table.bootstrapTable('refreshOptions', {url: "{{url('education', ['action' => 'liste-cours'])}}"});
            }
            if(mode != 0 && categorie==0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-mode/'+ mode});
            }
            if(mode == 0 && categorie!=0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-categorie/'+ categorie});
            }
            if(mode != 0 && categorie!=0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-cours-by-mode-categorie/'+ mode + '/' + categorie});
            }
        });
        
        $("#formAjout").submit(function (e) {
            e.preventDefault();

            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var methode = 'POST';
            var url = "{{route('education.cours.store')}}";
            var formData = new FormData($(this)[0]);
            coursEditerAction(methode, url, $(this), formData, $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idCoursDelete").val();

            deleteAction('cours/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idCours) {
        var $scope = angular.element($("#formAjout")).scope();
        var cours =_.findWhere(rows, {id: idCours});
        $scope.$apply(function () {
            $scope.populateForm(cours);
        });
        $("#id").val(cours.id);
        $("#libelle_cours").val(cours.libelle_cours);
        $("#duree").val(cours.duree);
        $("#prix").val(cours.prix);
        $("#description").val(cours.description);
        $("#nombre_place").val(cours.nombre_place);
        $("#mode_id").val(cours.mode_id).trigger('change');
        $("#categorie_id").val(cours.categorie_id).trigger('change');
        if(cours.enseignant_id!=null){
            $("#enseignant_id").val(cours.enseignant_id).trigger('change');
        }
        $(".bs-modal-ajout").modal("show");
    }

    function detailRow(idCours) {
        var $scope = angular.element($("#formDetail")).scope();
        var cours =_.findWhere(rows, {id: idCours});
        $scope.$apply(function () {
            $scope.populateForm(cours);
        });
      
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idCours) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var cours =_.findWhere(rows, {id: idCours});
        $scope.$apply(function () {
            $scope.populateForm(cours);
        });
       $(".bs-modal-supprimer").modal("show");
    }

    function prixFormatter(prix) {
        return Intl.NumberFormat().format(prix);
    }

    function publieFormatter(id, row){
        return row.publier ? row.date_publications : '<span class="text-danger">Non publier</span>';
    }
    function vedetteFormatter(id, row){
        return row.en_vedette ? '<span class="text-success">OUI</span>' : '<span class="text-danger">NON</span>';
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\
        <a class="flaticon-list text-warning cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Détails" onClick="javascript:detailRow(' + id + ');"></a>\n\
        <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }

    function coursEditerAction(methode, url, $formObject, formData, $overlayBlock, $spinnerLg, $table) {
        jQuery.ajax({
            type: methode,
            url: url,
            cache: false,
            data: formData,
            contentType: false,
            processData: false,
            success:function (response, textStatus, xhr){
                if (response.code === 1) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: response.msg,
                        showConfirmButton: false,
                        timer: 2500
                    });
                    $table.bootstrapTable('refresh');
                    document.forms["formAjout"].reset();
                    $("#mode_id,#categorie_id,#enseignant_id").val('').trigger('change');
                }
                if (response.code === 0) {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: response.msg,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
             },
            error: function (err) {
                var res = eval('('+err.responseText+')');
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: res.message,
                    showConfirmButton: false,
                    timer: 3000
                });
            },
            beforeSend: function () {
                $overlayBlock.addClass('overlay');
                $spinnerLg.addClass('spinner');
            },
            complete: function () {
                $overlayBlock.removeClass('overlay');
                $spinnerLg.removeClass('spinner');
            },
        });
    }

</script>
@endsection


