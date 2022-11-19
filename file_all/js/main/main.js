// JavaScript Document



function changeclass(ev){

	$(document).ready(function(e) {

		if(ev.className == "trvoucher selreg"){

			ev.className = 'trvoucher';

		}else{

			ev.className = 'trvoucher selreg';

		}

    });

}

var ini;

	ini = $(document);

	ini.ready(function(e) {

		$('#txtdesde').datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd/mm/yy',

			minDate:0,

			showAnim:'drop',

			onClose:function(dateText, inst){

				cantdias();

			}

		});

		

		function getdni(e){

			

			$.ajax(

				{

				async:true,

				type: "POST",

				dataType:"json",

				cache: false,

				contentType:"application/x-www-form-urlencoded",

				url:"/pruebas/global/sistema/panel/resultpass/",

				data:"dni="+e,

				success:function(datos){

					if(datos != 'error'){

						returndni(datos);

						calcularprecio();

					}

				},

				error: function(){

					error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

				},

				timeout:4000

				}

			)

			

		}

		

		$('#idkeysearch').keypress(function(e){

			if(e.which == 13) {

				var post = $(this).val();

				var dest = ""+$('.buscador input[name="busqt"]').val()+"";

				var ruta = $('.buscador input[name="busqr"]').val();

				var parametros = {agencias:post}

				$.ajax(

					{

					async:true,

					type: "POST",

					dataType:"html",

					cache: false,

					contentType:"application/x-www-form-urlencoded",

					url: ruta+post,

					data:$('.buscador input[name="busqt"]').val()+'='+post,

					success:function(datos){

						if(datos != 'si'){

							error_(datos,6000);							

						}else{

							document.location.href = ruta+post;

						}

					},

					error: function(){

						error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

					},

					timeout:4000

					}

				)

			}

		}) 

		

		$('#txtdni').focusout(function(){

			getdni($(this).val())

		})

		

		$('#btnnewcob').click(function(){

			if($('input[name="codvoucher[]"]').length){

				if($('input[name="txtagenruc"]').val() != ""){

					if($('input[name="txtpromotor"]').val() != ""){

						$('#frmnewcob').submit();

					}else{

						error_('Debe ingresar el código del promotor asignado a la agencia.',6000);

					}

				}else{

					error_('Debe ingresar el nombre de la agencia para emitir el documento de cobranza.',6000);

				}

			}else{

				error_('No existe ningun voucher agregado.',6000);

			}

			

		})

		

		$('input[name="btndelv"]').click(function(e){

			if($('input[name="codvoucher[]"]').length){

				var i = 0;

				$('.trvoucher').each(function(index, element) {

					if($(this).hasClass('trvoucher selreg')){

						$(this).remove();

					}

				});

				var sum = 0;

				$('input[name="costo[]"]').each(function(index, element) {									

					sum = parseFloat(parseFloat($(this).val()) + sum);

				});

				$('.totla').html(sum);

				$('#txtimptv').val(sum);

			}else{

				error_('No existe ningun voucher agregado.',6000);

			}

		})

		

		$('input[name="btnaddv"]').click(function(){

			var codvou = $('input[name="txtcodv"]').val();

			parametros = {'idvo':codvou}

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

					//alert(ee)

					if(ee == 0){

						$.ajax(

						{

						async:true,

						type: "POST",

						dataType:"html",

						cache: false,

						contentType:"application/x-www-form-urlencoded",

						url:"/pruebas/global/sistema/panel/getvou/",

						data:parametros,

						success:function(datos){

							if(datos != 'error'){

								$('#idlistv').append(datos);
								$('#idlistv2').append(datos);

								$('input[name="txtcodv"]').val("");

								$('input[name="costo[]"]').each(function(index, element) {									

									sum = parseFloat(parseFloat($(this).val()) + sum);

								});

								$('.totla').html(sum);

								$('#txtimptv').val(sum);

							}

						},

						error: function(){

							error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

						},

						timeout:4000

						})	

					}else{

						error_('El código ingresado ya existe.',6000);

					}

				}

			}

		})

		

		$('#idclicv').click(function(){

			$('#obsvou').submit();

		})

		

		$('#obvou').click(function(){

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

				

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			if(int.length == 1){

				$('input[name="idvou"]').val(int[0]);

				clearselect()

				$('#obsvou').submit();

			}else{

				error_('Debe seleccionar un voucher para poder proceder',6000);

			}

			

		})

		

		$('#btndelpre').click(function(e){

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Precios'

					}

					$('.opaco').html('Esta seguro que desea eliminar.').dialog({

						modal: true,

						title: 'Eliminar Precio',						

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											clearselect()

											$('.opaco').dialog('close')

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:4000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar un precio para eliminar',6000);

			}

		})

		

		$('#btndelc').click(function(){

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Counters'

					}

					$('.opaco').html('Se va eliminar a '+int.length+' ').dialog({

						modal: true,

						title: 'Eliminar Counter',						

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											clearselect()

											$('.opaco').dialog('close')

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:4000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar un counter para modificar',6000);

			}

			

		})

		$('#btndelpro').click(function(){

			//$('#frmeditar').submit();

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

				

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Promotores'

					}

					$('.opaco').html('Se va eliminar a '+int.length+' ').dialog({

						modal: true,

						title: 'Eliminar promotor',						

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											$('.opaco').dialog('close')

											clearselect();

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:4000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar un promotor para modificar',6000);

			}

		})

		

		$('#btndelagen').click(function(){

			//$('#frmeditar').submit();

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

				

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Agencia'

					}

					$('.opaco').html('Esta seguro de eliminar').dialog({

						modal: true,

						title: 'Eliminar Agencias',

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											$('.opaco').dialog('close')

											clearselect();

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:60000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar al menos una agencia para eliminar',6000);

			}

		})

		

		$('#btndelp').click(function(){

			//$('#frmeditar').submit();

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

				

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Pasajeros'

					}

					$('.opaco').html('Esta seguro de eliminar').dialog({

						modal: true,

						title: 'Eliminar pasajero',

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											$('.opaco').dialog('close')

											clearselect();

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:4000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar un promotor para modificar',6000);

			}

		})

		

		$('#btnexpor').click(function(e){

			$('.clsexport').fadeIn('fast');

		})

		

		$('#btnenviar').click(function(e){

			$('#frmexport input:checked').each(function(index, element) {				

                if($(this).val() == 's'){

					var int=[];var i = 0;

					$('#divtabla input:checkbox').each(function(index, element) {

						

						if($(this).prop('checked') == true){

							int[i++] = $(this).val();

						}

						

					});

					

					if(int.length > 0){				

					  $('#exprtsel').submit();

					}else{

						$('.erexp').html('Debe seleccionar una fila para exportar');

						$('.erexp').fadeIn(1500);

					}

				}else{					

					$('#frmexport').submit();					

				}

				

            });

			

			

		})

		

		$('#btncancelar').click(function(e){

			$('.clsexport').fadeOut('fast');

		})

		

		$('#txtfd').datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd/mm/yy',

			showAnim:'drop',

		});

		

		$('#txtfh').datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd/mm/yy',

			showAnim:'drop',

		});

		

		$('#btndelvou').click(function(){

			//$('#frmeditar').submit();

			var int=[];var i = 0;

			$('#divtabla input:checkbox').each(function(index, element) {

				

                if($(this).prop('checked') == true){

					int[i++] = $(this).val();

				}

				

            });

			

			//alert(int.length);

			if(int.length > 0){

					

					parametros = {

						'cod' : int,

						'event' : 'Voucher'

					}

					$('.opaco').html('Esta seguro de eliminar').dialog({

						modal: true,

						title: 'Eliminar voucher',

						zIndex: 10000,

						autoOpen: true,

						width: '400',

						resizable: false,

						buttons: {

							Si: function () {

								$.ajax(

									{

									async:true,

									type: "POST",

									dataType:"html",

									cache: false,

									contentType:"application/x-www-form-urlencoded",

									url:"/pruebas/global/sistema/panel/eliminar/",

									data:parametros,

									success:function(datos){

										if(datos != 'error'){

											error_(datos,6000);

											$('.opaco').dialog('close')

										}

									},

									error: function(){

										error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

									},

									timeout:4000

									}

								)

							},

							No: function () {

								$('.opaco').dialog('close')

							}

						},

						close: function (event, ui) {

						}

					});

				

				

			}else{

				error_('Debe seleccionar un voucher para eliminar',6000);

			}

		})

		

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

			setTimeout(function(){$('.erroreg').fadeOut('slow');},time)

		}

		

		function calprecdplan(datos){		

			$('#vpre').text(datos);

		}

		

		$('#btnmodpas').click(function(){

			$('#frmeditar').submit();

			clearselect();

		})

		

		/*$('#btnmodp').click(function(){

			$('#frmnewplan').submit();

			clearselect();

		})*/

		

		$('#btnmod').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/voucher/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un voucher a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un voucher para modificar',6000);

			}

			

		})

		

		$('#btnmodp').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/pasajeros/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un pasajero a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un pasajero para modificar',6000);

			}

			

		})

		

		$('#btnmoda').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/agencias/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un agencia a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un agencia para modificar',6000);

			}

			

		})

		

		$('#btnmodplan').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/planes/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un plan a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un plan para modificar',6000);

			}

			

		})



		// start crusbel

		$('#btnmodben').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/beneficios/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un beneficio a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un beneficio para modificar',6000);

			}

			

		})



		$('#btnmodservb').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/servicios/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un servicio a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un servicio para modificar',6000);

			}

			

		})

		// end crusbel

		

		$('input[name="btnvolver"]').click(function(e){

			window.location.href = $(this).attr('ruta');

		})

		

		$('#btnaddpre').click(function(){

			$('.cajainput').append('<tr><td><input type="text" name="txtcosto[]" class="clslarge" maxlength="6" style="text-align:center;"></td><td><input type="text" name="txtday[]" class="clslarge" maxlength="3" style="text-align:center;"></td></tr>');

		})

		

		$('#modpre').click(function(){

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

					window.location.href = $('#modpre').attr('ruta')+int[0];

				}else{

					error_('No esta permitido seleccionar más de un precio a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un precio para modificar',6000);

			}

			

		})

		

		$('.idbus').click(function(e){

			var post = $("#idkeysearch").val();

			var dest = ""+$('.buscador input[name="busqt"]').val()+"";

			var ruta = $('.buscador input[name="busqr"]').val();

			var parametros = {agencias:post}

			$.ajax(

			{

				async:true,

				type: "POST",

				dataType:"html",

				cache: false,

				contentType:"application/x-www-form-urlencoded",

				url: ruta+post,

				data:$('.buscador input[name="busqt"]').val()+'='+post,

				success:function(datos){

					if(datos != 'si'){

						error_(datos,6000);							

					}else{

						document.location.href = ruta+post;

					}

				},

				error: function(){

					error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

				},

				timeout:4000

			})

		})

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

			

		})

		

		$('#btnmodc').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/counters/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un counter a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un counter para modificar',6000);

			}

			

		})

		

		$('#btnmodpr').click(function(){

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

					window.location = '/pruebas/global/sistema/panel/promotores/editar/'+int[0];

				}else{

					error_('No esta permitido seleccionar más de un promotor a la vez',6000);

				}

				

			}else{

				error_('Debe seleccionar un promotor para modificar',6000);

			}

			

		})

		

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

			

		})

		

		$('#btnnewvou').click(function(){

			var error = [];var cont = 0;

			

			if($('#cboplan option:selected').val() === "Seleccione"){

				error[0] = '<span class="errorcolor">Debe elegir un plan</span>';

				cont++;

			}else{

				error[0] = '';

			}

			

			if($.trim($('input[name="txtdestino"]').val()) == ""){

				error[1] = '<span class="errorcolor">Ingrese el destino del pasajero</span>';

				cont++;

			}else{

				error[1] = '';

			}

			

			if($.trim($('input[name="txtdesde"]').val()) == ""){

				error[2] = '<span class="errorcolor">Debe ingresar la Cobertura desde</span>';

				cont++;

			}else{

				error[2] = '';

			}

			

			if($.trim($('input[name="txthasta"]').val()) == ""){

				error[3] = '<span class="errorcolor">Debe ingresar la Cobertura hasta</span>';

				cont++;

			}else{

				error[3] = '';

			}

			

			if($.trim($('input[name="txtdni"]').val()) == ""){

				error[4] = '<span class="errorcolor">Debe ingresar Nº de documento</span>';

				cont++;

			}else{

				error[4] = '';

			}

			

			if($.trim($('input[name="txtnombre"]').val()) == ""){

				error[5] = '<span class="errorcolor">Ingrese los nombres del pasajero</span>';

				cont++;

			}else{

				error[5] = '';

			}

			

			if($.trim($('input[name="txtapellido"]').val()) == ""){

				error[6] = '<span class="errorcolor">Ingrese los apellidos del pasajero</span>';

				cont++;

			}else{

				error[6] = '';

			}			

			

			if($.trim($('input[name="txtnac"]').val()) == ""){

				error[7] = '<span class="errorcolor">Ingrese la Fec. nacimiento del pasajero</span>';

				cont++;

			}else{

				error[7] = '';

			}

			

			if($.trim($('input[name="txtdomicilio"]').val()) == ""){

				error[8] = '<span class="errorcolor">Ingrese la dirección del pasajero</span>';

				cont++;

			}else{

				error[8] = '';

			}

			

			if($('#cbosexo option:selected').val() === "Seleccione"){

				error[9] = '<span class="errorcolor">Seleccione el sexo del pasajero</span>';

				cont++;

			}else{

				error[9] = '';

			}

			

			if($('#cbonaci option:selected').val() === "Seleccione"){

				error[10] = '<span class="errorcolor">Ingrese la nacionalidad del pasajero</span>';

				cont++;

			}else{

				error[10] = '';

			}

			

			if($.trim($('input[name="txtpais"]').val()) == ""){

				error[11] = '<span class="errorcolor">Ingrese el país del pasajero</span>';

				cont++;

			}else{

				error[11] = '';

			}

			

			if($.trim($('input[name="txtciudad"]').val()) == ""){

				error[11] = '<span class="errorcolor">Ingrese la ciudad del pasajero</span>';

				cont++;

			}else{

				error[11] = '';

			}			

			

			if($.trim($('input[name="txtname"]').val()) == ""){

				error[11] = '<span class="errorcolor">Ingrese los nombres de contacto de emergencia</span>';

				cont++;

			}else{

				error[11] = '';

			}

			

			if($.trim($('input[name="txtlname"]').val()) == ""){

				error[12] = '<span class="errorcolor">Ingrese los apellidos de contacto de emergencia</span>';

				cont++;

			}else{

				error[12] = '';

			}

			

			if($.trim($('input[name="txtphone"]').val()) == ""){

				error[13] = '<span class="errorcolor">Ingrese el teléfono de contacto de emergencia</span>';

				cont++;

			}else{

				error[13] = '';

			}

			

			if(cont === 0){

				$('#frmnewvou').submit();

			}else{

				error_('<span class="spantiterr">Por favor debe corregir los siguientes errores:</span>'+error[0]+error[1]+error[2]+error[3]+error[4]+error[5]+error[6]+error[7]+error[8]+error[9]+error[10]+error[11]+error[12]+error[13],50000)

			}

			

		})

		

		function loadprice(){

			var dias = parseInt($('#vday').text())

			var pra ={"day":dias,"TipoP":$('#cboplan option:selected').text(),"fec":$('#txtnac').val(),"desde":$('#txtdesde').val(),"hasta":$('#txthasta').val()}			

			$.ajax({

				type: "POST",

				url: "/pruebas/global/sistema/panel/precios",

				async: true,

				data:pra,

				dataType: "html",

				success:function(datos){

					if(datos.search('si*') == 0){

						x=datos.split('*');

						$('#vpre').text(x[1]);

						$('input[name="vpre"]').val(x[1])

					}else{

						error_(datos,6000);

					}

				},

				error:function(){

					error_('OPPSSS parece que hay problemas con la conexión a la ruta, intente nuevamente en unos instantes.',6000);

				},

				timeout:4000

			})

		}

		

		$('input[name="rdincp"]').click(function(){

			if($(this).prop('checked') == true){

				$(this).val(1);

			}else{

				$(this).val(0);

			}

			

		})

		

		function calcularprecio()

		{

			var dias = parseInt($('#vday').text())

			if($('#cboplan option:selected').text() != 'Seleccionar'){

				if($('#txtdesde').val() != '' || $('#txthasta').val() != ''){

					loadprice();

				}else{

					$('input[name="vpre"]').val(0);

					$('input[name="vday"]').val(0);

					$('#vpre').text(0);

					$('#vday').text(0);

				}

			}else{

				error_('Debe elegir un plan para poder cotizar su voucher',6000);

			}

		}

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

		function cantdias()

		{			

			//VERIFICAR NUMERO DE DIAS

			if($('#cboplan option:selected').text() != 'Seleccione'){

				if($('#cboplan option:selected').text() == 'VISA ANUAL 45' || $('#cboplan option:selected').text() == 'VISA ANUAL 60' || $('#cboplan option:selected').text() == 'VISA ANUAL 90' || $('#cboplan option:selected').text() == 'UNIVERSAL ANUAL 45' || $('#cboplan option:selected').text() == 'UNIVERSAL ANUAL 60' || $('#cboplan option:selected').text() == 'UNIVERSAL ANUAL 90' || $('#cboplan option:selected').text() == 'TRAVELLER ANUAL 45' || $('#cboplan option:selected').text() == 'TRAVELLER ANUAL 60' || $('#cboplan option:selected').text() == 'TRAVELLER ANUAL 90')

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

		$('#cboplan').change(function(){

			cantdias();

		})

		$('.cursor').click(function(){

		

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

		}

		$('#btnnewage').click(function(){

			$('#frmnewage').submit();

		})

		$('#btnnewplan').click(function(){

			$('#frmnewplan').submit();

		})

		

		$('#btnnewpre').click(function(){

			$('#frmnewpre').submit();

		})

		

		$('#btnmodpre').click(function(){			

			$('#frmmodpre').submit();

		})

		

		$('#btnnew').click(function(){

			$('#frmnew').submit();

		})

		$('select[name="frmcam"]').change(function(){

			window.location = $('.frmcam').attr('action')+$(this).val();

		})

		$('select[name="frmplan"]').change(function(){

			window.location = $('.frmplan').attr('action')+$(this).val();

		})

		$('select[name="frmplanf"]').change(function(){

			window.location = $('.frmplanf').attr('action')+$(this).val();

		})

		$('select[name="frmf"]').change(function(){

			window.location = $('.frmf').attr('action')+$(this).val();

			//alert(window.location.pathname)

		})

		$('#txthasta').datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd/mm/yy',

			minDate:0,

			showAnim:'drop',

			onClose:function(dateText, inst){

				cantdias();

			}

		});

		

		$('#txtnac').datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: 'dd/mm/yy',	

			maxDate:0,

			showAnim:'drop',

			onClose:function(dateText, inst){

				cantdias();

			}

		});

		

    });

function btn_exp_excel(){

	$('#customers').tableExport({type:'excel',escape:'false'});

	// $('#customers').tableExport();

	 // $("#tableExportExcel").table2excel({  
  //                   filename: "Your_File_Name.xls"  
  //               }); 

}

function set_txt_cob(value){
	$('#'+value+'_p').html($('#'+value).val());
}