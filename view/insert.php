<br>   
	<div class="m-5 p-5">
		<h1 class="text-info text-center">Add New Main List</h1>
        <div class="form-group">
			
			<div class="input-group mb-3">
			  <div class="input-group-prepend">
				<span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
			  </div>
			  <div class="custom-file">
				<input multiple type="file" class="custom-file-input" id="input_XLSX" name="input_XLSX" accept=".xlsx"  aria-describedby="inputGroupFileAddon01">
				<label class="custom-file-label" for="input_XLSX" id="textinput_XLSX" >Scegli la Lista Excel</label>
			  </div>
			</div>
			
        </div>
        <!-- <div class="form-group">

			<div class="input-group mb-3">
			  <div class="input-group-prepend">
				<span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
			  </div>
			  <div class="custom-file">
				<input webkitdirectory directory multiple type="file" class="custom-file-input" id="input_DXF" name="input_DXF[]"  aria-describedby="inputGroupFileAddon02">
				<label class="custom-file-label" for="input_DXF" id="textinput_DXF">Scegli la cartella DXF</label>
			  </div>
			</div>
			
        </div> -->

		<div class="form-row mb-3">
		
			<div class="input-group">
				<div class="input-group-prepend ml-1">
				  <div class="input-group-text"id="inputCodice" >Item:</div>
				</div>
				<input type="text" class="form-control" id="Codice" name="codice" placeholder="Code" aria-describedby="inputCodice" required>
				
				<div class="input-group-prepend ml-2">
				  <div class="input-group-text">Version:</div>
				</div>
				<input type="text" class="form-control mr-2" id="Versione" name="versione" placeholder="Version" required>
				
				<div class="input-group-prepend">
				  <div class="input-group-text">Description:</div>
				</div>
				<input type="text" class="form-control mr-1" id="descrizione" name="descrizione" placeholder="Description" required>				
			</div>
		
		</div>
		<div class="d-flex justify-content-between">
			<button id="getTable" class="btn btn-success">Insert</button>
			<button class="btn btn-secondary" onclick="window.location.reload()">Back</button>
		</div>

        <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="modal_insertTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_insertTitle">EBOARD Manager</h5>
            </div>
            <div class="modal-body" id="msg_insert">
            
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
        </div>
</div>
	
	<div id='riempi_ins'></div>	
	
	
   <script type="text/javascript">
       $(document).ready(function() {
			$('#getTable').on('click', function () {
				if($('#input_XLSX').val()) {
					if($('#Codice').val()=='' ||  $('#Versione').val()=='' ||  $('#descrizione').val()=='')
					{
						alert('Item, Version or Description invalid.');
						return;
					}
				} else {
					alert('File missing!');
					return;
				}
				if($('#Codice').val()=='' ||  $('#Versione').val()=='' ||  $('#descrizione').val()=='')
				{
					alert('Item, Version or Description invalid.');
					return;
				}
				
				var form_data = new FormData();
				
				form_data.append("input_XLSX", document.getElementById('input_XLSX').files[0]);
				form_data.append("code", $('#Codice').val());
				form_data.append("version", $('#Versione').val());
				form_data.append("description", $('#descrizione').val());
				// Display the key/value pairs
				for (var pair of form_data.entries()) {
					console.log(pair[0]+ ', ' + pair[1]);
				}
				$.ajax({
					url: '../app/main/new_dxflist.php', 
					processData: false,
					contentType: false,
					cache: false,
					data: form_data,
					type: 'post',
					beforeSend:function () {
						$('#msg_insert').html('Lista <b><i>'+$('#Codice').val()+' - '+$('#descrizione').val()+'</i></b> in uploading, waiting...');
						$('#modal_insert').modal('show'); // display success response from the PHP script
					},
					success: function (response) {
						//$('#modal_insert').modal('hide');
						//$('#riempi_ins').html(response); // display success response from the PHP script
						window.location.reload();
					},
					statusCode: {
						502: function () {
							setTimeout(function(){
								$('#modal_insert').modal('hide');
								$('#riempi_ins').html(response); // display success response from the PHP script
							}, 30000);
						}
					}
				});
			
			});
			

		$('#input_XLSX').change(function(){
			
			var filename =  document.getElementById('input_XLSX').files[0].name;
			
			$('#textinput_XLSX').html(filename);
			
		});
		
			
			
		});
    </script>
