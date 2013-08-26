<div itemscope itemtype="http://data-vocabulary.org/Product">
  <div class="prodNav grid_16">
    <div class="breadcrumb grid_12 alpha"> <a href="{{ $category->url() }}" itemprop="category" content="Hardware > Tools > Anvils">{{ $category->title }}</a> &raquo; <a href="{{ $subcategory->url() }}">{{ $subcategory->title }}</a> &raquo; {{ $product->title }}</div>
  </div>
  <div class="bodyContent grid_16">
    <div class="blogPage grid_11 alpha">
      <div class="post" style="border-bottom:0px;">
        <p>
          <img width="635px" src="{{ $product->img() }}" itemprop="image">
        </p>
      </div>
    </div>
    <div class="sideBarProd grid_5 omega">
      <div class="sideBarWarp" <? if(Session::get('lan') == "ar") echo 'dir="rtl"'; ?>>
        <h3 itemprop="name">{{ $product->title }}</h3>
        <h4 itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
          {{ l('S.R') }}
          <meta itemprop="currency" content="USD" />
          <span itemprop="price">{{ $product->price() }}</span>
        </h4>

        @if($product->inCart())
        {{ l('Product added to the cart') }}
        @else
         <form id="addCartForm">
          <p>
            <label for="qty">{{ l('Enter Qty') }} : </label>
            <input type="text" name="p_quantity" id="p_quantity" value="1" style="margin-left:10px; width:20px;" />
          </p>
          <p>
            <input type="button" id="add_to_cart{{$product->id}}" value="Add to Cart" tabindex="2" name="submit" class="addCart button" />
          </p>
        </form>
        @endif
        <div class="clear"></div>
      </div>
      <div class="fiveStar">
        <h4>{{l('Our Quality Guarantee')}}</h4>
        <p><img src="images/star.png" alt="" /> <img src="images/star.png" alt="" /> <img src="images/star.png" alt="" /> <img src="images/star.png" alt="" /> <img src="images/star.png" alt="" /></p>
        <p>
          {{ $product->quality }}
        </p>
      </div>
    </div>
  </div>
</div>