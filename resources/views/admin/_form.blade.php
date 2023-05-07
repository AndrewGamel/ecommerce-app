<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach(App\Models\Category::all() as $category)
        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    {{-- <x-input type="text" id="title" name="title" label="Title" placeholder="Enter Title" :value="$product->title" /> --}}
        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" label="title" placeholder="Enter Title" value="{{ old('title',$product->title) }}">
        @error('title')
        <p class="text-danger">{{ $message }}</p>
        @enderror
</div>

<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" label="quantity" placeholder="Enter quantity" value="{{ old('quantity',$product->quantity) }}">
    @error('quantity')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>



<div class="form-group">
    <label for="price">Price</label>
    <input type="text" class="form-control @error('price') is-invalid @enderror" id="quantity" name="price" label="price" placeholder="Enter price" value="{{ old('price',$product->price) }}">
    @error('price')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>




<div class="form-group">
    <label for="description">Description</label>
<textarea id="description" name="desc" placeholder="Enter Your Description" class="form-control @error('desc') is-invalid @enderror">{{ old('desc', $product->desc) }}</textarea>
    @error('desc')
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <input class="uploadButton-input" type="file" name="img[]"
    accept="image/*" id="upload" multiple />
    <br>
    <label class="uploadButton-button ripple-effect" for="upload">Upload
    Files</label>
    <span class="uploadButton-file-name">Images that might be helpful in
    describing your Product</span>
    </div>
    {{-- <div>
      @isset($project->attachments )
           @foreach ($project->attachments as $file)
               <li>
                  <a href="{{ asset('storage/' . $file) }}">{{basename($file)}}</a>
                  <form action=""></form>
                  </li>
              @endforeach
      @endisset

    </div> --}}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="Submit">
    </div>