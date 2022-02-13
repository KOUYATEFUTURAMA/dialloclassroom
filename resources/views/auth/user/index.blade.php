@extends('layouts.app')
@section('content')
    <script src="{{asset('js/crud.js')}}"></script>
    <script src="{{ asset('plugins/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js') }}"></script>
    <script src="{{asset('template/js/pages/features/forms/widgets/input-mask.js')}}"></script>
    <script src="{{asset('plugins/js/underscore-min.js')}}"></script>

    <link href="{{ asset('plugins/bootstrap-table/dist/bootstrap-table.min.css') }}" rel="stylesheet">
    <div class="card-body">
        <div class="bg-white rounded shadow-sm py-5 px-10 px-lg-20">
            <div class="row">
                <div class="col-xl-12">
                    <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                        data-pagination="true"
                        data-search="true"
                        data-toggle="table"
                        data-url="{{ url('auth', ['action' => 'liste-users']) }}"
                        data-unique-id="id"
                        data-show-toggle="false">
                        <thead>
                            <tr role="row">
                                <th data-field="name" data-searchable="true" data-sortable="true">Nom complet</th>
                                <th data-field="email">E-mail</th>
                                <th data-field="contact">Contact</th>
                                <th data-field="role">Role</th>
                                <th data-field="statut_compte" data-formatter="statutFormatter">Etat</th>
                                <th data-field="last_login">Derni&egrave;re connex.</th>
                                <th data-field="id" data-formatter="optionFormatter" data-width="120px" data-align="center"><i class="ki ki-wrench"></i></th>
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
                    <form id="formAjout" ng-controller="formAjoutCtrl" action="#">
                        <div class="modal-header">
                            <h5 class="modal-title">Gestion des utilisateurs</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" ng-hide="true" name="id" id="id" ng-model="user.id">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nom complet *</label>
                                        <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="name" id="name" ng-model="user.name" placeholder="Prénom(s) et nom" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact *</label>
                                        <input type="text" class="form-control" id="contact" name="contact" ng-model="user.contact" placeholder="Contact téléphonique" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail </label>
                                        <input type="email" class="form-control" name="email" id="email" ng-model="user.email" placeholder="Adresse mail">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mot de passe *</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role *</label>
                                        <select class="form-control" ng-model="user.role" name="role" id="role" required>
                                            <option value="">Selectionner le role</option>
                                            @if(Auth::user()->role == "Concepteur")
                                                <option value="Concepteur">Concepteur</option>
                                            @endif
                                            <option value="Administrateur">Administrateur</option>
                                            <option value="Gestionnaire">Gestionnaire</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"><br/>
                                    <div class="form-group">
                                        <span class="switch switch-outline switch-icon switch-success">
                                            <label>
                                                <input type="checkbox" name="statut_compte" id="statut_compte" ng-model="user.statut_compte" ng-checked="user.statut_compte==1"/><span></span>
                                            </label>
                                            <label for="statut_compte">&nbsp;Compte actif</label>
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
                        <input type="text" ng-hide="true" id="idUserDelete" value="@{{ user.id }}">
                        @csrf
                        <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer cet utilisateur ?</p>
                        <p class="text-center h4">@{{ user.name }}</p>
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
        $scope.populateForm = function (user) {
            $scope.user = user;
        };
        $scope.initForm = function () {
            $scope.user = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (user) {
            $scope.user = user;
        };
        $scope.initForm = function () {
            $scope.user = {};
        };
    });

    $(function () {

        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });

        // phone number format
        $("#contact").inputmask("mask", {
            "mask": "99 99 99 99 99"
        });        

        $("#formAjout").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var methode = 'POST';
            var url = "{{route('auth.user.action')}}";

            userAction(methode, url, $(this), $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idUserDelete").val();

            deleteAction('delete-user/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });

    function updateRow(idUser){
        var $scope = angular.element($("#formAjout")).scope();
        var user =_.findWhere(rows, {id: idUser});
        $scope.$apply(function () {
            $scope.populateForm(user);
        });
        $("#name").val(user.name);
        $("#email").val(user.email);
        $("#contact").val(user.contact);
        $("#role").val(user.role);
        $("#id").val(user.id);
        $(".bs-modal-ajout").modal("show");
    }

    function deleteRow(idUser) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var user =_.findWhere(rows, {id: idUser});
        $scope.$apply(function () {
            $scope.populateForm(user);
        });
        $(".bs-modal-supprimer").modal("show");
    }

    function statutFormatter(statut){
        return statut ? '<span class="label label-rounded label-success label-inline mr-2">Actif</span>' : '<span class="label label-rounded label-danger label-inline mr-2">Inactif</span>';
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\<a class="flaticon-delete text-danger cursor-pointer" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }

    function userAction(methode, url, $formObject, formData, $overlayBlock, $spinnerLg, $table){
            jQuery.ajax({
                type: methode,
                url: url,
                cache: false,
                data: formData,
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
                        timer: 2000
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
