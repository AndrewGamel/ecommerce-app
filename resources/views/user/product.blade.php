<x-front-layout>
    <!-- Page Content -->
    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>new arrivals</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <ul>
                            <li class="active" data-filter="*">All Products</li>
                            <li data-filter=".des">Featured</li>
                            <li data-filter=".dev">Flash Deals</li>
                            <li data-filter=".gra">Last Minute</li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="filters-content">
                        <div class="row grid">

                            @foreach ($product as $value)
                                <form action="{{ route('addCart', [$value->id]) }}" method="post">
                                    @csrf
                                    <div class="col-lg-4 col-md-4 all des">
                                        <div class="product-item">
                                            @foreach ($value->img as $key => $_img)
                                                @if ($key == 0)
                                                    <img src="{{ asset('storage/' . $value->img[$key]) }}"
                                                        class="h-25" style="max-height: 160px" alt="">
                                                @endif
                                            @endforeach


                                            <div class="down-content">
                                                <a href="#">
                                                    <h4>{{ $value->title }}</h4>
                                                </a>
                                                <h6>${{ $value->price }}</h6>
                                                <p>{{ $value->desc }}.</p>
                                                <ul class="stars">
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span>Reviews (12)</span>
                                            </div>

                                            <div class="row justify-content-between">


                                                <div class="col-4">
                                                    <button class="btn btn-outline-danger text-blue" type="submit">
                                                        <i class="fas fa-cart-shopping">Add ToCart</i>
                                                    </button>
                                                </div>

                                                <div class="form-group col-5" id="qualitiy">
                                                    <input type="number" class="form-control" placeholder="Quantity"
                                                        name="quantity"min="1" max="4" value="{{ $product->quantity ?? 1 }}" />
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    {{ $product->links() }}
                </div>

                <div class="col-md-12">
                    <ul class="pages">
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-front-layout>
