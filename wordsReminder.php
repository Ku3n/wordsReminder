<?php
header("Content-Type:text/html;charset=gbk");
require 'function.php';

# 用来储存上一个单词的内容
$word_save_file = "wordsave.csv";
$word_save = openCsv($word_save_file);



$flag = $_GET['flag'];

if($word_save[0][0] == "") {
    $word = randomWord($words_list);
    $word_save_list[0] = $word;
    saveCsv($word_save_list,$word_save_file);
    $new_word = $word;
}else {
    $word = $word_save[0];    
    $new_word = randomWord($words_list);
    $word_save_list[0] = $new_word;
    saveCsv($word_save_list,$word_save_file);
}

if($flag == "show") {
    $new_word = $word;
}





if($flag == "pass") {
    $index = searchIndex($word, $words_list);
    passWord($words_list, $index, $filename);
} elseif($flag == "dim") {
    $index = searchIndex($word, $words_list);
    dimWord($words_list, $index, $filename);
} elseif($flag == "forget") {
    $index = searchIndex($word, $words_list);
    forgetWord($words_list, $index, $filename);
}

function showAnwser($word, $flag) {     // 显示答案
    if ($flag == "show") {
        echo $word[1];
    }else {
        echo "*****";
    }
}

?>

<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
</head>
<script language="javascript" type="text/javascript">
    var flag = <?php echo $check_flag; ?>
    if(flag != 1) {
        window.location.href="index.php"
    }
</script>

<body>
    <table border="1">
        <?php 
        ?>
        <tr>
            <td><?php echo $words_list[0][0];?></td>
            <td><?php echo $words_list[0][1];?></td>
            <td><?php echo $words_list[0][2];?></td>
            <td><?php echo $words_list[0][3];?></td>
            <td><?php echo $words_list[0][4];?></td>
        </tr>
        <tr>
            <td><?php echo $new_word[0];?></td>
            <td><?php showAnwser($new_word, $flag);?></td>
            <td><?php echo $new_word[2];?></td>
            <td><?php echo $new_word[3];?></td>
            <td><?php echo $new_word[4];?></td>
        </tr>
        <tr>
            <td></td>
            <td><form action="wordsReminder.php" method="GET"><input type="submit" name="flag"value="show"></td>
            <td><form action="wordsReminder.php" method="GET"><input type="submit" name="flag"value="pass"></form></td>
            <td><form action="wordsReminder.php" method="GET"><input type="submit" name="flag"value="dim"></form></td>
            <td><form action="wordsReminder.php" method="GET"><input type="submit" name="flag"value="forget"></form></td>
        </tr>
        
    </table>
</body>

</html>