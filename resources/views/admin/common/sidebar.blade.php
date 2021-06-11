<?php
  $adminUserDetails = session('adminUserDetails');
?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

      <li class="header">NAVIGATION</li>
      <li class="treeview {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a href="{{ URL::to('admin/dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <!-- Manage Media -->
      <?php //if($adminUserDetails->role_type==1){ ?>
      {{-- <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} {{ Request::is('admin/media/detail/*') ? 'active' : '' }} {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-picture-o"></i> <span>Manage Media</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/media/add') ? 'active' : '' }} {{ Request::is('admin/media/detail/*') ? 'active' : '' }} ">
              <a href="{{url('admin/media/add')}}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Media </span>
              </a>
          </li>

          <li class="treeview {{ Request::is('admin/media/display') ? 'active' : '' }} {{ Request::is('admin/addimages') ? 'active' : '' }} {{ Request::is('admin/uploadimage/*') ? 'active' : '' }} ">
              <a href="{{url('admin/media/display')}}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Media Setings </span>
              </a>
          </li>
        </ul>
      </li> --}}
      <?php //} ?>
      <!-- Manage Media -->

      <!-- Customers Media -->
      
      <li class="treeview {{ Request::is('admin/customers/add') ? 'active' : '' }} {{ Request::is('admin/customers/edit/*') ? 'active' : '' }} {{ Request::is('admin/customers/display') ? 'active' : '' }}{{ Request::is('admin/customers/uploadExcel') ? 'active' : '' }}">
        <a href="{{url('admin/customers/display')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Customers</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <!-- Customers Media -->

      <!-- manage Clients -->
      <?php if($adminUserDetails->role_type==1){ ?>
      <li class="treeview {{ Request::is('admin/client/add') ? 'active' : '' }} {{ Request::is('admin/client/display') ? 'active' : '' }} {{ Request::is('admin/client/edit/*') ? 'active' : '' }}">
        <a href="{{url('admin/client/display')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Clients</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <?php } ?>
      <!-- manage Clients --> 

      <!-- Driver Media -->
      <?php if($adminUserDetails->role_type==1){ ?>
      <li class="treeview {{ Request::is('admin/drivers/add') ? 'active' : '' }} {{ Request::is('admin/drivers/edit/*') ? 'active' : '' }}{{ Request::is('admin/drivers/details/*') ? 'active' : '' }} {{ Request::is('admin/drivers/display') ? 'active' : '' }}">
        <a href="{{url('admin/drivers/display')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Driver</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <?php } ?>
      <!-- Driver Media -->

      <!-- manage task -->
      <?php if($adminUserDetails->role_type==1 || $adminUserDetails->role_type==2){ ?>
      <li class="treeview {{ Request::is('admin/task/add') ? 'active' : '' }} {{ Request::is('admin/task/details/*') ? 'active' : '' }}{{ Request::is('admin/task/edit/*') ? 'active' : '' }} {{ Request::is('admin/task/display') ? 'active' : '' }}">
        <a href="{{url('admin/task/display')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Task</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <?php } ?>
      <!-- manage task -->

      <!-- manage feedback -->
      <?php if($adminUserDetails->role_type==1){ ?>
      <li class="treeview {{ Request::is('admin/feedback/display') ? 'active' : '' }}">
        <a href="{{url('admin/feedback/display')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Feedback</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
      </li>
      <?php } ?>
      <!-- manage feedback -->

      <!-- Manage Content Based Pages -->
      <?php if($adminUserDetails->role_type==1){ ?>
      <li class="treeview {{ Request::is('admin/content/termsofuse') ? 'active' : '' }} {{ Request::is('admin/content/privacypolicy') ? 'active' : '' }} {{ Request::is('admin/content/help') ? 'active' : '' }}">
        <a href="{{url('#')}}">
          <i class="fa fa-picture-o"></i> <span>Manage Content Based Pages</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="treeview {{ Request::is('admin/content/termsofuse') ? 'active' : '' }} ">
              <a href="{{url('admin/content/termsofuse')}}">
                  <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Terms Of Use </span>
              </a>
          </li>
          <li class="treeview {{ Request::is('admin/content/privacypolicy') ? 'active' : '' }} ">
            <a href="{{url('admin/content/privacypolicy')}}">
                <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Privacy Policy </span>
            </a>
          </li>
          <li class="treeview {{ Request::is('admin/content/help') ? 'active' : '' }} ">
            <a href="{{url('admin/content/help')}}">
                <i class="fa fa-circle-o" aria-hidden="true"></i> <span> Help </span>
            </a>
          </li>
        </ul>
      </li>
      <?php } ?>
      <!-- Manage Content Based Pages -->

      

    
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
