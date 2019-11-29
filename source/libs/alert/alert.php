<?php
function createAlert($type, $mainMessage, $subMessage) {
	echo "<div class='wrapper alert $type' title='Click to Dismiss'><div>";
	echo "<p class='main'>$mainMessage</p>";
	echo "<p class='main'>$subMessage</p>";
	echo "</div></div>";
}
?>