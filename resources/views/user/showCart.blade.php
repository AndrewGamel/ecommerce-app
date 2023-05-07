<x-front-layout title="Sixteen Clothing | Cart">

    <div class="page-heading products-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-content">
                        <h4>Your Cart</h4>
                        <h2>sixteen products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Ttile</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $value)
                            <form action="{{ route('confirm') }}" method="POST">
                                @csrf
                                <tr>
                                    <th scope="row">{{ $value->id }}</th>
                                    <td>{{ $value->product->title }}</td>
                                    <td>{{ $value->price }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <th scope="col">{{ $value->quantity * $value->price }}</th>
                                    <th scope=""> {{ $value->created_at->diffForHumans() }} </th>
                                    <td><a class="btn btn-outline-primary" href="{{ url("/editCart/$value->id") }}">Edit</a></td>
                                    <td><a class="btn btn-outline-danger" href="{{ url("/deleteCart/$value->id") }}">Delete</a></td>
                                </tr>
                        @endforeach


                        <tr>
                            <th>Total : </th>
                            <th scope="col" colspan="2" class="border-bottom text-center">{{ $sum }}</th>
                            <td><button type="submit" class="btn btn-outline-success">Confirm</button></td>

                        </tr>
                        </form>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>



</x-front-layout>
