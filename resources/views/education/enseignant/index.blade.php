@extends('layouts.app')
@section('content')

<script src="{{asset('js/crud.js')}}"></script>
<script src="{{asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js')}}"></script>
<script src="{{asset('plugins/js/underscore-min.js')}}"></script>

<link href="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet">
<div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="card-body">
                <div class="bg-white rounded shadow-sm py-5 px-10 px-lg-20">
                    <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                            data-pagination="true"
                            data-search="true"
                            data-toggle="table"
                            data-url="{{ url('education', ['action' => 'liste-enseignants']) }}"
                            data-unique-id="id"
                            data-show-toggle="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="name" data-searchable="true" data-sortable="true">Nom & pr&eacute;nom(s)</th>
                                    <th data-field="contact">Contact</th>
                                    <th data-field="email">E-mail</th>
                                    <th data-field="aff_sur_site" data-formatter="siteFormatter" >Sur site</th>
                                    <th data-field="id" data-formatter="optionFormatter" data-width="150px" data-align="center"><i class="ki ki-wrench"></i></th>
                                </tr>
                            </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-1"></div>
</div>
<!-- modal ajout et modification -->
    <div class="modal fade bs-modal-ajout" data-backdrop="static" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="overlay overlay-block">
                    <form id="formAjout" ng-controller="formAjoutCtrl" action="#">
                        <div class="modal-header">
                            <h5 class="modal-title">Gestion des enseignants</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="enseignant.id" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nom & pr&eacute;nom(s) *</label>
                                        <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="name" id="name" ng-model="enseignant.name" placeholder="Nom complet de l'enseignant" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact *</label>
                                        <input type="text" class="form-control" name="contact" id="contact" ng-model="enseignant.contact" placeholder="Contact de l'enseignant" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email" ng-model="enseignant.email" placeholder="Adresse mail">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo (Taille : 1024 x 768)</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <span class="switch switch-outline switch-icon switch-success mt-8">
                                            <label>
                                                <input type="checkbox" name="aff_sur_site" id="aff_sur_site" ng-model="enseignant.aff_sur_site" ng-checked="enseignant.aff_sur_site==1"/><span></span>
                                            </label>
                                            <label for="aff_sur_site">&nbsp;Afficher sur site</label>
                                        </span>
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
    <div class="modal fade bs-modal-detail" id="formDetail" ng-controller="formDetailCtrl" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Enseignant : @{{ enseignant.name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 for="description">Photo</h5>
                            <img alt="m??dia" src="@{{ enseignant.image }}" class="w-100 rounded"/>
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
                            <input type="text" ng-hide="true" id="idEnseignantDelete" value="@{{ enseignant.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer cet enseignant ?</p>
                            <p class="text-center h4">@{{ enseignant.name }}</p>
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
        $scope.populateForm = function (enseignant) {
            $scope.enseignant = enseignant;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.enseignant = {};
        };
    });
    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (enseignant) {
            $scope.enseignant = enseignant;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.enseignant = {};
        };
    });
    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (enseignant) {
            $scope.enseignant = enseignant;
        };
        $scope.initForm = function () {
            $scope.enseignant = {};
        };
    });

    $(function () {
        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
        // phone number format 
        $("#contact").inputmask("mask", {
                "mask": "99 99 99 99"
            });
        $("#formAjout").submit(function (e) {
            e.preventDefault();

            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var methode = 'POST';
            var url = "{{route('education.enseignants.store')}}";
            var formData = new FormData($(this)[0]);
            enseignantEditerAction(methode, url, $(this), formData, $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");
            var id = $("#idEnseignantDelete").val();
            deleteAction('enseignants/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idEnseignant) {
        var $scope = angular.element($("#formAjout")).scope();
        var enseignant =_.findWhere(rows, {id: idEnseignant});
        $scope.$apply(function () {
            $scope.populateForm(enseignant);
        });
        $("#id").val(enseignant.id);
        $("#name").val(enseignant.name);
        $("#contact").val(enseignant.contact);
        $("#email").val(enseignant.email);
        $(".bs-modal-ajout").modal("show");
    }

    function detailRow(idEnseignant) {
        var $scope = angular.element($("#formDetail")).scope();
        var enseignant =_.findWhere(rows, {id: idEnseignant});
        $scope.$apply(function () {
            $scope.populateForm(enseignant);
        });
      
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idEnseignant) {
          var $scope = angular.element($("#formSupprimer")).scope();
          var enseignant =_.findWhere(rows, {id: idEnseignant});
           $scope.$apply(function () {
              $scope.populateForm(enseignant);
          });
       $(".bs-modal-supprimer").modal("show");
    }

    function siteFormatter(reponse){
        return reponse ? "Oui" : "Non";
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\
        <a class="flaticon-list text-warning cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="D??tails" onClick="javascript:detailRow(' + id + ');"></a>\n\
        <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }

    function enseignantEditerAction(methode, url, $formObject, formData, $overlayBlock, $spinnerLg, $table) {
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


