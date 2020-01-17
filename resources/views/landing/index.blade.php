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
              <button class="btn btn-pmu btn-block">Contattaci</button>
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
<section class="contact">
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
                <form class="row">
                    <div class="form-group col-12">
                          <label>Di cosa hai bisogno?</label>
                          <select class="form-control">
                              <option value="Informazioni">Informazioni</option>
                              <option value="Partner">Partner</option>
                          </select>
                    </div>
                    <div class="form-group col-12 col-md-6">
                          <label>Nome</label>
                          <input type="text" class="form-control" />
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label>Email*</label>
                        <input type="text" class="form-control" required />
                    </div>
                    <div class="form-group col-12">
                          <label>Oggeto*</label>
                          <input type="text" class="form-control" required />
                    </div>
                    <div class="form-group col-12">
                          <label>Messagio*</label>
                          <textarea class="form-control" required></textarea>
                    </div>
                    <div class="form-group form-checkbox col-12">
                      <input type="checkbox" class="form-custom-check" id="check-privacy">
                      <label class="form-check-label" for="check-privacy">Acconsento all’uso dei miei dati personali in accordo con la <a href="#" target="_blank">Privacy Policy del servizio</a></label>
                    </div>
                    <div class="form-group col-12">
                      <button type="submit" class="btn btn-pmu btn-block">Invia</button>
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
                    <li><a href="#">Cookies</a></li>
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
        <form>
            <div class="form-group">
                <label>La tua email</label>
                <input type="text" class="form-control" />
            </div>
            <div class="form-group form-checkbox">
              <input type="checkbox" class="form-custom-check" id="news-check-privacy">
              <label class="form-check-label" for="news-check-privacy">Acconsento all’uso dei miei dati personali in accordo con la <a href="#" target="_blank">Privacy Policy del servizio</a></label>
            </div>
            <div class="form-group col-12">
              <button type="submit" class="btn btn-pmu btn-block">Tienimi aggiornato</button>
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
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});


  /** LOAD */
  _iub.cons_instructions.push(["load",{
            submitElement: document.getElementById("submit_button"),
            form: {
            selector: document.getElementById("form"),
    },
            consent: {
              legal_notices: [
        {
          identifier: 'privacy_policy',
        },
        {
          identifier: 'cookie_policy',
        },
        {
          identifier: 'terms',
        }
        ]}
        }]);
</script>
@endpush
