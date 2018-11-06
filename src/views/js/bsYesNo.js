$(function() {    
    $(".switchyesno").bootstrapSwitch();
    /*
	$('.switchyesno').on('switchChange.bootstrapSwitch', function(e, state) {
        $this=$(this);
		//alert($this.val());
        //console.log(e);
		if (e.target.checked == true) {
    		$value = '1';
    		//$('input.prop_state').val($value);
            $this.val($value);
		} else {
    		$value = '0';
    		//$('input.prop_state').val($value);
            $this.val($value);    
		}
        
	});
    //*/
});    