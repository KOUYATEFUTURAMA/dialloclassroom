@extends('layouts.app')
@section('content')

<script src="{{asset('js/crud.js')}}"></script>
<script src="{{asset('plugins/jQuery/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-table/dist/locale/bootstrap-table-fr-FR.min.js')}}"></script>
<script src="{{asset('plugins/js/underscore-min.js')}}"></script>

<link href="{{asset('plugins/bootstrap-table/dist/bootstrap-table.min.css')}}" rel="stylesheet">
<div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="col-xl-12">
            <div class="card-body">
                <div class="bg-white rounded shadow-sm py-5 px-10 px-lg-20">
                    <table id="table" class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                            data-pagination="true"
                            data-search="true"
                            data-toggle="table"
                            data-url="{{ url('education', ['action' => 'liste-reservations']) }}"
                            data-unique-id="id"
                            data-show-toggle="false">
                            <thead>
                                <tr role="row">
                                    <th data-field="name_costumer" data-searchable="true">Client</th>
                                    <th data-field="contact_costumer">Contact</th>
                                    <th data-field="email_costumer">E-mail</th>
                                    <th data-field="cours.libelle_cours">Cours</th>
                                    <th data-field="amount" data-formatter="prixFormatter">Montant</th>
                                    <th data-field="payment_dates">Date achat</th>
                                </tr>
                            </thead>
                    </table>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    var add = true;
    var $table = jQuery("#table"), rows = [];

    $(function () {
        $table.on('load-success.bs.table', function (e, data) {
            rows = data.rows;
        });
    });

    function prixFormatter(prix) {
        return Intl.NumberFormat().format(prix);
    }
</script>
@endsection


