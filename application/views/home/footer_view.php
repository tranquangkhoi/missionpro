<div class="fs-callfix hidden-sm-down">
    <label>
        <a href="tel:0916510289" title="">
            <span></span>
            <p>Hotline : </p>
            <p><strong>091 65 10 289</strong></p>
        </a>
        <i></i>
    </label>
</div>
<script>
$(document).ready(function() {
    $('.fs-callfix i').click(function () {
      $('.fs-callfix').hide();
    });
});
</script>
<footer id="footer" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="footer">
    <div class="container">
      <section class="footer-up hidden-xs-down">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 hidden-xs-down footer-vertical">
            <h5><?php echo $name_one;?></h5>
            <?php
                foreach($info_one as $item){
            ?>
            <li><a href='<?php echo base_url().$this->config->item('index_page_add');?>gioi-thieu/<?php echo $item['intro_slug'].'.html';?>'><?php echo $item['intro_title'];?></a></li>
            <?php
                }
            ?>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 hidden-xs-down footer-vertical">
            <h5><?php echo $name_two;?></h5>
            <?php
                foreach($info_two as $item){
            ?>
            <li><a href='<?php echo base_url().$this->config->item('index_page_add');?>chinh-sach/<?php echo $item['intro_slug'].'.html';?>'><?php echo $item['intro_title'];?></a></li>
            <?php
                }
            ?>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 hidden-xs-down footer-vertical">
            <h5>Kết nối</h5>
            <ul>
                <li>
                    <a href="//www.facebook.com/dongho12hcom">
                        <img src="<?php echo base_url();?>public/home/images/fb.png" />
                    </a>
                </li>
                <li>
                    <a href="//www.facebook.com/dongho12hcom">
                        <img src="<?php echo base_url();?>public/home/images/google.png" />
                    </a>
                </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 hidden-xs-down footer-vertical facebook-widget">
            <h5>Liên hệ</h5>
            <ul>
                <li><strong><?php echo $company->company_name;?></strong></li>
                <li>
                    <?php echo $company->company_address;?> 
                </li>
                <li>
                    Email: <a href="#"><?php echo $company->company_email;?></a>
                </li>
                <li>
                    <h4 class="lead">
                        Hotline: <span> <?php echo $company->company_hotline;?></span>
                    </h4>
                </li>
            </ul>
          </div>
        </div>
      </section>
      <section class="footer-up">
        <div class="col-xs-12 hidden-sm-up">
          <div id="toogle_click" class="widget-item panel">
            <h5 class="widget-title" data-toggle="collapse" data-parent="#accordion" >Liên hệ<i class="fa fa-angle-right " aria-hidden="true"></i></h5>
            <ul class="widget-menu panel-collapse collapse in" id="collapseThree">
                 <li><strong><?php echo $company->company_name;?></strong></li>
                <li>
                    <?php echo $company->company_address;?> 
                </li>
                <li>
                    Email: <a href="#"><?php echo $company->company_email;?></a>
                </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 hidden-sm-up">
          <div id="toogle_click" class="widget-item panel">
            <h5 class="widget-title" data-toggle="collapse" data-parent="#accordion" ><?php echo $name_one;?><i class="fa fa-angle-down " aria-hidden="true"></i></h5>
            <ul class="widget-menu panel-collapse collapse" id="collapseOne">
             <?php
                foreach($info_one as $item){
            ?>
            <li><a href='<?php echo base_url().$this->config->item('index_page_add');?>gioi-thieu/<?php echo $item['intro_slug'].'.html';?>'><?php echo $item['intro_title'];?></a></li>
            <?php
                }
            ?>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 hidden-sm-up">
          <div id="toogle_click" class="widget-item panel">
            <h5 class="widget-title" data-toggle="collapse" data-parent="#accordion" ><?php echo $name_two;?><i class="fa fa-angle-right " aria-hidden="true"></i></h5>
            <ul class="widget-menu panel-collapse collapse" id="collapseTwo">
             <?php
                foreach($info_two as $item){
             ?>
            <li><a href='<?php echo base_url().$this->config->item('index_page_add');?>chinh-sach/<?php echo $item['intro_slug'].'.html';?>'><?php echo $item['intro_title'];?></a></li>
            <?php
                }
            ?>
            </ul>
          </div>
        </div>
        <div class="col-xs-12 hidden-sm-up">
          <div id="toogle_click" class="widget-item panel">
            <h5 class="widget-title" data-toggle="collapse" data-parent="#accordion" >Kết nối<i class="fa fa-angle-right " aria-hidden="true"></i></h5>
            <ul class="widget-menu panel-collapse collapse" id="collapseThree">
                <li>
                    <a href="//www.facebook.com/dongho12hcom">
                        <img src="<?php echo base_url();?>public/home/images/fb.png" />
                    </a>
                </li>
                <li>
                    <a href="//www.facebook.com/dongho12hcom">
                        <img src="<?php echo base_url();?>public/home/images/google.png" />
                    </a>
                </li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  </div>
  <div class="ft-bottom">
    <div class="container ft">
      <div class="row">
        <div class="col-lg-12 col-xs-12 copyright">
          <p>© Bản quyền thuộc về <b style="color:#fff;">bedota.com</b></p>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src='<?php echo base_url();?>public/home/js/common.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/jquery.flexslider.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/cloud-zoom.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/jquery.magnific-popup.min.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/js_custome.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/jgrowl.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/bootstrap.min.js' type='text/javascript'></script>
<script src='<?php echo base_url();?>public/home/js/owl.carousel.min.js' type='text/javascript'></script>
<script src="<?php echo base_url();?>public/home/js/bootstrap.min.js"></script>
<script src='<?php echo base_url();?>public/home/js/custom.js' type='text/javascript'></script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span></a>
</body>
</html>