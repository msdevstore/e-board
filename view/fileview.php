<head>
    <title>E-BOARD MANAGER</title>
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/dxf/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
	
	<!-- Font CSS-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/brands.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/solid.min.css" />
	<link rel="stylesheet" href="../assets/css/fileview.css" >
	<script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
</head>
<body>
    
    <div style="padding: 50px 100px;">
        <div class="p-3" style="border: 1px solid grey;">
        <hr>
        <p><label>File or Folder Selected: <input id="last_action" type="text" size="15" readonly=""></label></p>
        <hr>

        <?php 
    
        listFolderFiles('G:\xampp\htdocs\e-board\public');

        function listFolderFiles($dir)
        {
            echo '<ul class="group">';
            foreach (new DirectoryIterator($dir) as $fileInfo) {
                if (!$fileInfo->isDot()) {
                    if ($fileInfo->isDir()) {    
                        echo '<li role="treeitem" aria-expanded="false" aria-selected="false">
                        <span>' . $fileInfo->getFilename() . '</span>';
                        listFolderFiles($fileInfo->getPathname());
                    } else {
                        echo '<li role="treeitem" aria-selected="false" class="doc">' . $fileInfo->getFilename();
                    }
                    echo '</li>';
                }
            }
            echo '</ul>';
        }

        ?>
        

        </div>
    </div>
        <!-- <div>
            <h3 id="tree_label">
            File View
            </h3>
            <ul role="tree" aria-labelledby="tree_label">
            <li role="treeitem" aria-expanded="false" aria-selected="false">
                <span>
                Projects
                </span>
                <ul role="group">
                <li role="treeitem" aria-selected="false" class="doc">
                    project-1.docx
                </li>
                <li role="treeitem" aria-selected="false" class="doc">
                    project-2.docx
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    Project 3
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-3A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-3B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-3C.docx
                    </li>
                    </ul>
                </li>
                <li role="treeitem" aria-selected="false" class="doc">
                    project-4.docx
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    Project 5
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5C.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5D.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5E.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        project-5F.docx
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            <li role="treeitem" aria-expanded="false" aria-selected="false">
                <span>
                Reports
                </span>
                <ul role="group">
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    report-1
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-1A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-1B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-1C.docx
                    </li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    report-2
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-2A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-2B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-2C.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-2D.docx
                    </li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    report-3
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-3A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-3B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-3C.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        report-3D.docx
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            <li role="treeitem" aria-expanded="false" aria-selected="false">
                <span>
                Letters
                </span>
                <ul role="group">
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    letter-1
                    </span>
                    <ul>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-1A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-1B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-1C.docx
                    </li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    letter-2
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-2A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-2B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-2C.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-2D.docx
                    </li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false" aria-selected="false">
                    <span>
                    letter-3
                    </span>
                    <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-3A.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-3B.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-3C.docx
                    </li>
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-3D.docx
                    </li>
                    </ul>
                </li>
                </ul>
            </li>
            <li role="treeitem" aria-expanded="false" aria-selected="false">
                <span>
                    New Folder
                </span>
                <ul role="group">
                    <li role="treeitem" aria-selected="false" class="doc">
                        letter-3A.docx
                    </li>
                    <li role="treeitem" aria-expanded="false" aria-selected="false">
                        <span>
                            New File
                        </span>
                    </li>
                </ul>
            </li>
            </ul>
            <p><label>File or Folder Selected: <input id="last_action" type="text" size="15" readonly=""></label></p>
        </div> -->
     
    
    <script>
        $(document).ready(function() {
            $('ul:first').attr({'role' : 'tree', 'aria-labelledby' : 'tree_label'});
        })
    </script>
	<script src="../assets/js/fileview.js"></script>
</body>
        