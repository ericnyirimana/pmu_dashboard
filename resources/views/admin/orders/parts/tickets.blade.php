
@foreach($ordersTickets as $ticket)
<div class="card-box">
    <div class="row m-b-10">
    <div class="col-md-3 col-lg-3">
        <p><label>{{ ucfirst(trans('labels.id_ticket')) }}:</label> {{ $ticket->id }}</p>
        <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $ticket->offer_price }} €</p>
        <p><label>{{ ucfirst(trans('labels.fee')) }}:</label> {{ $ticket->fee }} €</p>
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> @if ($ticket->created_at) {{ $ticket->created_at->format('d/m/Y - H:m') }} @else N/A @endif</p>
    </div>
    <div class="col-md-3 col-lg-3">
        <p><label>{{ ucfirst(trans('labels.discount')) }}:</label> {{ $ticket->discounted_price }} €</p>
        <p><label>{{ ucfirst(trans('labels.pmu_commission')) }}:</label> {{ $ticket->pmu_commission }}</p>
        <p><label>{{ ucfirst(trans('labels.total_amount')) }}:</label> {{ $ticket->total_amount }}</p>
        <p><label>{{ ucfirst(trans('labels.restaurant_commission')) }}:</label> {{ $ticket->restaurant_commission }}</p>
    </div>
    <div class="col-md-3 col-lg-3">
        <p><label>{{ ucfirst(trans('labels.quantity')) }}:</label> {{ $ticket->quantity }}</p>
        <p><label>{{ ucfirst(trans('labels.promo_code')) }}:</label> {{ $ticket->promo_code }}</p>
        <p><label>{{ ucfirst(trans('labels.restaurant_status')) }}:</label> {{ $ticket->restaurant_status }}</p>
        <p><label>{{ ucfirst(trans('labels.restaurant_notes')) }}:</label> {{ $ticket->restaurant_notes }}</p>
    </div>
    <div class="col-md-3 col-lg-3">
    <div class="col-12" id="cancel_ticket_{{ $ticket->id }}">
    @if($order->status == 'PAID' || $ticket->closed || $ticket->restaurant_status == 'CANCELED')
    <label class="text-warning" style="border: 2px solid; padding: 6px;"><i class="fi-ban"></i> {{ ucfirst(trans('button.cancel_ticket')) }}</label>
    @else
    <button type="button" name="cancel-ticket" id="cancel-ticket" class="btn btn-md w-lg btn-info float-right form-control" data-name="{{ $ticket->id }}" data-register="{{ $ticket->id }}"
                                data-toggle="modal" data-target=".js-button-cancel-{{ $ticket->id }}">{{
            ucfirst(trans('button.cancel_ticket')) }}</button>
    @endif
    </div>
    <p>&nbsp;&nbsp;&nbsp;</p>
    <div class="col-12" id="ticket_{{ $ticket->id }}">
    @if($ticket->closed)
    <label class="text-danger" style="border: 2px solid; padding: 6px;"><i class="fi-check"></i> {{ ucfirst(trans('button.ticket_closed')) }}</label>
    @elseif($ticket->restaurant_status == 'CANCELED')
    <label class="text-danger" style="border: 2px solid; padding: 6px;"><i class="fi-ban"></i> {{ ucfirst(trans('button.close_ticket')) }}</label>
    @else
    <button type="click"
                    class="btn btn-md w-lg btn-danger float-right form-control js-button-close-ticket" value="{{ $ticket->id }}">{{ ucfirst(trans('button.close_ticket')) }}
                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
                    </button>
    @endif
    </div>
    </div>
  </div>
  <div class="col-9">
  <div class="col-12">
        <h5>{{ ucfirst(trans('labels.product_details')) }}</h5>
    </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>{{ ucfirst(trans('labels.product')) }}</th>
        <th>{{ ucfirst(trans('labels.quantity')) }}</th>
      </tr>
    </thead>
    <tbody>
    @php
    $count = 1
    @endphp
    @foreach ($order->orderProducts->where('pickup_id', $ticket->pickup->id) as $elem)
      <tr>
        <td>{{ $count++ }}</td>
        <td>{{ $products->find($elem->product_id)->name }}</td>
        <td>{{ $elem->quantity }}</td>
      </tr>
    @endforeach  
    </tbody>
  </table>
</div>
</div>
@include('admin.orders.parts.modal-cancel')
@endforeach