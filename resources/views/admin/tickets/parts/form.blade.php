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
            <label>{{ __('labels.notes') }}:</label>
            <p>{{ $ticket->restaurant_notes }}</p>
    </div>
</div>
