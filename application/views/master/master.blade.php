<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Larouch</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
{{ HTML::style('960.css') }}
{{ HTML::style('reset.css') }}
{{ HTML::style('text.css') }}
{{ HTML::style('style.css') }}
{{ HTML::style('themes/brown/style.css') }}
@if(Session::get('lan') == "ar")
 {{ HTML::style('ar_style.css')}}
@endif
@yield('styles')
  
</head>
<body>
<div id="warp">
  <div id="main" class="container_16">
    <div id="header" class="grid_16">
      <div id="logo" class="grid_4 alpha">
        <h1><a href="{{ URL::home() }}">Chocola</a></h1>
        <h2>Famously Delicious</h2>
      </div>
      <div id="headright" class="grid_7 prefix_5 omega">
        <h3 class="login" style="height:0px;">
          @if(Auth::guest())
            <a href="{{ URL::to('register') }}">{{ l('Sign_up') }}</a> / <a href="{{ URL::to('login') }}">{{ l('Login') }}</a>
          @else
            <span class="hiUser">{{ l('Hi') }}, {{ Auth::user()->name() }}</span> <a href="{{ URL::to('logout') }}">{{ l('Logout') }}</a>
          @endif
        </h3>
          <a href="{{ URL::to('set_language/arabic') }}"><img src="{{ URL::to('public/images/arabic_flag_icon.gif') }}" /></a>
          <a href="{{ URL::to('set_language/english') }}"><img src="{{ URL::to('public/images/english_flag_icon.gif') }}" /></a>
        <p>{{ l('Total'). ': '.l('S.R') .' '. number_format(Cart::total(), 2) }}</p>
        <p><span class="vChart"><a href="{{ URL::to('shopping-cart') }}">{{ l('View_Cart') }}</a></span> <span class="cOut"><a href="{{ URL::to('checkout') }}">{{ l('Checkout') }}</a></span></p>
      </div>
    </div>
    <div id="mainMenu" class="grid_16">


      <ul class="dropdown">
        <li><a href="{{ URL::home() }}" <? if(Session::get('lan') == "ar") echo 'style="font-size:18px;"'; ?> class="aActive">{{ l('Home') }}</a></li>
        <li><a href="#" <? if(Session::get('lan') == "ar") echo 'style="font-size:18px;"'; ?>>{{ l('Categories') }}</a>
          <ul class="sub_menu">
            @foreach($menu_categories as $category)
             <li>
              <a href="{{ $category->url() }}">{{ $category->title }}</a>
                <ul>
                  @foreach($category->subcategories as $subcategory)
                    <li><a href="{{ $subcategory->url() }}">{{ $subcategory->title }}</a></li>
                  @endforeach
                </ul>
             </li>
             @endforeach
          </ul>
        </li>
        @foreach($menu as $page)
        <li><a href="{{ $page->url() }}">{{ $page->title }}</a></li>
        @endforeach
      </ul>


    </div>
    <div id="stickySearch" class="grid_16">
      <div class="stickyNews grid_12 alpha">
        <!-- <p>New chocolates with <em>Free Delivery.</em> <a href="#" class="bookMan">More &raquo;</a></p> -->
      </div>
      <div class="search grid_4 omega">
        <form action="{{ URL::to_action('home@search') }}" method="get">
          <input type="text" value="{{ l('Search_Products') }}" id="s" class="txt" name="s" onfocus="if (this.value == '{{ l('Search_Products') }}') {this.value = '';}" onblur="if (this.value == '') {this.value = '{{ l('Search_Products') }}';}" />
          <input type="submit" class="sbmt" value="{{ l('Search') }}" />
        </form>
      </div>
    </div>
    
    @yield('slider')

  </div>
  <div class="clear"></div>
</div>

@yield('body')

<div id="richContent">
  <div class="container_16">
    @foreach($footer_subcategories as $subcategory)
    <div class="popularCakes grid_4">
      <h4>{{ $subcategory->title }}</h4>
      <ul>
        <? $limit = 0; ?>
        @foreach($subcategory->products as $product)
          <? $limit++; ?>
          @if($limit < 5)
            <li><a href="{{ $product->url() }}">{{ $product->title }}</a></li>
          @endif
        @endforeach
      </ul>
    </div>
    @endforeach
    <div class="orderPhone grid_4">
      <h4><em>{{ l('Order by Phone') }}</em> <span style="font-size:20px;">+966-01-4330077</span></h4>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div id="richContent2">
  <div class="container_16">
    <div class="fromBlog grid_4">
      @if(Session::get('lan') != "ar")
      <h4>Chocolate Quotes</h4>
      <h5>Baron Justus von Liebig</h5>
      <p>Chocolate is a perfect food, as wholesome as it is delicious, a beneficent restorer of exhausted power. It is the best friend of those engaged in literary pursuits.</p>
      @endif
    </div>
    <div class="storeDelivery grid_4">
      <h4>{{ l('Shopping Cart') }}</h4>
      <ul>
        @if(Auth::guest())
        <li><a href="{{ URL::to('register') }}">{{ l('Sign_up') }} / {{ l('Login') }}</a></li>
        @endif
        <li><a href="#">{{ l('Total'). ': '.l('S.R') .' '. number_format(Cart::total(), 2) }}</a></li>
        <li><a href="#">{{ l('View Cart') }}</a></li>
        <li><a href="#">{{ l('Checkout') }}</a></li>
        @if(!Auth::guest())
        <li><a href="{{ URL::to('logout') }}">{{ l('Logout') }}</a></li>
        @endif
      </ul>
    </div>
    <div class="storeDelivery grid_4">
      <h4>{{ l('Categories') }}</h4>
      <ul>
        <? $i = 1; ?>
        @foreach($menu_categories as $category)
         <? if($i > 5) break; $i ++; ?>
         <li><a href="{{ $category->url() }}">{{ $category->title }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="socialNet grid_4">
      <h4>Keep in touch</h4>
      <ul>
        <li><a href="http://www.facebook.com/chocola.larouch" class="facebook">Facebook</a></li>
        <li><a href="https://twitter.com/ChocolaLarouch" class="twitter">Twitter</a></li>
        <li><a href="https://www.youtube.com/channel/UCJMdRIZjvxcKDHb5mI0IxFQ?feature=mhee" class="feed" style="height:55px;">Youtube</a></li>
      </ul>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div id="footer">
  <div class="container_16">
    <div class="copyright grid_16">
      <p class="left">{{ l('Copyright') }}</p>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<!--
  To be used after dapur when yielding scripts because unfortuntly the slider needs an older
  version of the jquery library
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
-->
{{ HTML::script('jquery-1.4.2.js')}}
{{ HTML::script('jquery.tools.min.js') }}
{{ HTML::script('dapur.js') }}
@yield('scripts')


{{ HTML::style('public/plugins/drop/css/style.css') }}
@if(Session::get('lan') == "ar")
  {{ HTML::style('public/plugins/drop/css/style_ar.css') }}
@endif
{{ HTML::script('public/plugins/drop/js/jquery.dropdownPlain.js') }}

</body>
</html>