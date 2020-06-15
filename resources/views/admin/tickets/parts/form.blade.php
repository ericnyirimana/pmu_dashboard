<div class="row m-b-10">
    <div class="col-12">
        <h2>{{ ucfirst(trans('labels.id_ticket')) }}: #{{ $ticket->id_formatted }}</h2>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $ticket->date_formatted}}</p>
        <p><label>{{ ucfirst(trans('labels.id_order')) }}:</label> {{ $ticket->order->id }}</p>
        <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $ticket->order->user_id }}</p>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.order_type')) }}:</label> {{ $ticket->pickup->type_pickup }}</p>
        <p><label>{{ ucfirst(trans('labels.offer')) }}:</label> {{ $ticket->pickup->name }}</p>
        <p><label>{{ ucfirst(trans('labels.status')) }}:</label> {{ $ticket->restaurant_status }}</p>
    </div>
    <div class="col-12 col-md-5 col-lg-5">
        @if($ticket->restaurant_status != 'CANCELED')
            <field-area label="notes" field="restaurant_notes" :model="$ticket" required/>
        @else
            <label>{{ __('labels.notes') }}</label>
            <p>{{ $ticket->restaurant_notes }}</p>
        @endif
    </div>

    <div class="form-group d-flex align-items-center justify-content-between col-12 mt-5">
        @if((Auth::user()->is_super || Auth::user()->is_manager) && $ticket->restaurant_status != 'CANCELED')
            <button type="submit" field="restaurant_status" name="restaurant_status" value="CANCELED" class="btn btn-block w-lg
            btn-primary col-5">{{ ucfirst(trans('button.order_cancel')) }}</button>
        @endif
    </div>
</div>
