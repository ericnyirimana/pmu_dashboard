<div class="card-box">
<div class="row m-b-10">
    <div class="col-12">
        <h2>{{ ucfirst(trans('labels.id_order')) }}: #{{ $order->id }}</h2>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.date_hour')) }}:</label> {{ $order->created_at->format('d/m/Y - H:m') }}</p>
        <p><label>{{ ucfirst(trans('labels.payment_type')) }}:</label>@if($order->payment == null) N/A @else {{ $order->payment->payment_method_types }} @endif</p>
        {{--<p><label>{{ ucfirst(trans('labels.detail')) }}:</label> {{ $order }}</p>--}}
        <p><label>{{ ucfirst(trans('labels.customer_id')) }}:</label> {{ $order->user_id }}</p>
        <p><label>{{ ucfirst(trans('labels.status')) }}:</label> {{ $order->status }}</p>
    </div>
    <div class="col-md-3 col-lg-5">
        <p><label>{{ ucfirst(trans('labels.price')) }}:</label> {{ $order->total_amount }} €</p>
        <p><label>{{ ucfirst(trans('labels.email')) }}:</label> {{ $user->email }}</p>
        @if($order->payment != null)
        @if( $order->payment->payment_method_types == 'PROMO_CODE')
            <p><label>{{ ucfirst(trans('labels.promo_code')) }}:</label> {{ $order->promo_code }} </p>
        @endif
        @endif
        <p><label>{{ ucfirst(trans('labels.restaurant')) }}:</label> {{ $restaurant->name }}</p>
    </div>
    @if(Auth::user()->is_super)
    <div class="col-md-3 col-lg-2 close-order-btn">
    <input type="hidden" name="order_id" id="order_id" value="{{ $order->id }}"/>
    @if(($order->status == 'PAID') ||
     ($order->payment->payment_method_types == 'PROMO_CODE' 
     && $order->payment->status == 'DONE' 
     && $order->status == 'COMPLETED' 
     && $closedTickets !== 0))
    <label class="text-success" style="border: 2px solid; padding: 6px;"><i class="fi-check"></i> {{ ucfirst(trans('button.order_is_closed')) }}</label>
    @elseif($order->status == 'CANCELED' || $order->status == 'ERROR' || $order->status == 'REJECTED')
    <label class="text-danger" style="border: 2px solid; padding: 6px;"><i class="fi-ban"></i> {{ ucfirst(trans('button.order_closed')) }}</label>
    @else
    @if($order->payment != null)
    <button type="click"
                    class="btn btn-md w-lg btn-danger float-right form-control close-order">{{ ucfirst(trans('button.order_closed')) }} 
                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i></button>
    @endif
    @endif
    </div>
    @endif
    @include('admin.orders.parts.tickets')
{{--    <div class="form-group d-flex align-items-center justify-content-between col-12 mt-5">--}}
{{--        @if(Auth::user()->is_super || Auth::user()->is_manager)--}}
{{--            @if($order->status == 'PENDING')--}}
{{--            <button type="submit" field="status" name="status" value="REJECTED" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>--}}
{{--            <button type="submit" field="status" name="status" value="PAID" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>--}}
{{--            @elseif($order->status == 'PAID')--}}
{{--            <button type="submit" field="status" name="status" value="REJECTED" class="btn btn-block w-lg btn-primary col-5">{{ ucfirst(trans('button.reject')) }}</button>--}}
{{--            <button type="submit" field="status" name="status" value="CLOSED" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.order_closed')) }}</button>--}}
{{--            @else--}}
{{--            <button type="submit" field="status" name="status" value="PAID" class="btn w-lg btn-success col-5">{{ ucfirst(trans('button.confirm')) }}</button>--}}
{{--            @endif--}}
{{--        @endif--}}
{{--    </div>--}}
</div>
</div>
@push('scripts')
    <script>
    var order_id = $('#order_id').val();
        $(document).ready(function () {
            var list_error = `<div class="d-flex">
                        <div class="col-12"><div class="alert alert-danger error_msg">
                        <ul></ul>
                        </div></div></div>`;
            $('.fa-spin').hide();
            $(document).on('click', '.close-order', function(e) {
                e.preventDefault();
                $('.close-order .fa-spin').show();
                $('.close-order').attr('disabled', true);
                if(order_id === null) {
                    $('#error_response').empty();
                    $('#error_response .error_msg ul').append(`<li id="alert-error">Order not found</li>`);
                    return false;
                }
                else{
                $.ajax({
                    type: 'POST',
                    url: "{{ route('close.order') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": order_id,
                    },
                    success: function (data) {
                        $(`.close-order`).attr('disabled', true);
                        $(`.close-order .fa-spin`).show();
                        window.location.reload();
                    },
                    error: function (reject) {
                        $(`.close-order`).attr('disabled', false);
                        $(`.close-order .fa-spin`).hide();
                        $('#error_response').empty();
                        var errorMsg = JSON.parse(reject.responseText);
                        $('#error_response').append(list_error);
                        if(errorMsg.error){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errorMsg.error}</li>`)
                        }
                        $('html, body').animate({scrollTop: '0px'}, 0);
                    }
                });
                }
            });
            $(document).on('click', '#ticket_'+$(this).val()+', .js-button-close-ticket', function(e) {
                e.preventDefault();
                $('.js-button-close-ticket .fa-spin').show();
                $('.js-button-close-ticket').attr('disabled', true);
                var ticket_id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('close.ticket') }}/"+ticket_id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": ticket_id,
                        "_method": 'put',
                    },
                    success: function (data) {
                        $('#ticket_'+ticket_id).empty();
                        $('#ticket_'+ticket_id).append(`<label class="text-danger" style="border: 2px solid; padding: 6px;">
                        <i class="fi-check"></i> {{ ucfirst(trans('button.ticket_closed')) }}</label>`);
                        $('#cancel_ticket_'+ticket_id).empty();
                        $('#cancel_ticket_'+ticket_id).append(`<label class="text-warning" style="border: 2px solid; padding: 6px;">
                            <i class="fi-ban"></i> {{ ucfirst(trans('button.cancel_ticket')) }}</label>`);
                        $(`.js-button-close-ticket`).attr('disabled', false);
                        $(`.js-button-close-ticket .fa-spin`).hide();
                    },
                    error: function (reject) {
                        $(`.js-button-close-ticket`).attr('disabled', false);
                        $(`.js-button-close-ticket .fa-spin`).hide();
                        $('#error_response').empty();
                        var errorMsg = JSON.parse(reject.responseText);
                        $('#error_response').append(list_error);
                        if(errorMsg.error){
                            $('#error_response .error_msg ul').append(`<li id="alert-error">${errorMsg.error}</li>`)
                        }
                        $('html, body').animate({scrollTop: '0px'}, 0);
                    }
                });
            });
            $(document).on('click', '#cancel_'+$(this).val()+', .approve-cancelation', function(e) {
                e.preventDefault();
                $('.approve-cancelation .fa-spin').show();
                $('.approve-cancelation').attr('disabled', true);
                var ticket_id = $(this).val();
                var ticket_note = $('#restaurant_notes_'+ticket_id).val();
                $.ajax({
                    type: 'POST',
                    url:"{{ url('admin/tickets') }}/"+ticket_id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "ticket": ticket_id,
                        "restaurant_notes": ticket_note,
                        "restaurant_status": 'CANCELED',
                        "return_json": true,
                        "_method": 'put',
                    },
                    success: function (data) {
                        if (data.restaurant_status == 'CANCELED') {
                            $('.js-button-cancel-'+ticket_id).modal('hide');
                            $('#cancel_ticket_'+ticket_id).empty();
                            $('#cancel_ticket_'+ticket_id).append(`<label class="text-warning" style="border: 2px solid; padding: 6px;"><i class="fi-ban"></i> {{ ucfirst(trans('button.cancel_ticket')) }}</label>`);
                            $(`.approve-cancelation`).attr('disabled', false);
                            $(`.approve-cancelation .fa-spin`).hide();
                            if (data.order.status == 'CANCELED') {
                                $('.close-order-btn').empty();
                                $('.close-order-btn').append(`<label class="text-danger" style="border: 2px solid; padding: 6px;">
                                <i class="fi-ban"></i> {{ ucfirst(trans('button.order_closed')) }}</label>`);
                            }
                            $('#ticket_'+ticket_id).empty();
                            $('#ticket_'+ticket_id).append(`<label class="text-danger" style="border: 2px solid; padding: 6px;">
                            <i class="fi-ban"></i> {{ ucfirst(trans('button.close_ticket')) }}</label>`);    
                        }
                        if (data.order.status == 'ERROR' || data.order.status == 'REJECTED') {
                            $('#error_response').empty();
                            $('#error_response').append(list_error);
                            $('#error_response .error_msg ul').append(`<li id="alert-error">An error occurred during update the Orders</li>`)
                        }
                    },
                    error: function (reject) {
                        $(`.approve-cancelation`).attr('disabled', false);
                        $(`.approve-cancelation .fa-spin`).hide();
                        $('#error-modal-'+ticket_id).empty();
                        var errorMsg = JSON.parse(reject.responseText);
                        $('#error-modal-'+ticket_id).append(list_error);
                        if(errorMsg.error){
                            $('#error-modal-'+ticket_id+' .error_msg ul').append(`<li id="alert-error">${errorMsg.error}</li>`)
                        }
                    }
                });
            });
        });
    </script>
@endpush