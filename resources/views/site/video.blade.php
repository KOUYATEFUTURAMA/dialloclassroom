@extends('layouts.app')
@section('content')

<script src="{{asset('js/crud.js')}}"></script>
<script src="{{asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js')}}"></script>
<script src="{{asset('plugins/js/underscore-min.js')}}"></script>

<link href="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet">
<div class="card-body">
    <div class="row">
        <div class="col-xl-12">
                <div class="bg-white rounded shadow-sm py-5 px-10 px-lg-20">
                    <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                            data-pagination="true"
                            data-search="false"
                            data-toggle="table"
                            data-url="{{ url('site', ['action' => 'liste-videos']) }}"
                            data-unique-id="id"
                            data-show-toggle="false"
                            data-show-columns="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="titre">Titre</th>
                                    <th data-field="id" data-formatter="optionFormatter" data-width="150px" data-align="center"><i class="ki ki-wrench"></i></th>
                                </tr>
                            </thead>
                    </table>
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
                            <h5 class="modal-title">Gestion des vid&eacute;os</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="video.id">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Titre de la vid&eacute;o </label>
                                        <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="titre" id="titre" ng-model="video.titre" placeholder="Titre de la vidéo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Vid&eacute;o * (100 Mo maxi)</label>
                                        <input type="file" class="form-control" name="video" id="video">
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
                <h5 class="modal-title" >Titre : @{{ video.titre }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="image">Video</h5>
                        <video src="@{{ video.video }}" controls class="w-100 rounded"></video>
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
                            <input type="text" ng-hide="true" id="idVideoDelete" value="@{{ video.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer cette vid&eacute;o ?</p>
                            <p class="text-center h4">@{{ video.titre }}</p>
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
   
     var $table = jQuery("#table"), rows = [];

    smartApp.controller('formAjoutCtrl', function ($scope) {
        $scope.populateForm = function (video) {
            $scope.video = video;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.video = {};
        };
    });

    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (video) {
            $scope.video = video;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.video = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (video) {
            $scope.video = video;
        };
        $scope.initForm = function () {
            $scope.video = {};
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
            var url = "{{route('site.videos.store')}}";
            var formData = new FormData($(this)[0]);
            videoEditerAction(methode, url, $(this), formData, $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idVideoDelete").val();

            deleteAction('videos/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idVideo) {
        var $scope = angular.element($("#formAjout")).scope();
        var video =_.findWhere(rows, {id: idVideo});
        $scope.$apply(function () {
            $scope.populateForm(video);
        });
        $("#id").val(video.id);
        $("#titre").val(video.titre);
        $(".bs-modal-ajout").modal("show");
    }

    function detailRow(idVideo) {
        var $scope = angular.element($("#formDetail")).scope();
        var video =_.findWhere(rows, {id: idVideo});
        $scope.$apply(function () {
            $scope.populateForm(video);
        });
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idVideo) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var video =_.findWhere(rows, {id: idVideo});
        $scope.$apply(function () {
            $scope.populateForm(video);
        });
       $(".bs-modal-supprimer").modal("show");
    }


    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\
        <a class="flaticon-list text-warning cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Détails" onClick="javascript:detailRow(' + id + ');"></a>\n\
        <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }

    function videoEditerAction(methode, url, $formObject, formData, $overlayBlock, $spinnerLg, $table) {
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


