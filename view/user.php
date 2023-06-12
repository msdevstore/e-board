<head>
    <title>E-BOARD MANAGER</title>
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/dxf/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/brands.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/solid.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" >
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" ></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<!-- Font CSS-->
</head>
<body>
    <div>
    <?php session_start();
     include "./layouts/nav.php";?>
        <div class="header">
            <h1 class="logo text-secondary p-5 display-3" style="margin-block-end: 0px; text-align: center">User Table</h1>
            <div class="d-flex justify-content-between p-3">
                <a class="btn btn-primary ml-3 text-white" data-toggle="modal" data-target="#addModal">Add User</a>
                <a class="btn btn-info mr-3 text-white" onclick="window.history.back()">Return</a>
            </div>
        </div>
        <div class="px-4">
            <?php 

            ?>
            <table id="table_id" class="table table-hover table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th style="width: 100px">Reset Password</th>
                        <th style="width: 100px">Edit</th>
                        <th style="width: 100px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 0;
                    $con=mysqli_connect("localhost","root","","eboard");
                    $result = mysqli_query($con, "SELECT * FROM users");
                    if ($result->num_rows > 0) {
                        while($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                                echo "<td>" . ++$i . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['code'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td key=".$row['role'].">";
                                switch($row['role']) {
                                    case 0: echo 'Admin'; break;
                                    case 1: echo 'Designer'; break;
                                    case 2: echo 'User'; break;
                                    default: echo 'User';
                                }
                                echo "</td>";
                                echo "<td><button class='btn btn-info' id='reset-".$row['id']."'> <i class='fa fa-key'></i> </button></td>";
                                echo "<td><button class='btn btn-success' id='modify-".$row['id']."'> <i class='fa fa-pencil-alt'></i> </button></td>";
                                echo "<td><button class='btn btn-danger' id='delete-".$row['id']."'> <i class='fa fa-trash-alt'></i> </button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo 'No user!';
                    }

                    ?>
                </tbody>
            </table>
        </div>
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pl-5 pr-5">
            <form>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Name</span>
                    </div>
                    <input type="text" class="form-control" id="name" placeholder="John Smith">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Code</span>
                    </div>
                    <input type="text" class="form-control" id="code" placeholder="F0123">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Username</span>
                    </div>
                    <input type="text" class="form-control" id="username" placeholder="angel003">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Role</span>
                    </div>
                    <select type="text" class="form-control" id="role" placeholder="08/18/2001">
                        <option value="2">User</option>
                        <option value="1">Designer</option>
                        <option value="0">Admin</option>
                    </select>
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
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body pl-5 pr-5">
            <form>
                <input type="hidden" id="edit-index">
                <input type="hidden" id="edit-id">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Name</span>
                    </div>
                    <input type="text" class="form-control" id="edit-name" placeholder="John Smith">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Code</span>
                    </div>
                    <input type="text" class="form-control" id="edit-code" placeholder="F0123">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Username</span>
                    </div>
                    <input type="text" class="form-control" id="edit-username" placeholder="angel003">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 150px;">Role</span>
                    </div>
                    <select type="text" class="form-control" id="edit-role" placeholder="08/18/2001">
                        <option value="2">User</option>
                        <option value="1">Designer</option>
                        <option value="0">Admin</option>
                    </select>
                </div>
            </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="edit-btn">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="edit-cancel-btn">Close</button>
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
            <input type="hidden" id="del-index">
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
  <!-- The Modal -->
  <div class="modal fade" id="resetModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            Are you sure you want to reset password?
            <input type="hidden" id="reset-index">
            <input type="hidden" id="reset-id">
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="reset-ok-btn">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="reset-cancel-btn">No</button>
        </div>
        
      </div>
    </div>
  </div>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resetModal" style="display: none" id="reset-modal-btn">
    Open modal
  </button>
       
    </div>
    <script>
        $(document).ready(function() {
            var t = $('#table_id').DataTable(
                {
                "dom": 'Blfrtip',
                "order": [[ 0, "asc" ]]
                }
            );


            $('#create-btn').click(function() {
                let name = $('#name').val();
                let code = $('#code').val();
                let username = $('#username').val();
                let role = $('#role').val();
                if(!name | !code | !username) alert('Please input all information!');
                else {
                    $.ajax({
                        url: '../app/user/create.php',
                        type: 'post',
                        data: {
                            name : name,
                            code : code,
                            username : username,
                            role : role
                        },
                        success:function(data) {
                            if(data == 'error1') alert('Username is already taken!');
                            else if(data == 'error2') alert('Failed!');
                            else {
                                let roleName = 'User';
                                switch(role) {
                                    case '0': roleName = 'Admin'; break;
                                    case '1': roleName = 'Designer'; break;
                                    case '2': roleName = 'User'; break;
                                    default: roleName = 'User';
                                }
                                t.row.add([t.rows().count() + 1, name, code, username, roleName, "<button class='btn btn-info' id='reset-" + data + "'> <i class='fa fa-key'></i> </button>", "<button class='btn btn-success' id='modify-" + data + "'> <i class='fa fa-pencil-alt'></i> </button>", "<button class='btn btn-danger' id='delete-" + data + "'> <i class='fa fa-trash-alt'></i> </button>"]).draw(false);
                                $('#create-cancel-btn').click();
                                $('#name').val('');
                                $('#code').val('');
                                $('#username').val('');
                                $('#role').val('2');
                            }
                        }
                    })
                }
            });
        document
        .querySelector('#table_id tbody')
        .addEventListener('click', function (e) {
            if(e.target.id) {
                var ids = e.target.id.split('-');
                if(ids[0] == 'modify') {
                    let $elem = $(e.target).parent().siblings();
                    let index = $elem.eq(0).text();
                    let name = $elem.eq(1).text();
                    let code = $elem.eq(2).text();
                    let username = $elem.eq(3).text();
                    let role = $elem.eq(4).attr('key');
                    $('#edit-index').val(index);
                    $('#edit-id').val(ids[1]);
                    $('#edit-name').val(name);
                    $('#edit-code').val(code);
                    $('#edit-username').val(username);
                    $('#edit-role').val(role);
                    $('#edit-modal-btn').click();
                } else if(ids[0] == 'delete') {
                    let $elem = $(e.target).parent().siblings();
                    let index = $elem.eq(0).text();
                    $('#del-index').val(index);
                    $('#del-id').val(ids[1]);
                    $('#del-modal-btn').click();
                } else if(ids[0] == 'reset') {
                    $('#reset-id').val(ids[1]);
                    $('#reset-modal-btn').click();
                }
            }
        });
            $('#edit-btn').click(function() {
                let id = $('#edit-id').val();
                let name = $('#edit-name').val();
                let code = $('#edit-code').val();
                let username = $('#edit-username').val();
                let role = $('#edit-role').val();
                if(!name | !code | !username) {
                    alert('Please input all information!');
                } else {
                    $.ajax({
                        url: '../app/user/update.php',
                        type: 'post',
                        data: {
                            id: id,
                            name: name,
                            code: code,
                            username: username,
                            role: role
                        },
                        success:function(data) {
                            switch(role) {
                                case '0': roleName = 'Admin'; break;
                                case '1': roleName = 'Designer'; break;
                                case '2': roleName = 'User'; break;
                                default: roleName = 'User';
                            }
                            if(data == 'error1') alert('Username is already taken!');
                            else if(data == 'error2') alert('Failed!');
                            else {
                                $('#edit-cancel-btn').click();
                                let newData = [$('#edit-index').val(), name, code, username, roleName, "<button class='btn btn-info' id='reset-" + data + "'> <i class='fa fa-key'></i> </button>", "<button class='btn btn-success' id='modify-" + data + "'> <i class='fa fa-pencil-alt'></i> </button>", "<button class='btn btn-danger' id='delete-" + data + "'> <i class='fa fa-trash-alt'></i> </button>"];
                                t.row( $('#edit-index').val() - 1 ).data( newData ).draw();
                            }
                        }
                    })
                }
            });
            $('#del-ok-btn').click(function() {
                $.ajax({
                    url: '../app/user/delete.php',
                    type: 'post',
                    data: {
                        id: $('#del-id').val()
                    },
                    success:function(data) {
                        if(data == 'failed') alert('Failed!');
                        else {
                            $('#del-cancel-btn').click();
                            t.row( $('#del-index').val() - 1 ).remove().draw();
                        }
                    }
                })
            });
            $('#reset-ok-btn').click(function() {
                $.ajax({
                    url: '../app/user/reset.php',
                    type: 'post',
                    data: {
                        id: $('#reset-id').val()
                    },
                    success:function(data) {
                        if(data == 'failed') alert('Failed!');
                        else {
                            $('#reset-cancel-btn').click();
                            alert('Password is changed into "000" successfully!');
                        }
                    }
                })
            })
        })
    </script>
</body>
        