<?php 
header("Content-Type:text/html;charset=gbk");

$check_flag = 0;

# ��ʼ����������
$filename = "test.csv";
$words_list = openCsv($filename);   // ���еĵ����Զ�ά�������ʽ������words_list��
$words_list = initWords($words_list, $filename);    // ��ֻ�����˵��ʺͺ���ĳ��ִ�����ģ�����������Ǵ�����Ϊ0

# ���ܺ���
function openCsv($filename) {       // ��csv�ļ�
    $file = fopen($filename,'r'); 
    if($file != "") {
        while ($data = fgetcsv($file)) {
            $words_list[] = $data;
        }
    }
    fclose($file);
    return $words_list;
}


function initWords($words_list, $filename) {   //���ֻ�����˵��ʺͺ��壬���ʼ������Ϊ0
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


function saveCsv($words_list, $filename) {  //�������ݵ�csv�ļ�
    $file = fopen($filename,'w');
    foreach($words_list as $word) {
        fputcsv($file, $word);
    }
    fclose($file);
}

function randomWord($words_list) {     // �������һ������
    $i = rand(1, count($words_list) - 1);
    $word = $words_list[$i];
    return $word;    
}

function searchIndex($word,$words_list) {   // �ҵ����ʵ�index���±꣩
    $i = 0;
    foreach($words_list as $target) {
        if($word[0] == $target[0]) {
            return $i;
        } else {
            $i++;
        }
    }
}

function dimWord($words_list, $index, $filename) {   // ģ���ĵ��ʣ�ģ������һ
    $words_list[$index][2]++;
    $words_list[$index][3]++;
    saveCsv($words_list,$filename);
}

function passWord($words_list, $index, $filename) {   // pass�ĵ��ʣ���������һ
    $words_list[$index][2]++;
    saveCsv($words_list,$filename);
}

function forgetWord($words_list, $index, $filename) {   // ���ǵĵ��ʣ���������һ
    $words_list[$index][2]++;
    $words_list[$index][4]++;
    saveCsv($words_list,$filename);
}
?>



