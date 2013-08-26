<div id="fresh">
  <div class="container_16">
    <div id="freshCake" class="grid_16">
      <div class="grid_1 alpha"> <a class="prevButton">&laquo;</a></div>
      <div class="headLine grid_14">
        <h3>{{ l('You might also like') }}</h3>
      </div>
      <div class="grid_1 omega"> <a class="nextButton">&raquo;</a></div>
    </div>
    <div class="newCakes">
      <div class="scroller">
        @foreach($related as $product)
          <div class="newCake"><a href="{{ $product->url() }}" class="grid_4">
            <img src="{{ $product->img('_sp') }}" width="220" height="120" />
          </a></div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>