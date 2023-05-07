
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




@isset($product->img)
    @if (count($product->img)>0)
 <h5>Your Product Images</h5>
        <div class="row gx-2 position-relative z-10">

        @foreach ($product->img as $key => $_img)
        <form action="{{ route('product.deleteImages',[$product,$key]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger position-absolute translate-middle badge rounded rounded-circle">X</button>
        </form>
        @isset($_img)
  <img src="{{ asset('storage/'.$_img) }}"
        class="p-2 rounded " style="width: 100px;height: 100px;" alt="">

        @endisset


  @endforeach
    </div>
    @endif
@endisset



<form action="{{ route('product.update', $product->id) }}) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin._form')
</form>

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</x-dashboard-layout>