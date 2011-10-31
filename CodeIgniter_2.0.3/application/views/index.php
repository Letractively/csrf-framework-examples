<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<h1>Recent status messages</h1>

<?php echo $status_messages; ?>


<h1>Update your status</h1>


<?php
$this->load->helper('form');

echo form_open('update') .
	'<p>'.form_label('Your name:', 'author').
	form_input('author', '').
	'</p><p>'.form_label('What are you doing?', 'status').
	form_input('status', '').'</p>'.
	form_submit('submit', 'Submit status') .
	form_close();

?>

</body>
</html>
