<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            {{-- TODO: pass value to this component and foreach to display breadcrums and their corresponding route name --}}
            <h1 class="mt-4">{{ $title }}</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ $breadcrumb }}</li>
            </ol>
            @yield('side-navigation-content')
        </div>
    </main>
    {{-- Footer --}}
    @include('layouts.footer')
</div>