<div class="pageInfo grid_16">
  <div class="dapurBlog grid_11 alpha">
    <h3>Checkout</h3>
  </div>
</div>
<div class="checkout grid_16">
  <div class="billInfo grid_11 alpha">
    <h4>1. {{ l('Shipping Information') }}</h4>
    <form method="post" action="#" id="comment_form">
      <fieldset>
      <div class="errors"><? echo implode("<br />" ,$errors->all()) ?></div>
        <label for="firstName">{{ l('First Name') }}: </label>
        <input type="text" value="{{ Auth::user()->first_name }}" size="30" value="" id="first_name" name="first_name" class="text" />
        <br />
        <label for="lastName">{{ l('Last Name') }}: </label>
        <input type="text" value="{{ Auth::user()->last_name }}" size="30" value="" id="last_name" name="last_name" class="text" />
        <br />
        <label for="address">{{ l('Address') }}:</label>
        <input type="text" size="30" value="{{ Auth::user()->address }}" id="address" name="address" class="text" />
        <br />
        <label for="phone">{{ l('Phone') }}:</label>
        <input type="text" size="30" value="{{ Auth::user()->phone }}" id="phone" name="phone" class="text" />
        <br />
        <div class="clear"></div>
      </fieldset>
      <input type="submit" value="Next step" id="nextSubmit" name="checkout" class="button" />
      <input type="hidden" value="30" name="comment_post_ID" />
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
        <li><a href="#" class="billActive">{{ l('Shipping Information') }}</a></li>
        <li><a href="#" class="billDie">{{ l('Delivery Option') }}</a></li>
      </ul>
    </div>
  </div>
</div>