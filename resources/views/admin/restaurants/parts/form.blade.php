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
                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
            </div>
            <div class="tab-pane" id="orders">
                @include('admin.restaurants.parts.tab-orders')
            </div>
            <div class="tab-pane" id="account">
                <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
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
