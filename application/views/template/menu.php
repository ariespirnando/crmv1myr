<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">

        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url().'assets/' ?>assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="<?php echo base_url() ?>" class="nav-link">CRM SIK </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories" id="accordionExample">
        <?php 
            $role = base64_decode($this->session->userdata('role_ses'));  ##Baca aja Sesionya
            if($role != ""){ 
                    switch ($role) {
                        case "U-ADMIN":
                            $this->view('template/role/admin.php');
                            break;  
                        default:
                            $this->view('template/role/cs.php');
                    } 
            }else{
                $roles = base64_decode($this->session->userdata('guid_ConsigneSes'));
                if($roles != ""){
                    $this->view('template/role/consignee.php');
                }
            }
        ?>            
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->