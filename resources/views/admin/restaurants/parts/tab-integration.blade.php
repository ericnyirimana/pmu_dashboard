
<div id="msg_response"></div>
<h6 class="">{{ ucfirst(trans('labels.scloby_integration')) }}</h6>

<div class="card-body">
    <div class="col-12">
        <field-scloby :model="$scloby"/>
    </div>
</div>
<div class="d-flex flex-row row card-body">
    <div class="col-6">
        <div class="form-group">
            <button type="click" class="btn btn-block w-lg btn-success float-right save-integration">Salva 
            <i class="fa fa-circle-o-notch fa-spin" style="font-size:19px"></i>
            </button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.fa-spin').hide();
            $(document).on('click', '.save-integration', function(e) {
                e.preventDefault();
                $('.save-integration .fa-spin').show();
                $('.save-integration').attr('disabled', true);
                var scloby = $('#scloby').val();
                var scloby_token = $('#scloby_token').val();
                var department_id = $('#department_id').val();
                var category_id = $('#category_id').val();
                var ajaxData = {
                    "_token": "{{ csrf_token() }}",
                    "scloby": scloby,
                    "scloby_token": scloby_token,
                    "department_id": department_id,
                    "category_id": category_id,
                    "_method": 'post'
                }
                $.ajax({
                    type: 'POST',
                    url: '{{ route("restaurant.set.integration", $restaurant->id ) }}',
                    data: ajaxData,
                    success: function (data) {
                        $('.save-integration').attr('disabled', false);
                        $('.save-integration .fa-spin').hide();
                        $('#msg_response').empty();
                        var displayMsg = `<div class="d-flex">
                        <div class="col-12"><div class="alert alert-success msg">
                        </div></div></div>`;
                        $('#msg_response').append(displayMsg);
                        $('#msg_response .msg').append(`${data.success}`);
                    },
                    error: function (reject) {
                        $('.save-integration').attr('disabled', false);
                        $('.save-integration .fa-spin').hide();
                        $('#msg_response').empty();
                        var displayMsg = `<div class="d-flex">
                        <div class="col-12"><div class="alert alert-danger msg">
                        <ul></ul>
                        </div></div></div>`;
                        var errors = JSON.parse(reject.responseText);
                        console.log("======>", errors);
                        $('#msg_response').append(displayMsg);
                        if(errors.errors){
                            $('#msg_response .msg ul').append(`<li id="alert-error">${errors.errors}</li>`)
                        }
                        if(errors.errors.department_id){
                            $('#msg_response .msg ul').append(`<li id="alert-error">${errors.errors.department_id[0]}</li>`)
                        }
                        if(errors.errors.category_id){
                            $('#msg_response .msg ul').append(`<li id="alert-error">${errors.errors.category_id[0]}</li>`)
                        }
                        $('html, body').animate({scrollTop: '0px'}, 0);
                    }
                });
                
            }); 
        });
    </script>
@endpush