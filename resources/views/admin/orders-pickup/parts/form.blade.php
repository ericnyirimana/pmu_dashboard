<div class="row m-b-10">
    <div class="col-12">
        <h2>{{ ucfirst(trans('labels.id_order')) }}: #{{ $ordersPickup->order->id }}</h2>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $ordersPickup->order->created_at->format('d/m/Y - H:m') }}</p>
        <p><label>{{ ucfirst(trans('labels.order_type')) }}:</label> {{ $ordersPickup->pickup->type_pickup }}</p>
        <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $ordersPickup->pickup->name }}</p>
        {{--<p><label>{{ ucfirst(trans('labels.detail')) }}:</label> {{ $order }}</p>--}}
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $ordersPickup->order->user_id }}</p>
        <p><label>{{ ucfirst(trans('labels.status')) }}:</label> {{ $ordersPickup->order->status }}</p>
        <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $ordersPickup->pickup->price }} €</p>
    </div>

    <div class="form-group d-flex align-items-center justify-content-between col-12 mt-5">
        @if(Auth::user()->is_super || Auth::user()->is_manager)
            @if($ordersPickup->order->status == 'PENDING')
            <button type="submit" field="status" name="status" value="REJECTED" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>
            <button type="submit" field="status" name="status" value="PAID" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>
            @elseif($ordersPickup->order->status == 'PAID')
            <button type="submit" field="status" name="status" value="REJECTED" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>
            <button type="submit" field="status" name="status" value="CLOSED" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.order_closed')) }}</button>
            @else
            <button type="submit" field="status" name="status" value="PAID" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>
            @endif
        @endif
    </div>
</div>
