<div class="pageInfo grid_16">
  <div class="dapurBlog grid_11 alpha">
    <h3>Checkout</h3>
  </div>
</div>
<div class="checkout grid_16">
  <div class="billInfo grid_11 alpha">
    <h4>2. {{ l('Delivery Option') }}</h4>
    <form method="post" action="{{ URL::to('checkout/second') }}" id="comment_form">
      <fieldset>
      <div class="errors"><? echo implode("<br />" ,$errors->all()) ?></div>
        <label class="delivery">{{ l('Deliver on this specific date') }}:</label>
        <input type="text" name="deliver_at" value="{{ date('n/j/Y') }}" class="date_picker" />
        <br />
        <label class="delivery">{{ l('Deliver on this specific time') }}:</label>
        <select name="deliver_range" style="margin-top:15px;">
          <option value="As soon as possible">{{ l('As soon as possible') }}</option>
          <option value="8.00 - 10.00 AM">8.00 - 10.00 AM</option>
          <option value="10.00 - 12.00 AM">10.00 - 12.00 AM</option>
          <option value="12.00 - 2.00 PM">12.00 - 2.00 PM</option>
          <option value="2.00 - 4.00 PM">2.00 - 4.00 PM</option>
          <option value="4.00 - 6.00 PM">4.00 - 6.00 PM</option>
          <option value="6.00 - 8.00 PM">6.00 - 8.00 PM</option>
        </select>
        <div class="clear"></div>
      </fieldset>
      <input type="submit" value="Place Order &amp; Checkout" id="checkout" name="checkout" class="button" />
    </form>
  </div>
  <div class="summary grid_5 omega">
    <h4>{{ l('Summary') }}</h4>
    <div class="sumWarp">
      <ul>
        <li><a href="#" class="down">{{ l('Shopping Cart') }} <span><img src="images/done.png" alt="" /></span></a>
          <ul>
            <li class="info">{{ Cart::total_items() }} {{ l('items in your cart') }}</li>
            <li class="total">{{ l('S.R').' '.number_format(Cart::total(), 2) }}</li>
            <li class="clear"></li>
          </ul>
        </li>
        <li><a href="{{ URL::to('checkout') }}" class="down">{{ l('Shipping Information') }} <span><img src="images/done.png" alt="" /></span></a>
          <ul>
            <li class="info"> {{ Auth::user()->name() }}<br />
              {{ Auth::user()->address }}<br />
              {{ Auth::user()->phone }}</li>
            <li class="clear"></li>
          </ul>
        </li>
        <li><a href="#" class="billActive">{{ l('Delivery Option') }}</a></li>
      </ul>
    </div>
  </div>
</div>