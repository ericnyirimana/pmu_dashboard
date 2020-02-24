<div class="row">
    <div class="col-12 col-md-6">
          <field-text label="Name" field="name" :model="$pickup" required  />
    </div>
    <div class="col-12 col-md-6">
          <field-radio label="Type" field="type_pickup" :items="['offer'=>'Offer','subscription'=>'Subscription']" :model="$pickup" required  />
    </div>
</div>

<div class="row">
  <brand-restaurant-select :model="$pickup" />
</div>


<div class="row">
    <div class="col-12 col-md-4">
          <field-select label="Price range" field="price" :model="$pickup" type="simple" :values="['7' => '7 €', '14' => '14 €' ]"  required  />
    </div>
    <div class="col-12 col-md-4">
          <field-date label="Offer duration" :model="$pickup" field="date" range="true" />
    </div>
    <div class="col-12 col-md-4">
          <field-select label="Offer disposable" field="timeslot" foreignid="timeslot_id" :model="$pickup" type="relation" :values="$timeslots" required  />
    </div>
</div>


<div class="row">
  <div class="col-12">
    <h5>BUILD YOUR OFFER</h5>
  </div>
</div>

<div class="row clearfix">
  <div class="col-6">
        <span class="text-center btn btn-primary btn-block text-uppercase">simple</span>
  </div>
  <div class="col-6 text-center">
        <span class="text-center btn btn-secondary btn-block  text-uppercase">combo</span>
  </div>
</div>
<div class="row mt-4">
    <div class="col-4">
        <div class="card-box">
            <div class="visible-always-scroll" style="max-height: 800px;">
              <h4 class="text-dark header-title m-t-0 m-b-30">Menu</h4>


                  <ul class="list-menu">

                      @foreach(['Dish','Drink'] as $type)
                      @php $class = 'sections'.$type; @endphp
                      <li><h5>{{ $type }}</h5>
                          <ul>
                            @foreach($menu->{$class} as $section)
                              <li data-name="{{ $section->name }}"><h6 class="add-all">{{ $section->name }}</h6>
                                  <ul>
                                    @foreach($section->products as $product)
                                      <li class="add" data-id="{{ $product->id }}" data-name="{{ $product->name }}"  data-section="{{ $section->name }}">{{ $product->name }}</li>
                                      @endforeach
                                  </ul>
                              </li>
                            @endforeach
                          </ul>
                      </li>
                      @endforeach

                  </ul>

            </div>
        </div>
    </div><!-- end col -->
    <div class="col-8">
        <div class="card-box">
            <div class="visible-always-scroll list-section">

              @foreach($pickup->sections as $name=>$section)
              <div class="card " id="{{ $name }}">
                <div class="card-header">
                  <h6 class="float-left">{{ $name }}</h6>
                  <i class="fi-trash float-right font-18 remove-section"></i>
                </div>
                <div class="card-body">
                  <p class="card-title text-right">Disponibilità <small>(x giorno)</small></p>

                  <ul class="list-group list-group-flush group-products">
                      @foreach($section as $product)
                      <li class="list-group-item" data-id="{{ $product->id }}">
                          <i class="fa fa-minus-square remove"></i>
                          <div class="name">{{ $product->name }}</div>
                          <div class="quantity"><input type="text" value="{{ $product->pivot->quantity_offer }}" maxlength="3" /></div>
                          <input type="hidden" name="products[]" value="{{ $product->id }}" />
                      </li>
                      @endforeach
                  </ul>
                </div>
              </div>
              <div class="text-center mt-4 mb-4"><i class="fi-plus"></i></div>
              @endforeach
            </div>
        </div>
    </div><!-- end col -->
</div>


<div class="row mt-5">
  <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-block w-lg btn-success float-right">Save</button>
        </div>
  </div>
</div>
@push('styles')
<style>

  .list-menu ul ul li, .list-menu ul li, .remove-section {
    cursor: pointer;
    padding: 5px;
    list-style: none;
  }

  .list-menu ul ul li.removed {
    color: #CCCCCC;
  }

  .list-menu ul ul li.add:before, .list-menu ul li h6.add-all::before {
   content: "\f0fe"; /* FontAwesome Unicode */
   font-family: FontAwesome;
   display: inline-block;
   margin-left: -1.3em; /* same as padding-left set on li */
   width: 1.3em; /* same as padding-left set on li */

  }


  .group-products input {
      text-align: right;
      padding: 3px 10px;
      width: 50px;
      border-radius: 5px;
      border: 1px solid #CCCCCC;
  }

  .group-products li .name {
    padding-top: 5px;
    float: left;
  }

  .group-products li .quantity {
    float: right;
  }
  .group-products li .remove {
   margin-left: -1.3em;
   font-size: 1.2rem;
   padding-top: 5px;
   float: left;
   cursor: pointer;

  }

</style>
@endpush
@push('scripts')
<script>
$(document).ready(function(){


    /* MENU LEFT ACTIONS */
    $(document).on('click', '.list-menu ul li .add', function() {
          addItem( this );
    });

    $(document).on('click', '.list-menu .add-all', function() {

          var section = $(this).text();

          if (!$('#'+section).length)
          addSection(section);

          $(this).parent().children('ul').children('li').each(function(i,item) {
            addItem( item );
          });

          $(this).removeClass('add-all');



    });
    /* MENU END */

    /* LIST PRODUCTS ACTIONS */
    $(document).on('click', '.remove-section', function() {

          $(this).parent().parent().find('.group-products li').each(function(i, el){
              removeItem( el );
          });

          removeSection( $(this).parent().parent() );

    });
    $(document).on('click', '.list-group-item .remove', function() {
          removeItem( $(this).parent() );
    });
    /* PRODUCTS END */

});

function addItem(el) {

    var id = $(el).data('id');
    var name = $(el).data('name');
    var section = $(el).data('section');

    $(el).removeClass('add');
    $(el).addClass('removed');

    var html = '<li class="list-group-item" data-id="{{ $product->id }}">';
        html += '<i class="fa fa-minus-square remove"></i>';
        html += '<div class="name">' + name + '</div>';
        html += '<div class="quantity"><input type="text" value="1" maxlength="3" /></div>';
        html += '<input type="hidden" name="products[]" value="' + id + '" />';
      html += '</li>';
    $('#' + section + ' .group-products').append(html);

}

function removeItem(el) {

    var  name = $(el).find('.name').text();

    $(el).remove();

    $(".list-menu ul").find("[data-name='" + name + "']").removeClass('removed');
    $(".list-menu ul").find("[data-name='" + name + "']").addClass('add');


}

function addSection(name) {

    var html = '<div class="card " id="' + name + '">';
       html += '<div class="card-header">';
       html += '<h6 class="float-left">' + name + '</h6>';
       html += '<i class="fi-trash float-right font-18 remove-section"></i>';
       html += '</div>';
       html += '<div class="card-body">';
       html += '<p class="card-title text-right">Disponibilità <small>(x giorno)</small></p>';
       html += '<ul class="list-group list-group-flush group-products">';
       html += '</ul>';
       html += '</div>';
       html += '</div>';

       $('.list-section').append(html);


}

function removeSection(el) {

    var name = $(el).attr('id');
    console.log(name);
    $(el).remove();

    $(".list-menu").find("[data-name='" + name + "'] h6").addClass('add-all');


}

</script>
@endpush
