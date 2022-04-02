@extends('layouts.site')
@section('content')
<link href="{{asset('template/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('plugins/jQuery/query.min.js')}}"></script>
<script src="{{asset('template/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script src="{{asset('template/plugins/global/plugins.bundle.js')}}"></script>
<div class="course-content">
    <h3 class="text-center">
        {{$cour->mode->slug == "cours-video" ? 'Acheter : '.$cour->libelle_cours : 'Reserver : '.$cour->libelle_cours}}
        <br/><br/>
        @if($cour->mode->slug == "cours-video")
        Prix : {{number_format($cour->prix, 0, ',', ' ')}} F CFA
        @else
        Prix : {{number_format(5000, 0, ',', ' ')}} F CFA
        @endif
    </h3>
</div>
<section class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="#" class="sl-form">
                    @if($cour->mode->slug != "cours-video")
                        <div class="form-group">
                            <input type="text" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.substr(1);" placeholder="Nom et prénom(s)" name="full_name_costumer" id="full_name_costumer" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Votre adresse email" name="email_costumer" id="email_costumer" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Contact téléphonique" name="contact_costumer" id="contact_costumer" required>
                        </div>
                    @endif
                </form>
                <button onclick="checkout()" class="btn btn-filled btn-round">
                    @if($cour->mode->slug == "cours-video")
                        Acheter
                    @else
                        Reserver
                    @endif
                </button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>
<script src="https://cdn.cinetpay.com/seamless/main.js"></script>
<script>
    function checkout() {
        var cours_id = {!! json_encode($cour->id) !!};
        var mode = {!! json_encode($cour->mode->slug) !!};
        if(mode != "cours-video"){
            var montant = 5000;
        }else{
            var montant = {!! json_encode($cour->prix) !!};
        }
      
        var description = {!! json_encode($cour->libelle_cours) !!};

        if(mode != "cours-video" && $("#contact_costumer").val() == "" && $("#email_costumer").val() == "" && $("#full_name_costumer").val() == ""){
            Swal.fire({
                title: 'Renseigner les informations pour votre inscription au cours SVP',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
            return;
        }

        CinetPay.getCheckout({
            transaction_id: Math.floor(Math.random() * 100000000).toString(),
            amount: montant,
            currency: 'XOF',
            channels: 'ALL',
            description: description,  
        });
        CinetPay.waitResponse(function(data) {
            if (data.status == "REFUSED") {
                if (alert("Votre paiement a échoué")) {
                    window.location.reload();
                }
            }else if (data.status == "ACCEPTED") {
                if (alert("Votre paiement a été effectué avec succès")) {
                    var formData = {
                        '_token' : "{{ csrf_token() }}",
                        'contact': $('input[name=contact_costumer]').val(), 
                        'email': $('input[name=email_costumer]').val(), 
                        'name': $('input[name=full_name_costumer]').val(), 
                        'amount' : data.amount,
                        'mode' : mode,
                        'payment_method' : data.payment_method,
                        'description' : data.description,
                        'operator_id' : data.operator_id,
                        'payment_date' : data.payment_date,
                        'cours_id' : cours_id,
                    };
                    $.ajax({
                        url: "/retour-payement-success",
                        type: "post",
                        data: formData,
                        success: function(response) {
                            if(response.code == 1){
                                if(response.link != "" && response.mode == "cours-video"){
                                    window.location.href = response.link;
                                }else{
                                    window.location.href = "/cours";
                                }
                            }
                        }
                    });
                }
            }
        });
        CinetPay.onError(function(data) {
            console.log(data);
        });
    }
</script>
@endsection