	
	/*Para CLinica*/
	function activa_consulta(idconsulta,valor,idpsicologo){
		if(idconsulta!=''){
			$.ajax({
				async:true,
				type: "POST",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"../../consulta/activa_consulta",
				data:{"idconsulta":idconsulta,"valor":valor,"idpsicologo":idpsicologo},
					success:function(datos){
						if(datos=='ingresado'){
							var $toast = toastr["success"]("Tipo de consulta agreada.", "Tipo de Consulta"); 
					        $toastlast = $toast;						
						}else{
							var $toast = toastr["warning"]("Tipo de consulta retirado", "Tipo de Consulta"); 
					        $toastlast = $toast;						
						}

	        			//setTimeout(function(){$('#modal_psicologo').modal('hide');}, 3000);
					},
					error: function(){
						console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
					}
			})	
		}else{
		 	setTimeout(function(){$(des).css('border-color','red');}, 1000);
			var $toast = toastr["warning"]("Actualización tipo consulta", "Ingrese una descripción."); // Wire up an event handler to a button in the toast, if it exists
	        $toastlast = $toast;		
		}
	}
	function agregar_consulta(){
		var des = $("#tpconsulta").val();
		if(des!=''){
			$.ajax({
				async:true,
				type: "POST",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"consulta/agregar_consulta",
				data:{"des":des},
					success:function(datos){
						if(datos==1){
							//var des = "#txt_consulta"+id;
		        			//setTimeout(function(){$(des).css('border-color','green');}, 1000);
		        			//$("#msgaddconsulta").text('Msg: último tipo de consulta agregado - ' + des);
		        			//setTimeout(function(){$("#tpconsulta").val('');}, 2000);
            				setTimeout(function(){ location.reload(true); }, 1500);
							var $toast = toastr["success"]("Agregado Correctamente.", "Datos Agregados."); // Wire up an event handler to a button in the toast, if it exists
					        $toastlast = $toast;						
						}else{
							var $toast = toastr["warning"]("Hubo un error", "No se pudo Agregar."); // Wire up an event handler to a button in the toast, if it exists
					        $toastlast = $toast;						
						}

	        			//setTimeout(function(){$('#modal_psicologo').modal('hide');}, 3000);
					},
					error: function(){
						console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
					}
			})	
		}else{
		 	setTimeout(function(){$(des).css('border-color','red');}, 1000);
			var $toast = toastr["warning"]("Actualización tipo consulta", "Ingrese una descripción."); // Wire up an event handler to a button in the toast, if it exists
	        $toastlast = $toast;		
		}
	}

	function actualizar_consulta(id){
		var des = "#txt_consulta"+id;
		var des = $(des).val();
		if(des!=''){
			$.ajax({
				async:true,
				type: "POST",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"consulta/actualiza_consulta",
				data:{"id":id,"des":des},
					success:function(datos){
						if(datos==1){
							var des = "#txt_consulta"+id;
		        			setTimeout(function(){$(des).css('border-color','green');}, 1000);
		        			setTimeout(function(){$(des).css('border-color','black');}, 3000);
							var $toast = toastr["success"]("Actualización tipo consulta.", "Datos actualizados."); // Wire up an event handler to a button in the toast, if it exists
					        $toastlast = $toast;						
						}else{
							var $toast = toastr["warning"]("Actualización tipo consulta", "No se pudo actualizar."); // Wire up an event handler to a button in the toast, if it exists
					        $toastlast = $toast;						
						}

	        			//setTimeout(function(){$('#modal_psicologo').modal('hide');}, 3000);
					},
					error: function(){
						console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
					}
			})	
		}else{
		 	setTimeout(function(){$(des).css('border-color','red');}, 1000);
			var $toast = toastr["warning"]("Actualización tipo consulta", "Ingrese una descripción."); // Wire up an event handler to a button in the toast, if it exists
	        $toastlast = $toast;		
		}

	}

	function get_filtro(fin,ini){
		$.ajax({
			async:true,
			type: "POST",
			cache: false,
			contentType:"application/x-www-form-urlencoded",
			url:"consulta/get_filtro",
			data:{"fin":fin,"ini":ini},
				success:function(datos){
					var json       = eval("(" + datos + ")");
				    $("#panel_consulta").html(json.cadena);
					//var $toast = toastr["success"]("Actualización", "Datos actualizados."); // Wire up an event handler to a button in the toast, if it exists
			        //$toastlast = $toast;
        			//setTimeout(function(){$('#modal_psicologo').modal('hide');}, 3000);
				},
				error: function(){
					console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
				}
		})
	}

	
	function actualizar_data(){
		var id = $("#pid").val();
		var no = $("#pnombres").val();
		var ap = $("#papellidos").val();
		var fe = $("#pfecha").val();
		var dn = $("#pdni").val();
		var ge = $("#pgenero").val();
		var ce = $("#pcelular").val();
		var co = $("#pcorreo").val();
		var di = $("#pdireccion").val();
		if(id!='' && ap!='' && fe!='' && dn!='' && ge!='' && ce!='' && co!='' && di!='' && no!=''){
			$.ajax({
				async:true,
				type: "POST",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"voucher/update_data",
				data:{"id":id,"ap":ap,"fe":fe,"dn":dn,"ge":ge,"ce":ce,"co":co,"di":di,"no":no},
					success:function(datos){
						var $toast = toastr["success"]("Actualización", "Datos actualizados."); // Wire up an event handler to a button in the toast, if it exists
				        $toastlast = $toast;
            			setTimeout(function(){$('#modal_psicologo').modal('hide');}, 3000);
					},
					error: function(){
						console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
					}
			})
		}		
	}

	function activa(id,valor){
			$.ajax({
				async:true,
				type: "POST",
				dataType:"json",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"voucher/set_status",
				data:{"id":id,"valor":valor},
					success:function(datos){
						if(datos != 'error'){
							toastr.options = {
				                closeButton: 1,
				                progressBar: 1,
				                onclick: null
				            };
				            var $toast = toastr["success"]("Realizado", "Actualización de Estdo"); // Wire up an event handler to a button in the toast, if it exists
				            $toastlast = $toast;
						}
					},
					error: function(){
						console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
					}
			})
	}
	/*Fin Clinica*/

	// Funciòn Modal cargar imagenes
	function funcionModal(imagen1,imagen2,imagen3,titulo){
		$('#tituloModal').html(titulo);
		
		
		var item1='<div class="item active"><img id="imagen01" src="http://localhost/panel/uploads/resize/'+imagen1+'_thumb.jpg" alt="item0"><div class="carousel-caption"></div></div>';
		var item2='<div class="item "><img id="imagen02" src="http://localhost/panel/uploads/resize/'+imagen2+'_thumb.jpg" alt="item0"><div class="carousel-caption"></div></div>';
		var item3='<div class="item "><img id="imagen03" src="http://localhost/panel/uploads/resize/'+imagen3+'_thumb.jpg" alt="item0"><div class="carousel-caption"></div></div>';
		//PRUEB AVANCE 
		if(imagen1=="sinimagen"){
			item1='';
		}else{
		}

		if(imagen2=="sinimagen"){
		item2='';
		}else{
		}

		if(imagen3=="sinimagen"){
		item3='';
		}else{
		}

		var concadena=item1+item2+item3;

		$('#imagenesSlider').html(concadena);

		// 


		// if(imagen1=="sinimagen"){
		// document.getElementById("imagen01").src="../"+"uploads/"+imagen1+".jpg";

		// }else{
		// document.getElementById("imagen01").src="../"+"uploads/"+imagen1;
		// }

		// if(imagen2=="sinimagen"){
		// document.getElementById("imagen02").src="../"+"uploads/"+imagen2+".jpg";
		// }else{
		// document.getElementById("imagen02").src="../"+"uploads/"+imagen2;
		// }

		// if(imagen3=="sinimagen"){
		// document.getElementById("imagen03").src="../"+"uploads/"+imagen3+".jpg";			
		// }else{
		// document.getElementById("imagen03").src="../"+"uploads/"+imagen3;			
		// }
		$('#myModal').modal('show');
	}

    function mostrarModal(response) {
        var resp = jQuery.parseJSON(response);
        $('#modalConfirm').modal('show');
        $('#titulomodal').text(resp.titulo);
        $('#mensajemodal').text(resp.mensaje);
        $('#rutamodal').attr('href', baseurl + resp.ruta);
    }
    function mostrarModalError(response) {
        var resp = jQuery.parseJSON(response);
        $('#modalError').modal('show');
        $('#titulomodale').text(resp.titulo);
        $('#mensajemodale').text(resp.mensaje);
    }
    function mostrarModalErrorVar(titulo, mensaje) {
        $('#modalError').modal('show');
        $('#titulomodale').text(titulo);
        $('#mensajemodale').text(mensaje);
    }


	function changeclass(ev){
		$(document).ready(function(e) {
			if(ev.className == "trvoucher selreg"){
				ev.className = 'trvoucher';
			}else{
				ev.className = 'trvoucher selreg';
			}
	    });
	}


// mensajes de validaciÃ³n para los formularios
jQuery(document).ready(function($) {
	
	


    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es requerido.",
        remote: "Por favor arregla este campo.",
        email: "Por favor, introduce una dirección de correo electrónico válida.",
        url: "Por favor, introduce una URL válida.",
        date: "Por favor, introduce una fecha válida.",
        dateISO: "Por favor, introduce una fecha válida (ISO).",
        number: "Por favor, introduce un número válido.",
        digits: "Por favor ingrese solo dígitos.",
        equalTo: "Por favor, introduzca el mismo valor de nuevo.",
        accept: "Introduzca un valor con una extensión válida.",
        maxlength: jQuery.validator.format("No ingrese más de {0} caracteres."),
        minlength: jQuery.validator.format("Introduzca al menos {0} caracteres."),
        rangelength: jQuery.validator.format("Introduzca un valor entre {0} y {1} caracteres."),
        range: jQuery.validator.format("Introduzca un valor entre {0} y {1}."),
        max: jQuery.validator.format("Ingrese un valor menor o igual a {0}."),
        min: jQuery.validator.format("Ingrese un valor mayor o igual a {0}.")
    });
});
// fin mensajes de validaciÃ³n para los formularios
var ini;
	ini = $(document);
	ini.ready(function(e) {

		/*Consultas x psicologo*/
		$('#tb_psicoxconsulta').DataTable();
		/**/


		$('#txtdesde').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			minDate:0,
			showAnim:'drop',
			onClose:function(dateText, inst){
                calcCantDias();
			}
		});
        /*lo uso*/
		function getdni(e){
			$.ajax(
				{
				async:true,
				type: "POST",
				dataType:"json",
				cache: false,
				contentType:"application/x-www-form-urlencoded",
				url:"/panel/voucher/resultpass",
				data:"dni="+e,
				success:function(datos){
					if(datos != 'error'){
						returndni(datos);
						calcularprecio();
					}
				},
				error: function(){
					console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
				}
				}
			)
        }
        /*lo uso*/
        $('#txtdni').focusout(function()
		{
			getdni($(this).val());
		});

		$('#idclicv').click(function()
		{
			$('#obsvou').submit();
		});

		$('#obvou').click(function(){
			var int=[];var i = 0;
			$('#divtabla input:checkbox').each(function(index, element) {
                if($(this).prop('checked') == true){
					int[i++] = $(this).val();
				}
            });
			if(int.length == 1){
				$('input[name="idvou"]').val(int[0]);
				clearselect();
				$('#obsvou').submit();
			}else{
				error_('Debe seleccionar un voucher para poder proceder',6000);
			}
		});

		/*$('#btnexpor').click(function(e){
			$('.clsexport').fadeIn('fast');
		});*/


		/*$('#btncancelar').click(function(e){
			$('.clsexport').fadeOut('fast');
		})*/
		/* lo uso */
		$('#txtfd').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			showAnim:'drop',
		});
		/* lo uso */
		$('#txtfh').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			showAnim:'drop',
		});
		/*lo uso*/
		function returndni(datos){
			$( "#cbonaci option" ).each(function(index, element) {
                if($(this).val() == datos[9]){
					$(this).attr("selected","selected");
				}
            });
			$( "#cbosexo option" ).each(function(index, element) {
                if($(this).val() == datos[4]){
					$(this).attr("selected","selected");
				}
            });
			//fecha NACIMIENTO
			var fecnac = datos[3].split('-');
			$('input[name="txtnombre"]').val(datos[0]);
			$('input[name="txtapellido"]').val(datos[1]);
			$('input[name="txtdomicilio"]').val(datos[2]);
			$('input[name="txttel"]').val(datos[5]);
			$('input[name="txttel2"]').val(datos[6]);
			$('input[name="txttel3"]').val(datos[7]);
			$('input[name="txtcorreo"]').val(datos[8]);
			$('input[name="txtpais"]').val(datos[10]);
			$('input[name="txtciudad"]').val(datos[11]);
			$('input[name="txtdistrito"]').val(datos[12]);
			$('input[name="txtname"]').val(datos[13]);
			$('input[name="txtlname"]').val(datos[14]);
			$('input[name="txtphone"]').val(datos[15]);
			$('input[name="txtnac"]').val(fecnac[2]+'/'+fecnac[1]+'/'+fecnac[0]);
		}

		

		function error_(mensaje,time)
		{
			$('.erroreg .clsresult').html(mensaje);
			$('.erroreg').fadeIn('slow');
			setTimeout(function(){$('.erroreg').fadeOut('slow');},time);
		}

		function calprecdplan(datos){
			$('#vpre').text(datos);
		}

		$('#btnmodpas').click(function(){

			$('#frmeditar').submit();

			clearselect();

		})

		$('#btnaddpre').click(function(){

			$('.cajainput').append('<tr><td><input type="text" name="txtcosto[]" class="clslarge" maxlength="6" style="text-align:center;"></td><td><input type="text" name="txtday[]" class="clslarge" maxlength="3" style="text-align:center;"></td></tr>');

		})

/*
		$('#obplan').click(function(){
			//$('#frmeditar').submit();
			var int=[];var i = 0;
			$('#divtabla input:checkbox').each(function(index, element) {
                if($(this).prop('checked') == true){
					int[i++] = $(this).val();
				}
            });
			//alert(int.length);
			if(int.length > 0){
				if(int.length == 1){
					clearselect();
					window.location = '/pruebas/global/sistema/panel/planes/obplan/'+int[0];
				}else{
					error_('No esta permitido seleccionar más de un plan a la vez',6000);
				}
			}else{
				error_('Debe seleccionar un plan para ver los precios',6000);
			}
		})*/
/*
		$('#btnimprimir').click(function(){
			//$('#frmeditar').submit();
			var int=[];var i = 0;
			$('#divtabla input:checkbox').each(function(index, element) {
                if($(this).prop('checked') == true){
					int[i++] = $(this).val();
				}
            });
			//alert(int.length);
			if(int.length > 0){
				if(int.length == 1){
					clearselect();
					window.open('/pruebas/global/sistema/panel/cobranza/imprimir/'+int[0],'_blank')
				}else{
					error_('No esta permitido seleccionar más de un promotor a la vez',6000);
				}
			}else{
				error_('Debe seleccionar un promotor para modificar',6000);
			}
		})*/

		/*lo uso*/
		function loadprice(){
            var dias = parseInt($('#vday').val());
			var pra ={
						"day":dias,
						"TipoP":$('#cboplan').val(),
						"fec":$('#txtnac').val(),
						"desde":$('#txtdesde').val(),
						"hasta":$('#txthasta').val()
					}
			$.ajax({
				type: "POST",
				url: "/panel/voucher/precios",
				async: true,
				data:pra,
				dataType: "html",
				success:function(datos){
					var resp = jQuery.parseJSON(datos);
					if (!resp.error)
					{
                        $('#vpre').text(resp.data);
                        $('input[name="vpre"]').val(resp.data);
					}
					else
					{
						mostrarModalErrorVar('Validando',resp.data);
					}
				},
				error:function( er ){
					console.log('error '+ er);
				}
			})
		}

		/*lo uso*/
		function calcularprecio()
		{
			var dias = parseInt($('#vday').val());
			if($('#cboplan').val() != ''){
				if($('#txtdesde').val() != '' || $('#txthasta').val() != ''){
					loadprice();
				}else{
					$('input[name="vpre"]').val(0);
					$('input[name="vday"]').val(0);
					$('#vpre').text(0);
					$('#vday').text(0);
				}
			}else{
				mostrarModalErrorVar('Validando','Debe elegir un plan para poder cotizar su voucher');
			}
		}



		function mensajeprueba(){
			mostrarModalErrorVar('Validando','Debe elegir un plan para poder cotizar su voucher');
		}
		/*lo uso*/
		sumaFecha = function(d, fecha)
		{
			 var Fecha = new Date();
			 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
			 var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
			 var aFecha = sFecha.split(sep);
			 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
			 fecha= new Date(fecha);
			 fecha.setDate(fecha.getDate()+parseInt(d));
			 var anno=fecha.getFullYear();
			 var mes= fecha.getMonth()+1;
			 var dia= fecha.getDate();
			 mes = (mes < 10) ? ("0" + mes) : mes;
			 dia = (dia < 10) ? ("0" + dia) : dia;
			 var fechaFinal = dia+sep+mes+sep+anno;
			 return (fechaFinal);
		 }
		/*lo uso*/
		function cantdias()
		{
			//VERIFICAR NUMERO DE DIAS
			if($('#cboplan').val() != ''){
				if($('#cboplan').val() == 'VISA ANUAL 45' ||
					$('#cboplan').val() == 'VISA ANUAL 60' ||
					$('#cboplan').val() == 'VISA ANUAL 90' ||
					$('#cboplan').val() == 'UNIVERSAL ANUAL 45' ||
					$('#cboplan').val() == 'UNIVERSAL ANUAL 60' ||
					$('#cboplan').val() == 'UNIVERSAL ANUAL 90' ||
					$('#cboplan').val() == 'TRAVELLER ANUAL 45' ||
					$('#cboplan').val() == 'TRAVELLER ANUAL 60' ||
					$('#cboplan').val() == 'TRAVELLER ANUAL 90')
				{
					if($('#txtdesde').val() != '')
					{
						var totaldias = sumaFecha('364',$('#txtdesde').val())
						$('#txthasta').val(totaldias);
						if($('#txtdesde').val() != '' && $('#txthasta').val() != '')
						{
							var d1 = $('#txtdesde').val().split("/");
							var dat1 = new Date(d1[2], parseFloat(d1[1])-1, parseFloat(d1[0]));
							var d2 = $('#txthasta').val().split("/");
							var dat2 = new Date(d2[2], parseFloat(d2[1])-1, parseFloat(d2[0]));
							var dayNum = dat2.getTime() - dat1.getTime();
							dayAct = Math.floor(dayNum/(1000*60*60*24));
							if(dayAct == 364)
							{
								$('input[name="vday"]').val(dayAct+1);
								$('#vday').text(dayAct+1);
								calcularprecio();
							}else{
								$('input[name="vpre"]').val(0);
								$('input[name="vday"]').val(0);
								$('#vday').text(0);
								$('#vpre').text(0)
							}
						}
					}
				}else{
					if($('#txtdesde').val() != '' && $('#txthasta').val() != '')
					{
						var d1 = $('#txtdesde').val().split("/");
						var dat1 = new Date(d1[2], parseFloat(d1[1])-1, parseFloat(d1[0]));
						var d2 = $('#txthasta').val().split("/");
						var dat2 = new Date(d2[2], parseFloat(d2[1])-1, parseFloat(d2[0]));
						var dayNum = dat2.getTime() - dat1.getTime();
						dayAct = Math.floor(dayNum/(1000*60*60*24));
						$('input[name="vday"]').val(dayAct+1);
						$('#vday').text(dayAct+1);
						calcularprecio()
					}
				}
			}
		}
		/* lo uso*/
		function calcCantDias() {
                cantdias();
        }
        /*lo uso*/
		$('#cboplan').change(function(){
            calcCantDias();
        });

		/*$('.cursor').click(function(){
			if($(this).hasClass("selecttr")){
				$(this).removeClass("selecttr");
				$(this).find('input').prop('checked',false);
			}else{
				$(this).addClass("selecttr");
				$(this).find('input').prop('checked',true)
			}
		})

		function clearselect(){
			$('.cursor').removeClass("selecttr");
			$('.cursor input').prop('checked',false);
		}*/

        /* lo uso */
		$('#txthasta').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			minDate:0,
			showAnim:'drop',
			onClose:function(dateText, inst){
                calcCantDias();
			}
		});



        /*lo uso*/
		$('#txtnac').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			maxDate:0,
			showAnim:'drop',
			onClose:function(dateText, inst){
                calcCantDias();
			}
		});

    });

/*lo uso*/
$('#btnaddv').click(function(){
    var codvou = $('#txtcodv').val();
    parametros = {'idvo':codvou};
    if(codvou != ""){
        if($.isNumeric(codvou)){
            var ee = 0;var sum = 0;
            if($('input[name="codvoucher[]"]').length){
                $('input[name="codvoucher[]"]').each(function(index, element) {
                    if($(this).val() == codvou){
                        ee = 1;
                    }
                });
            }
            if(ee == 0){
                $.ajax(
                    {
                        async:true,
                        type: "POST",
                        dataType:"html",
                        cache: false,
                        contentType:"application/x-www-form-urlencoded",
                        url:"/panel/cobranza/voucher",
                        data:parametros,
                        success:function(datos){
                            if(datos != 'error'){
                                $('#idlistv').append(datos);
                                $('#idlistv2').append(datos);
                                $('#txtcodv').val("");
                                $('#idlistv input[name="costo[]"]').each(function(index, element) {
                                    sum = parseFloat(parseFloat($(this).val()) + sum);
                                });
                                $('.totla').html(sum);
                                $('#txtimptv').val(sum);
                            }
                        },
                        error: function(){
                            console.log('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.');
                        }
                    })
            }else{
                mostrarModalErrorVar('Validando','El código ingresado ya existe.');
            }
        }
    }
});
	
/*REPUESTOS*/
	$('#btnimagen1').click(function(e){
		var ruta=$('#inputimagen1').val();
		// alert(ruta);
		document.getElementById("resultadoimagen").src=ruta;
		$("#largeModal").modal()
	});
	$('#btnimagen2').click(function(e){
		var ruta=$('#inputimagen2').val();
		// alert(ruta);
		document.getElementById("resultadoimagen").src=ruta;
		$("#largeModal").modal()
	});
	$('#btnimagen3').click(function(e){
		var ruta=$('#inputimagen3').val();
		// alert(ruta);
		document.getElementById("resultadoimagen").src=ruta;
		$("#largeModal").modal()
	});	
	// function verimagen(imagen){
	// 	alert(imagen);
	// 	$("#largeModal").modal()
	// }
/*REPUESTOS*/


/*lo uso*/
$('#btndelv').click(function(e){
    if($('#idlistv input[name="codvoucher[]"]').length){
        var i = 0;
        $('#idlistv .trvoucher').each(function(index, element) {
            if($(this).hasClass('trvoucher selreg')){
                $(this).remove();
            }
        });
        var sum = 0;
        $('#idlistv input[name="costo[]"]').each(function(index, element) {
            sum = parseFloat(parseFloat($(this).val()) + sum);
        });
        $('.totla').html('');
        $('#txtimptv').val('');
        $('.totla').html(sum);
        $('#txtimptv').val(sum);
        $('#idlistv2').html('');
        $('#idlistv .trvoucher').each(function () {
            $('#idlistv2').append($(this).html());
        });
    }else{
        mostrarModalErrorVar('Validando','No existe ningun voucher agregado.');
    }
});

/*lo uso*/
function changeclass(ev){
    $(document).ready(function(e) {
        if(ev.className == "trvoucher selreg"){
            ev.className = 'trvoucher';
        }else{
            ev.className = 'trvoucher selreg';
        }
    });
}
/*lo uso*/
$('#txtNacimiento').datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'dd/mm/yy',
    showAnim:'drop'
});
$('#txtfd').datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: 'dd/mm/yy',
    maxDate:0,
	showAnim:'drop'
});
$('#txtfh').datepicker({
	changeMonth: true,
	changeYear: true,
	dateFormat: 'dd/mm/yy',
    maxDate:0,
	showAnim:'drop'
});
/*lo uso*/
function btn_exp_excel(){
	$('#customers').tableExport({type:'excel',escape:'false'});
}
/* lo uso*/
function set_txt_cob(value){
	$('#'+value+'_p').html($('#'+value).val());
}
$('#modalDelete').on('show.bs.modal', function(e) {
	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});