	function registrarAsistencia(){
    var txtcoordenadas = $('#txtcoordenadas').val();
    //alert(txtcoordenadas);
    if(txtcoordenadas!==''){
        $("#fromEntrada").submit();
    }else{
        $("#panelMensajito").css("display","block"); 
        setInterval(function(){ $("#panelMensajito").css("display","none"); }, 5000);
    }
}

function registrarSalida(){
    var txtcoordenadas = $('#txtcoordenadas2').val();
    //alert(txtcoordenadas);
    if(txtcoordenadas!==''){
        $("#fromSalida").submit();
    }else{
        $("#panelMensajito2").css("display","block"); 
        setInterval(function(){ $("#panelMensajito2").css("display","none"); }, 5000);
    }
}

function visualizaPanelSalida(){
    $("#panelmarcarsalida").css("display", "block");
    $("#btnmarcarsalida").css("display", "none");
}


function obtenerFecha(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

    dia = momentoActual.getDate();
    mes = momentoActual.getMonth()+1;
    anio = momentoActual.getFullYear();

    horaImprimible =anio+"-"+mes+"-"+dia+" "+hora+":"+minuto+ ":"+segundo;
    $('#txtHoraIngreso').val(horaImprimible);
}
function obtenerFecha2(){
    momentoActual = new Date();
    hora = momentoActual.getHours();
    minuto = momentoActual.getMinutes();
    segundo = momentoActual.getSeconds();

    dia = momentoActual.getDate();
    mes = momentoActual.getMonth()+1;
    anio = momentoActual.getFullYear();

    horaImprimible =anio+"-"+mes+"-"+dia+" "+hora+":"+minuto+ ":"+segundo;
    $('#txtHoraIngreso2').val(horaImprimible);
}
       
$(document).ready(function() {

    /*Validamos si el campo COORDENADAS*/
    
    /*var verificaCoordenadas = function(){
        var valor = $('#txtcoordenadas').val();
        if(valor!=''){
            var element = document.getElementById('panelMensaje');
              element.style.display = "none";
              
            var element = document.getElementById('panelVisual');
              element.style.display = "block";
        }else{
              var element = document.getElementById('panelMensaje');
              element.style.display = "block";
              
              var element = document.getElementById('panelVisual');
              element.style.display = "none";
        }
    }*/
    

    
        
  var actualizarHora = function(){
    var fecha = new Date(),
        hora = fecha.getHours(),
        minutos = fecha.getMinutes(),
        segundos = fecha.getSeconds(),
        diaSemana = fecha.getDay(),
        dia = fecha.getDate(),
        mes = fecha.getMonth(),
        anio = fecha.getFullYear(),
        ampm;
    
    var $pHoras = $("#horas"),
        $pSegundos = $("#segundos"),
        $pMinutos = $("#minutos"),
        $pAMPM = $("#ampm"),
        $pDiaSemana = $("#diaSemana"),
        $pDia = $("#dia"),
        $pMes = $("#mes"),
        $pAnio = $("#anio");
    var semana = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    
    $pDiaSemana.text(semana[diaSemana]);
    $pDia.text(dia);
    $pMes.text(meses[mes]);
    $pAnio.text(anio);
    if(hora>=12){
      hora = hora - 12;
      ampm = "PM";
    }else{
      ampm = "AM";
    }
    if(hora == 0){
      hora = 12;
    }
    if(hora<10){$pHoras.text("0"+hora)}else{$pHoras.text(hora)};
    if(minutos<10){$pMinutos.text("0"+minutos)}else{$pMinutos.text(minutos)};
    if(segundos<10){$pSegundos.text("0"+segundos)}else{$pSegundos.text(segundos)};
    $pAMPM.text(ampm);
    
  };
  
  
  actualizarHora();
  //verificaCoordenadas();
  
  var intervalo = setInterval(actualizarHora,1000);
  //var intervalo = setInterval(verificaCoordenadas,1000);
});

function localize()
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(mapa,error);
    }
    else
    {
        alert('Tu navegador no soporta geolocalizacion.');
    }
}

function localize2()
{
    if (navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(mapa2,error);
    }
    else
    {
        alert('Tu navegador no soporta geolocalizacion.');
    }
}

function mapa2(pos)
{
/************************ Aqui están las variables que te interesan***********************************/
    var latitud = pos.coords.latitude;
    var longitud = pos.coords.longitude;
    var precision = pos.coords.accuracy;

    var concadena = latitud + "," + longitud;
    $('#txtcoordenadas2').val(concadena);
    

    var contenedor = document.getElementById("map")

    var centro = new google.maps.LatLng(latitud,longitud);

    var propiedades =
    {
        zoom: 15,
        center: centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(contenedor, propiedades);

    var marcador = new google.maps.Marker({
        position: centro,
        map: map,
        title: "Tu posicion actual"
    });
}


function mapa(pos)
{
/************************ Aqui están las variables que te interesan***********************************/
    var latitud = pos.coords.latitude;
    var longitud = pos.coords.longitude;
    var precision = pos.coords.accuracy;

    var concadena = latitud + "," + longitud;
    $('#txtcoordenadas').val(concadena);
    

    var contenedor = document.getElementById("map")

    var centro = new google.maps.LatLng(latitud,longitud);

    var propiedades =
    {
        zoom: 15,
        center: centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(contenedor, propiedades);

    var marcador = new google.maps.Marker({
        position: centro,
        map: map,
        title: "Tu posicion actual"
    });
}

function error(errorCode)
{
    if(errorCode.code == 1)
        alert("No has permitido buscar tu localizacion")
    else if (errorCode.code==2)
        alert("Posicion no disponible")
    else
        alert("Ha ocurrido un error")
}

$('#fromEntrada').validate({
    rules: {
        "txtcoordenadas":{required:true},
        "txtHoraIngreso":{required:true},
    }
});

$('#fromSalida').validate({
    rules: {
        "txtcoordenadas2":{required:true},
        "txtHoraIngreso2":{required:true},
    }
});

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