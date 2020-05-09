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
              <div class="offers-box"><figure>🙋‍♀️</figure><h4>CONTATTO DIRETTO CON IL CLIENTE</h4><p>Il cliente che viene nel tuo ristorante per ritirare il suo ordine entra in contatto con te, vive l'atmosfera del tuo locale e scopre tutto ciò che offri.</div>
              <div class="offers-box"><figure>👔</figure><h4>SERVIZIO SU MISURA</h4><p>Scegli tu quali piatti promuovere, puoi creare offerte più accattivanti nei momenti di minor affluenza e gestire al meglio la dispensa.</div>
              <div class="offers-box"><figure>🙌</figure><h4>SEMPLICE, SICURO E FLESSIBILE</h4><p>Il sistema è stato studiato per garantire una gestione semplice del menù, degli ordini e delle offerte, in modo veloce, sicuro e intuitivo.</div>
              <div class="offers-box"><figure>💸</figure><h4>PAGAMENTI RAPIDI</h4><p>È importante che il ristoratore riceva rapidamente il pagamento dei prodotti venduti. Contento tu, contenti noi.</div>
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
                  <div class="col-12 col-md-9"><p>Ti daremo maggiori dettagli sul funzionamento di Pick Meal Up e su come potrà aiutarti nella gestione quotidiana del tuo locale!</p></div>
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
                          <label>Oggetto*</label>
                          <input type="text" name="subject" data-cons-subject="subject" class="form-control" required />
                    </div>
                    <div class="form-group col-12">
                          <label>Messaggio*</label>
                          <input type="text" class="form-control input-textarea" name="message" data-cons-subject="message" required />
                    </div>
                    <div class="form-group form-checkbox">
                      <input type="checkbox" class="form-custom-check" id="check-privacy" data-cons-preference="restaurant-privacy-policy" required>
                      <label class="form-check-label" for="check-privacy">Acconsento all’uso dei miei dati personali in accordo con la <a href="https://www.iubenda.com/privacy-policy/65092557" class="iubenda-nostyle no-brand iubenda-embed" title="Privacy Policy">Privacy Policy</a> del servizio*</label>
                    </div>
                    <div class="form-group form-checkbox">
                      <input type="checkbox" class="form-custom-check" id="check-newsletter" data-cons-preference="restaurant-newsletter">
                      <label class="form-check-label" for="check-newsletter">Acconsento alla ricezione di comunicazioni commerciali personalizzate da parte di Pick Meal Up</label>
                    </div>

                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-pmu desactivated btn-block" id="send-restaurant-contact">Invia</button>
                    </div>
                    <div class="col-12">
                          <label class="form-check-label">*Campi obbligatori</label>
                    </div>
                </form>


            </div>
    </div>
</section>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8">
                <p>PICKMEALUP S.r.l – Via Crocifissa di Rosa n. 3, Brescia – Italia – P.IVA 04098450986 – REA: BS – 588233, capitale sociale 80.000€ <br />Copyright 2020 © PICKMEALUP S.r.l.</p>
            </div>
            <div class="col-12 col-md-4">
                <ul class="links">
                    <li><a href="https://www.iubenda.com/privacy-policy/65092557" class="iubenda-nostyle no-brand iubenda-embed" title="Privacy Policy">Privacy Policy<a/></li>
                    <li><a href="https://www.iubenda.com/privacy-policy/65092557/cookie-policy" class="iubenda-nostyle no-brand iubenda-embed" title="Cookie Policy">Cookies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
<script type="text/javascript">(function (w,d) {var loader = function () {var s = d.createElement("script"), tag = d.getElementsByTagName("script")[0]; s.src="https://cdn.iubenda.com/iubenda.js"; tag.parentNode.insertBefore(s,tag);}; if(w.addEventListener){w.addEventListener("load", loader, false);}else if(w.attachEvent){w.attachEvent("onload", loader);}else{w.onload = loader;}})(window, document);</script>
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
                <label>La tua email*</label>
                <input type="email" name="email" class="form-control" data-cons-subject="email" required email />
            </div>
            <div class="form-group form-checkbox">
              <input type="checkbox" class="form-custom-check" id="client-check-privacy" data-cons-preference="client-privacy-policy" required>
              <label class="form-check-label" for="client-check-privacy">Acconsento all’uso dei miei dati personali in accordo con la <a href="https://www.iubenda.com/privacy-policy/65092557" class="iubenda-nostyle no-brand iubenda-embed" title="Privacy Policy">Privacy Policy</a> del servizio*</label>
            </div>
            <div class="form-group form-checkbox">
              <input type="checkbox" class="form-custom-check" id="client-check-newsletter" data-cons-preference="client-newsletter">
              <label class="form-check-label" for="client-check-newsletter">Acconsento alla ricezione di comunicazioni commerciali personalizzate da parte di Pick Meal Up</label>
            </div>
            <div class="form-group col-12">
              <button type="submit" class="btn btn-pmu desactivated btn-block" id="send-client-contact">Tienimi aggiornato</button>
            </div>
            <div class="col-12">
                  <label class="form-check-label">*Campo obbligatorio</label>
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

  $.ajax({
      url: 'https://pickmealup.com.dev7.21ilab.com/api/v1/user',
      type: 'GET',
      beforeSend: function (xhr) {
          xhr.setRequestHeader('Authorization', 'Bearer eyJraWQiOiIxUHlUQ3Q1MFI1SGI0ZTVUVGsycDhlTXpCb2hDdGk3MnNnVkFBZjR3dytvPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiIxZjRkYWFmMi1iNzEzLTQ0ZjktOWI3MC1kOWRiNDBkMjkzZjQiLCJldmVudF9pZCI6IjU4MjJjYzVkLTY3ZTQtNDY1Mi04NDBhLTEwMzM3YzMxZmQ4MCIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoiYXdzLmNvZ25pdG8uc2lnbmluLnVzZXIuYWRtaW4iLCJhdXRoX3RpbWUiOjE1ODQ1NDAzMTgsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5ldS13ZXN0LTEuYW1hem9uYXdzLmNvbVwvZXUtd2VzdC0xX1VBMUxGMDdndyIsImV4cCI6MTU4NDU0MzkxOCwiaWF0IjoxNTg0NTQwMzE4LCJqdGkiOiI1YWQ2Y2UyYS1hOTFkLTQ5MWYtYjBiYy1kYjZlNmQzMjMzZGUiLCJjbGllbnRfaWQiOiI1MnM3cXI2YWJsNnMxamNhZWQzcTluZWR2dCIsInVzZXJuYW1lIjoiMWY0ZGFhZjItYjcxMy00NGY5LTliNzAtZDlkYjQwZDI5M2Y0In0.XpB8lN4GDyS6TmAduMx-TMp7rZDRg4A8AHkWfd9ooXrNRkZMYycJY-Ja_K1CWEu4QV7Vx7toBSGvEiS99PPzoC_ohiieNDYNgBcl4dNBHN4i_M5nKNYcRr12oiAHBSWXSOQQuFWVMA8vX7tEiK7NjqdovMAHF7wyK4s9YPfq7PVr3dzgNe7fDu_MZ-9zqZmWx8RKGhnYFIfCmYd597NH6tCOvKvaApVSeOaQvBhtNlmgFIrl_W4G-07fXXmzEEHE1VmADX2TxV1n0_jB0sQnf4UQo2F_H18i50Jg5CJDfTHAT7StgYqI-ZGQsBPCDoRnzcmeJdBSD1Di-GrtpVcPBg');
      },
      data: {},
      success: function (data) {
      console.log(data);
    },
      error: function () { },
  });


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
