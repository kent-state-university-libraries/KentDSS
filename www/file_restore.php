<?php
/*

	Copyright 2013 Kent State University

	Licensed under the Apache License, Version 2.0 (the "License");
	you may not use this file except in compliance with the License.
	You may obtain a copy of the License at

		http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.
   
*/

	if ($dss_userId == 0 || $dss_accessLevel == 0) {
	
		header("Location: /index.php");
		exit;
		
	}

	/* Make sure this file is not already queued to be restore. */
	
	$query = db_query("SELECT id FROM item WHERE restorePending=0 AND id=".escapeValue($_REQUEST["itemId"]));
	
	if (db_numrows($query) == 1) {
	
		/* Queue this item to be restored from the selected pod. */
			
		db_query("UPDATE item SET ".escapeValue($_REQUEST["itemId"]));restorePending=".escapeValue($_REQUEST["pod"])." WHERE id=".escapeValue($_REQUEST["itemId"]));

	}
		
	header("Location: item_detail.php?itemId=".escapeValue($_REQUEST["itemId"])."&infoMessage=".rawurlencode("A restore request has been queued for this item."));
	
?>