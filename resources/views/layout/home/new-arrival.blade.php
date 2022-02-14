<section id="new-arrivals__slider">
    <h2><a href="#">WHAT'S NEW</a></h2>
    <div class="gender__toggle">
      <button class="btns active-toggle">For Him</button>
      <button class="btns">For Her</button>
    </div>
    <div class="products__slider">
      <div class="slider">
        <div class="for-him owl-carousel">

            @foreach($new_hims as $item)
                <div>
                    <div> <a href="{{ route('product.detail', ['product' => $item->namevi]) }}"><span style="background-image:url({{ $item->image }})" alt=""></span></a> </div>
                    <div class="detail">
                        <h6 class="name">{{ $item->name }}</h6>
                        <div class="price">
                            <p>{{ number_format($item->price) }}đ</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
      </div>
      <div class="slider active-slider">
        <div class=" for-her owl-carousel">
            @foreach($new_hims as $item)

            <div>
            <div><a href="{{ route('product.detail', ['product' => $item->namevi]) }}"><span style="background-image:url({{ $item->image }})" alt=""></span></a></div>
            <div class="detail">
              <h6 class="name">{{ $item->name }}</h6>
              <div class="price">
                <p>{{ number_format($item->price) }}đ</p>
              </div>
            </div>
          </div>
            @endforeach
        </div>
      </div>
    </div>
  </section>
