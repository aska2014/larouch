<div id="fresh">
  <div class="container_16">
    <div id="freshCake" class="grid_16">
      <div class="grid_1 alpha"> <a class="prevButton">&laquo;</a></div>
      <div class="headLine grid_14">
        <h3>{{ l('Special_products') }}</h3>
      </div>
      <div class="grid_1 omega"> <a class="nextButton">&raquo;</a></div>
    </div>
    <div class="newCakes">
      <div class="scroller">
        @foreach($specials as $special)
          <div class="newCake"><a href="{{ $special->url() }}" class="grid_4">
            <img src="{{ $special->img('_sp') }}" width="220" height="120" />
          </a></div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="clear"></div>
</div>