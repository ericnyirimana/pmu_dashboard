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
                <a href="#account" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.account')) }}
                </a>
            </li>
            @if(Route::currentRouteName() == 'restaurants.edit')  
            <li class="nav-item">
                <a href="#integration" data-toggle="tab" aria-expanded="false" class="nav-link">
                    {{ ucfirst(trans('datatable.tab_restaurant.integration')) }}
                </a>
            </li>
            @endif
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
            <div class="tab-pane" id="account">
                @include('admin.restaurants.parts.tab-account')
            </div>
            @if(Route::currentRouteName() == 'restaurants.edit') 
            <div class="tab-pane" id="integration">
                @include('admin.restaurants.parts.tab-integration')
            </div>
            @endif
        </div>
    </div>
</div> <!-- end col -->

