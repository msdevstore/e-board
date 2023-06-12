<?php

    $con=mysqli_connect("localhost","root","","eboard");
    mysqli_set_charset($con, 'utf8');
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br />";
    }

    $result = mysqli_query($con, "SELECT * FROM ebs");
    
    if (!mysqli_num_rows($result))
        echo('<br />
        <br />
        <center>
        <h1 class="text-secondary">E-Board list</h1>
        </center>
        <div class="row m-5">
        <a href="javascript:;" id="insert"><svg xmlns="http://www.w3.org/2000/svg" style="fill: #007bff;" width="48" height="48" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg></a>
        </div>
        <center>
            <h5>No records...</h5>
        </center>
        ');
    else {
    echo '
    <br />
    <br />
    <center>
    <h1 class="text-secondary">E-Board list</h1>
    </center>
    <div class="row mr-5 mb-5 float-right">';
    if($_SESSION['role'] != 2) echo '<a href="javascript:;" id="insert"><svg xmlns="http://www.w3.org/2000/svg" style="fill: #007bff;" width="48" height="48" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 13h-5v5h-2v-5h-5v-2h5v-5h2v5h5v2z"/></svg></a>';
    echo '</div>
    <table id="ebTable" class="table table-striped table-bordered" style="margin-left: auto; margin-right: auto; ">
    <thead>
        <tr>
            <th>Item</th>
            <th>Version</th>
            <th>Description</th>
            <th>Last Updates</th>
            <th>Status</th>
            <th>Modify</th>
            <th>Delete</th>
        </tr>
    </thead>'
    ;
    echo "<tbody>";
    while($row = mysqli_fetch_array($result)) 
    {
        
        switch ($row['status']) {
            case 0:
                $status = '<button type="button" class="btn btn-danger">In review</button>';
                break;
            case 1:
                $status = '<button type="button" class="btn btn-success">All datas available</button>';
                break;
            case 2:
                $status = '<button type="button" class="btn btn-secondary">Deprecate</button>';
                break;
            default:
                $status = '<button type="button" class="btn btn-warning">Partial data</button>';
                break;
        }
        
        echo "<tr>";
            echo "<td><a href='#' class='ebItem' key=".$row['id']." id='". $row['item_code']. "_" . $row['version'] ."'>" . $row['item_code']. "_" . $row['version'] . "</a></td>";
            echo "<td>" . $row['version'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td  data-sort=".  strtotime($row['last_update']) .">" . date('d-m-Y H:i',strtotime($row['last_update'])) . "</td>";
            echo "<td class='text-center'>" . $status . "</td>";
            echo "<td class='text-center'><a href='javascript:;' style='font-size: 36px; color:black' onclick='edit(".$row['id'].")'><i class='fa fa-pencil-alt'></i></a></td>";
            echo "<td class='text-center'><a href='javascript:;' style='font-size: 36px; color:black' onclick='del(".$row['id'].")'><i class='fa fa-trash-alt'></i></a></td>";
        echo "</tr>";
    };
    echo "</tbody>";
    echo "</table>";
    }

    mysqli_close($con);
      
  ?>
    <!-- The Modal -->
  <div class="modal fade" id="delMainModal">
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
            <input type="hidden" id="delMain-id">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="delMain-ok-btn">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="delMain-cancel-btn">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delMainModal" style="display: none" id="delMain-modal-btn">
    Open modal
  </button>
    <!-- The Modal -->
  <div class="modal fade" id="editMainModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Description</span>
                    </div>
                    <input type="text" class="form-control" id="main-description">
                </div>
                <input type="hidden" id="editMain-id">
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="editMain-ok-btn">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="editMain-cancel-btn">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editMainModal" style="display: none" id="editMain-modal-btn">
    Open modal
  </button>

  <div id='riempi'></div>
  <div id='fileview'>
  </div>

    <br />
    <br />

  <script type="text/javascript">

    $(document).ready(function() {
        $('#ebTable').DataTable(
                    {
            "order": [[ 3, "desc" ]],
            "lengthMenu": [[25, 50, -1], [25, 50, "All"]]	
            }	
        );
    });

    function edit(id) {
        $('#editMain-id').val(id);
        $.ajax({
            url: '../app/main/edit.php',
            type: 'post',
            data: {
                id : id
            },
            success:function(data) {
                if(data != 'error') {
                    $('#main-description').val(data);
                    $('#editMain-modal-btn').click();
                } else {
                    alert('Failed!');
                }
            }
        })
        
    }

    $('#editMain-ok-btn').click(function() {
        $.ajax({
            url: '../app/main/update.php',
            type: 'post',
            data: {
                id : $('#editMain-id').val(),
                description : $('#main-description').val()
            },
            success:function(data) {
                if(data != 'error') {
                    window.location.reload();
                }else {
                    alert('Failed!');
                }
            }
        })
    })

    function del(id){
        $('#delMain-id').val(id);
        $('#delMain-modal-btn').click();
    }

    $('#delMain-ok-btn').click(function() {
        $.ajax({
            url: "../app/main/delete.php",
            type: "post",
            data: {
                id : $('#delMain-id').val()
            },
            success:function(data) {
                if(data) {
                    $('#delMain-cancel-btn').click();
                    window.location.reload();
                }
                else alert("Failed!");
            }
        })
    });
    var t;
    $(".ebItem").click(function()
    {
    let param =  $(this).attr("key");
    let tempId = $(this).attr("id");
    localStorage.setItem("code", tempId);
    let code = $(this).text();
    $.ajax(
        {  
        url: "details.php",
        type: "POST",
        data: { iddxftes: param
        },
        success: function(response)

                        {
                        $('#riempi').html('');
                        $("#riempi").html(response);
                        t = $('#dxfLista').DataTable(
                                        {
                                        "dom": 'Blfrtip',
                                        "buttons": [ 'excel', 'pdf', 'copy' ],
                                        "order": [[ 1, "asc" ]]
                                        }
                        );
                        } 
        }
        );

        $.ajax(
        {  
        url: "./treetable.php",
        type: "POST",
        data: {
            code : code
        },
        success: function(response) {
            $('#fileview').html(response);
        }
        });
    });
                                  
    $("#insert").click(function() {
        $.ajax(
        {  
        url: "./insert.php",
        type: "POST",
        success: function(response) {
            $('#main').html(response);
        }
        });
    });    

    const downloadFile = (dataUrl, filename) => {
        const link = document.createElement("a");
        link.href = dataUrl;
        link.download = filename;
        link.click();
        link.remove();
    };

    let history = localStorage.getItem("code");
    if(history) {
        if($('a#' + history)) {
            $('a#' + history).click();
        }
    }
                                  
  </script>
