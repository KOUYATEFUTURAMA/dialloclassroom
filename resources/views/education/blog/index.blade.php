@extends('layouts.app')
@section('content')

<script src="{{asset('js/crud.js')}}"></script>
<script src="{{asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js')}}"></script>
<script src="{{asset('plugins/js/underscore-min.js')}}"></script>
<link href="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet">
<script src="{{asset('template/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>

<div class="card-body">
    <div class="bg-white rounded shadow-sm py-10 px-10 px-lg-20">
    <div class="row">
        <div class="col-xl-4">
            <div class="form-group">
                <label for="libelle_cours">Recherche par titre</label>
                <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control"  id="searcheByLibelle"  placeholder="Rechercher..." >
            </div>
        </div>
        <div class="col-xl-4">
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
    </div>
    <div class="row">
        <div class="col-xl-12">
                    <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                            data-pagination="true"
                            data-search="false"
                            data-toggle="table"
                            data-url="{{ url('education', ['action' => 'liste-blogs']) }}"
                            data-unique-id="id"
                            data-show-toggle="false"
                            data-show-columns="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="titre_blog">Titre</th>
                                    <th data-field="categorie.libelle_categorie">Cat&eacute;gorie</th>
                                    <th data-field="date_events">Date</th>
                                    <th data-formatter="publieFormatter" >Publi&eacute;</th>
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
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="overlay overlay-block">
                <form id="formAjout" ng-controller="formAjoutCtrl" enctype="multipart/form-data" action="#">
                    <div class="modal-header">
                        <h5 class="modal-title">Gestion des blogs</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" ng-hide="true" name="id" id="id" ng-model="blog.id">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" class="form-control" name="titre_blog" id="titre_blog" ng-model="blog.titre_blog" placeholder="Titre du blog" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="categorie">Cat&eacute;gorie *</label>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Image principale *</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label>Date de l'&eacute;v&egrave;nement *</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" id="date_event" class="form-control datetimepicker-input" placeholder="Date de l'évènement" name="date_event" data-target="#date_event" ng-model="blog.date_events" required>
                                    <div class="input-group-append" data-target="#date_event" data-toggle="datetimepicker">
                                        <span class="input-group-text">
                                            <i class="ki ki-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <span class="switch switch-outline switch-icon switch-success mt-8">
                                        <label>
                                            <input type="checkbox" name="publier" id="publier" ng-model="blog.publier" ng-checked="blog.publier==1"/><span></span>
                                        </label>
                                        <label for="publier">&nbsp;Valider la publication du blog</label>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="rowContent">
                            <label class="form-label">Contenu du m&eacute;dia *</label>
                            <textarea class="form-control" name="content" id="content"></textarea>
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
                <h5 class="modal-title" >Titre : @{{ blog.titre_blog }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Image principale</h5>
                        <img alt="média" src="@{{ blog.image_detail }}" class="w-100 rounded"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5 for="description">Contenu</h5>
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
                            <input type="text" ng-hide="true" id="idBlogDelete" value="@{{ blog.id }}">
                            @csrf
                            <p class="text-center text-muted h5">Etes vous certain de vouloir supprimer ce blog ?</p>
                            <p class="text-center h4">@{{ blog.titre_blog }}</p>
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
    let editorContent;

    smartApp.controller('formAjoutCtrl', function ($scope) {
        $scope.populateForm = function (blog) {
            $scope.blog = blog;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.blog = {};
        };
    });

    smartApp.controller('formDetailCtrl', function ($scope) {
        $scope.populateForm = function (blog) {
            $scope.blog = blog;
        };
        $scope.initForm = function () {
            ajout = true;
            $scope.blog = {};
        };
    });

    smartApp.controller('formSupprimerCtrl', function ($scope) {
        $scope.populateForm = function (blog) {
            $scope.blog = blog;
        };
        $scope.initForm = function () {
            $scope.blog = {};
        };
    });

    $(function () {
        //initialisation de l'editeur
        MyEditor();

        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
        
        $('#categorie_id, #searchByCategorie').select2({width: '100%'});

        $('#date_event').datetimepicker({
            locale: 'fr',
            defaultDate: new Date(),
            formatTime: 'H:mm',
            formatDate: 'DD-MM-yyyy',
            format: 'DD-MM-yyyy',
            maxDate : new Date()
        });

        $("#btnModalAjout").on("click", function () {
            $("#categorie_id").val('').trigger('change');
        });

        $("#searcheByLibelle").keyup(function (e) {
            var titre = $("#searcheByLibelle").val();
            if(titre == ""){
                $table.bootstrapTable('refreshOptions', {url: "{{url('education', ['action' => 'liste-blogs'])}}"});
            }else{
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-blogs/' + titre});
            }
        });

        $("#searchByCategorie").change(function (e) {
            var categorie = $("#searchByCategorie").val();
            
            if(categorie==0){
                $table.bootstrapTable('refreshOptions', {url: "{{url('education', ['action' => 'liste-blogs'])}}"});
            }
            if(categorie!=0){
                $table.bootstrapTable('refreshOptions', {url: '../education/liste-blogs-by-categorie/'+ categorie});
            }
        });
        
        $("#formAjout").submit(function (e) {
            e.preventDefault();

            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var methode = 'POST';
            var url = "{{route('education.blogs.store')}}";
            var formData = new FormData($(this)[0]);
            blogEditerAction(methode, url, $(this), formData, $overlayBlock, $spinnerLg, $table);
        });

        $("#formSupprimer").submit(function (e) {
            e.preventDefault();
            var $overlayBlock = $(".overlay-block");
            var $spinnerLg = $(".spinner-lg");

            var id = $("#idBlogDelete").val();

            deleteAction('blogs/' + id, $(this).serialize(), $overlayBlock, $spinnerLg, $table);
        });
    });
    function getDataFromTheEditor() {
        return tinymce.get("content").getContent();
    }
    function updateRow(idBlog) {
        var $scope = angular.element($("#formAjout")).scope();
        var blog =_.findWhere(rows, {id: idBlog});
        $scope.$apply(function () {
            $scope.populateForm(blog);
        });
        $("#id").val(blog.id);
        $("#titre_blog").val(blog.titre_blog);
        $("#date_event").val(blog.date_events);
        $("#categorie_id").val(blog.categorie_id).trigger('change');
        var editor = tinymce.get("content");
        var content = editor.getContent();
        content = content.replace("");
        editor.setContent(blog.content);
        $(".bs-modal-ajout").modal("show");
    }

    function detailRow(idBlog) {
        var $scope = angular.element($("#formDetail")).scope();
        var blog =_.findWhere(rows, {id: idBlog});
        $scope.$apply(function () {
            $scope.populateForm(blog);
        });
        $("#afffContent").html("");
        $("#afffContent").append(blog.content);
        $(".bs-modal-detail").modal("show");
    }

    function deleteRow(idBlog) {
        var $scope = angular.element($("#formSupprimer")).scope();
        var blog =_.findWhere(rows, {id: idBlog});
        $scope.$apply(function () {
            $scope.populateForm(blog);
        });
       $(".bs-modal-supprimer").modal("show");
    }

    function publieFormatter(id, row){
        return row.publier ? row.date_events : '<span class="text-danger">Non publier</span>';
    }

    function optionFormatter(id, row) {
        return '<a class="flaticon2-pen text-primary cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Modifier" onClick="javascript:updateRow(' + id + ');"></a>\n\
        <a class="flaticon-list text-warning cursor-pointer mr-4 ml-2" data-toggle="tooltip" title="Détails" onClick="javascript:detailRow(' + id + ');"></a>\n\
        <a class="flaticon-delete text-danger cursor-pointer ml-2" data-toggle="tooltip" title="Supprimer" onClick="javascript:deleteRow(' + id + ');"></a>';
    }

    function blogEditerAction(methode, url, $formObject, formData, $overlayBlock, $spinnerLg, $table) {
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
                    $("#categorie_id").val('').trigger('change');
                     MyEditor();
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

    function MyEditor(){
        tinymce.init({
            selector: '#content',
            menubar: false,
            setup: function (editor) {
                editor.on('init', function (e) {
                    editor.setContent('');
                });
            },
            toolbar: ['styleselect fontselect fontsizeselect',
                        'undo redo | bold italic | link insertfile image media pageembed | alignleft aligncenter alignright alignjustify',
                        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | preview '],
            plugins : 'advlist autolink link image media mediaembed lists charmap print preview code',
            images_upload_url : '{{ route('education.ckeditor.upload', [ '_token' => csrf_token() ]) }}',
            automatic_uploads : true,
            image_title: true,
            paste_data_images: true,
            file_picker_types: 'image',
            convert_urls: false,
            images_upload_handler: function (blobInfo, success, failure, progress) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;

                xhr.open('POST', '{{ route('education.ckeditor.upload', [ '_token' => csrf_token() ]) }}');
                xhr.onload = function() {
                    let json;
                    if (xhr.status !== 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || json.uploaded != true) {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.url);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },

		});
    }

</script>
@endsection


