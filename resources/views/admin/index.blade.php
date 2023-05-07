
<x-dashboard-layout>
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Starter Page</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
{{-- ++++++++ START HERE +++++++++++++ --}}



<small><a href="{{ route('product.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>
<br><br>
@isset($message)
<x-flash-message />

@endisset

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>img</th>
                <th>Edti</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->desc }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>@foreach ($product->img as $_img)
                 <img src="{{ asset('storage/'.$_img) }}"  style="width: 40px ;height: 40px;"/>
                @endforeach</td>
                <td><a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-dark">Edit</a></td>
                <td>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"  onclick="return confirm('Are you sure?');" >Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $products->links() }}




</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</x-dashboard-layout>