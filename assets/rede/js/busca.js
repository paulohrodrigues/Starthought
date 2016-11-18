function busca(){
	var busca = $("#busca").val();

	//alert(busca);
	if(busca != ""){
		$.get("/busca",{"pesquisa":busca},function(retorno){
			var usuarios=JSON.parse(retorno);
			usuario=" ";
			//alert("entrou");
			for (value in usuarios) {
				usuario +=  '<div class=""  style="width: 300px; border:8px; padding:15px; background: #EBEBEB;"> <img src="http://localhost:8989/assets/rede/img/user/'+usuarios[value].foto +
				'" alt="" width="50" height="50" style="border-radius: 30px;  float:left; margin:0 10px 10px 0;"> ';
				usuario += '<p style="text-decoration: none;color: #F1BB04; font: 12px">' + usuarios[value].nome  +"</p></div>";
			}

			$('#pesquisa').html(usuario);	
			$("#pesquisa").mouseleave(function(){
        		$('#pesquisa').html(" ");	
    		});
		});
	
	}else {
		$('#pesquisa').html(" ");	
	}
}


function buscaMinhasEscritas(){
	var busca = $("#buscaE").val();

	//alert(busca);
	if(busca != ""){
		$.get("/buscaMinhasEscritas",{"pesquisa":busca},function(retorno){
			var escritos=JSON.parse(retorno);
			escrito=" ";
			//alert("entrou");

			$('#pesquisaE').val("");

			for (value in escritos) {
				escrito += '<a href="#section1" class="meustextos">' + escritos[value].titulo  +"<br></a>";
			}

			$('#pesquisaE').html(escrito);	

		});
	}
	// }else {
	// 	$('#pesquisaE').html(" ");	
	// }
}
