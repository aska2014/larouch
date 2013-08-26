<div id="k_container">
  <div id="k_body">
    <div id="left_panel">
      <h3>{{ l('Categories') }}</h3>
      <ul>
        @foreach($categories as $category)
          <li>
            <div class="icon"></div><A href="{{ $category->url() }}">{{ $category->title }}</a>
            <style type="text/css">
              .subcategory a{color:#ffc978;}
              .subcategory a:hover{color:#FFF;}
            </style>
            <ul class="subcategory">
            @foreach($category->subcategories as $subcategory)
              <li><A href="{{ $subcategory->url() }}">{{ $subcategory->title }}</a></li>
            @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    </div>
    <div id="products">
      <? $row = 1 ?>
      <div class="row">
      @if(empty($main_products->results))
        <div style="height:300px;">
            There are no products in this section
        </div>
      @endif
      @foreach($main_products->results as $product)
        <div class="product" id="product{{$product->id}}">
          <a href="{{ $product->url() }}">
            <div class="img_holder">
              <img src="{{ $product->img('_th') }}">
            </div>
          </a>
          <div class="info">
            <div class="name">{{ $product->title }}</div>
            <div class="cart_btn <?php if($product->inCart())echo 'remove_from_cart'; else echo 'add_to_cart'; ?>"></div>
          </div>
        </div>
        @if($row%3 == 1)
          </div>
          <div class="row">
        @endif
        <? $row++ ?>
      @endforeach
      </div>
      <div class="clear"></div>
      <div id="pages">
        {{ $main_products->links() }}
      </div>
    </div><!-- END of .products -->

  </div>
  <div class="clear"></div>
</div>
