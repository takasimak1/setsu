<?php include('header.php'); ?>
    <main>
        <section class="button-section">
            <h2>いまはこれだけ</h2>
            <a href="sample.php" class="cool-button">sample</a>
            <a href="denpyo.php" class="cool-button">denpyo.php</a>
            <a href="sample2.php?style=1" class="cool-button" style="background-color: #AAA;">sample2</a>
        </section>
    </main>
</body>
<?php include('footer.php'); ?>
<?php

echo $_SERVER["REMOTE_ADDR"] ;

if( $_SERVER["REMOTE_ADDR"] == "160.86.175.153" ) {
echo "<br />シータから発信";
} else {
echo "<br />よそからから発信";
}
	$db_root_path_2 = 'www.aqualabo.com/';

?>

</html>
