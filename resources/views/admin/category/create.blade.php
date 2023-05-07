
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



<form action="{{ route('category.store') }}" method="POST">
@csrf
@method('post')



<div class="form-group">
    {{-- <x-input type="text" id="title" name="title" label="Title" placeholder="Enter Title" :value="$product->title" /> --}}
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" label="name" placeholder="Enter Category Name" value="{{ old('name',$category->name) }}">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
</div>

<div class="form-group">
    <label for="slug">slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" label="slug" placeholder="Enter slug" value="{{ old('slug',$category->slug) }}">
    @error('slug')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Submit">
    </div>


</form>


</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</x-dashboard-layout>