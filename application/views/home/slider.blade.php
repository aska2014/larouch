<div class="products grid_16">
  <div class="productsWarp">
    <ul>
      @foreach($slider as $slide)
        <li><a href="{{ $slide->url() }}">
          <img src="{{ $slide->img() }}" width="938" height="398"  />
        </a></li>
      @endforeach
   </ul>
  </div>
</div>
<div class="productThumb grid_10 prefix_3 suffix_3">
  <ul>
    <?php $first = true; ?>
    @foreach($slider as $slide)
      <li class="grid_2<?php if($first){echo ' alpha'; $first = false;} ?>">
        <a href="#">
        <img src="{{ $slide->img('_th') }}" width="100" height="60" />
        </a>
      </li>
    @endforeach
  </ul>
</div>