<section id="weekly-best">
    <h2><a href="#">WEEKLY BEST</a></h2>
    <div class="gender__toggle">
      <button class="btn-weekly active-weekly">For Him</button>
      <button class="btn-weekly">For Her</button>
    </div>
    <ul class="weekly-list">
        @foreach($weekly_hims as $item)
            <li>
                <div class="product">
                    <div class="thumnail">
                        <a href="{{ route('product.detail', ['product' => $item->namevi]) }}"><span style="background-image:url({{ $item->image }})"
                                          alt=""></span></a>
                        <div>
                            <div class="detail">
                                <h6 class="name">{{ $item->name }}</h6>
                                <div class="price">
                                    <p>{{ number_format($item->price) }}đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach


    </ul>
    <ul class="weekly-list active-list">
        @foreach($weekly_hers as $item)
            <li>
                <div class="product">
                    <div class="thumnail">
                        <a href="{{ route('product.detail', ['product' => $item->namevi]) }}"><span style="background-image:url({{ $item->image }})"
                                          alt=""></span></a>
                        <div>
                            <div class="detail">
                                <h6 class="name">{{ $item->name }}</h6>
                                <div class="price">
                                    <p>{{ number_format($item->price) }}đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>
  </section>
