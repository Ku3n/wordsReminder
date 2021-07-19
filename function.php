<?php 
header("Content-Type:text/html;charset=gbk");

$check_flag = 0;

# 初始化单词数组
$filename = "test.csv";
$words_list = openCsv($filename);   // 所有的单词以二维数组的形式存在于words_list中
$words_list = initWords($words_list, $filename);    // 将只保存了单词和含义的出现次数、模糊次数、忘记次数置为0

# 功能函数
function openCsv($filename) {       // 打开csv文件
    $file = fopen($filename,'r'); 
    if($file != "") {
        while ($data = fgetcsv($file)) {
            $words_list[] = $data;
        }
    }
    fclose($file);
    return $words_list;
}


function initWords($words_list, $filename) {   //如果只输入了单词和含义，则初始化数量为0
    $row_lenth = count($words_list);
    for($i = 0; $i < $row_lenth; $i++) {
        if($words_list[$i][2] == "") {
            $words_list[$i][2] = 0;
            $words_list[$i][3] = 0;
            $words_list[$i][4] = 0;
        }
    } 
    saveCsv($words_list,$filename);
    return $words_list;
}


function saveCsv($words_list, $filename) {  //保存内容到csv文件
    $file = fopen($filename,'w');
    foreach($words_list as $word) {
        fputcsv($file, $word);
    }
    fclose($file);
}

function randomWord($words_list) {     // 随机返回一个单词
    $i = rand(1, count($words_list) - 1);
    $word = $words_list[$i];
    return $word;    
}

function searchIndex($word,$words_list) {   // 找到单词的index（下标）
    $i = 0;
    foreach($words_list as $target) {
        if($word[0] == $target[0]) {
            return $i;
        } else {
            $i++;
        }
    }
}

function dimWord($words_list, $index, $filename) {   // 模糊的单词，模糊数加一
    $words_list[$index][2]++;
    $words_list[$index][3]++;
    saveCsv($words_list,$filename);
}

function passWord($words_list, $index, $filename) {   // pass的单词，出现数加一
    $words_list[$index][2]++;
    saveCsv($words_list,$filename);
}

function forgetWord($words_list, $index, $filename) {   // 忘记的单词，忘记数加一
    $words_list[$index][2]++;
    $words_list[$index][4]++;
    saveCsv($words_list,$filename);
}
?>



