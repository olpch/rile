$('#content').on("click", "", function(obj){
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
});