<?php include('includes/db_connect.php'); ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM borrowers where id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-borrower">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Last Name</label>
						<input name="lastname" class="form-control" id="inputLname" value="<?php echo isset($lastname) ? $lastname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">First Name</label>
						<input name="firstname" class="form-control" id="inputFname" value="<?php echo isset($firstname) ? $firstname : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Middle Name</label>
						<input name="middlename" class="form-control" id="inputMname" value="<?php echo isset($middlename) ? $middlename : '' ?>">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Company Name</label>
						<input name="companyname" class="form-control" id="inputCname" value="<?php echo isset($companyname) ? $companyname : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Address</label>
							<textarea name="address" id="inputAdd" cols="30" rows="2" class="form-control" required=""><?php echo isset($address) ? $address : '' ?></textarea>
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">Contact #</label>
						<input type="text" class="form-control" name="contact_no" id="inputCont" value="<?php echo isset($contact_no) ? $contact_no : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
							<label for="">Email</label>
							<input type="email" class="form-control" name="email" id="inputEmail" value="<?php echo isset($email) ? $email : '' ?>">
				</div>
				<div class="col-md-5">
					<div class="">
						<label for="">ID Number</label>
						<input type="text" class="form-control" name="id_number" id="inputNid" value="<?php echo isset($id_number) ? $id_number : '' ?>">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	 $('#manage-borrower').submit(function(e){
	 	e.preventDefault()
	 	start_load()
		var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		var lname = $('#inputLname').val();
		var fname = $('#inputFname').val();
		var mname = $('#inputMname').val();
		var cname = $('#inputCname').val();
		var addr = $('#inputAdd').val();
		var cont = $('#inputCont').val();
		var email = $('#inputEmail').val();
		var idnr = $('#inputNid').val();
		if(lname.trim() == '' ){
			alert('Please enter their lastname.');
			$('#inputLname').focus();
			return false;
		}else if(fname.trim() == '' ){
			alert('Please enter their firstname.');
			$('#inputFname').focus();
			return false;
		}else if(mname.trim() == '' ){
			alert('Please enter their middlename.');
			$('#inputMname').focus();
			return false;
		}else if(cname.trim() == '' ){
			alert('Please enter the companyname.');
			$('#inputCname').focus();
			return false;
		}else if(addr.trim() == '' ){
			alert('Please enter their addres.');
			$('#inputAdd').focus();
			return false;
		}else if(cont.trim() == '' ){
			alert('Please enter their phone nr.');
			$('#inputCont').focus();
			return false;
		}else if(email.trim() == '' ){
			alert('Please enter their email.');
			$('#inputEmail').focus();
			return false;
		}else if(email.trim() != '' && !reg.test(email)){
			alert('Please enter valid email.');
			$('#inputEmail').focus();
			return false;
		}else if(idnr.trim() == '' ){
			alert('Please enter their id number.');
			$('#inputNid').focus();
			return false;
		}else{
			$.ajax({
				url:'ajax.php?action=save_borrower',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						alert_toast("Borrower data successfully saved.","success");
						setTimeout(function(e){
							location.reload()
						},1500)
					}
				}
			})
		}
	 })
</script>