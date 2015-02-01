$.validator.addMethod('currency', function(value, element, regexp) {
    var re = /^\d{1,9}(\.\d{1,2})?$/;
    return this.optional(element) || re.test(value);
}, '');

$.validator.addMethod("valueNotDefaults", function(value, element, arg){
  return arg != value;
 }, "Value must not equal arg.");

/*$('#content').on("click", "", function(obj){
	console.clear();
	console.log(obj);
	console.log($(this).parents("form"));
	var formulario = $(this).parents("form").validate();
	if(formulario.checkForm()){
		alert('guardando');
	}else{
		alert('Error');
	}
	alert('Ha echo click');
});*/