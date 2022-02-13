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
                            data-search="false"
                            data-toggle="table"
                            data-url="{{ url('site', ['action' => 'liste-comments']) }}"
                            data-unique-id="id"
                            data-show-toggle="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="name">Internaute</th>
                                    <th data-field="contact">Contact</th>
                                    <th data-formatter="concerneformatter">Concerne</th>
                                    <th data-field="avis_favo" data-formatter="avisformatter">Avis</th>
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
                            <h5 class="modal-title">Gestion des commentaires</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="comment.id">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nom & pr&eacute;nom(s) *</label>
                                        <input type="text" class="form-control" name="name" id="name" ng-model="comment.name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact *</label>
                                        <input type="text" class="form-control" name="contact" id="contact" ng-model="comment.contact" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <span class="switch switch-outline switch-icon switch-success mt-8">
                                            <label>
                                                <input type="checkbox" name="avis_favo" id="avis_favo" ng-model="blog.avis_favo" ng-checked="comment.avis_favo==1"/><span></span>
                                            </label>
                                            <label for="publier">&nbsp;Valider comme avis</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Commentaire *</label>
                                        <textarea class="form-control" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" minlength="5" name="content" id="description" ng-model="comment.content" rows="7" required></textarea>
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
                <h5 class="modal-title" >Titre : <span id="titre"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Commentaire</h5>
                        <p class="font-size-h5 font-weight-boldest mb-4" id="afffContent"></p>
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
                            <input type="text" ng-hide="true" id="idCommentDelete" value="@{{ comment.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer cet commentaire ?</p>
                            <p class="text-center h4">@{{ comment.name }}</p>
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
        $scope.populateForm = function (comment) {
            $scope.comment = comment;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.comment = {};
        };
    });

    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (comment) {
            $scope.comment = comment;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.comment = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (comment) {
            $scope.comment = comment;
        };
        $scope.initForm = function () {
            $scope.comment = {};
        };
    });

    $(function () {
        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
     
        $("#formAjout").submit(function (e) {
            e.preventDefault();

            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var methode = 'POST';
            var url = "{{route('site.comments.store')}}";

            editerAction(methode, url, $(this), $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idCommentDelete").val();

            deleteAction('comments/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idComment) {
        var $scope = angular.element($("#formAjout")).scope();
        var comment =_.findWhere(rows, {id: idComment});
        $scope.$apply(function () {
            $scope.populateForm(comment);
        });
        $("#id").val(comment.id);
        $("#name").val(comment.name);
        $("#contact").val(comment.contact);
        $("#content").val(comment.content);
        $(".bs-modal-ajout").modal("show");
    }

    function commentRow(idComment) {
        var $scope = angular.element($("#formDetail")).scope();
        var comment =_.findWhere(rows, {id: idComment});
        $scope.$apply(function () {
            $scope.populateForm(blog);
        });
        $("#afffContent").html("");
        $("#afffContent").append(comment.content);
        comment.cour_id ? $("#titre").html(comment.cour.libelle_cours) : $("#titre").html(comment.blog.titre_blog);
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idComment) {
          var $scope = angular.element($("#formSupprimer")).scope();
          var comment =_.findWhere(rows, {id: idComment});
           $scope.$apply(function () {
              $scope.populateForm(comment);
          });
       $(".bs-modal-supprimer").modal("show");
    }

    function concerneformatter(id, row){
        return row.cour_id ? '<span> Cours </span>' : '<span> Blog </span>';
    }

    function avisformatter(avis){
        return avis ? '<span class="text-success"> OUI </span>' : '<span class="text-danger"> NON </span>';
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\<a class="flaticon-list text-warning cursor-pointer ml-2" data-toggle="tooltip" title="Commentaire" onClick="javascript:commentRow(' + id + ');"></a>\n\
                <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }
</script>
@endsection


