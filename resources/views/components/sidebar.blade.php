<div class="sidebar">
    <div class="sidebar-title-container">
        <h1>Pariwisata Jember</h1>
    </div>
    <div class="sidebar-menu">
        <div class="sidebar-submenu sidebar-menu-general">
            <a href="/admin/home" class="sidebar-list {{ $active == "home" ? 'active' : '' }}"><i class="bi bi-house-fill"></i> Home</a>
            <a href="/admin/category" class="sidebar-list {{ $active == "category" ? 'active' : '' }}"><i class="bi bi-grid"></i> Kategori</a>
            <a href="/admin/tourist" class="sidebar-list {{ $active == "tourist" ? 'active' : '' }}"><i class="bi bi-car-front-fill"></i> Pariwisata</a>
        </div>
        <div class="sidebar-submenu sidebar-menu-profile">
            <h1>Profil</h1>
            <a href="/admin/profile" class="sidebar-list {{ $active == "profil" ? 'active' : '' }}"><i class="bi bi-person-fill"></i> Edit profil</a>
        </div>
    </div>
</div>