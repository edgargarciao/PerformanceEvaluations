var accion = document.querySelector("#close_sesion");
if(accion!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'homeDoc'},
        type:"post",
        dataType: "json",
        success:function(data){
            document.getElementById("name").innerText = data.persona.nombres + " " + ((data.persona.apellidos == "null") ? "" :data.persona.apellidos);
        }
    });
}

var accion2 = document.querySelector("#view_profile");
if(accion2!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'viewProfileDoc'},
        type:"post",
        dataType:"json",
        success:function(data){

            document.getElementById("codigo").innerText = data.persona.codigo;
            document.getElementById("nombres").innerText = data.persona.nombres;
            document.getElementById("apellidos").innerText = ((data.persona.apellidos == "null") ? "" :data.persona.apellidos );
            document.getElementById("cedula").innerText = data.persona.dni;
            document.getElementById("celular").innerText = ((data.persona.celular == "null") ? "" :data.persona.celular );
            document.getElementById("direccion").innerText = ((data.persona.direccion == "null") ? "" :data.persona.direccion );;
            document.getElementById("correo").innerText = ((data.persona.correo == "null") ? "" :data.persona.correo );
        }
    });
}

var accion3 = document.querySelector("#edit_profile");
if(accion3!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'viewProfileDoc'},
        type:"post",
        dataType:"json",
        success:function(data){
            document.querySelector("#cel").value = ((data.persona.celular == "null") ? "" :data.persona.celular );
            document.querySelector("#dir").value = ((data.persona.direccion == "null") ? "" :data.persona.direccion );
        }
    });
}



var accion4 = document.querySelector("#info");
if(accion4!=null) {
    var date = new Date();
    var mes = date.getMonth()+1;
    var newDate = date.getDate() +" - "+ mes +" - "+ date.getFullYear();

    var t = $('#dataTables-example1').DataTable({select: true, lengthChange: false, searching: false, bInfo: false, bPaginate: false});
    t.clear().draw();
    t.row.add([newDate]).draw(false);
}

var accion5 = document.querySelector("#list_pair");
if(accion5!=null) {
    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listarDocentesDocente'},
        type: "post",
        //dataType: "Array",
        success: function (response) {
            var json = JSON.parse(response);
            var respuesta = "";
            var respuesta2 = "";

            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable({select: true});
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombres + " " + ((json[i].apellidos == "null")?"":json[i].apellidos);
                    var Codigo = json[i].codigo;

                    respuesta2 += '<a href="pairEvaluation.php?id='+Codigo+'" class="btn btn-danger"><i class="zmdi zmdi-check"></i>';
                    respuesta2 += '&nbsp Realizar Evaluacion';
                    respuesta2 += '</a>';


                    t.row.add([Nombre, respuesta2]).draw(false);
                    respuesta2 = "";
                    respuesta = "";
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                alert("Ha ocurrido un error al listar los docentes");
            }
        }
    });
}

var accion6 = document.querySelector("#pair");
if(accion6!=null){
    var loc = document.location.href;
    var getString = loc.split('?')[1];
    var codigo = getString.split('=');
    var id = codigo[1];

    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listDocentes'},
        type: "post",
        //dataType: "Array",
        success: function (response) {
            var json = JSON.parse(response);
            var respuesta = "";
            var respuesta2 = "";
            if (json.length != 0) {
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombres + " " + json[i].apellidos;
                    var Codigo = json[i].codigo;

                    if (Codigo === id) {
                        document.getElementById("nameDoc").innerText = Nombre;
                        document.getElementById("codigo").value = Codigo;
                    }
                }
            }
        }
    });
}

/********************************************
 *  PREGUNTAS EVALUACION DOCENTE - DOCENTE
 ********************************************/

criteriosDirectorDocente = [];

function cargarEvaluacionDocenteDocente(id){
    codigoDocente = id;

    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listPreguntasDocenteDocente'},
        type: "post",     
   
        success: function (response) {
   
            var json = JSON.parse((response));

            if (json.length != 0) {
                var t = $('#tabla').DataTable({bSort: false});
                //t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    console.log(json[i]);
                    var criterio = json[i].nombreCriterio;
                    var codigo = json[i].id;

                    //criteriopregunta.id, criteriopregunta.nombrePregunta, criteriopregunta.estado, 
                    //criteriopregunta.criterio, criterio.nombreCriterio

                    var radio1 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-5\" value=\"5\"></td>";
                    var radio2 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-4\" value=\"4\"></td>";
                    var radio3 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-3\" value=\"3\"></td>";
                    var radio4 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-2\" value=\"2\"></td>";
                    var radio5 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-1\" value=\"1\"></td>";

                    
                    t.row.add([criterio, radio1,radio2,radio3,radio4,radio5]).draw(false);
                    var crit = {codigo:codigo, criterio:criterio};
                    criteriosDirectorDocente.push(crit);
                }
            }else{
                var t = $('#tabla').DataTable();
                t.clear().draw();
            }
        },
        error: function(xhr, status, error) {            
            
            console.log(xhr.responseText);            
            console.log(xhr.statusText);
            console.log(status);
            console.log(error);

        }  
    });
}

function guardarEvaluacionDocenteDocente(){

    var resultados = [];
    var arrayLength = criteriosDirectorDocente.length;
    for (var j = 0; j < arrayLength; j++) {
        var value = 0;
        if(document.getElementById(criteriosDirectorDocente[j].codigo+"-1").checked){
            value = 1;
        }else if(document.getElementById(criteriosDirectorDocente[j].codigo+"-2").checked){
            value = 2;
        }else if(document.getElementById(criteriosDirectorDocente[j].codigo+"-3").checked){
            value = 3;
        }else if(document.getElementById(criteriosDirectorDocente[j].codigo+"-4").checked){
            value = 4;
        }else if(document.getElementById(criteriosDirectorDocente[j].codigo+"-5").checked){
            value = 5;
        }
        if(value == 0){
            alert("Debes llenar todos los campos");
            return;
        }
        resultados.push({codigo:criteriosDirectorDocente[j].codigo, valor:value});
    }  


    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'guardarEvaluacionDocenteDocente', codigoDocente:codigoDocente, resultados:resultados},
        type: "post",     
        success: function (response) {
            window.location="listPairEvaluation.php";                  
        },
        error: function(xhr, status, error) {            
            
            console.log(xhr.responseText);            
            console.log(xhr.statusText);
            console.log(status);
            console.log(error);

        }  
    });
}


/********************************************
 *  PREGUNTAS AUTOEVALUACION DIRECTOR
 ********************************************/

criteriosAutDirector = [];

var accion6 = document.querySelector("#auto_director");
if(accion6!=null) {

        $.ajax({
            url: "../../include.php",
            data: {solicitud: 'listPreguntasAutoDocente'},
            type: "post",     
    
            success: function (response) {
    
                var json = JSON.parse((response));

                if (json.length != 0) {

                    var critAnt = 0;
                    var critNuev = 0;
                    var count  = 1;
                    for (var i = 0; i < json.length; i++) {
                        console.log(json[i]);

                        var criterioId = json[i].criterio;
                        var criterio = json[i].nombreCriterio;
                        var codigoPregunta = json[i].id;
                        var nombrePregunta = json[i].nombrePregunta;

                        if(i == 0 || critAnt != criterioId){
                            var critAnt = criterioId;
                            var tbody = document.getElementById("tbo");

                            var tr = document.createElement("tr");                            
                            tr.setAttribute("class","text-center");
                            var td1 = document.createElement("td");                            
                            tr.appendChild(td1);
                            
                            var td2 = document.createElement("td");                       
                            
                            td2.setAttribute("style","font-weight: bold");

                            var textotd2 = document.createTextNode(criterio);       
                            td2.appendChild(textotd2);
                            tr.appendChild(td2);
                            tbody.appendChild(tr);
                            count = 1;
                        }
                        /*
                        <tr>
                            <td style="font-weight: bold">1. </td>
                            <td class="text-justify">Participa en los diversos comités y equipos de trabajo que desarrollan acciones de mejora de los procesos pedagógicos.</td>
                            <td><input type="radio" name="a" value="5"></td>
                            <td><input type="radio" name="a" value="4"></td>
                            <td><input type="radio" name="a" value="3"></td>
                            <td><input type="radio" name="a" value="2"></td>
                            <td><input type="radio" name="a" value="1"></td>
                            <td>    </td>
                        </tr>*/
                        
                            var tbody = document.getElementById("tbo");

                            var tr = document.createElement("tr");                            
                            tr.setAttribute("class","text-center");

                            // td1
                            var td1 = document.createElement("td");  
                            td1.setAttribute("style","font-weight: bold");
                            var textotd1 = document.createTextNode( (count++) +". ");       
                            td1.appendChild(textotd1);                            
                            tr.appendChild(td1);
                            
                            // td2
                            var td2 = document.createElement("td");                                                   
                            td2.setAttribute("class","text-justify");
                            var textotd2 = document.createTextNode(nombrePregunta);       
                            td2.appendChild(textotd2);
                            tr.appendChild(td2);

                            // td3
                            var td3 = document.createElement("td");
                            var input1 = document.createElement("input");
                            input1.setAttribute("type","radio");
                            input1.setAttribute("name",codigoPregunta);
                            input1.setAttribute("id",codigoPregunta+"-5");
                            input1.setAttribute("value","5");
                            td3.appendChild(input1);
                            tr.appendChild(td3);

                            // td4
                            var td4 = document.createElement("td");
                            var input2 = document.createElement("input");
                            input2.setAttribute("type","radio");
                            input2.setAttribute("name",codigoPregunta);
                            input2.setAttribute("id",codigoPregunta+"-4");
                            input2.setAttribute("value","4");
                            td4.appendChild(input2);
                            tr.appendChild(td4);
                            
                            // td5
                            var td5 = document.createElement("td");
                            var input3 = document.createElement("input");
                            input3.setAttribute("type","radio");
                            input3.setAttribute("name",codigoPregunta);
                            input3.setAttribute("id",codigoPregunta+"-3");
                            input3.setAttribute("value","3");
                            td5.appendChild(input3);
                            tr.appendChild(td5);
                            
                            // td6
                            var td6 = document.createElement("td");
                            var input4 = document.createElement("input");
                            input4.setAttribute("type","radio");
                            input4.setAttribute("name",codigoPregunta);
                            input4.setAttribute("id",codigoPregunta+"-2");
                            input4.setAttribute("value","2");
                            td6.appendChild(input4);
                            tr.appendChild(td6);  
                            
                            // td7
                            var td7 = document.createElement("td");
                            var input5 = document.createElement("input");
                            input5.setAttribute("type","radio");
                            input5.setAttribute("name",codigoPregunta);
                            input5.setAttribute("id",codigoPregunta+"-1");
                            input5.setAttribute("value","1");
                            td7.appendChild(input5);
                            tr.appendChild(td7);                              

                            var td8 = document.createElement("td");
                            var textotd8 = document.createTextNode("\n");       
                            td8.appendChild(textotd8);
                            tr.appendChild(td8); 

                            tbody.appendChild(tr);

                            var crit = {codigo:criterioId, pregunta:codigoPregunta};
                            criteriosAutDirector.push(crit);
                        

                        

                        
/*
                        var radio1 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-5\" value=\"5\"></td>";
                        var radio2 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-4\" value=\"4\"></td>";
                        var radio3 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-3\" value=\"3\"></td>";
                        var radio4 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-2\" value=\"2\"></td>";
                        var radio5 = "<input type=\"radio\" name=\""+codigo+"\" id=\""+codigo+"-1\" value=\"1\"></td>";

                        
                        t.row.add([criterio, radio1,radio2,radio3,radio4,radio5]).draw(false);
                        */
                    }
                }else{
                    alert("Usted ya hizo su autoevaluacion");
                    window.location="home.php"; 
                }
            },
            error: function(xhr, status, error) {            
                
                console.log(xhr.responseText);            
                console.log(xhr.statusText);
                console.log(status);
                console.log(error);

            }  
        });
    
}

function guardarAutoEvaluacionDirector(){

    var resultados = [];
    var arrayLength = criteriosAutDirector.length;
    for (var j = 0; j < arrayLength; j++) {



        var value = 0;
        if(document.getElementById(criteriosAutDirector[j].pregunta+"-1").checked){
            value = 1;
        }else if(document.getElementById(criteriosAutDirector[j].pregunta+"-2").checked){
            value = 2;
        }else if(document.getElementById(criteriosAutDirector[j].pregunta+"-3").checked){
            value = 3;
        }else if(document.getElementById(criteriosAutDirector[j].pregunta+"-4").checked){
            value = 4;
        }else if(document.getElementById(criteriosAutDirector[j].pregunta+"-5").checked){
            value = 5;
        }
        if(value == 0){
            alert("Debes llenar todos los campos");
            return;
        }
        resultados.push({criterio:criteriosAutDirector[j].codigo ,codigo:criteriosAutDirector[j].codigo, valor:value});
    }  


    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'guardarAutoEvaluacionDocente', resultados:resultados},
        type: "post",     
        success: function (response) {
            window.location="selfEvaluation.php";                  
        },
        error: function(xhr, status, error) {            
            
            console.log(xhr.responseText);            
            console.log(xhr.statusText);
            console.log(status);
            console.log(error);

        }  
    });
}


