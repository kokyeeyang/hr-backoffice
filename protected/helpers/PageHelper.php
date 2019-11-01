<?php 
class PageHelper {

	public static function printViewAllHeader($breadcrumbTop, $spanTitle){
		return ("
			<div class=\"breadcrumb\">
				<div class=\"breadcrumb_wrapper\">
					<div class=\"breadcrumb-top\"> $breadcrumbTop</div>
					<div class=\"breadcrumb-bottom breadcrumb-bottom-key\">
						<div class=\"title\">
							<span>$spanTitle</span>
						</div>
					</div>
				</div>
			</div>
		");
	}
}