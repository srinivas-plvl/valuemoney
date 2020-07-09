
<style>
#fade-menu {
    font-size: 14px;
    font-weight: 100;
}
.bg_switch {
display:none;
}
.navbar-fixed-top {
    top: 64px;
}
.navbar-fixed-top, .navbar-fixed-bottom {
    left: 0;
    margin-bottom: 0;
    position: absolute;
    right: 0;
    z-index: 1030;
}
.navbar .top-search input {
display:none;
}
#fade-menu ul li.selected {
    background-color: #303434;
}
.select{
    background-color: #303434;
}
</style>

 <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<header>
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="main-logo"><a href="<?php echo base_url()?>welcome/number">Admin</div>
				</div>
				<div  class="floatright">
					Welcome, Admin (<?php echo date("d/m/y")." " ?><span id="clock"></span>)
					<br/>
					<a href="<?php echo base_url();?>welcome/logout" class="floatright">Logout</a>
				</div>
		   </div>
		</div>
	</header>
<div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="pull-right top-search">
                            <form action="" >
                                <input type="text" name="q" id="q-main">
                                
                            </form>
                        </div>
                        <div id="fade-menu" class="pull-left">
                            <ul class="clearfix" id="mobile-nav">
                                 <li  <?php if($page=="number") echo "class=selected"; ?>><a href="<?php echo base_url(); ?>welcome/number">Number Category</a>
								 <li <?php if($page=="news") echo "class=selected"; ?>><a href="<?php echo base_url(); ?>welcome/news">News Letter</a>                              
							  <li>
                                    <a <?php if($page=="accounts") echo "class=select"; ?> >Accounts</a>
                                 <ul>
                                        <li>
                                             <a href="<?php echo base_url();?>welcome/users">Users</a>
                                        </li>
                                        <li>
										<a href="<?php echo base_url(); ?>welcome/accounts">Payments/Receipts</a>
                                           
                                        </li>
                                    </ul> 
                                </li>
                                
                                  
                            </ul>
                        </div>
                    </div>
                </div>
</div>
