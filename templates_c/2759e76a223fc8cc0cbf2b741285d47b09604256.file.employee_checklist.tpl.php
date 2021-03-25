<?php /* Smarty version Smarty-3.1.8, created on 2020-12-05 10:32:33
         compiled from "/home/time2view/public_html/cirrus/templates/layouts/employee_checklist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15929383865fcb61c13ed597-60587059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2759e76a223fc8cc0cbf2b741285d47b09604256' => 
    array (
      0 => '/home/time2view/public_html/cirrus/templates/layouts/employee_checklist.tpl',
      1 => 1551076690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15929383865fcb61c13ed597-60587059',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url_path' => 0,
    'translate' => 0,
    'privileges_general' => 0,
    'user_role' => 0,
    'all_employee_checklist' => 0,
    'checklists' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_5fcb61c148d022_19086280',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5fcb61c148d022_19086280')) {function content_5fcb61c148d022_19086280($_smarty_tpl) {?>
	<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/bootstrap.css" type="text/css" />
	 		<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/responsive.css" type="text/css" />
	        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
	        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
fonts/font-awesome/css/font-awesome.min.css">
	        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style-flat.css?1372280934" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
	        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
css/style.css" type="text/css" /><!-- CHILD THEME -->
			<style type="text/css">
			

			.help .inner .main-list.undragable li{ background: #fff !important; border: 0; border-bottom: solid thin #ddd !important; }
				.btn-help{
			    			margin: 5px;
			    			cursor: pointer;}
			    .help{ position: relative;top: 0;z-index: 9999;left: 0;right: 0;bottom: 0;/*background-color: rgba(0, 0, 0, 0.9);background: rgba(0, 0, 0, 0.9); */}
			    .help .inner{ position: relative; background: #fff;padding: 30px 20px; }
			    .help .inner .main-list .icon {  display: block; color: #63BCD1; font-size: 18px;     position: relative;

	}
			    .help .inner .main-list { margin-top: 30px !important; 
										overflow: auto;  padding-right: 15px; }
			 	.help .inner .main-list li{ border: solid thin #ddd;padding: 15px;background: #f8f8f8;margin: 15px 0;border-radius: 5px; }
										.help .inner .main-list li:last-child{ border: 0 !important; }
			    .help .inner .main-list .helpdes{  max-width: 500px;
													margin-left: 7px;
													width: 100%; position: relative; }
			    .help .inner .main-list .helpdes p{ line-height: 22px;
													font-size: 14px; }
			    .help .inner .main-list .actions{ max-width: 100px; margin-right: 20px; }
			    .help .inner .main-list .actions .btn { border-radius: 100%;
														background: #eee;
														width: 20px;
														height: 20px; border: 0;
														padding: 6px;
														margin: 0 5px 0 0;
														color: #fff; }
				.help .inner .main-list .actions .btn.delete { background: #fc4f4f; }
				.help .inner .main-list .actions .btn.edit { background: #ffbb3e; }
				.icon-close{ position: absolute;right: 0;cursor: pointer !important;top: -37px;z-index: 99999;				font-size: 25px;color: #8c8c8c;display: block; }
				.icon-close:hover{ color: #fff; }

				.dragele{  display: inline-block;float: right;opacity: 0.5;cursor: move !important; width: 30px; height: 30px; text-align: center;  position: relative;}
				.dragele > span{ position: absolute;
								background: transparent !important;
								width: 35px;
								display: block;
								height: 30px;
								top: 0; }

								.header{ position: fixed;
									top: 0;
									left: 0;
									right: 0;
									background: #fff;
									z-index: 1;
									-webkit-box-shadow: 0px -1px 4px 0px rgba(133, 129, 129, 0.75);
									-moz-box-shadow: 0px -1px 4px 0px rgba(133, 129, 129, 0.75);
									box-shadow: 0px -1px 4px 0px rgba(133, 129, 129, 0.75);
									padding: 15px; }
								.btn-checklist {
									max-width: 75px;
									max-height: 25px;
									font-size: 18px !important;
									line-height: 25px;
									background: #59a059;
									color:#fff; 
								 }


			</style>
		</head>
		<body>
			<div class="help">
				<div class="inner">
				<div class="header">
					<h4 class="pull-left"><?php echo $_smarty_tpl->tpl_vars['translate']->value['checklist_help'];?>
</h4>

					<!-- <span  class="icon-remove-circle icon pull-right icon-close" onclick="closeHelp();"></span> -->
			        <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['employee_check_list']==1&&($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['user_role']->value==7)){?>
					  <a class="btn btn-default btn-checklist btn-margin-set btn-option-panel pull-right btn-margin-lft" onclick="addNewlistItem();" style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['add'];?>
</a>
			        <?php }?>
					
			        <div class="clearfix"></div>
			        </div>
					<ul class="list-unstyled main-list" id="checklist_list">

			            <?php  $_smarty_tpl->tpl_vars['checklists'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['checklists']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['all_employee_checklist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['checklists']->key => $_smarty_tpl->tpl_vars['checklists']->value){
$_smarty_tpl->tpl_vars['checklists']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['checklists']->key;
?>
			    			<li class="clearfix" id="cheklist_<?php echo $_smarty_tpl->tpl_vars['checklists']->value['id'];?>
"  data-id = "<?php echo $_smarty_tpl->tpl_vars['checklists']->value['id'];?>
">
			    			<i class="icon-move dragele"><span></span></i>
			    				<span  class="icon-check icon pull-left"></span>
			    				<div class="helpdes pull-left">
			    					<p><span><?php echo $_smarty_tpl->tpl_vars['key']->value+1;?>
 . </span><?php echo $_smarty_tpl->tpl_vars['checklists']->value['description'];?>
</p>
			    				</div>
			                    <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['employee_check_list']==1&&($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['user_role']->value==7)){?>
			                    	<div class="actions pull-right">
			                    	   <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick="delete_check_list(this,<?php echo $_smarty_tpl->tpl_vars['checklists']->value['id'];?>
)"><span  class="icon-trash"></span></a>
			                    	   <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,<?php echo $_smarty_tpl->tpl_vars['checklists']->value['id'];?>
,'<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['checklists']->value['description'], ENT_QUOTES, 'UTF-8', true);?>
');"><span  class="icon-edit-sign"></span></a>
			                    	</div>
			                    <?php }?>
			    		    </li>
			            <?php } ?>
				
						<li class="clearfix additem-list">
							<div class=" hide">
			    				<textarea rows="3" id="checklist_description" class="form-control update-text"  style="width:95%;"></textarea>
			    				<a class="btn btn-success" onclick="addNewCkecklist()" style="margin-top: 10px; color:#fff;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</a>
			    				<a class="btn btn-danger" onclick="cancelAddnew();" style="margin-top: 10px; color:#fff;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</a>
			    			</div>
						</li>	
					</ul>
				</div>
			</div>
	 <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-1.10.1.min.js"></script><!-- JQuery -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script><!-- JQueryUI -->
    <!-- JQueryUI Touch Punch --><!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/demo/common.js"></script><!-- Common Demo Script -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/bootbox.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.droppable.js"></script>
		<script type="text/javascript">
		<?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['employee_check_list']==1&&($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['user_role']->value==7)){?>
			  $( function() {
			  	$( ".inner" ).draggable();
			    $( ".main-list" ).sortable();
			    $( ".main-list" ).disableSelection();
			  } );
			var before_sort_order = [];
			var after_sort_id     = [];
			$( ".main-list" ).sortable({
				cancel: "textarea,a",
			    // change: function(e, ui) {
			    //     before_sort_order = [];
			    //     $("#checklist_list li").not('.additem-list').each(function( index ) {

			    //       if($(this).data('sortable') != undefined){
			    //          before_sort_order.push($(this).data('sortable'));
			    //       }
			    //     });
			    // },
			    update: function( event, ui ) {
			        after_sort_id     = [];
			         $("#checklist_list li").not('.additem-list').each(function( index ) {
			          after_sort_id.push($(this).data('id'));
			        });
			        // console.log(before_sort_order,after_sort_id); 
			        dataObj = {
			            // before_sort_order : before_sort_order,
			            after_sort_id     : after_sort_id,
			            action            : 'changing_sort_order'
			        }
			        $.ajax({
			            method  : 'post',
			            url     : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/checklist/',
			            data    : dataObj,
			            success : function(data){
			                // data = JSON.parse(data);
			                // console.log(data);
			                // for (var key in data) {
			                //     $('#cheklist_'+key).attr('data-sortable',data[key]);
			                // }

			            }
			        });

			  }
			});
		<?php }else{ ?>
			$('.dragele').hide();
			$('.main-list').addClass('undragable');
		<?php }?>


		function  cancelAddnew(){

		 $('.main-list').animate({
		                    scrollTop: $(".main-list li:first-child").offset().top
		                }, 100);


		  $('.additem-list > div').addClass('hide');
		}


		function addNewlistItem(){

		 $('#checklist_description').val('');
		 $('.main-list').animate({
		                    scrollTop: $(".additem-list").offset().top
		                }, 100);


		  $('.additem-list > div').removeClass('hide');
		}



		function closeHelp(e){
		    $('.help').addClass('hide');
		}


		// function showHelp(e){
		// 	window.open('<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
ajax_employee_checklist.php',' ','width=600,height=400,top=150,left=250')
		//     // $('.help').removeClass('hide');
		// }


		function editItem(e,id,description){
			// description = description.replace(/"/g, '\\"');
				//$(e).parents('li').find('.helpdes ').css('max-width','100%');
			$(e).parents('li').find('.actions ').addClass('hide');
		    $(e).parents('li').find('.helpdes p').html();
		    $(e).parents('li').find('.helpdes').html('<textarea rows="3" class="form-control update-text" style="width:95%;">'+description+'</textarea><a class="btn btn-success"  onClick="updateListText(this,'+id+');" style="margin: 10px 5px 10px 0px; color:#fff;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['save'];?>
</a><a class="btn btn-danger" onClick="canelEdit(this);" style="margin: 10px 0; color:#fff;"><?php echo $_smarty_tpl->tpl_vars['translate']->value['cancel'];?>
</a>');
		}


		function canelEdit(e){
			var description = $(e).siblings('textarea').text();
			$(e).parents('li').find('.helpdes').html(description);
			$('.actions ').removeClass('hide');
		}

		function addNewCkecklist(){
            var dataObj = {
                checklistDescription : $('#checklist_description').val(),
                action : 'add_new_checklist'
            }
            if(dataObj.checklistDescription != ''){
                $.ajax({
                    method : 'POST',
                    url : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/checklist/',
                    data : dataObj,
                    success : function(data){
                        data = JSON.parse(data);
                        cancelAddnew();
                        var html = '<li class="clearfix" id="cheklist_'+data.cheklist_id+'"  data-id = "${ data.cheklist_id}">\n\
                                    <i class="icon-move dragele"><span></span></i>\n\
                                    <span class="icon-check icon pull-left">\n\
                                    </span>\n\
                                    <div class="helpdes pull-left">\n\
                                        <p>'+data.description+'</p>\n\
                                    </div>\n\
                                    <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['employee_check_list']==1&&($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['user_role']->value==7)){?>\n\
                                        <div class="actions pull-right">\n\
                                           <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick ="delete_check_list(this,'+data.cheklist_id+')"><span  class="icon-trash"></span></a>\n\
                                           <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,'+data.cheklist_id+',\''+data.description+'\')"><span  class="icon-edit-sign"></span></a>\n\
                                        </div>\n\
                                    <?php }?>\n\
                                </li>';
                        $('.additem-list').before(html);
                    }
                });
            }
            else{
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['checklist_description_is_mandatory'];?>
', function(result){ });
            }
        }

        function delete_check_list(e,id){
            bootbox.dialog('<?php echo $_smarty_tpl->tpl_vars['translate']->value['do_u_want_delete_checklist'];?>
', [
            {
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['no'];?>
",
                "class" : "btn-danger",
            },
            {  
                "label" : "<?php echo $_smarty_tpl->tpl_vars['translate']->value['yes'];?>
",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        method : 'post',
                        url : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/checklist/',
                        data : { 'id' : id, 'action' : 'delete_check_list'},
                        success : function(data){
                            if(data){
                                $(e).parents('li').remove();
                            }
                        }
                    });
                }
            }
            ]);
        }

        function updateListText(e,id){
            $(e).parents('li').find('.actions ').removeClass('hide');
            var description = $(e).parents('li').find('.update-text').val();
            dataObj = {
                id : id,
                description : description,
                action : 'edit_checklist'
            }
             if($.trim(description).length > 0 ){
                $.ajax({
                    method : 'post',
                    url : '<?php echo $_smarty_tpl->tpl_vars['url_path']->value;?>
employee/checklist/',
                    data : dataObj,
                    success : function(data){
                    	// console.log(data);
                        data = JSON.parse(data);
                        if(data.status === true){
                            var li_to_append = $(e).parents('li');
                            li_to_append.empty();
                            var description =  data.description;
                            var html = '<i class="icon-move dragele"><span></span></i>\n\
                            			<span  class="icon-check icon pull-left">\n\
                            			</span>\n\
                                        <div class="helpdes pull-left">\n\
                                            <p>'+data.description+'</p>\n\
                                        </div>\n\
                                        <?php if ($_smarty_tpl->tpl_vars['privileges_general']->value['employee_check_list']==1&&($_smarty_tpl->tpl_vars['user_role']->value==1||$_smarty_tpl->tpl_vars['user_role']->value==6||$_smarty_tpl->tpl_vars['user_role']->value==7)){?>\n\
                                            <div class="actions pull-right">\n\
                                               <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick ="delete_check_list(this,'+data.cheklist_id+')"><span  class="icon-trash"></span></a>\n\
                                               <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,'+data.cheklist_id+',\''+description+'\')"><span  class="icon-edit-sign"></span></a>\n\
                                            </div>\n\
                                        <?php }?>\n\
                                        ';
                            // console.log(html);
                            li_to_append.append(html);
                            $(e).parents('li').find('.helpdes ').css('max-width','450px')
                        }
                        else{
                            
                        }
                    } 
                });
            }
            else{
                bootbox.alert('<?php echo $_smarty_tpl->tpl_vars['translate']->value['checklist_description_is_mandatory'];?>
', function(result){ });
            }

            // $(e).parents('li').find('.helpdes').html('<p>'+textData+'</p>');
            // $(e).parents('li').find('.helpdes ').css('max-width','450px');
        }

		</script>
		</body>
	</html>

	 <?php }} ?>