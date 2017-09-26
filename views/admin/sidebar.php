        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="hidden-md hidden-lg user-pro"> <a href="javascript:void(0);" class=waves-effect><span class="hide-menu">  <img src="<?php echo get_user_avatar_link($user->ID) ?>" alt="user-img" width="36" class="img-circle"><b><?php echo $user->display_name ?></b> <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo get_logout_url(current_url()) ?>"><i class="fa fa-power-off"></i> Đăng xuất</a></li>
                        </ul>
                    </li>

                    <li> <a href="<?php echo get_admin_url() ?>" class="waves-effect <?php if($action == 'admin-index') echo 'active'; ?>"><i class="fa fa-dashboard"></i><span class="hide-menu"> Quản trị</span></a>
                    </li>
                    <?php

                    if(is_array($list_post_type)){
                        foreach ($list_post_type as $key => $post_type){ ?>
                        <li> 
                            <a href="javascript:void(0);" class="waves-effect <?php if(strpos($action, $post_type[1]) !== false) echo 'active'; ?>"><i class="ti-write"></i> <span class="hide-menu"> <?php echo $post_type[0] ?><span class="fa arrow"></span></span></a>
                            <ul class="nav nav-second-level">
                                <li> <a href="<?php echo get_web_url() ?>/admin/post/<?php echo $post_type[1] ?>/list">Danh sách <?php echo strtolower($post_type[0]) ?></a> </li>
                                <li> <a href="<?php echo get_web_url() ?>/admin/post/<?php echo $post_type[1] ?>/add-new">Thêm <?php echo strtolower($post_type[0]) ?> mới</a> </li>
                                <li> <a href="<?php echo get_web_url() ?>/admin/post/<?php echo $post_type[1] ?>/edit-category">Danh mục <?php echo strtolower($post_type[0]) ?></a> </li>
                            </ul>
                        </li>
                        <?php }
                    } ?>
                    
                    <li> <a href="javascript:void(0);" class="waves-effect <?php if(strpos($action, 'print') !== false) echo 'active'; ?>"><i class="ti-layout-grid4"></i> <span class="hide-menu"> Mạch in<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo get_web_url() ?>/admin/print-curcuit/list">Danh sách mạch in</a> </li>
                            <li> <a href="<?php echo get_web_url() ?>/admin/print-curcuit/add-new">Thêm mạch in mới</a> </li>
                            <li> <a href="<?php echo get_web_url() ?>/admin/print-curcuit/properties">Thuộc tính mạch in</a> </li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect <?php if(strpos($action, 'order') !== false) echo 'active'; ?>"><i class="fa fa-shopping-cart"></i> <span class="hide-menu"> Đơn hàng<span class="fa arrow"></span></span><span id="order_to_check" class="label label-rouded label-danger pull-right">0</span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo get_web_url() ?>/admin/order/list">Danh sách đơn hàng</a> </li>
                            <li> <a href="<?php echo get_web_url() ?>/admin/order/add-new">Thêm đơn hàng</a> </li>
                        </ul>
                    </li>
                    <?php if(is_admin()){ ?>
                    <li><a href="javascript:void(0)" class="waves-effect <?php if(strpos($action, 'user') !== false) echo 'active'; ?>"><i class="fa fa-user"></i><span class="hide-menu"> Tài khoản <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo get_web_url() ?>/admin/user/list">Danh sách tài khoản</a></li>
                            <li><a href="<?php echo get_web_url() ?>/admin/user/add-new">Thêm tài khoản</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0)" class="waves-effect <?php if(strpos($action, 'theme') !== false) echo 'active'; ?>"><i class="ti-palette"></i><span class="hide-menu"> Giao diện <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo get_web_url() ?>/admin/edit-menu">Menu</a></li>
                            <li><a href="<?php echo get_web_url() ?>/admin/setting/index-option">Trang chủ</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0)" class="waves-effect <?php if(strpos($action, 'setting') !== false) echo 'active'; ?>"><i class="fa fa-cog"></i><span class="hide-menu"> Cài đặt <span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="<?php echo get_web_url() ?>/admin/setting/post-type">Các loại bài đăng</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>