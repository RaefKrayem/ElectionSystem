<?php 
	session_start();
	require 'connect.php';

	function showPrompt() {
		echo "<div>".$_SESSION['prompt']."</div>";
	}

	function showError() {
		echo "<div>".$_SESSION['errprompt']."</div>";
	}

?>