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
                            data-url="{{ url('parametre', ['action' => 'liste-modes']) }}"
                            data-unique-id="id"
                            data-show-toggle="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="libelle_mode" data-searchable="true" data-sortable="true">Mode</th>
                                @if(Auth::user()->role =="Concepteur")
                                    <th data-field="id" data-formatter="optionFormatter" data-width="100px" data-align="center"><i class="ki ki-wrench"></i></th>
                                @endif
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="overlay overlay-block">
                    <form id="formAjout" ng-controller="formAjoutCtrl" action="#">
                        <div class="modal-header">
                            <h5 class="modal-title">Gestion des modes de cours</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="mode.id">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nom du mode *</label>
                                        <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="libelle_mode" id="libelle_mode" ng-model="mode.libelle_mode" placeholder="Cours en ligne" required>
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
                            <input type="text" ng-hide="true" id="idModeDelete" value="@{{ mode.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer ce mode ?</p>
                            <p class="text-center h4">@{{ mode.libelle_mode }}</p>
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
        $scope.populateForm = function (mode) {
            $scope.mode = mode;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.mode = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (mode) {
            $scope.mode = mode;
        };
        $scope.initForm = function () {
            $scope.mode = {};
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
            var url = "{{route('parametre.modes.store')}}";

            editerAction(methode, url, $(this), $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idModeDelete").val();

            deleteAction('modes/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idMode) {
        var $scope = angular.element($("#formAjout")).scope();
        var mode =_.findWhere(rows, {id: idMode});
        $scope.$apply(function () {
            $scope.populateForm(mode);
        });
        $("#id").val(mode.id);
        $("#libelle_mode").val(mode.libelle_mode);
        $(".bs-modal-ajout").modal("show");
    }

    function deleteRow(idMode) {
          var $scope = angular.element($("#formSupprimer")).scope();
          var mode =_.findWhere(rows, {id: idMode});
           $scope.$apply(function () {
              $scope.populateForm(mode);
          });
       $(".bs-modal-supprimer").modal("show");
    }


    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\
                <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }
</script>
@endsection


