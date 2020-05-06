<div class="row m-b-10 card-box">
    <div class="col-12">
        <h2>{{ ucfirst(trans('labels.id_order')) }}: {{ $order->id }}</h2>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $order->created_at }}</p>
        {{--<p><label>{{ ucfirst(trans('labels.order_type')) }}:</label> {{ $order->pickups->type_pickup }}</p>--}}
        <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $order->pickups->name }}</p>
        {{--<p><label>{{ ucfirst(trans('labels.detail')) }}:</label> {{ $order }}</p>--}}
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $order->user_id }}</p>
        <p><label>{{ ucfirst(trans('labels.status')) }}:</label> {{ $order->status }}</p>
        {{--<p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $order->pickups->price }}</p>--}}
    </div>

    <div class="form-group d-flex align-items-center justify-content-between col-12 mt-5">
        @if(Auth::user()->is_super || Auth::user()->is_restaurateur)
            <button type="submit" field="$order->status" name="status" value="REJECTED" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>
            <button type="submit" field="$order->status" name="status" value="APPROVED" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>
        @endif
    </div>
</div>
