      <!-- Sidebar -->
      <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="light">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark">
            <a href="">
              <img src="/images/1719841360.png" width="110" height="32" alt="Link4Sub" class="navbar-brand-image">
            </a>
          </h1>
          <div class="navbar-nav flex-row d-lg-none">


            <div class="nav-item d-lg-flex me-3">
              <a data-theme="dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
              </a>
              <a data-theme="light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
		   data-bs-placement="bottom">
                <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
              </a>
            </div>
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(/images/1719840181.jpg)"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="#" class="dropdown-item">Status</a>
                <a href="/backend/profile.html" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Feedback</a>
                <div class="dropdown-divider"></div>
                <a href="/backend/settings.html" class="dropdown-item">Settings</a>
                <a href="/backend/sign-in.html" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
          <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
              @foreach (config('sidebar') as $item)
              <li class="nav-item {{ isset($item['children']) ? 'dropdown' : '' }}">
                <a class="nav-link {{ isset($item['children']) ? 'dropdown-toggle' : '' }}"
                  @if (isset($item['children']))
                  href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false"
                  @else
                  href="{{ route($item['url']) }}"
                  @endif>

                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    {!! $item['icon'] !!}
                  </span>
                  <span class="nav-link-title">
                    {{ __($item['title']) }}
                  </span>
                </a>
                @if (isset($item['children']))
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      @foreach ($item['children'] as $child)
                      <a class="dropdown-item" href="{{ route($child['url']) }}">
                        {{ __($child['title']) }}
                      </a>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </aside>