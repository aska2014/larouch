<div class="prodNav grid_16">
  <div class="prodHeadline grid_12 alpha">
    <h3>{{ $category->title }}</h3>
  </div>
</div>
<div class="bodyContent grid_16" <? if(Session::get('lan') == "ar")echo 'dir="rtl"';?>>
  <div class="products grid_16 alpha">
    @foreach($subcategories->results as $subcategory)
    <div class="prodMenu">
      <h4>{{ $subcategory->title }} <a href="{{ $subcategory->url() }}" class="viewAll">{{ l('View All') }} &raquo;</a></h4>
      <? $i = 0; ?>
      @foreach($subcategory->products as $product)
        @if($i < 4)
          <? $i++ ?>
          <div class="menu grid_4 alpha">
            <p>
              <a href="{{ $product->url() }}" class="grid_4 alpha">
                <img src="{{ $product->img('_th') }}" alt="" width="220" height="120" />
              </a><br />
              <a href="{{ $product->url() }}">{{ $product->title }}</a>
            </p>
          </div>
        @endif
      @endforeach
    </div>
    @endforeach
  </div>
  <div class="commentPages grid_16">
    <ul>
      {{ $subcategories->links() }}
    </ul>
  </div>
</div>