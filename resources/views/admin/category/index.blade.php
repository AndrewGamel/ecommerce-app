
<x-dashboard-layout>
    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Category Page</h1>
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



<small><a href="{{ route('category.create') }}" class="btn btn-sm btn-outline-primary">Create</a></small>
<br><br>
@isset($message)
<x-flash-message />

@endisset

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>

                {{-- <th></th>
                <th>Edti</th>
                <th>Delete</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</a></td>
                <td>{{ $category->slug }}</td>
                {{-- <td>{{ $category->parent_name }}</td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-sm btn-dark">Edit</a></td> --}}
                {{-- <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- {{ $categories->withQueryString()->appends(['q' => 'test'])->links() }} --}}




</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</x-dashboard-layout>