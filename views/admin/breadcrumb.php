                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title ?></h4>
                    </div>
                    <?php if($page_title != 'Trang quản trị'){ ?>
                    <div class="col-lg-9 col-md-8">
                        <ul class="breadcrumb pull-right">
                            <li><a href="<?php echo get_admin_url() ?>">Quản trị</a></li>
                            <li class="active"><?php echo $page_title ?></li>
                        </ul>
                    </div>
                    <?php } ?>
                    <!-- /.col-lg-12 -->
                </div>