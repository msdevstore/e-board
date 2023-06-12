<?php
$item = $_POST['item'];
$version = $_POST['version'];
$path = $item."_".$version;
echo $path;
$target_dir = $_SERVER["DOCUMENT_ROOT"]."/e-board/public/".$path."/";
if(!empty($_FILES['file1'])){ 
    $target_file_1 = $target_dir . $path . "/" . basename($_FILES["file1"]["name"]);
    $status_1 = move_uploaded_file($_FILES["file1"]["tmp_name"], $target_file_1);
}
if(!empty($_FILES['file2'])){ 
    $target_file_2 = $target_dir . $path . "_FIRM_PRJ/" . basename($_FILES["file2"]["name"]);
    $status_2 = move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file_2);
}
if(!empty($_FILES['file3'])){ 
    $target_file_3 = $target_dir . $path . "_FIRM_TP/" . basename($_FILES["file3"]["name"]);
    $status_3 = move_uploaded_file($_FILES["file3"]["tmp_name"], $target_file_3);
}
if(!empty($_FILES['file4'])){ 
    $target_file_4 = $target_dir . $path . "_GERBER/" . basename($_FILES["file4"]["name"]);
    $status_4 = move_uploaded_file($_FILES["file4"]["tmp_name"], $target_file_4);
}
if(!empty($_FILES['file5'])){ 
    $target_file_5 = $target_dir . $path . "_HARD_PRJ/" . basename($_FILES["file5"]["name"]);
    $status_5 = move_uploaded_file($_FILES["file5"]["tmp_name"], $target_file_5);
}
if(!empty($_FILES['file6'])){ 
    $target_file_6 = $target_dir . $path . "_PICTURE/" . basename($_FILES["file6"]["name"]);
    $status_6 = move_uploaded_file($_FILES["file6"]["tmp_name"], $target_file_6);
}
// if(!$status_1 || !$status_2 || !$status_3 || !$status_4 || !$status_5 || !$status_6){
//     echo 'ok';
// } else {
//     echo 'err';
// }
echo 'ok';
?>

