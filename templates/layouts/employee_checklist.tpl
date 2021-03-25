
	<!DOCTYPE html>
	<html>
		<head>
			<link rel="stylesheet" href="{$url_path}css/bootstrap.css" type="text/css" />
	 		<link rel="stylesheet" href="{$url_path}css/responsive.css" type="text/css" />
	        <link rel="stylesheet" href="{$url_path}fonts/glyphicons/css/glyphicons.css" /><!-- Glyphicons Font Icons -->
	        <link rel="stylesheet" href="{$url_path}fonts/font-awesome/css/font-awesome.min.css">
	        <link rel="stylesheet" href="{$url_path}css/style-flat.css?1372280934" type="text/css" /><!-- Main Theme Stylesheet :: CSS -->
	        <link rel="stylesheet" href="{$url_path}css/style.css" type="text/css" /><!-- CHILD THEME -->
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
					<h4 class="pull-left">{$translate.checklist_help}</h4>

					<!-- <span  class="icon-remove-circle icon pull-right icon-close" onclick="closeHelp();"></span> -->
			        {if $privileges_general.employee_check_list == 1 && ($user_role == 1 || $user_role == 6 || $user_role == 7)}
					  <a class="btn btn-default btn-checklist btn-margin-set btn-option-panel pull-right btn-margin-lft" onclick="addNewlistItem();" style="text-align: center;">{$translate.add}</a>
			        {/if}
					
			        <div class="clearfix"></div>
			        </div>
					<ul class="list-unstyled main-list" id="checklist_list">

			            {foreach from = $all_employee_checklist key= key item = checklists}
			    			<li class="clearfix" id="cheklist_{$checklists.id}"  data-id = "{$checklists.id}">
			    			<i class="icon-move dragele"><span></span></i>
			    				<span  class="icon-check icon pull-left"></span>
			    				<div class="helpdes pull-left">
			    					<p><span>{$key+1} . </span>{$checklists.description}</p>
			    				</div>
			                    {if $privileges_general.employee_check_list == 1 && ($user_role == 1 || $user_role == 6 || $user_role == 7)}
			                    	<div class="actions pull-right">
			                    	   <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick="delete_check_list(this,{$checklists.id})"><span  class="icon-trash"></span></a>
			                    	   <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,{$checklists.id},'{$checklists.description|escape:'html'}');"><span  class="icon-edit-sign"></span></a>
			                    	</div>
			                    {/if}
			    		    </li>
			            {/foreach}
				
						<li class="clearfix additem-list">
							<div class=" hide">
			    				<textarea rows="3" id="checklist_description" class="form-control update-text"  style="width:95%;"></textarea>
			    				<a class="btn btn-success" onclick="addNewCkecklist()" style="margin-top: 10px; color:#fff;">{$translate.save}</a>
			    				<a class="btn btn-danger" onclick="cancelAddnew();" style="margin-top: 10px; color:#fff;">{$translate.cancel}</a>
			    			</div>
						</li>	
					</ul>
				</div>
			</div>
	 <script src="{$url_path}js/jquery-1.10.1.min.js"></script><!-- JQuery -->
    <script src="{$url_path}js/jquery-migrate-1.2.1.min.js"></script>
    <script src="{$url_path}js/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js"></script><!-- JQueryUI -->
    <!-- JQueryUI Touch Punch --><!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
    <script src="{$url_path}js/bootstrap.min.js"></script><!-- Bootstrap -->
    <script src="{$url_path}js/demo/common.js"></script><!-- Common Demo Script -->
    <script type="text/javascript" src="{$url_path}js/bootbox.js"></script>
    <script src="{$url_path}js/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js"></script><!-- Uniform Forms Plugin -->
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="{$url_path}js/plugins/system/jquery-ui/development-bundle/ui/jquery.ui.droppable.js"></script>
		<script type="text/javascript">
		{if $privileges_general.employee_check_list == 1 && ($user_role == 1 || $user_role == 6 || $user_role == 7)}
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
			            url     : '{$url_path}employee/checklist/',
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
		{else}
			$('.dragele').hide();
			$('.main-list').addClass('undragable');
		{/if}


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
		// 	window.open('{$url_path}ajax_employee_checklist.php',' ','width=600,height=400,top=150,left=250')
		//     // $('.help').removeClass('hide');
		// }


		function editItem(e,id,description){
			// description = description.replace(/"/g, '\\"');
				//$(e).parents('li').find('.helpdes ').css('max-width','100%');
			$(e).parents('li').find('.actions ').addClass('hide');
		    $(e).parents('li').find('.helpdes p').html();
		    $(e).parents('li').find('.helpdes').html('<textarea rows="3" class="form-control update-text" style="width:95%;">'+description+'</textarea><a class="btn btn-success"  onClick="updateListText(this,'+id+');" style="margin: 10px 5px 10px 0px; color:#fff;">{$translate.save}</a><a class="btn btn-danger" onClick="canelEdit(this);" style="margin: 10px 0; color:#fff;">{$translate.cancel}</a>');
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
                    url : '{$url_path}employee/checklist/',
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
                                    {if $privileges_general.employee_check_list == 1 && ($user_role == 1 || $user_role == 6 || $user_role == 7)}\n\
                                        <div class="actions pull-right">\n\
                                           <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick ="delete_check_list(this,'+data.cheklist_id+')"><span  class="icon-trash"></span></a>\n\
                                           <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,'+data.cheklist_id+',\''+data.description+'\')"><span  class="icon-edit-sign"></span></a>\n\
                                        </div>\n\
                                    {/if}\n\
                                </li>';
                        $('.additem-list').before(html);
                    }
                });
            }
            else{
                bootbox.alert('{$translate.checklist_description_is_mandatory}', function(result){ });
            }
        }

        function delete_check_list(e,id){
            bootbox.dialog('{$translate.do_u_want_delete_checklist}', [
            {
                "label" : "{$translate.no}",
                "class" : "btn-danger",
            },
            {  
                "label" : "{$translate.yes}",
                "class" : "btn-success",
                "callback": function() {
                    $.ajax({
                        method : 'post',
                        url : '{$url_path}employee/checklist/',
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
                    url : '{$url_path}employee/checklist/',
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
                                        {if $privileges_general.employee_check_list == 1 && ($user_role == 1 || $user_role == 6 || $user_role == 7)}\n\
                                            <div class="actions pull-right">\n\
                                               <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft delete" onclick ="delete_check_list(this,'+data.cheklist_id+')"><span  class="icon-trash"></span></a>\n\
                                               <a class="btn btn-default btn-margin-set btn-option-panel pull-right btn-margin-lft edit" onclick="editItem(this,'+data.cheklist_id+',\''+description+'\')"><span  class="icon-edit-sign"></span></a>\n\
                                            </div>\n\
                                        {/if}\n\
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
                bootbox.alert('{$translate.checklist_description_is_mandatory}', function(result){ });
            }

            // $(e).parents('li').find('.helpdes').html('<p>'+textData+'</p>');
            // $(e).parents('li').find('.helpdes ').css('max-width','450px');
        }

		</script>
		</body>
	</html>

	 