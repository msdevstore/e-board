
	
    <?php
        require '../../vendor/autoload.php';

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    

        if(!empty($_POST['code']) && !empty($_FILES['input_XLSX']) ) {
			
			$code = $_POST['code'];
			$version = $_POST['version'];
			if(!empty($_POST['version']))
			$moduleName = $code.'_'.$version;
			else
			$moduleName = $code;	
                    
            $uploadOk = 1;

            $fileName = $_FILES['input_XLSX']['name'];
            $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

            $allowed_ext = ['xls','csv','xlsx'];

            $con=mysqli_connect("localhost","root","","eboard");
            mysqli_set_charset($con, 'utf8');
            // Check connection
            if (mysqli_connect_errno())
            {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br />";
            }
            else
            {
                $result = mysqli_query($con,"SELECT ID from ebs where item_code='".$_POST['code']."' and version='".$_POST['version']."'");
                $numrow = mysqli_num_rows($result);
                if($numrow > 0)
                {
                    die("Hey: code e version exist");
                    
                }
                
                $lastupdate = date('Y-m-d H:i:s');

                mysqli_query($con,"INSERT INTO ebs (item_code,version,description,last_update) value ('".$_POST['code']."','".$_POST['version']."','".$_POST['description']."', '".$lastupdate."')");
                $result = mysqli_query($con,"SELECT id from ebs where item_code='".$_POST['code']."' and version='".$_POST['version']."' and description='".$_POST['description']."'");
                $row = mysqli_fetch_array($result);
                $code = $_POST['code'];
                $version = $_POST['version'];
                if(!is_dir('../../public')) {
                    mkdir('../../public');
                }
                if(!is_dir('../../public/'.$code.'_'.$version)) {
                    mkdir('../../public/'.$code.'_'.$version);
                }
                $path = '../../public/'.$code.'_'.$version.'/';
                mkdir($path.$code.'_'.$version);
                mkdir($path.$code.'_'.$version.'_GERBER');
                mkdir($path.$code.'_'.$version.'_PICTURE');
                mkdir($path.$code.'_'.$version.'_HARD_PRJ');
                mkdir($path.$code.'_'.$version.'_FIRM_PRJ');
                mkdir($path.$code.'_'.$version.'_FIRM_PRJ'.'/'.$code.'_'.$version.'_FIRM_SRC');
                mkdir($path.$code.'_'.$version.'_FIRM_PRJ'.'/'.$code.'_'.$version.'_FIRM_CMP');
                mkdir($path.$code.'_'.$version.'_FIRM_TP');
                mkdir($path.$code.'_'.$version.'_FIRM_TP'.'/'.$code.'_'.$version.'_FIRM_HWP');
                mkdir($path.$code.'_'.$version.'_FIRM_TP'.'/'.$code.'_'.$version.'_FIRM_FWP');
                $moduleName = $row['id'];

                if(in_array($file_ext, $allowed_ext))
                {
                    $inputFileNamePath = $_FILES['input_XLSX']['tmp_name'];
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
                    $data = $spreadsheet->getActiveSheet()->toArray();
                    $count = 0;
                    foreach($data as $row)
                    {
                        if($count > 0)
                        {
                            $qty = $row[0];
                            $parts = $row[1];
                            $description = $row[2];
                            $package = $row[3];
                            $productor = $row[4];
                            $mpn = $row[5];
                            $spn = $row[6];
                            $remark = $row[7];
                            $ebId = $moduleName;
                            $sql = "INSERT INTO boms(qty, parts, description, package, productor, mpn, spn, remark, ebId) VALUES ('$qty','$parts','$description','$package','$productor','$mpn','$spn','$remark', '$ebId')";
                            $result = mysqli_query($con, $sql);
                            //$last_id = $con->insert_id;
                            //mkdir('public/'.$mainName."/".$last_id);
                            $msg = true;
                        }
                        $count += 1;
                    }
                }
                    
                write_table($moduleName);
            }
		} 
			
		//divido per 1000 una stringa numerica e la formatto -- Es. 13 = 0.013	
        function pad($number, $min_digits){
                return strrev(
                    implode(",",str_split(str_pad(strrev($number), $min_digits, "0", STR_PAD_RIGHT),3))
                );
            }
            
		function write_table($code)
		{
            $con=mysqli_connect("localhost","root","","eboard");
            mysqli_set_charset($con, 'utf8');
            // Check connection
            if (mysqli_connect_errno())
            {
            echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br />";
            }

            $result = mysqli_query($con,"SELECT * FROM boms inner join ebs on ebs.id = boms.ebId where ebId='".$code."'");
			
			$row = mysqli_fetch_array($result);
			
			if($row['version'] != '' )
			$moduleName = $row['item_code'].'_'.$row['version'];
			else
			$moduleName = $row['item_code'];	

            echo '
            <br />
            <br />
			<center>
			<h2> LISTA: '.$row['item_code'].' - '.$row['description'].' </h2>
			<h3>Version : '.$row['version'].' </h3>
			<h4> Last Update : '.$row['last_update'].' </h4>
			</center>
            <table id="dxfTable1" class="table table-striped table-bordered" style="margin-left: auto; margin-right: auto; ">
            <thead>
                <tr>
                    <th>Q.ty
                    </th>
                    <th>Parts
                    </th>
                    <th>Description
                    </th>
                    <th>Package
                    </th>
                    <th> Productor
                    </th>
                    <th>Manufacturer Part Number ( MPN )
                    </th>
                    <th>Supplier part number ( SPN )
                    </th>
					<th>Remark
                    </th>
                </tr>
            </thead>'
            ;
            echo "<tbody>";
            do {
     
                echo "<tr>";
                    echo "<td>" . $row['qty'] . "</td>";
                    echo "<td>" . $row['parts'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['package'] . "</td>";
                    echo "<td>" . $row['productor'] . "</td>";
                    echo "<td>" . $row['mpn'] . "</td>";
                    echo "<td>" . $row['spn'] . "</td>";
                    echo "<td>" . $row['remark'] . "</td>";
                echo "</tr>";
            } while($row = mysqli_fetch_array($result));
            echo "</tbody>";
            echo "</table>";

            mysqli_close($con);
        }
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dxfTable1').DataTable(
				{
				} 
			);
        } );
    </script>