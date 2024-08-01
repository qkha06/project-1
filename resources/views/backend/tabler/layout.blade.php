@php 
extract($data)
@endphp

<!doctype html>

<html lang="en">
  @include('backend.tabler.blocks.head')
  <body >
    <script src="/backend/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page">
      @include('backend.tabler.blocks.sidebar')
      <!-- Navbar -->
      @include('backend.tabler.blocks.navbar')
      <div class="page-wrapper px-2">
        <!-- Page header -->
        @include('backend.tabler.blocks.breadcrumb')
        <div class="page-body">
          <div class="container-xl">
          @include('backend.tabler.blocks.arlert')

          <!-- Page body -->
          @include('backend.tabler.'.$content)
          </div>
        </div>
        @include('backend.tabler.blocks.footer')
      </div>
    </div>

    @include('backend.tabler.blocks.modal')
    @include('backend.tabler.blocks.script')
    @stack('scripts')

  </body>
</html>