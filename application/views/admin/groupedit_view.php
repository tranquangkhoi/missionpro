	<?php echo $header; ?>	
    <script src="/tinyeditor/tinymce/tinymce.min.js"></script>
	<script language="javascript" type="text/javascript">
	
	function checkAllGroupItem(groupID,obj){
				var objValue =  obj.value;
				if(!isNaN(groupID)){
					if(objValue != "0"){
						for(var i=0;i<groupadd.elements.length;i++){
							if((groupadd.elements[i].type == "checkbox") && (groupadd.elements[i].id == groupID)){
								groupadd.elements[i].checked = true;
							}
						}
						obj.value = "0";
					}
					else{
						for(var i=0;i<groupadd.elements.length;i++){
							if((groupadd.elements[i].type == "checkbox") && (groupadd.elements[i].id == groupID)){
								groupadd.elements[i].checked = false;
							}
						}
						obj.value = "1";
					}
				}
			}
	
	</script>

    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin Menubar-->
      <?php echo $menubar; ?>
      <!-- End Menubar-->
      
      <!-- Begin Path -->
      <div id="breadcrumb"  class="container" style="padding-top:70px;">
          <ul class="breadcrumb">
            <li>
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/welcome">Home</a>
            </li>
            <li>
              <a href="#">Hệ thống</a>
            </li>
            <li class="active">
              <a href="<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>">Phân quyền quản trị</a>
            </li>            
            <li class="active">
              <a href="#">Cập nhật nhóm quyền quản trị</a>
            </li>
          </ul>
      </div>      
      <!-- End Path -->
     
      <!-- Begin page content -->
      <div id="main" class="container">
      		<div class="row">  			
                <div class="col-md-12">
                    <div class="btn-toolbar pull-right btn-group" style="margin-bottom:10px; margin-top:-10px;">        	
                        <a class="btn btn-primary" href="javascript:frm_submit('groupadd');"><span class="glyphicon glyphicon-floppy-disk"></span> Ghi lại</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>/add"><span class="glyphicon glyphicon-plus"></span> Thêm</a>
                        <a class="btn btn-primary" href="<?php echo base_url().$this->config->item('index_page_add').'admin/'.$this->uri->segment(2);?>">Thoát <span class="glyphicon glyphicon-arrow-right"></span></a>					 					
                    </div>
                </div>
            </div>           
            <div class="panel panel-default">          
			<div class="panel-heading"><strong style="font-size:16px;">Cập nhật thông tin</strong></div>
			<div class="panel-body">
            	<form name="groupadd" id="groupadd" class="form-horizontal" action='<?php echo base_url().$this->config->item('index_page_add');?>admin/<?php echo $this->uri->segment(2);?>/edit/<?php echo $f_group['group_id'];?>' method="POST" role="form">
				<h3>1. Thông tin chung về nhóm</h3>
				<?php if(!empty($msg)){?>
					<div class="alert alert-danger alert-dismissable"  style="margin-top:-10px;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<font color="#FF0000"><?php echo $msg;?></font>
					</div>
				<?php
				}
				?>
                
                <div class="form-group">
					<label for="group_name" class="col-sm-4 control-label">Tên Nhóm:</label>
					<div class="col-sm-5">                            	
						<input type="text" class="form-control" id="group_name" name="group_name" placeholder="Nhập tên nhóm quyền quản trị" maxlength="128" value="<?php echo $f_group['group_name'];?>">
					</div>
				</div>
                <div class="form-group">
					<label for="group_description" class="col-sm-4 control-label">Mô tả:</label>
					<div class="col-sm-5">                            	
						 <textarea class="span6" id="group_description" name="group_description" rows="3"><?php echo $f_group['group_description'];?></textarea>
                         <?php
							echo $f_group['text_area_desc'];
						?>
					</div>
				</div>
                <div class="form-group">
					<label for="group_level" class="col-sm-4 control-label">Mức quyền:</label>
					<div class="col-sm-5">                            	
						<input type="text" class="form-control" id="group_level" name="group_level" placeholder="Nhập mức quyền quản trị" maxlength="128" value="<?php echo $f_group['group_level'];?>">
					</div>
				</div>
                
                 <div class="form-group">
					<label for="group_level" class="col-sm-4 control-label">Active:</label>
					<div class="col-sm-5">                            	
						<input type="checkbox" id="group_active" name="group_active" <?php echo $f_group['check_group_active'];?>>
					</div>
				</div>              
                <h3>2. Thông tin phân quyền cho nhóm</h3>
                <table class="table table-bordered table-hover">
                                                            <tbody>
                                                              <tr>
                                                                <th class="center" width="35%">Nhóm quyền </td>
                                                                <th class="center" width="14%" >Thêm</td>
                                                                <th class="center" width="13%">Sửa </td>
                                                                <th class="center" width="11%">Xóa </td>
                                                                <th class="center" width="13%">Xem</td>
                                                                <th class="center" width="14%">Duyệt</td>
                                                              </tr>
															 <?php															 
                                                             for($i=1; $i<=count($frame_arr); $i++){	
                                                                $check1 = in_array($frame_arr[$i]['frame_code']."add", $grant_arr) ? 'checked' : '';
                                                                $check2 = in_array($frame_arr[$i]['frame_code']."edit", $grant_arr)? 'checked' : '';
                                                                $check3 = in_array($frame_arr[$i]['frame_code']."del", $grant_arr) ? 'checked' : '';
                                                                $check4 = in_array($frame_arr[$i]['frame_code'], $grant_arr) 	   ? 'checked' : '';
                                                                $check5 = in_array($frame_arr[$i]['frame_code']."app", $grant_arr) ? 'checked' : '';		
                                                                $tt = $i;
                                                                $frame_code = $frame_arr[$i]['frame_code'];
																$frame_name = $frame_arr[$i]['frame_name'];                                                            
															?>
                                                              <tr>
                                                                <td>
                                                                  <input type="hidden" value="1" name="<?php echo $frame_code."1";?>">                                                                  
																  <a title="Đánh dấu hết" href="javascript:checkAllGroupItem(<?php echo $tt;?>,document.groupadd.<?php echo $frame_code;?>1)"><?php echo $frame_name;?></a>
																</td>
                                                                <td class="center" >
																	<input id="<?php echo $tt;?>" type="checkbox"  name="<?php echo $frame_code;?>11" <?php echo $check1;?> />
																</td>
																<td class="center" >
																	<input id="<?php echo $tt;?>" type="checkbox"  name="<?php echo $frame_code;?>12" <?php echo $check2;?> />
																</td>
																<td class="center" >
																	<input id="<?php echo $tt;?>" type="checkbox"  name="<?php echo $frame_code;?>13" <?php echo $check3;?> />
																</td>
																<td class="center" >
																	<input id="<?php echo $tt;?>" type="checkbox"  name="<?php echo $frame_code;?>14" <?php echo $check4;?> />
																</td class="center" >
																<td class="center" >
                                                                	<input id="<?php echo $tt;?>" type="checkbox"  name="<?php echo $frame_code;?>15" <?php echo $check5;?> />
                                                                </td>
                                                              </tr>                                                              
															 <?php
															 }
															 ?> 
                                                            </tbody>
                                                          </table>
                                                          <input name="id" type="hidden" id="id" value="<?php echo $f_group['group_id'];?>" />
                </form>
          	</div>
        </div>
        
      </div>
      <div id="push"></div>
    </div>
    <!-- End page Content-->

    <!-- Begin Footer -->
    <?php echo $footer; ?>
	<!-- End Footer -->