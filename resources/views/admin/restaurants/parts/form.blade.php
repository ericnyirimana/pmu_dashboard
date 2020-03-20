<div class="col-md-12">
    <div class="">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    Restaurant
                </a>
            </li>
            <li class="nav-item">
                <a href="#payments" data-toggle="tab" aria-expanded="true" class="nav-link">
                    Payment history
                </a>
            </li>
            <li class="nav-item">
                <a href="#orders" data-toggle="tab" aria-expanded="false" class="nav-link">
                    Orders
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

            </div>
            <div class="tab-pane" id="orders">
                
            </div>
            <div class="tab-pane" id="account">


            </div>
        </div>
    </div>
</div> <!-- end col -->

<div class="d-flex flex-row row card-body">
    <div class="col-12">
          <div class="form-group">
              <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
          </div>
    </div>
</div>
