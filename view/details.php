<?php
session_start();
//divido per 1000 una stringa numerica e la formatto -- Es. 13 = 0.013	
function pad($number, $min_digits){
		return strrev(
			implode(",",str_split(str_pad(strrev($number), $min_digits, "0", STR_PAD_RIGHT),3))
		);
	}

$iddxftes = 'nessuna';

if(isset($_POST['iddxftes']))
	$iddxftes = $_POST['iddxftes'];


$con=mysqli_connect("localhost","root","","eboard");
mysqli_set_charset($con, 'utf8');
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br />";
}


$result = mysqli_query($con, "SELECT ebs.item_code, ebs.version, ebs.last_update, boms.id, boms.qty, boms.parts, boms.description, boms.package, boms.productor, boms.mpn, boms.spn, boms.remark, boms.ebId FROM boms join ebs on ebs.id = boms.ebId where boms.ebId='".$iddxftes."'");

if(mysqli_num_rows($result)===0 )
	die ('<script type="text/javascript">alert("No details")</script>');

$row = mysqli_fetch_array($result);

if($row['version'] != '' )
$moduleName = $row['item_code'].'_'.$row['version'];
else
$moduleName = $row['item_code'];	

$descrizione = $row['item_code'].' - '.$row['description'];

echo '
<br />
<br />
<div class="text-center">
    <h2> <b>LISTA</b> : <a>'.$descrizione.' </a></h2>
    <h3> <b>Version</b> : '.$row['version'].' </h3>
    <h4> <b>Last Update</b> : '.$row['last_update'].' </h4>
</div>
<div align="right" style="margin: 0px 0px 10px 0px;" >
			<span style="font-size: 32px; color: Dodgerblue;" >
			<i class="fas fa-file-pdf" id="pdf"></i>
			</span>
			<span style="font-size: 32px; color: Dodgerblue;" >
			<i class="fas fa-file-archive" id="zip"></i>
			</span>
			<span style="font-size: 32px; color: Dodgerblue;" >
			<i class="fas fa-euro-sign" id="euro"></i>
			</span>
</div>
<div class="tools">';

if($_SESSION['role'] != 2) echo '<button class="btn btn-primary m-3" data-toggle="modal" data-target="#addModal">Add Component</button>';
else echo '<br>';
    
echo '</div>
<table id="dxfLista" class="table table-striped table-bordered" style="margin-left: auto; margin-right: auto; ">
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
		<th>Productor
        </th>
		<th>Manufacturer Part Number ( MPN )
        </th>
		<th>Supplier part number ( SPN )
        </th>
		<th>Remark
        </th>
        <th>
            Modify
        </th>
        <th>
            Delete
        </th>
	</tr>
</thead>';
echo "<tbody>";
$total_surf = array();
$total_paint = 0;
$counter_lav = 0;
$counter_prod = 0;
$spessori = array();
$taglio = 0;
$costo = array();
$cnt = 0;
$ebId = 0;
do {
    if($cnt == 0) {
        $ebId = $row['ebId'];
    }
	echo "<tr>";
		echo "<td>" . $row['qty'] . "</td>";
		echo "<td><a href='javascript:;'>" . $row['parts'] . "</a></td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['package'] . "</td>";
		echo "<td>" . $row['productor'] . "</td>";
		echo "<td>" . $row['mpn'] . "</td>";
		echo "<td>" . $row['spn'] . "</td>";
		echo "<td>" . $row['remark'] . "</td>";
        echo "<td><button class='btn btn-success' id='modify-".$row['id']."'> Modify </button></td>";
        echo "<td><button class='btn btn-danger' id='delete-".$row['id']."'> Delete </button></td>";
    echo "</tr>";
	
} while($row = mysqli_fetch_array($result));
echo "</tbody>";
echo "</table>";

mysqli_close($con);
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">DXF Manager</h5>
      </div>
      <div class="modal-body p-5" id="msg">
        Lista "<?php echo $descrizione; ?>" in elaborazione, attendere...
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Component</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pl-5 pr-5">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Q.ty</span>
                    </div>
                    <input type="number" class="form-control" id="qty" placeholder="1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Parts</span>
                    </div>
                    <input type="text" class="form-control" id="parts" placeholder="LED1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Description</span>
                    </div>
                    <input type="text" class="form-control" id="description" placeholder="Standard LEDs SMD/SMT, Red">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Package</span>
                    </div>
                    <input type="text" class="form-control" id="package" placeholder="0805">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Productor</span>
                    </div>
                    <input type="text" class="form-control" id="productor" placeholder="Lite-On">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">MPN</span>
                    </div>
                    <input type="text" class="form-control" id="mpn" placeholder="LTST-C171KRKT">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">SPN</span>
                    </div>
                    <input type="text" class="form-control" id="spn" placeholder="568-6651-2-ND">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Remark</span>
                    </div>
                    <input type="text" class="form-control" id="remark" placeholder="Coating ZONE as per picture here close">
                </div>
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="create-btn">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="create-cancel-btn">Close</button>
        </div>
        
      </div>
    </div>
  </div>

  <div class="modal fade" id="editModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit List</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pl-5 pr-5">
            <form>
                <input type="hidden" id="edit-id">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Q.ty</span>
                    </div>
                    <input type="number" class="form-control" id="edit-qty">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Parts</span>
                    </div>
                    <input type="text" class="form-control" id="edit-parts">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Description</span>
                    </div>
                    <input type="text" class="form-control" id="edit-description">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Package</span>
                    </div>
                    <input type="text" class="form-control" id="edit-package">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Productor</span>
                    </div>
                    <input type="text" class="form-control" id="edit-productor">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">MPN</span>
                    </div>
                    <input type="text" class="form-control" id="edit-mpn">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">SPN</span>
                    </div>
                    <input type="text" class="form-control" id="edit-spn">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Remark</span>
                    </div>
                    <input type="text" class="form-control" id="edit-remark">
                </div>
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update-btn">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="update-close-btn">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" style="display: none" id="edit-modal-btn">
    Open modal
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="delModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            Are you sure you want to delete it?
            <input type="hidden" id="del-id">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="del-ok-btn">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="del-cancel-btn">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delModal" style="display: none" id="del-modal-btn">
    Open modal
  </button>

<script type="text/javascript">
  $(document).ready(function() {
		$('#pdf').click(function()
        {
        
        var param =  <?php echo $iddxftes; ?>;
            $.ajax(
                    {  
                        url: "../app/main/lista_pdf.php",
                        type: "post",
                        data: { 
                            iddxftes: param
                        },
                        beforeSend: function(result) {
                            $('#msg').html('Lista "<?php echo $descrizione; ?>" in elaborazione, attendere...');
                            $('#exampleModalCenter').modal('show');
                            },
                        success: function(result) {
                            $('#exampleModalCenter').modal('hide');
                            window.open('./data/<?php echo $moduleName; ?>/<?php echo $moduleName; ?>_lista.pdf','_blank');	
                            }
                    }
                );
        });

		$('#zip').click(function()
        {
        
        var param =  <?php echo $iddxftes; ?>;
            $.ajax(
                    {  
                        url: "../app/main/lista_pdf.php",
                        type: "post",
                        data: { iddxftes: param
                        },
                        beforeSend: function(result) {
                            $('#msg').html('Archivio Zip "<?php echo $moduleName; ?>.zip" in elaborazione, attendere...');
                            $('#exampleModalCenter').modal('show');
                            }
                    }
                ).done( function() {
                        $('#exampleModalCenter').modal('hide');
                        window.location = 'dxfzipper.php?id=<?php echo $moduleName;?>';
                    }
                );
        });

        $('#euro').click(function()
        {
        
        var param =  <?php echo $iddxftes; ?>;
            $.ajax(
                    {  
                        url: "../app/main/lista_pdf.php",
                        type: "post",
                        data: { iddxftes: param,
                                euro: '1'
                        },
                        beforeSend: function(result) {
                            $('#msg').html('Lista costi "<?php echo $descrizione; ?>" in elaborazione, attendere...');
                            $('#exampleModalCenter').modal('show');
                            },
                        success: function(result) {
                            $('#exampleModalCenter').modal('hide');
                            window.open('./data/<?php echo $moduleName; ?>/<?php echo $moduleName; ?>_lista_costi.pdf','_blank');	
                            }
                    }
                );
        });
		
        $('#create-btn').click(function() {
            if(!$('#qty').val() || !$('#parts').val()) {
                alert("You are missing something!");
            } else {
                $.ajax({
                    url: "../app/list/create.php",
                    type: "POST",
                    data: {
                        id : '<?php echo $ebId; ?>',
                        qty : $('#qty').val(),
                        parts : $('#parts').val(),
                        description : $('#description').val(),
                        package : $('#package').val(),
                        productor : $('#productor').val(),
                        mpn : $('#mpn').val(),
                        spn : $('#spn').val(),
                        remark : $('#remark').val()
                    },
                    success:function(data) {
                        if(data == 'error') {
                            alert("Failed!");
                        } else {
                            //alert("Success!");
                            let $target = $('#dxfLista').children().eq(1);
                            //let no = t.rows().count() + 1;
                            t.row.add([$('#qty').val(), '<a href="javascript:;">' + $('#parts').val() + '</a>', $('#description').val(), $('#package').val(), $('#productor').val(), $('#mpn').val(), $('#spn').val(), $('#remark').val(), '<button class="btn btn-success" id="modify-' + data + '"> Modify </button>', '<button class="btn btn-danger" id="delete-' + data + '"> Delete </button>']).draw(false);
                            $('#create-cancel-btn').click();
                        }
                    }
                })
            }
        });

        document
        .querySelector('#dxfLista tbody')
        .addEventListener('click', function (e) {
            if(e.target.id) {
                var ids = e.target.id.split('-');
                if(ids[0] == 'modify') {
                    let $elem = $(e.target).parent().siblings();
                    let qty = $elem.eq(0).text();
                    let parts = $elem.eq(1).text();
                    let description = $elem.eq(2).text();
                    let package = $elem.eq(3).text();
                    let productor = $elem.eq(4).text();
                    let mpn = $elem.eq(5).text();
                    let spn = $elem.eq(6).text();
                    let remark = $elem.eq(7).text();
                    $('#edit-id').val(ids[1]);
                    $('#edit-qty').val(qty);
                    $('#edit-parts').val(parts);
                    $('#edit-description').val(description);
                    $('#edit-package').val(package);
                    $('#edit-productor').val(productor);
                    $('#edit-mpn').val(mpn);
                    $('#edit-spn').val(spn);
                    $('#edit-remark').val(remark);
                    $('#edit-modal-btn').click();
                } else if(ids[0] == 'delete') {
                    $('#del-id').val(ids[1]);
                    $('#del-modal-btn').click();
                }
            }
        });

        $('#update-btn').click(function() {
            if(!$('#edit-qty').val() || !$('#edit-parts').val()) {
                alert('You are missing something!');
            } else {
                $.ajax({
                    url: '../app/list/update.php',
                    type: 'post',
                    data: {
                        id : $('#edit-id').val(),
                        qty : $('#edit-qty').val(),
                        parts : $('#edit-parts').val(),
                        description : $('#edit-description').val(),
                        package : $('#edit-package').val(),
                        productor : $('#edit-productor').val(),
                        mpn : $('#edit-mpn').val(),
                        spn : $('#edit-spn').val(),
                        remark : $('#edit-remark').val()
                    },
                    success:function(data) {
                        if(data != 'error') {
                            //alert('Success!');
                            let idName = 'modify-' + data;
                            let $elem = $('#' + idName).parent().siblings();
                            $elem.eq(0).text($('#edit-qty').val());
                            $elem.eq(1).children().eq(0).text($('#edit-parts').val());
                            $elem.eq(2).text($('#edit-description').val());
                            $elem.eq(3).text($('#edit-package').val());
                            $elem.eq(4).text($('#edit-productor').val());
                            $elem.eq(5).text($('#edit-mpn').val());
                            $elem.eq(6).text($('#edit-spn').val());
                            $elem.eq(7).text($('#edit-remark').val());
                            $('#update-close-btn').click();
                        } else alert('Failed!');
                    }
                })
            }
        });

        $('#del-ok-btn').click(function() {
            $.ajax({
                url: '../app/list/delete.php',
                type: 'post',
                data: {
                    id : $('#del-id').val()
                },
                success:function(data) {
                    if(data != 'error') {
                        $('#del-cancel-btn').click();
                        let idName = 'delete-' + data;
                        $('#' + idName).parent().parent().remove();
                    }
                    else alert('Failed!');
                }
            })
        });

		$('#zip').click(function()
        {
        
        var param =  <?php echo $iddxftes; ?>;
            $.ajax(
                    {  
                        url: "../app/main/lista_pdf.php",
                        type: "post",
                        data: { iddxftes: param
                        },
                        beforeSend: function(result) {
                            $('#msg').html('Archivio Zip "<?php echo $moduleName; ?>.zip" in elaborazione, attendere...');
                            $('#exampleModalCenter').modal('show');
                            }
                    }
                ).done( function() {
                        $('#exampleModalCenter').modal('hide');
                        window.location = 'dxfzipper.php?id=<?php echo $moduleName;?>';
                    }
                );
        });
							     
								 
		$('#euro').click(function()
        {
        
        var param =  <?php echo $iddxftes; ?>;
            $.ajax(
                    {  
                        url: "./app/main/lista_pdf.php",
                        type: "post",
                        data: { iddxftes: param,
                                euro: '1'
                        },
                        beforeSend: function(result) {
                            $('#msg').html('Lista costi "<?php echo $descrizione; ?>" in elaborazione, attendere...');
                            $('#exampleModalCenter').modal('show');
                            },
                        success: function(result) {
                            $('#exampleModalCenter').modal('hide');
                            window.open('./data/<?php echo $moduleName; ?>/<?php echo $moduleName; ?>_lista_costi.pdf','_blank');	
                            }
                    }
                );
        });
        
        } );						 

</script>