<form class="card" action="{{ route('admin.category.update',  $category->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-header">
      <h3 class="card-title">Chỉnh sủa danh mục: {{ $category->name }}</h3>
      <div class="card-actions">
        <a href="{{ route('admin.category.index') }}" class="btn btn-primary">
          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
          Quay lại
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label required" for="name">Tên</label>
        <input class="form-control" name="name" value="{{ old('name') ?: $category->name }}" id="name" placeholder="Nhập tên danh mục..." required>
      </div>
      <div class="mb-3">
        <label class="form-label required" for="slug">Slug</label>
        <input class="form-control" name="slug" value="{{ old('slug') ?: $category->slug }}" id="slug" placeholder="Nhập slug danh mục..." required>
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Mô tả</label>
        <textarea class="form-control" name="description" value="{{ old('description') ?: $category->description }}" id="description" rows="5" placeholder="Nhập mô tả danh mục..."></textarea>
      </div>
    </div>
    <div class="card-footer text-end">
      <input value="Thêm danh mục" type="submit" class="btn btn-primary">
    </div>
</form>