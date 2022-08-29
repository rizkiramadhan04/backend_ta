 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <p>Toko</p>
         </div>
         <div class="sidebar-brand-text mx-1">Serba <sup>99</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="index.html">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Interface
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="{{ route('admin.user') }}">
             <i class="fas fa-fw fa-cog"></i>
             <span>User</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Produk Dan Penjualan
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Data Produk</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item" href="{{ route('admin.produk') }}">
                     <h6 class="collapse-header">Produk</h6>
                 </a>
                 <a class="collapse-item" href="{{ route('admin.create-produk-page') }}">
                     <h6 class="collapse-header">Tambah Produk Baru</h6>
                 </a>
                 <a class="collapse-item" href="{{ route('admin.update-update-page') }}">
                     <h6 class="collapse-header">Mengubah Produk</h6>
                 </a>
             </div>
         </div>
     </li>


     <!-- Nav Item - Tables -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('admin.penjualan') }}">
             <i class="fas fa-fw fa-table"></i>
             <span>Data Penjualan</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>


 </ul>
 <!-- End of Sidebar -->
