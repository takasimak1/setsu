<?PHP
include('header.php');
//DBのパスワード admin paradise
// 共通の設定ファイルをインクルード
include 'config.php';

if (!isset ($_REQUEST['action'])) $_REQUEST['action']='';
$result = array();

//リストかカードか
if (isset($_GET['style'])) {
	$style = $_GET['style'];
	//var_dump($style);
}

	$debug = 0;

include_once ('fmREST.php');

$host = 'https://sys.kei1.me';
$db = 'fmREST-sample';
$user = 'fmrest';
$pass = 'paradise';
$layout = '作業日報';

$fm = new fmREST ($host, $db, $user, $pass, $layout);
$fm -> show_debug = false; //false turn this to true or "html" to show automatically. We're manually including debug information with <print_r ($fm->debug_array);>
$fm -> secure = true; //not required - defaults to true
//v18以下では条件分岐がある
$fm -> fmversion = 19; 

	//ソートするフィールド
	$sortFieldName = "現場責任者";

	//get records 全レコード
	//	$parameters['_limit'] = 1;
	//	$parameters['script'] = $_REQUEST['Script'];
	//	$parameters['script.param'] = $_REQUEST['Parameter'];
	$sort[] = [ "fieldName" => $sortFieldName, "sortOrder" => "ascend"];
	$parameters['_sort'] = json_encode($sort);
	$result = $fm -> getRecords ($parameters, $layout); 
?>

<html lang="ja">
<head>
<meta charset="UTF-8" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<title>テスト.php</title>
</head>
<body>


<div>
<hr />
<p> 全レコードリスト<br/></p>
<?PHP
$records = $result['response']['data'];
if ( $style == 1 ) {
?>
    <table>
        <tr>
            <th style="width: 20px">ID</th>
            <th style="width: 100px">日付</th>
            <th style="width: 100px">業務名</th>
            <th style="width: 100px">現場名</th>
            <th style="width:120px">現場責任者</th>
            <th style="width:120px">写真</th>
            <th style="width:100px">コメント</th>
        </tr>
        <?php foreach ($records as $record) { ?>
            <tr>
				<td><?= $record['recordId'] ?> </td>
<td class="center"><?= date('Y-m-d', strtotime($record['fieldData']['作成情報タイムスタンプ'])) ?></td>
                <td><?= htmlspecialchars($record['fieldData']['業務名']) ?> </td>
                <td><?= htmlspecialchars($record['fieldData']['現場名']) ?></td>
                <td class="center"><?= htmlspecialchars($record['fieldData']['現場責任者']) ?> </th>
                <td class="center"><img src="<?= $record['fieldData']['現場写真'] ?>" alt="現場写真" width="180" /> </th>
                <td><?= htmlspecialchars($record['fieldData']['コメント']) ?></td>
            </tr>
        <?php } ?>
    </table>
    

<div>
	<div style="margin: 50px;margin-top:10px;width:350px;">
		<form method='post' enctype="multipart/form-data">
		
			<div class="border rounded p-3">
				<input name='recordid' class="form-control" placeholder="Record ID">
				<input type="date" name='date' class="form-control" placeholder="日付"
				 value="<?= date('Y-m-d', strtotime($record['fieldData']['作成情報タイムスタンプ'])) ?>">
				<input name='Text1' class="form-control" placeholder="業務名"
				 value="<?= htmlspecialchars($record['fieldData']['業務名']) ?>">
				<input name='Text1' class="form-control" placeholder="現場名"
				 value="<?= htmlspecialchars($record['fieldData']['現場名']) ?>">
				<input name='Text1' class="form-control" placeholder="現場責任者"
				 value="<?= htmlspecialchars($record['fieldData']['現場責任者']) ?>">
				<input name='Text2' class="form-control" placeholder="Text2">
				<input name='Global' class="form-control" placeholder="Global">
				<input name='Script' class="form-control" placeholder="Script">
				<input name='Parameter' class="form-control" placeholder="Script Parameter">

				<div class="custom-file">
				  <input type="file" class="custom-file-input" name="file">
				  <label class="custom-file-label" for="customFile">Choose a file</label>
				</div>
			</div>
<button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
		</form>
	</div>
</div>




<?PHP
} else {



	echo "<br />";
	echo "<br />";
	foreach ($records as $oneRecords){
	echo "現場責任者 : ";
	echo htmlspecialchars($oneRecords['fieldData']['現場責任者']);
	echo "<br />";
	echo "現場写真 : ";
	echo $oneRecords['fieldData']['現場写真'];
	echo "<br />";
	echo '<img src="'.$oneRecords['fieldData']['現場写真'].'" alt="現場写真" width="200" />';
	echo "<br />";
	echo "主キー : ";
	echo $oneRecords['fieldData']['主キー'];
	echo "<br />";
	echo "作成者 : ";
	echo $oneRecords['fieldData']['作成者'];
	echo "<br />";
	echo "修正者 : ";
	echo $oneRecords['fieldData']['修正者'];
	echo "<br />";
	echo "<br />";
	echo "next recode : ";
	echo "<br />";
	echo "<br />";
	}
}

//$oneData = $result['response']['data'][0]['fieldData'];
//echo $oneData['Text1'];
//var_dump($result['response']);

if ( $debug == 1 ) {
?>
<div style="margin-left:10px;" class="bg-light">
	<div class="bg-info">
	<pre>
		POST: 
		<?PHP print_r ($_POST); ?>
		<hr>	
		GET: 
		<?PHP print_r ($_GET); ?>
		<hr>
		FILES: 
		<?PHP print_r ($_FILES); ?>
		<hr>
		COOKIES: 
		<?PHP print_r ($_COOKIE); ?>
	</pre>
	<hr>
		<strong>Result:</strong>
		<pre>
			<?PHP print_r ($result); ?>
		</pre>
	</div>
	<strong>Request:</strong>
	<strong>Debug Log:</strong>
	<pre>
		<?PHP print_r ($fm->debug_array); ?>
	</pre>
</div>
<?PHP
}
?>
</body>
<?php include('footer.php'); ?>
</html>
