<!-- Modal -->
<div class="modal fade view-detail" tabindex="-1" role="dialog" aria-labelledby="removeRegister" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0"><b>{{ ucfirst(trans('labels.modal.transaction_list')) }}</b></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
    <script type="text/javascript">
        var translations = {
            dateTime: '{{ ucfirst(trans('labels.date_hour')) }}',
            product: '{{ ucfirst(trans('labels.product_details')) }}',
            quantity: '{{ ucfirst(trans('labels.quantity')) }}',
        }
        $(document).ready(function () {

            $(document).on('click', '.vw-detail', function () {
                $('.modal-body').empty();
                $('.modal-body').addClass('text-center');
                $('.modal-body').append(`<span class="loader"><i class="fa fa-circle-o-notch fa-spin" style="font-size: 30px;"></i></span>`);
                var order_id = $(this).data('order');
                var pickup_id = $(this).data('pickup');

                $.ajax({
                    type: 'GET',
                    url: "{{ route('subscriptions.detail') }}/"+order_id+"/"+pickup_id,
                    success: function (data) {
                        $('.modal-body').empty();
                        $('.modal-body').removeClass('text-center');
                        var textMessage = '';
                        if(data.message){
                            textMessage = `<p class="text-danger" style="font-size: 20px"><i class="fa fa-exclamation-circle"></i> ${data.message}</p>`;
                        }
                        else {
                            
                            var groupBy = function(xs, key) {
                            return xs.reduce(function(rv, x) {
                                (rv[x[key]] = rv[x[key]] || []).push(x);
                                return rv;
                            }, {});
                            };
                            var groubedByTeam=groupBy(data, 'created_at')
                            $.each(groubedByTeam, function(index) {   
                                textMessage += `<div class="card-box col-12" style="padding-top: 0px;">
                                                    <div class="row m-b-10">
                                                        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
                                                            <p><b><label>${translations.dateTime}:</label> ${index}</b></p>
                                                            <p><label>${translations.quantity}:</label> ${groubedByTeam[index][0].quantity}</p>
                                                        </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <p><label>${translations.product}:</label><ul>`;  

                                $.each(groubedByTeam[index], function(i) {     
                                textMessage += `
                                        <li>${groubedByTeam[index][i].name}</li>`;
                                });
                                textMessage += `</ul></p></div></div></div>`;
                            });
                            textMessage += `</div></div>`;
                        }
                        $('.modal-body').append(textMessage);
                    },
                    error: function (reject) {
                        $('.modal-body').empty();
                        $('.modal-body').removeClass('text-center');
                        $('.modal-body').append(`<p class="text-danger" style="font-size: 20px"><i class="fa fa-exclamation-circle"></i> Something went wrong</p>`)
                    }
                });
            });

        });
    </script>
@endpush
