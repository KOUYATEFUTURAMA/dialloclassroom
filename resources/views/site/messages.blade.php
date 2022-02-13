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
                            data-url="{{ url('site', ['action' => 'liste-messages']) }}"
                            data-unique-id="id"
                            data-show-toggle="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="name">Internaute</th>
                                    <th data-field="sujet">Sujet</th>
                                    <th data-field="contact">Contact</th>
                                    <th data-field="email">E-mail</th>
                                    <th data-field="id" data-formatter="optionFormatter" data-width="100px" data-align="center"><i class="ki ki-wrench"></i></th>
                                </tr>
                            </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-1"></div>
</div>


<!-- Modal content-->
<div class="modal fade bs-modal-detail" id="formDetail" ng-controller="formDetailCtrl" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Sujet : @{{message.sujet}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Message</h5>
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
                            <input type="text" ng-hide="true" id="idMessageDelete" value="@{{ message.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer cet message ?</p>
                            <p class="text-center h4">@{{ message.sujet }}</p>
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

    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (message) {
            $scope.message = message;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.message = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (message) {
            $scope.message = message;
        };
        $scope.initForm = function () {
            $scope.message = {};
        };
    });

    $(function () {
        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
     
        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idMessageDelete").val();

            deleteAction('messages/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function commentRow(idMessage) {
        var $scope = angular.element($("#formDetail")).scope();
        var message =_.findWhere(rows, {id: idMessage});
        $scope.$apply(function () {
            $scope.populateForm(message);
        });
        $("#afffContent").html("");
        $("#afffContent").append(message.message);
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idMessage) {
          var $scope = angular.element($("#formSupprimer")).scope();
          var message =_.findWhere(rows, {id: idMessage});
           $scope.$apply(function () {
              $scope.populateForm(message);
          });
       $(".bs-modal-supprimer").modal("show");
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon-list text-warning cursor-pointer ml-2" data-toggle="tooltip" title="Commentaire" onClick="javascript:commentRow(' + id + ');"></a>\n\
                <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }
</script>
@endsection


