<div class="col-md-12">
    <div class="">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    Ristorante
                </a>
            </li>
            <li class="nav-item">
                <a href="#payments" data-toggle="tab" aria-expanded="true" class="nav-link">
                    Storico pagamenti
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-toggle="tab" aria-expanded="false" class="nav-link">
                    Ordini
                </a>
            </li>
            <li class="nav-item">
                <a href="#account" data-toggle="tab" aria-expanded="false" class="nav-link">
                    Account
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="general">
                @include('admin.restaurants.parts.tab-general')
            </div>
            <div class="tab-pane" id="payments">
                {{--@include('admin.restaurants.parts.tab-payments')--}}
            </div>
            <div class="tab-pane" id="orders">
                {{--@include('admin.restaurants.parts.tab-orders')--}}
            </div>
            <div class="tab-pane" id="account">
                @include('admin.restaurants.parts.tab-account')
            </div>
        </div>
    </div>
</div> <!-- end col -->

<div class="d-flex flex-row row card-body">
    <div class="col-12">
          <div class="form-group">
              <button type="submit" class="btn btn-block w-lg btn-success float-right">Salva</button>
          </div>
    </div>
</div>
