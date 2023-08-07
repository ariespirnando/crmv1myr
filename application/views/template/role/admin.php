
<li class="menu <?php echo ($modul=="dashboard")?"active":"" ?>">
    <a href="apps_calendar.html" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
        <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        <span>Dashboard</span>
        </div>
    </a>
</li>

<li class="menu <?php echo ($modul=="masterpengguna")?"active":"" ?>">
    <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
        <span>Data</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">  

        <li>
            <a href="<?php echo base_url().'consigne' ?>"> Consignee </a>
        </li> 

        <li>
            <a href="<?php echo base_url().'produk' ?>"> Produk  </a>
        </li>

        <li>
            <a href="<?php echo base_url().'konsiyasi' ?>"> Konsinyasi  </a>
        </li>

        <li>
            <a href="<?php echo base_url().'laporan' ?>"> Laporan  </a>
        </li>
            
    </ul>
</li>
  
<li class="menu <?php echo ($modul=="masterpengguna2")?"active":"" ?>">
    <a href="#components2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg><span>Management Pengguna</span>
        </div>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </div>
    </a>
    <ul class="collapse submenu list-unstyled" id="components2" data-parent="#accordionExample">
        <li>
            <a href="<?php echo base_url().'karyawan' ?>"> Pengguna </a>
        </li>  
    </ul>
</li>
 
 



    