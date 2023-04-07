  <div class="row">
    <div class="col-md-2">
      <label class="label" style="float: right;">Excise Duty Reg</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text" id="exciseduty" name="exciseduty" class="form-control" placeholder="Enter Ledger Excise Duty Reg">
    </div>
    </div>
    <div class="col-md-2">
      <label class="label" style="float: right;">Address1</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text"  id="address1" name="address1" class="form-control" placeholder="Enter Address1">
    </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-2">
      <label class="label" style="float: right;">PAN</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text" id="pan" name="pan" class="form-control" placeholder="Enter PAN" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
      <span class="text-danger" id="pancheck">Enter Pan Number (ABCDE1234F)</span>
    </div>
    </div>
    <div class="col-md-2">
      <label class="label" style="float: right;">Address2</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text"  id="address2" name="address2" class="form-control" placeholder="Address2">
    </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-2">
      <label class="label" style="float: right;">TIN No</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="number" id="tin" name="tin" class="form-control" placeholder="Enter TIN No" onkeydown="javascript: return event.keyCode == 69 ? false : true">
    </div>
    </div>
    <div class="col-md-2">
      <label class="label" style="float: right;">Address3</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text"  id="address3" name="address3" class="form-control" placeholder="Address3">
    </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-2">
      <label class="label" style="float: right;">Service Tax</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="number" id="servicetax" name="servicetax" class="form-control" placeholder="Enter Service Tax" onkeydown="javascript: return event.keyCode == 69 ? false : true">
    </div>
    </div>
    <div class="col-md-2">
      <label class="label" style="float: right;">Address4</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text"  id="address4" name="address4" class="form-control" placeholder="Address4">
    </div>
    </div>
  </div>

    <div class="row">
    <div class="col-md-2">
      <label class="label" style="float: right;">Contact Person</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="text" id="contactperson" name="contactperson" class="form-control" placeholder="Enter Contact Person">
    </div>
    </div>
    <div class="col-md-2">
      <label class="label" style="float: right;">Contact Number</label>
    </div>
    <div class="col-md-3">
      <div class="form-group">
      <input type="number"  id="contactnumber" name="contactnumber" class="form-control" placeholder="Enter Contact Number" onkeydown="javascript: return event.keyCode == 69 ? false : true" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
    </div>
    </div>
  </div>

<script type="text/javascript">
// Validate pan
$(document).ready(function () {
$('#pancheck').hide();  
let panError = true;
$('#pan').keyup(function () {     
  this.value = this.value.toUpperCase();
  validatepan();
});

function validatepan() {
  let panValue = $('#pan').val();
  var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;

  if (!(panValue.match(regpan))) {
  $('#pancheck').show();
  panError = false;
    return false;
  }
  else if(panValue.length == '')
  {
    $('#pancheck').hide();
    panError = true;
  }
  else 
  {
    $('#pancheck').hide();
    panError = true;
  }
  }


});

  </script>