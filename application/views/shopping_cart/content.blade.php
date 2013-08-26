<div class="prodNav grid_16">
  <div class="prodHeadline grid_16">
    <h3>{{ l('Your Shopping Cart') }}</h3>
  </div>
</div>
<div class="bodyContent grid_16">
  <div class="shopCart grid_16 alpha">
    <div class="headCart grid_16 alpha">
      <div class="itemHead grid_9 alpha">{{ l('Item Description') }}</div>
      <div class="priceHead grid_2"> {{ l('Price') }}</div>
      <div class="qtyHead grid_1"> {{ l('Qty') }}</div>
      <div class="subtotalHead grid_2"> {{ l('Subtotal') }}</div>
      <div class="remHead grid_2 omega"> {{ l('Remove') }}</div>
    </div>
    <form action="{{ URL::to('shopping-cart') }}" method="POST">
      <div class="bodyCart grid_16 alpha">
        @if(empty($products))
        <div class="warpCart">
          <div class="item grid_9 alpha">
          {{ l('There_are_no_items') }}
        </div>
        </div>
        @endif
        @foreach($products as $product)
        <div class="warpCart">
          <div class="item grid_9 alpha">
            <p><a href="{{ $product->url() }}"><img width="50px" src="{{ $product->img('_th') }}" alt="" />{{ $product->title }}</a> </p>
          </div>
          <div class="price grid_2">
            <p>{{ l('S.R').' '.number_format($product->price, 2) }}</p>
          </div>
          <div class="qty grid_1">
            <input type="text" size="1" value="{{ $product->qty }}" name="qty[]" />
          </div>
          <div class="subtotal grid_2">
            <p>{{ l('S.R').' '.number_format($product->subtotal, 2) }}</p>
          </div>
          <div class="remove grid_2 omega">
            <input type="checkbox" name="remove[]" value="{{ $product->id }}" />
          </div>
          <input type="hidden" name="ids[]" value="{{ $product->id }}" />
        </div>
        @endforeach
      </div>
      <div class="footCart grid_16 alpha" >
        @if(Session::get('lan') == "ar")
          <div class="totalPrice grid_2 omega" style="font-size:18px; "> {{ l('S.R').' '.number_format(Cart::total(), 2)}}</div>
          <div class="grandTotal grid_3 prefix_11 alpha" style="padding-left:10px;">{{ l('Grand Total') }}</div>
        @else
          <div class="grandTotal grid_3 prefix_11 alpha">{{ l('Grand Total') }}</div>
          <div class="totalPrice grid_2 omega" style="font-size:18px;">{{ l('S.R').' '.number_format(Cart::total(), 2)}}</div>
        @endif
      </div>
      <div class="buttonCart grid_16 alpha">
        <input type="button" value="Continue Shopping" name="Continue Shopping" class="continueShop" />
        <input type="submit" value="Checkout" name="Checkout" class="checkoutCart" />
        <input type="submit" value="Update Cart" name="Update Cart" class="updateCart" />
        <div class="clear"></div>
      </div>
    </form>
  </div>