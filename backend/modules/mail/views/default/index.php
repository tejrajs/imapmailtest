<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\modules\mail\components\Mail;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';

//$mailbox = yii::$app->imap->connection;
$mail = new Mail();
$mailIds  = $oMail->sortMails();
$start_page = (($page * 10) - 10);
$end_page = $page * 10;
$i= 0;
?>
<div class="mail-default-index">
	<div class="alert alert-success" role="alert" id="alertmessage" style="display: none"></div>
	<?php $form = ActiveForm::begin(['id' => 'form-mail']); ?>
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <a href="#" class="btn btn-danger btn-sm btn-block" role="button"><i class="glyphicon glyphicon-edit"></i> Compose</a>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Split button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">
                    <div class="checkbox" style="margin: 0;">
                        <label>
                            <input type="checkbox" id="SelectAll">
                        </label>
                    </div>
                </button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" id="checkAll">All</a></li>
                    <li><a href="#" id="checkNone">None</a></li>
                    <li><a href="#" id="checkReaded">Read</a></li>
                    <li><a href="#" id="checkUnread">Unread</a></li>
                    <li><a href="#" id="checkImportant">Important</a></li>
                </ul>
            </div>
            <button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" id="RefreshMail">
                &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-refresh"></span>&nbsp;&nbsp;&nbsp;</button>
            <!-- Single button -->
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    More <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#" id="MarkAllRead">Mark all as read</a></li>
                    <li><a href="#" id="MarkAllUnRead">Mark all as Un-read</a></li>
                    <li><a href="#" id="MarkAllImportant">Marks As Important</a></li>
                    <li><a href="#" id="MarkAllDelete">Delete Selected</a></li>
                    <li class="divider"></li>
                    <li class="text-center"><small class="text-muted">Select messages</small></li>
                </ul>
            </div>
            <div class="pull-right">
                <span class="text-muted"><b><?= $start_page?></b> - to - <b> <?= $end_page?></b> of <b><?=$totalMials?></b></span>
                <div class="btn-group btn-group-sm">
                	<?= Html::a('<span class="glyphicon glyphicon-chevron-left"></span>',['/mail/default/index','page'=> $page-1],['class'=> 'btn btn-default'])?>
                    <?= Html::a('<span class="glyphicon glyphicon-chevron-right"></span>',['/mail/default/index','page'=> $page+1],['class'=> 'btn btn-default'])?>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <ul class="nav nav-pills nav-stacked">
            	<?php     	
            		$mailFolders 	= $mail->getListingFolders();
            	?>
            	<?php foreach ($mailFolders as $folder):?>
            	<?php 
            		$nMail = new Mail($folder);
            		$count = $nMail->countMails();
            		$foldername = '';
            		if(strpos($folder,'/')){
            			$data = explode('/', $folder);
            			$foldername = $data[1];
            		}elseif(strpos($folder,'}')){
            			$data = explode('}', $folder);
            			$foldername = $data[1];
            		}else{
            			$foldername = $folder;
            		}
            	?>
                <li class="<?= $type==$folder?'active':''?>">
                	<?= Html::a(Html::tag('span',$count,['class'=> 'badge pull-right']).' '.ucwords($foldername),['/mail/default/index','type' => $folder])?>
                </li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                	<a href="#home" data-toggle="tab">
                		<span class="glyphicon glyphicon-inbox"></span>Primary
                	</a>
                </li>
                <li>
                	<a href="#settings" data-toggle="tab">
                		<span class="glyphicon glyphicon-plus no-margin"></span>
                	</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class="list-group">
                    <?php Pjax::begin(['id' => 'container']) ?>
                    <?php 
      
				      
				      foreach ($mailIds as $mailId){
				      	if($i >= $start_page &&  $i < $end_page){
				      		$email = $oMail->getMailsInfo([$mailId]);
				      ?>
				      <?php 
				      	$class = '';
				      	$classes = '';
				      	if($email[0]->seen == 0){
				      		$class = 'read';
				      		$classes .= 'unread';
				      	}else{
				      		$classes = 'readed';
				      	}/*elseif ($email[0]->deleted == 1){
				      		$class = 'danger';
				      	}*/
				      	if ($email[0]->flagged == 1){
				      		$classes .= ' important';
				      	}
				    ?>
				    <?php 
				    
				    $fromMail = $email[0]->from;
				    $mailSubject = $email[0]->subject;
				    $dateTime =  date('D d M Y',strtotime($email[0]->date));
?>
					<div class="list-group-item <?= $class?>">
						<div class="checkbox">
                      		<label><input type="checkbox" name="mail[]" value="<?= $mailId?>" class="checkboxes <?= $classes?>"></label>
                   		</div>
					<?php 
					if($email[0]->flagged == 1){
						echo Html::a(Html::tag('span','',['class'=> 'glyphicon glyphicon-star']),['#']);
					}else{
						echo Html::a(Html::tag('span','',['class'=> 'glyphicon glyphicon-star-empty']),['/mail/mail/important','id' => $mailId]);
					}
					?>
					
<?php
    $html = <<<EOF
                    <span class="name" style="width: 150px;display: inline-block;"><b>{$fromMail}</b></span>
                    <span class="subject" style="display: inline-block;"><b>{$mailSubject}</b></span>     
					<span class="text-muted" style="font-size: 11px;">- More content here</span>               
EOF;
?>
    					<span class="badge"><?= $dateTime?></span>
                    	<?= Html::a($html,['/mail/mail/show','id'=> $mailId])?>	
                    	<span class="pull-right">
                       		<span class="glyphicon glyphicon-paperclip"></span>
                    	</span>
                    </div>	
                   	<?php }	$i++; ?>   
					<?php } ?>   
					<?php Pjax::end() ?>          
                    </div>
                </div>
                <div class="tab-pane fade in" id="settings">
                    This tab is empty.
                </div>
            </div>
            <?= LinkPager::widget([
			 		'pagination' => $pagination,
			 ]); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
</div>
<?php 
$ajaxUrlAllRead = Url::to(['/mail/mail/read']);
$ajaxUrlAllUnRead = Url::to(['/mail/mail/un-read']);
$ajaxUrlAllImportant = Url::to(['/mail/mail/importants']);
$ajaxUrlAllDelete = Url::to(['/mail/mail/delete-all']);
$jsScript = <<<EOF
$("#MarkAllRead").click(function(){
		var form = $('#form-mail').serialize();
		
		$.ajax({
          	url: "{$ajaxUrlAllRead}",
            method: "POST",
			dataType: "json",
            data:form,
				beforeSend: function() {    
					$("#alertmessage").show();
	            	$("#alertmessage").html('Loading..........');
	            },
	            success: function(e) {	
					if(e.sucess == 1){	         
					 	$("#alertmessage").html(e.msg);
					 	$.pjax.reload({container:"#container"});
					}else{
						$("#alertmessage").html(e.error);
					}	
	            }
        });
});
$("#MarkAllUnRead").click(function(){
		var form = $('#form-mail').serialize();		
		$.ajax({
          	url: "{$ajaxUrlAllUnRead}",
            method: "POST",
			dataType: "json",
            data:form,
				beforeSend: function() {    
					$("#alertmessage").show();
	            	$("#alertmessage").html('Loading..........');
	            },
	            success: function(e) {	
					if(e.sucess == 1){	         
					 	$("#alertmessage").html(e.msg);
					 	$.pjax.reload({container:"#container"});
					}else{
						$("#alertmessage").html(e.error);
					}	
	            }
        });
});
$("#MarkAllImportant").click(function(){
		var form = $('#form-mail').serialize();		
		$.ajax({
          	url: "{$ajaxUrlAllImportant}",
            method: "POST",
			dataType: "json",
            data:form,
				beforeSend: function() {    
					$("#alertmessage").show();
	            	$("#alertmessage").html('Loading..........');
	            },
	            success: function(e) {	
					if(e.sucess == 1){	         
					 	$("#alertmessage").html(e.msg);
					 	$.pjax.reload({container:"#container"});
					}else{
						$("#alertmessage").html(e.error);
					}	
	            }
        });
});
$("#MarkAllDelete").click(function(){
		var form = $('#form-mail').serialize();		
		$.ajax({
          	url: "{$ajaxUrlAllDelete}",
            method: "POST",
			dataType: "json",
            data:form,
				beforeSend: function() {    
					$("#alertmessage").show();
	            	$("#alertmessage").html('Loading..........');
	            },
	            success: function(e) {	
					if(e.sucess == 1){	         
					 	$("#alertmessage").html(e.msg);
                		$.pjax.reload({container:"#container"});
					}else{
						$("#alertmessage").html(e.error);
					}	
	            }
        });
});
$("#RefreshMail").click(function(){
	$.pjax.reload({container:"#container"});
});
$("#checkAll").click(function(){
	$('input[type *= checkbox]').prop('checked', true);            		
});
$("#checkNone").click(function(){
	$('input[type *= checkbox]').prop('checked', false);            		
});
$("#checkUnread").click(function(){
            		
    $('input[type *= checkbox]').prop('checked', false); 
            		      		
	$('input[class *= unread]').prop('checked', true);       
            		     		
});
$("#checkReaded").click(function(){
    $('input[type *= checkbox]').prop('checked', false); 
            		
	$('input[class *= readed]').prop('checked', true);            		
});
$("#checkImportant").click(function(){
    $('input[type *= checkbox]').prop('checked', false); 
            		
	$('input[class *= important]').prop('checked', true);            		
});
$("#SelectAll").click(function(){
    if ($("#SelectAll").prop('checked')) {
    	$('input[class *= checkboxes]').prop('checked', true);      
	}else {
   		$('input[class *= checkboxes]').prop('checked', false);      
	}      		
});
EOF;

$this->registerJs($jsScript);
?>
