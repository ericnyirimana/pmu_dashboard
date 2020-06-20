<div class="col-md-12">
    <div class="">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item">
                <a href="#general" data-toggle="tab" aria-expanded="false" class="nav-link active">
                    {{ ucfirst(trans('datatable.tab_restaurant.restaurant')) }}
                </a>
            </li>
            @if(isset($restaurant->merchant_stripe))
                <li class="nav-item">
                    <a href="#payments" data-toggle="tab" aria-expanded="true" class="nav-link">
                        {{ ucfirst(trans('datatable.tab_restaurant.payment')) }}
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="#orders" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.order')) }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#tickets" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.ticket')) }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#subscriptions" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.subscription')) }}
                </a>
            </li>
            <li class="nav-item">
                <a href="#account" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.account')) }}
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="general">
                @include('admin.restaurants.parts.tab-general')
            </div>
            @if(isset($restaurant->merchant_stripe))
                <div class="tab-pane" id="payments">
                    @include('admin.restaurants.parts.tab-payments')
                </div>
            @endif
            <div class="tab-pane" id="orders">
                @include('admin.restaurants.parts.tab-orders')
            </div>
            <div class="tab-pane" id="tickets">
                @include('admin.restaurants.parts.tab-tickets')
            </div>
            <div class="tab-pane" id="subscriptions">
                @include('admin.restaurants.parts.tab-subscriptions')
            </div>
            <div class="tab-pane" id="account">
                @include('admin.restaurants.parts.tab-account')
            </div>
        </div>
    </div>
</div> <!-- end col -->

