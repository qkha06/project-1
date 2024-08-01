<script src="https://link4sub.qkt/js/ckeditor5/ckeditor.js"></script>

<style>
.ck-editor__editable_inline {
    height: 400px;
}
.ck.ck-icon, .ck.ck-icon * {
    stroke: none
}
.ck.ck-powered-by {
    display: none !important;
    opacity: 0 !important;
    height: 0 !important;
}

.preview {
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 100%;
    max-width: 100%;
    border: 1px solid #ced4da;
    border-radius: 10px;
    margin: auto;
    background-color: rgb(255, 255, 255);
    box-shadow: 0 0 20px rgba(170, 170, 170, 0.2);
    margin: 20px 0;

}
.preview img {
    width: 100%;
    object-fit: cover;
    border-radius: 12px;
}
</style>
<div class="row row-deck">
    <div class="col-12">
        <form class="form card" action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-header">
                <h3 class="card-title">Quản lý bài đăng</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.post.index') }}" class="btn btn-primary">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
                        Quay lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <label class="form-label required" for="post-title">Post title</label>
                            <input type="text" id="post-title" name="title" value="{{ $post->title }}" placeholder="Enter post title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="post-slug">Slug</label>
                            <input type="text" id="post-slug" name="slug" value="{{ $post->slug }}" placeholder="Enter post slug" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="post-description">Description</label>
                            <input type="text" id="post-description" name="description" value="" placeholder="Enter post description" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label required" for="post-content">Post Content</label>
                            <textarea style="min-height: 300px" type="text" id="post-content" name="content" value="" placeholder="Enter post Content" class="form-control"></textarea>
                        </div>
        
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label class="form-label" for="post-category">Post category</label>
                            <select id="post-category" class="form-control" name="category">
                                <option value="">Choose...</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}</option>  
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="featured-image">Post featured image</label>
                            <input type="file" id="featured-image" class="form-control" name="image">
                            <label class="preview" for="featured-image">
                                <img id="img-preview" src="{{ $post->image ?? '/img.png'  }}" />
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="tags">Tags</label>
                            <input type="text" id="tags" name="tags" placeholder="Enter tags" class="form-control" value="{{ $post->tags }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="visibility">Visibility</label>
                            <select id="visibility" class="form-control">
                                <option value="public">Public</option>
                                <option value="private">Private</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex align-items-center">
                <input class="btn btn-primary" type="submit" name="submit" value="Lưu lại">
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById('featured-image');
        const image = document.getElementById('img-preview');

        input.addEventListener('change', (e) => {
            if (e.target.files.length) {
                const src = URL.createObjectURL(e.target.files[0]);
                image.src = src;
            }
        });
        ClassicEditor.create(document.querySelector('#post-content'), {
            // ckfinder: {
            //     uploadUrl: '/ckeditor/upload?_token=' + CR_TOKEN,
            // },
            mediaEmbed: {
                previewsInData: true
            },
            initialData: `{!! $post->content !!}`
        })
        .catch(error => {
            console.error(error);
        }).then(newEditor => { window.editor = newEditor; });
    });
</script>
