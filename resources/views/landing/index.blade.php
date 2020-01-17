@extends('layouts.master')

@section('content')
<header class="cover">
   <div class="container-fluid">
      <div class="cover-head-logo">
          @svg('pmu-logo', 'image-logo')
      </div>
      <div class="cover-image">
          <figure class="show-desktop"><img src="/images/landing-cover.png"></figure>
          <figure class="show-mobile"><img src="/images/landing-cover-mobile.png"></figure>

      </div>
      <div class="cover-stores">
            <div class="btn-bagde" data-toggle="modal" data-target="#modalNewslleter">@svg('google-play-badge', 'google-bagde')</div>
            <div class="btn-bagde" data-toggle="modal" data-target="#modalNewslleter">@svg('apple-play-badge', 'apple-bagde')</div>
      </div>
    </div>
</header>
<section class="content">
  <div class="container-fluid">
      <div class="row">
          <div class="col-12 col-md-6 content-show-case">
            <figure></figure>
          </div>
          <div class="col-12 col-md-6 content-text">
              <h2>Sei un ristoratore?</h2>
              <h3>Scopri come Pick Meal Up può aiutare il tuo business!</h3>
              <p>Pick Meal Up è l’<strong>app di take away</strong> pensata dai ristoratori per i ristoratori.
                Con Pick Meal Up offri al tuo cliente la possibilità di <strong>ordinare un pasto in
                modo semplice e a un prezzo fisso</strong>: scegli tu cosa, quando e quanto promuovere
                a seconda delle tue necessità. Sarai tu a consegnare il piatto <strong>senza ulteriori
                passaggi</strong>, rispettando la qualità e la cura con cui l’hai preparato. E il cliente
                potrà conoscere meglio te, il tuo locale e la tua offerta. Con Pick Meal Up hai
                a disposizione gli strumenti necessari per <strong>gestire al meglio il servizio</strong>, in modo
                intuitivo, semplice e rapido, <strong>senza canone o costi di attivazione</strong>. Dovrai pensare
                solo a quello che sai fare meglio: <strong>alla promozione pensiamo noi.</strong></p>
              <button class="btn btn-pmu btn-block goto-contact-container">Contattaci</button>
          </div>
     </div>
     <div class="row content-plus">
       <div class="col-12">
         <h2>Ti abbiamo convinto?</h2>
         <h3>Scopri i vantaggi di pick meal up!</h3>
       </div>
       <div class="col-12 content-offers">
          <div class="offers">
              <div class="offers-box"><figure>🙋‍♀️</figure><h4>CONTATTO DIRETTO CON IL CLIENTE</h4><p>Il Cliente si reca nel tuo ristorante, ritira un pasto realizzato al momento gestisci direttamente la relazione con lui.</div>
              <div class="offers-box"><figure>👔</figure><h4>SERVIZIO SU MISURA</h4><p>Scegli tu prodotti e tempi così gestisci al meglio scorte e affluenza.</div>
              <div class="offers-box"><figure>🙌</figure><h4>SEMPLICE, SICURO E FLESSIBILE</h4><p>Semplice gestione di menu, offerte e ordini. App dedicate su iOS e Android o integrazioni con sistemi di cassa innovativi.</div>
              <div class="offers-box"><figure>💸</figure><h4>PAGAMENTI RAPIDI</h4><p>Ricevi i pagamenti delle tue vendite con cadenza settimanale o ogni 48h.</div>
          </ul>
       </div>
     </div>
</section>
<section class="contact" id="contact-container">
    <div class="container-fluid">

          <div class="row">
            <div class="col-12 col-md-6">
                <h2>Cosa Aspetti?</h2>
                <h3>Compila il form e conosciamoci</h3>
                <div class="row no-gutters contact-text">
                  <div class="d-none d-md-block col-md-3"><figure>👋</figure></div>
                  <div class="col-12 col-md-9"><p>ti daremo maggiori dettagli sul funzionamento di Pick Meal Up e su come potrà aiutarti nella gestione quotidiana del tuo locale!</p></div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div id="form-restaurant-success" class="hide">
                      <h4>Grazie per averci contattato. <br />
                      Ti risponderemo al più presto!</h4>
                </div>
                <form class="row" id="form-restaurant">
                    <div class="form-group col-12">
                          <label>Di cosa hai bisogno?</label>
                          <select class="form-control" name="type" data-cons-subject="type" id="form-type-contact">
                              <option value="Informazioni">Informazioni</option>
                              <option value="Voglio diventare partner">Voglio diventare partner</option>
                              <option value="Comunicazioni e novità riguardo al servizio">Comunicazioni e novità riguardo al servizio</option>
                          </select>
                    </div>
                    <div class="form-group col-12 col-md-6">
                          <label>Nome</label>
                          <input type="text" name="name" class="form-control" data-cons-subject="full_name" />
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label>Email*</label>
                        <input type="email" name="email" class="form-control" data-cons-subject="email" required />
                    </div>
                    <div class="form-group col-12">
                          <label>Oggeto*</label>
                          <input type="text" name="subject" data-cons-subject="subject" class="form-control" required />
                    </div>
                    <div class="form-group col-12">
                          <label>Messagio*</label>
                          <input type="text" class="form-control input-textarea" name="message" data-cons-subject="message" required />
                    </div>
                    <div class="form-group form-checkbox">
                      <input type="checkbox" class="form-custom-check" id="check-newsletter" data-cons-preference="restaurant-newsletter">
                      <label class="form-check-label" for="check-newsletter">Acconsento alla ricezione di comunicazioni commerciali personalizzate da parte di Pick Meal Up</label>
                    </div>
                    <div class="form-group form-checkbox">
                      <input type="checkbox" class="form-custom-check" id="check-privacy" data-cons-preference="restaurant-privacy-policy" required>
                      <label class="form-check-label" for="check-privacy">Acconsento all’uso dei miei dati personali in accordo con la <a href="https://www.iubenda.com/privacy-policy/65092557/legal" target="_blank">Privacy Policy</a> del servizio</label>
                    </div>
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-pmu desactivated btn-block" id="send-restaurant-contact">Invia</button>
                    </div>
                </form>


            </div>
    </div>
</section>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8">
                <p>© Copyright PickMealUp S.r.l. PICKMEALUP Srl – Via Crocifissa di Rosa n. 3, Brescia – Italia – P.IVA 04098450986 – REA: BS – 588233, capitale sociale 80.000€</p>
            </div>
            <div class="col-12 col-md-4">
                <ul class="links">
                    <li><a href="https://www.iubenda.com/privacy-policy/65092557/legal" target="_blank">Privacy Policy<a/></li>
                    <li><a href="https://www.iubenda.com/privacy-policy/65092557/cookie-policy" target="_blank">Cookies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" tabindex="-1" role="dialog" id="modalNewslleter">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" aria-label="Close" data-dismiss="modal">
        <span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-body">
        <figure>📢</figure>
        <h6>I progetti migliori hanno bisogno di tempo… ma ci siamo quasi!</h6>
        <p>Lasciaci la tua email: ti avviseremo appena l’app sarà disponibile sullo store!</p>
        <div id="form-client-success" class="hide">
              <h4>Grazie per l’interesse! Sarai il primo <br />a sapere di noi!</h4>
        </div>
        <form id="form-client">
            <div class="form-group">
                <label>La tua email</label>
                <input type="email" name="email" class="form-control" data-cons-subject="email" />
            </div>
            <div class="form-group form-checkbox">
              <input type="checkbox" class="form-custom-check" id="client-check-newsletter" data-cons-preference="client-newsletter">
              <label class="form-check-label" for="client-check-newsletter">Acconsento alla ricezione di comunicazioni commerciali personalizzate da parte di Pick Meal Up</label>
            </div>
            <div class="form-group form-checkbox">
              <input type="checkbox" class="form-custom-check" id="client-check-privacy" data-cons-preference="client-privacy-policy" required>
              <label class="form-check-label" for="client-check-privacy">Acconsento all’uso dei miei dati personali in accordo con la Privacy Policy del servizio</label>
            </div>
            <div class="form-group col-12">
              <button type="submit" class="btn btn-pmu desactivated btn-block" id="send-client-contact">Tienimi aggiornato</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
var _iub = _iub || [];
_iub.csConfiguration = {"lang":"it","siteId":1773473,"cookiePolicyId":65092557, "banner":{ "acceptButtonDisplay":true,"customizeButtonDisplay":true,"position":"float-top-center","acceptButtonColor":"#F92818","acceptButtonCaptionColor":"white","customizeButtonColor":"#212121","customizeButtonCaptionColor":"white","backgroundColor":"#0F218B","backgroundOverlay":true }};
</script><script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
<script>

$(document).ready(function(){

  $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
   });

   $(document).on('click', '.goto-contact-container', function(){

        $("#form-type-contact").val('Voglio diventare partner');
        $('html, body').animate({ scrollTop: $('#contact-container').offset().top}, 1000);

   });

   $(document).on('click', '#check-privacy', function() {

        var enable = $(this).is(':checked');

        if (enable) {
          $('#send-restaurant-contact').removeClass('desactivated');
        } else {
          $('#send-restaurant-contact').addClass('desactivated');
        }
   });

   $(document).on('submit', '#form-restaurant', function(e) {

      e.preventDefault();

      var enable = $("#check-privacy").is(':checked');

      if (enable) {
          /** LOAD */
          _iub.cons_instructions.push(["submit",{
              form: {
                selector: document.getElementById("form-restaurant"),
              },
              consent: {
                legal_notices: [
                  {
                    identifier: 'restaurant-newsletter',
                  },
                  {
                    identifier: 'restaurant-privacy-policy',
                  }
                ]},
            },
            {
              success: function(response) {
                  $('#form-restaurant').addClass('hide');
                  $('#form-restaurant-success').removeClass('hide');
              },
              error: function(response) {
                console.log(response);
              }
            }
          ]);
        }

   });


   $(document).on('click', '#client-check-privacy', function() {

        var enable = $(this).is(':checked');

        if (enable) {
          $('#send-client-contact').removeClass('desactivated');
        } else {
          $('#send-client-contact').addClass('desactivated');
        }
   });

   $(document).on('submit', '#form-client', function(e) {

      e.preventDefault();


      var enable = $("#client-check-privacy").is(':checked');


      if (enable) {
        /** LOAD */
        _iub.cons_instructions.push(["submit",{
            form: {
              selector: document.getElementById("form-client"),
                },
                consent: {
                  legal_notices: [
                    {
                      identifier: 'client-newsletter',
                    },
                    {
                      identifier: 'client-privacy-policy',
                    }
                  ]},
            },
            {
              success: function(response) {
                $("#form-client").addClass('hide');
                $("#form-client-success").removeClass('hide');
              },
              error: function(response) {
                console.log(response);
              }
            }
          ]);
      }


   });

  $('.offers').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          dots: true
        }
      }

    ]
  });
});




</script>
@endpush
