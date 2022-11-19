/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Calendar init js
*/
var defaultEvents = [];
var calendar ; 
var NuevoEvento; 
var valida = 1; 

!function($) {
    "use strict";

    var CalendarPage = function() {};

    CalendarPage.prototype.init = function() {

            var addEvent=$("#event-modal");
            var modalTitle = $("#modal-title");
            var formEvent = $("#form-event");
            var selectedEvent = null;
            var newEventData = null;
            var forms = document.getElementsByClassName('needs-validation');
            var selectedEvent = null;
            var newEventData = null;
            var eventObject = null;
            /* initialize the calendar */

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var Draggable = FullCalendarInteraction.Draggable;
            var externalEventContainerEl = document.getElementById('external-events');
            // init dragable
            new Draggable(externalEventContainerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        className: $(eventEl).data('class')
                    };
                }
            });

            var draggableEl = document.getElementById('external-events');
            var calendarEl = document.getElementById('calendar');

            function addNewEvent(info) {
                addEvent.modal('show');
                formEvent.removeClass("was-validated");
                formEvent[0].reset();
                $("#event-title").val();
                $("#event-date").val(info.dateStr);
                $('#event-category').val();
                //Seteamos colores border
                $('#event-title').css('border','1px solid #ced4da');
                $('#event-category').css('border','1px solid #ced4da');
                $('#event-hora-inicio').css('border','1px solid #ced4da');
                $('#event-hora-fin').css('border','1px solid #ced4da');
                $('#event-description').css('border','1px solid #ced4da');
                modalTitle.text('Agregar Evento');
                newEventData = info;
            }
            

            calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                editable: true,
                droppable: true,
                selectable: true,
                defaultView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                locale:'es',
                eventClick: function(info) {
                    addEvent.modal('show');
                    formEvent[0].reset();
                    selectedEvent = info.event;
                    //alert(selectedEvent.extendedProps.id_tipo_evento);
                    console.log(selectedEvent); 
                    $("#event-title").val(selectedEvent.title);
                    //$('#event-category').val(selectedEvent.classNames[0]);
                    $('#event-category').val(selectedEvent.extendedProps.id_tipo_evento);
                    $('#event-description').val(selectedEvent.extendedProps.descripcion);
                    $('#event-ID').val(selectedEvent.id);
                    //alert(selectedEvent.start.toLocaleDateString());
                    //$('#event-date').val(selectedEvent.start.toLocaleDateString());
                    //alert(selectedEvent.extendedProps.f_fin); 
                    $('#event-date').val(selectedEvent.extendedProps.f_fin);
                    //alert(selectedEvent.extendedProps.h1+':'+selectedEvent.extendedProps.u1);
                    //alert(selectedEvent.extendedProps.h2+':'+selectedEvent.extendedProps.u2);
                    $('#event-hora-inicio').val(selectedEvent.extendedProps.h1+':'+selectedEvent.extendedProps.u1);
                    $('#event-hora-fin').val(selectedEvent.extendedProps.h2+':'+selectedEvent.extendedProps.u2);
                    newEventData = null;
                    modalTitle.text('Editar Evento');
                    newEventData = null;
                },
                dateClick: function(info) {
                    addNewEvent(info);
                },
                eventDrop:function(info){
                    //formEvent[0].reset();
                    selectedEvent = info.event;
                    $("#event-title").val(selectedEvent.title);
                    $('#event-category').val(selectedEvent.extendedProps.id_tipo_evento);
                    $('#event-description').val(selectedEvent.extendedProps.descripcion);
                    $('#event-ID').val(selectedEvent.id);
                    
                    var d = new Date(info.event.start.toISOString());
                    //var hora = d.getUTCHours();
                    //var minuto = d.getUTCMinutes();

                    var FechaHora = info.event.start.toISOString();
                    var FechaHora = FechaHora.split("T");

                    //alert(hora);
                    //alert(minuto);
                    console.log(info);

                    $('#event-date').val(FechaHora[0]);
                    //$('#event-hora-inicio').val(hora+':'+minuto);

                    //alert(FechaHora[0]);
                    //alert(FechaHora[1]);
                    //$('#event-date').val(selectedEvent.extendedProps.f_fin);
                    //$('#event-hora-inicio').val(selectedEvent.extendedProps.h1+':'+selectedEvent.extendedProps.u1);
                    $('#event-hora-fin').val(selectedEvent.extendedProps.h2+':'+selectedEvent.extendedProps.u2);
                    $('#event-hora-inicio').val(selectedEvent.extendedProps.h1+':'+selectedEvent.extendedProps.u1);
                    modificar_evento();
                },
                //events : defaultEvents
                events : 'http://localhost/monitoreo/C_agenda/cargar_eventos'
            });
            calendar.render();
            
             /*Add new event*/
            // Form to add new event

            $(formEvent).on('submit', function(ev) {
                ev.preventDefault();
                var inputs = $('#form-event :input');
                var updatedTitle = $("#event-title").val();
                var updatedCategory =  $('#event-category').val();
                
                // validation
                if (forms[0].checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        forms[0].classList.add('was-validated');
                } else {
                    if(selectedEvent){
                        selectedEvent.setProp("title", updatedTitle);
                        selectedEvent.setProp("classNames", [updatedCategory]);
                    } else {
                        var newEvent = {
                            title: updatedTitle,
                            start: newEventData.date,
                            allDay: newEventData.allDay,
                            className: updatedCategory
                        }
                        calendar.addEvent(newEvent);
                    }
                    addEvent.modal('hide');
                }
            });

            $("#btn-delete-event").on('click', function(e) {
                if (selectedEvent) {
                    selectedEvent.remove();
                    selectedEvent = null;
                    addEvent.modal('hide');
                }
            });

            $("#btn-new-event").on('click', function(e) {
                addNewEvent({date: new Date(), allDay: true});
            });

    },
    //init
    $.CalendarPage = new CalendarPage, $.CalendarPage.Constructor = CalendarPage
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CalendarPage.init()
}(window.jQuery);

function grabar_evento(){
    RecolectarDatosGui();
    if(valida==1){
        $('#event-modal').modal('hide');
        add_eventos();
    }else{
        //alert();
    }
    //if(nuevoEvento!=0){
    //     
    //}
}

function borrar_evento(){
    RecolectarDatosGui();
    delete_eventos();
    $('#event-modal').modal('hide');
    //if(nuevoEvento!=0){
    //     
    //    
    //}

}

function modificar_evento(){
    RecolectarDatosGui();
    if(valida==1){
        upd_evento(); 
        $('#event-modal').modal('hide');
    }else{
    }
    //if(nuevoEvento!=0){

    //}
}

function RecolectarDatosGui(){
    //if($('#event-ID').val()!=''){
        //if($('#event-date').val()!=''){
        //    alert($('#event-date').val());
        //}
         
        if($('#event-title').val()!=''){
            $('#event-title').css('border','1px solid green');
            if($('#event-category').val()!=''){
                $('#event-category').css('border','1px solid green');
                if($('#event-date').val()!=''){
                    if($('#event-hora-inicio').val()!=''){
                        $('#event-hora-inicio').css('border','1px solid green');
                        if($('#event-hora-fin').val()!=''){
                            $('#event-hora-fin').css('border','1px solid green');
                            if($('#event-description').val()!=''){
                                $('#event-description').css('border','1px solid green');
                                NuevoEvento = {
                                    id:$('#event-ID').val(),
                                    title:$('#event-title').val(),
                                    tipo:$('#event-category').val(),
                                    start:$('#event-date').val()+ " " + $('#event-hora-inicio').val(),
                                    end:$('#event-date').val()+ " " + $('#event-hora-fin').val(),
                                    descripcion:$('#event-description').val(),
                                };
                            }else{
                                valida=0;
                                $('#event-description').css('border','1px solid red');
                                alertify.error('Ingrese una observación del evento.');return;
                            }
                        }else{
                            valida=0;
                            $('#event-hora-fin').css('border','1px solid red');
                            alertify.error('Ingrese una hora de término del evento');return;
                        }
                    }else{
                        valida=0;
                        $('#event-hora-inicio').css('border','1px solid red');
                        alertify.error('Ingrese una hora inicio del evento.');return;
                    }
                }else{
                    valida=0;
                    $('#event-date').css('border','1px solid red');
                    alertify.error('Seleccione la fecha del evento.');  
                }
            }else{
                valida=0;
                $('#event-category').css('border','1px solid red');
                alertify.error('Seleccione la categoría del evento.');
            }
        }else{
            valida=0;
            $('#event-title').css('border','1px solid red');
            alertify.error('Ingrese el nombre del evento.');
        }
    /*}else{
        nuevoEvento=0;
        alertify.error('No se cuenta un ID de evento seleccionado.');
    }*/


}

function add_eventos(){
    $.ajax({
        type: "POST",
        url: "http://localhost/monitoreo/C_agenda/agregar",
        data: NuevoEvento, 
        beforeSend:function(){
        },   
        success: function(e){
            calendar.refetchEvents();
            alertify.success('Evento agregado correctamente.');
        }
    });
}

function upd_evento(){
    $.ajax({
        type: "POST",
        url: "http://localhost/monitoreo/C_agenda/modificar",
        data: NuevoEvento, 
        beforeSend:function(){
        },   
        success: function(e){
            calendar.refetchEvents();
            alertify.success('Evento actualizado correctamente.');
        }
    });
}

function delete_eventos(){
    $.ajax({
        type: "POST",
        url: "http://localhost/monitoreo/C_agenda/eliminar",
        data: NuevoEvento, 
        beforeSend:function(){
        },   
        success: function(e){
            calendar.refetchEvents();
            alertify.success('Evento eliminado correctamente.');
        }
    });
}





function registrar_evento(){

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    defaultEvents.push({title: 'Prueba de dato',start: new Date(y, m, d+2)});
    console.log(y+'_'+m+'_'+d);
    $.CalendarPage.init();
    calendar.render();
    
    eventSource.refetch();

}

function cargar_eventos(){
    $.ajax({
        type: "POST",
        url: "http://localhost/monitoreo/C_agenda/cargar_eventos",
        data: {
        }, 
        beforeSend:function(){
        },   
        success: function(e){
            for(var i=0; i < e.length; i++)
            {
                defaultEvents.push({title: e[i]['title'],start: new Date(e[i]['y1'], e[i]['m1'], e[i]['d1'], e[i]['h1'], e[i]['u1'])});
            }
            console.log(defaultEvents);
            calendar.render();
            $.CalendarPage.init();
        }
    });
}