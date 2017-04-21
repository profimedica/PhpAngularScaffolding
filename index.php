<?php
session_start();
header('Access-Control-Allow-Origin: *', false);
$_POST = json_decode(file_get_contents('php://input'), true);

$myAngularAppPath = './test.html';// Is the current path
$myAngularAppContent = file_get_contents($myAngularAppPath);

if(isset($_POST['FieldName']))
{
		$trans = array("</body>" => '<br>		'.$_POST['FieldName'].':<input type="text" ng-model="message"/> </body>'.PHP_EOL);
        $myAngularAppContent = strtr($myAngularAppContent, $trans);
        file_put_contents($myAngularAppPath, $myAngularAppContent);
		echo ('{ "Status" : 1 }');
		exit();
}

?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>

<script>
function AddField(fieldName)
{
	$.ajax({
		type: "POST",
		url: window.location,
		data: JSON.stringify({FieldName : fieldName}),
		dataType: "json"
	}).done(function(data, m, n) {});
}
</script>

</h3>Angular Manager<h3>

Your Angular Application is <span style='color:red'><?php echo $myAngularAppPath ?></span> <a target='_blank' href='<?php echo $myAngularAppPath ?>'>Open it in new window</a>
<br>
Add new field named <input id='newFieldName'> <button value='Add Now !' onclick='AddField($("#newFieldName").val())'>Add</button>

<div>
	<textarea readonly style='width: 800px; height: 300px'><?php echo $myAngularAppContent ?></textarea>
</div>
