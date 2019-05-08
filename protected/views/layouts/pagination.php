<?php
if(isset($objPagination) && is_object($objPagination) && ($intTotalPages = $objPagination->getPageCount()) > 0){ ?>
<div class="pagination_wrapper">
	<table cellpadding="2" cellspacing="2" border="0" width="100%">
		<tbody>
			<tr>
				<td>
					<?php echo Yii::t('app', 'Page'); ?>:
					<select name="pagination" class="pagination">
						<?php		
						for($iPageIndex = 0; $iPageIndex < $intTotalPages; $iPageIndex++){ ?>
							<option value="<?php echo $iPageIndex; ?>" <?php if($objPagination->getCurrentPage() === $iPageIndex){?>selected="selected"<?php } ?>><?php echo ($iPageIndex + 1); ?></option>
						<?php
						} // - end: for	?>
					</select>
					<?php 
					/*$this->widget('CLinkPager', array(
						'header' => '',
						'firstPageLabel' => '&lt;&lt;',
						'prevPageLabel' => '&lt;',
						'nextPageLabel' => '&gt;',
						'lastPageLabel' => '&lt;&lt;',
						'pages' => $objPagination,
					));*/
					?>&nbsp;&nbsp;
					<?php 
					if(empty($strItemCountLabel)){
						$strItemCountLabel = Yii::t('app', 'Total: [#item_count] Record(s)');
					} // - end: if else					
					echo str_replace('[#item_count]', (int)$objPagination->getItemCount(), $strItemCountLabel); 
					?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
<?php
} // - end: if
?>