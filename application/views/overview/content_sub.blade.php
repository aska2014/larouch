<div class="prodNav grid_16">
  <div class="prodHeadline grid_12 alpha">
    <h3>{{ $subcategory->title }}</h3>
  </div>
</div>
<div class="bodyContent grid_16">
  <div class="products grid_16 alpha">
    <div class="prodMenu">
    @foreach($m_products->results as $product)
      <div class="menu grid_4 alpha">
        <p>
          <a href="{{ $product->url() }}" class="grid_4 alpha">
            <img src="{{ $product->img('_th') }}" alt="" width="220" height="120" />
          </a><br />
          <a href="{{ $product->url() }}">{{ $product->title }}</a>
        </p>
      </div>
    @endforeach
    </div>
  </div>
  <div class="commentPages grid_16">
    <ul>
      {{ $m_products->links() }}
    </ul>
  </div>
</div>