<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script>
 tinymce.init({
   selector: 'textarea#editor',  //Change this value according to your HTML
   auto_focus: 'element1',
   width: "700",
   height: "200"
 }); 
 
 </script>
<div class="breadcrumb">
  <div class="breadcrumb_wrapper">
    <div class="breadcrumb-top"><?php echo Yii::t('app', 'Add New Offer Letter Template'); ?></div>
    <div class="breadcrumb-bottom breadcrumb-bottom-people">
      <div class="title">
        <span><?php echo Yii::t('app', 'Add a new offer letter template'); ?></span>
      </div>
    </div>
  </div>
</div>
<div class="common_content_wrapper admin_login_log_list">
  <div class="common_content_inner_wrapper">
    <h4 class="widget_title"><?php //echo Yii::t('app', 'Add a new offer letter template'); ?>
    </h4>
    <form method="post" enctype="multipart/form-data" id="createOfferLetterForm" name="createOfferLetterForm" action="<?php echo $this->createUrl('registration/saveOfferLetterTemplate') ?>" >
    	<table style="line-height: 32px;padding-left: 10px;font-size: 15px;">
    		<tr>
    			<td><?php echo Yii::t('app', 'Offer Letter Title'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="offerLetterTitle"/>
    			</td>
    		</tr>
    		<tr>
    			<td><?php echo Yii::t('app', 'Description'); ?> </td>
    			<td>:</td>
    			<td>
    				<input type="text" name="offerLetterDescription"/>
    			</td>
    		</tr>
    		<tr>
	    		<textarea id="basic-example">
					  <p style="text-align: center;">
					    <img title="TinyMCE Logo" src="//www.tiny.cloud/images/glyph-tinymce@2x.png" alt="TinyMCE Logo" width="110" height="97" />
					  </p>

					  <h2 style="text-align: center;">Welcome to the TinyMCE editor demo!</h2>

					  <h2>Got questions or need help?</h2>

					  <ul>
					    <li>Our <a href="https://www.tiny.cloud/docs/">documentation</a> is a great resource for learning how to configure TinyMCE.</li>
					    <li>Have a specific question? Visit the <a href="https://community.tiny.cloud/forum/" target="_blank">Community Forum</a>.</li>
					    <li>We also offer enterprise grade support as part of <a href="https://www.tiny.cloud/pricing">TinyMCE Enterprise</a>.</li>
					  </ul>

					  <h2>A simple table to play with</h2>

					  <table style="text-align: center;">
					    <thead>
					      <tr>
					        <th>Product</th>
					        <th>Cost</th>
					        <th>Really?</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>TinyMCE</td>
					        <td>Free</td>
					        <td>YES!</td>
					      </tr>
					      <tr>
					        <td>Plupload</td>
					        <td>Free</td>
					        <td>YES!</td>
					      </tr>
					    </tbody>
					  </table>

					  <h2>Found a bug?</h2>

					  <p>
					    If you think you have found a bug please create an issue on the <a href="https://github.com/tinymce/tinymce/issues">GitHub repo</a> to report it to the developers.
					  </p>

					  <h2>Finally ...</h2>

					  <p>
					    Don't forget to check out our other product <a href="http://www.plupload.com" target="_blank">Plupload</a>, your ultimate upload solution featuring HTML5 upload support.
					  </p>
					  <p>
					    Thanks for supporting TinyMCE! We hope it helps you and your users create great content.<br>All the best from the TinyMCE team.
					  </p>
					</textarea>
	    	</tr>
    	</table>
    </form>
  </div>
</div>