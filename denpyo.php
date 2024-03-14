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
$db = 'recIRIS';
$user = '1';
$pass = '1';
$layout = '出納帳_入力';

$fm = new fmREST ($host, $db, $user, $pass, $layout);
$fm -> show_debug = false; //false turn this to true or "html" to show automatically. We're manually including debug information with <print_r ($fm->debug_array);>
$fm -> secure = true; //not required - defaults to true
//v18以下では条件分岐がある
$fm -> fmversion = 19; 

	//ソートするフィールド
	$sortFieldName = "日付";

	//get records 全レコード
	//	$parameters['_limit'] = 1;
	//	$parameters['script'] = $_REQUEST['Script'];
	//	$parameters['script.param'] = $_REQUEST['Parameter'];
	$sort[] = [ "fieldName" => $sortFieldName, "sortOrder" => "ascend"];
	$parameters['_sort'] = json_encode($sort);
	$result = $fm -> getRecords ($parameters, $layout); 
	
	
	//var_dump($result);
	
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
<?php
$records = $result['response']['data'];
?>
    <table>
        <tr>
            <th style="width: 20px">ID</th>
            <th style="width: 100px">日付</th>
            <th style="width: 100px">支出_科目</th>
            <th style="width: 100px">支出_摘要</th>
            <th style="width:120px">支出_金額</th>
            <th style="width:120px">写真</th>
            <th style="width:100px">記入者</th>
        </tr>
        <?php foreach ($records as $record) { ?>
            <tr>
				<td><?= $record['recordId'] ?> </td>
<td class="center"><?= date('Y-m-d', strtotime($record['fieldData']['日付'])) ?></td>
                <td><?= htmlspecialchars($record['fieldData']['支出_科目']) ?> </td>
                <td><?= htmlspecialchars($record['fieldData']['支出_摘要']) ?></td>
                <td class="center"><?= htmlspecialchars($record['fieldData']['支出_金額']) ?> </th>
                <td class="center"><img src="<?= $record['fieldData']['Container'] ?>" alt="Container" width="180" /> </th>
                <td><?= htmlspecialchars($record['fieldData']['記入者']) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
<?php include('footer.php'); ?>
</html>
