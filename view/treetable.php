<head>
    <title>E-BOARD MANAGER</title>
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/dxf/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
	
	<!-- Font CSS-->
	<link rel="stylesheet" href="../assets/css/jquery.treetable.css" />
	<link rel="stylesheet" href="../assets/css/jquery.treetable.theme.default.css" >
</head>
<style>
    /* Style the header with a grey background and some padding */
.header {
  overflow: hidden;
  background-color: #f1f1f1;
}

/* Style the header links */
.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  line-height: 25px;
  border-radius: 4px;
}

/* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

/* Change the background color on mouse-over */
.header a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the active/current link*/
.header a.active {
  background-color: dodgerblue;
  color: white;
}

/* Float the link section to the right */
.header-right {
  float: right;
}
.custom-button {
  float: right;
  padding: 8px 12px;
  background-color: #6c757d;
  color: white;
  border-radius: 4px;
}
.custom-button:hover {
    cursor: pointer;
}

/* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  .header-right {
    float: none;
  }
}
</style>
<body>
    <div style="margin-top: 150px">
        <div id="loading">
            <!-- <div id="uploadStatus" class="text-center"></div> -->
            <div class="progress" id="progress">
                <div class="progress-bar"></div>
            </div>
        </div>
        <div class="header">
            <h1 class="logo" style="margin-block-end: 0px; text-align: center">Database</h1>
            <div class="d-flex justify-content-between px-3">
                <?php 
                session_start();
                if($_SESSION['role'] != 2) echo '<a class="btn btn-success ml-3 text-white" data-toggle="modal" data-target="#uploadModal">Upload</a>';              
                ?>
                <a class="btn btn-info mr-3 text-white" id="download-all">Download</a>
            </div>
        </div>
        <div>
            <table id="table_id">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Creation Date</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $code = $_POST['code'];
                    listFolderFiles('../public/'.$code, 0);
                    $tempArr = explode('_', $code);
                    $item = $tempArr[0];
                    $len = count($tempArr);
                    for($i = 1; $i < $len - 1; $i++) {
                        $item = $item . "_" . $tempArr[$i];
                    }
                    $version = $tempArr[$len - 1];
                    
                    function listFolderFiles($dir, $ttId)
                    {
                        $unit = array('Byte', 'KB', 'MB', 'GB');
                        foreach (new DirectoryIterator($dir) as $fileInfo) {
                            if (!$fileInfo->isDot()) {
                                $tempArr = explode('-', $ttId);
                                $len = count($tempArr);
                                $ttId = $tempArr[0];

                                if($len > 1) {
                                    for($i = 1; $i < $len; $i++) {
                                        if($i == $len - 1) {
                                            ++$tempArr[$i];
                                        }
                                        $ttId = $ttId.'-'.$tempArr[$i];
                                    }
                                } else {
                                    ++$ttId;
                                }
                                if($len > 1){
                                    $ttParentId = $tempArr[0];
                                    for($i = 1; $i < $len - 1; $i++) {
                                        $ttParentId = $ttParentId.'-'.$tempArr[$i];
                                    }
                                    
                                    if ($fileInfo->isDir()) {    
                                        echo '<tr data-tt-id="'.$ttId.'" data-tt-parent-id="'.$ttParentId.'"><td><span class="folder">' . $fileInfo->getFilename() . '</span></td><td>..</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                                        listFolderFiles($fileInfo->getPathname(), $ttId.'-0');
                                    } else {
                                        $size = $fileInfo->getSize();
                                        $cnt = 0;
                                        while($size > 1024) {
                                            $size /= 1024;
                                            $size = round($size, 2);
                                            $cnt++;
                                        }
                                        echo '<tr data-tt-id="'.$ttId.'" data-tt-parent-id="'.$ttParentId.'"><td><a href="e-board/'.$fileInfo->getPathname().'"><span class="file">' . $fileInfo->getFilename() . '</span></a></td><td>' .$size." ".$unit[$cnt]. '</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                                    }
                                } else {
                                    if ($fileInfo->isDir()) {    
                                        echo '<tr data-tt-id="'.$ttId.'"><td><span class="folder">' . $fileInfo->getFilename() . '</span></td><td>..</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                                        listFolderFiles($fileInfo->getPathname(), $ttId.'-0');
                                    } else {
                                        $size = $fileInfo->getSize();
                                        $cnt = 0;
                                        while($size > 1024) {
                                            $size /= 1024;
                                            $size = round($size, 2);
                                            $cnt++;
                                        }
                                        echo '<tr data-tt-id="'.$ttId.'"><td><a href="e-board/'.$fileInfo->getPathname().'"><span class="file">' . $fileInfo->getFilename() . '</span></a></td><td>' .$size." ".$unit[$cnt]. '</td><td>' . date("Y-m-d h-m-s", $fileInfo->getATime()). '</td><td>' .date("Y-m-d h-m-s", $fileInfo->getCTime()). '</td></tr>';
                                    }
                                }
                               
                            }
                        }
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="uploadModal">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Upload File</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <form action="app/file/upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
                        <div class="modal-body pl-5 pr-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?></span>
                                </div>
                                <input type="file" class="form-control" name="file1" id="file1" placeholder="<?php echo $code; ?>">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?>_FIRM_PRJ</span>
                                </div>
                                <input type="file" class="form-control" name="file2" id="file2" placeholder="<?php echo $code; ?>_FIRM_PRJ">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?>_FIRM_TP</span>
                                </div>
                                <input type="file" class="form-control" name="file3" id="file3" placeholder="<?php echo $code; ?>_FIRM_TP">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?>_GERBER</span>
                                </div>
                                <input type="file" class="form-control" name="file4" id="file4" placeholder="<?php echo $code; ?>_FIRM_GERBER">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?>_HARD_PRJ</span>
                                </div>
                                <input type="file" class="form-control" name="file5" id="file5" placeholder="<?php echo $code; ?>_HARD_PRJ">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="width: 350px;"><?php echo $code; ?>_PICTURE</span>
                                </div>
                                <input type="file" class="form-control" name="file6" id="file6" placeholder="<?php echo $code; ?>_PICTURE">
                            </div>
                            <input type="hidden" name="item" id="item" value="<?php echo $item; ?>"> 
                            <input type="hidden" name="version" id="version" value="<?php echo $version; ?>"> 
                        </div>
                    
                    <!-- Modal footer -->
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary" id="ok-btn">Upload</button> -->
                            <input type="submit" name="submit" value="UPLOAD" class="btn btn-primary" id="ok-btn">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-btn">Close</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
       
    </div>
	<script src="../assets/js/jquery.treetable.js"></script>
    <script>
    $("#table_id").treetable({ expandable: true });

    // Highlight selected row
    $("#table_id tbody").on("mousedown", "tr", function() {
    $(".selected").not(this).removeClass("selected");
    $(this).toggleClass("selected");
    });
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        var formData = new FormData();
        formData.append('item', $('#item').val());
        formData.append('version', $('#version').val());
        // Attach file
        formData.append('file1', $('#file1')[0].files[0]); 
        formData.append('file2', $('#file2')[0].files[0]); 
        formData.append('file3', $('#file3')[0].files[0]); 
        formData.append('file4', $('#file4')[0].files[0]); 
        formData.append('file5', $('#file5')[0].files[0]); 
        formData.append('file6', $('#file6')[0].files[0]); 
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete+'%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '../app/file/upload.php',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#loading').slideDown();
                $(".progress-bar").width('0%');
                $('#uploadStatus').html('<img src="./assets/img/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                }else if(resp == 'err'){
                    $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                }
                $('#close-btn').click();
                setTimeout(mySlide, 1000);
                
            }
        });
    });

    function mySlide() {
        $('#loading').slideUp();
        window.location.reload();
    }
	
    // File type validation
    $("#fileInput").change(function(){
        var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        var file = this.files[0];
        var fileType = file.type;
        if(!allowedTypes.includes(fileType)){
            alert('Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
            $("#fileInput").val('');
            return false;
        }
    });

    $('#download-all').click(function() {
        // let $aArr = $('#table_id a');
        // let len = $aArr.length;
        // for(let i = 0; i < len; i++) {
        //     let href = $aArr[i].href;
        //     if(href.slice(-1) != '#') {
        //         downloadFile(href, href.substring(href.lastIndexOf('/')+1));
        //     };
        // }
        $.ajax({
            url: '../app/file/download.php',
            type: 'post',
            data: {
                code: '<?php echo $code; ?>'
            },
            success:function(data) {
                if(data == 'failed') {
                    alert('Failed!');
                } else {
                    downloadFile('public/download/' + data + '_ALLFILES.zip', data + '.zip');
                }
            }
        })
    });
    </script>
</body>
        