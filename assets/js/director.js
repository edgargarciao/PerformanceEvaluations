

var preguntasDirector = [];
var preguntasDocente = []; 


function errorSesion() {
    var accion = document.getElementById("sesion_alert");
    accion.innerHTML = '<div class="alert alert-danger" style="color: #000000bf "role="alert">\n' +
        '                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>\n' +
        '                    Usuario o contraseña invalidos\n' +
        '                </div>';
    console.log(accion.innerHTML);
}

var accion = document.querySelector("#sesion_alert");
if(accion!=null){

    $.ajax({
        url:"include.php",
        data:{solicitud:'login'},
        type:"post",
        dataType:"json",
        success:function(data){
            document.getElementById("name").innerText = data.persona.nombres + " " + data.persona.apellidos;
        }
    });
}

var accion2 = document.querySelector("#close_sesion");
if(accion2!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'homeDir'},
        type:"post",
        dataType:"json",
        success:function(data){
            document.getElementById("name").innerText = data.persona.nombres + " " + data.persona.apellidos;
        }
    });
}

var accion3 = document.querySelector("#view_profile");
if(accion3!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'viewProfileDir'},
        type:"post",
        dataType:"json",
        success:function(data){
            document.getElementById("codigo").innerText = data.persona.codigo;
            document.getElementById("nombres").innerText = data.persona.nombres;
            document.getElementById("apellidos").innerText = data.persona.apellidos;
            document.getElementById("cedula").innerText = data.persona.dni;
            document.getElementById("celular").innerText = data.persona.celular;
            document.getElementById("direccion").innerText = data.persona.direccion;
            document.getElementById("correo").innerText = data.persona.correo;
        }
    });
}

var accion4 = document.querySelector("#edit_profile");
if(accion4!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'viewProfileDir'},
        type:"post",
        dataType:"json",
        success:function(data){
            document.querySelector("#cel").value = data.persona.celular;
            document.querySelector("#dir").value = data.persona.direccion;
        }
    });
}

var accion5 = document.querySelector("#teacher_list");
if(accion5!=null) {
    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listDocentes'},
        type: "post",
        async:false,
        success: function (response) {
            var json = JSON.parse(response);
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";

            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Codigo = json[i].codigo;
                    var Nombre = json[i].nombres;
                    var Apellido = (json[i].apellidos == "null")?"":json[i].apellidos;                    
                    var Celular =  (json[i].celular == "null")?"":json[i].apellidos;
                    var Direccion = (json[i].direccion == "null")?"":json[i].apellidos;
                    var Correo = json[i].correo;
                    var Departamento = 'Ingenieria de Sistemas';


                    respuesta3 += ' <a class="btn btn-default" data-toggle="modal" data-target="#myModal'+Codigo+'"> ';
                    respuesta3 += 'Editar';
                    respuesta3 += '</a> \n' ;
                    respuesta3 += '<button id="hab'+Codigo+'" class="btn btn-success '+((json[i].estado == "Activo")?"disabled":"")+' " onclick="habilitarDocente(\''+Codigo+'\')">';
                    respuesta3 += 'Habilitar';
                    respuesta3 += '</button>  \n';
                    respuesta3 += '<button id="deshab'+Codigo+'" class="btn btn-danger '+((json[i].estado == "Inactivo")?"disabled":"")+'" onclick="desHabilitarDocente(\''+Codigo+'\')">';
                    respuesta3 += 'Deshabilitar';
                    respuesta3 += '</button>';
                    
                    t.row.add([Codigo, Nombre, Apellido, Celular, Direccion, Correo, Departamento, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";


            var modals = document.getElementById("modals");


            var div1 = document.createElement("DIV");
            div1.setAttribute("id","myModal"+json[i].codigo);
            div1.setAttribute("class","modal fade myModal");
            div1.setAttribute("tabindex","-1");
            div1.setAttribute("role","dialog");
            div1.setAttribute("aria-labelledby","myModalLabel");
            div1.setAttribute("aria-hidden","true");


            var div2 = document.createElement("DIV");
            div2.setAttribute("class","modal-dialog modal-dialog-centered");
            
            var div3 = document.createElement("DIV");
            div3.setAttribute("class","modal-content");

            var div4 = document.createElement("DIV");
            div4.setAttribute("class","modal-header");
            div4.setAttribute("style","display: block");
            
            div3.appendChild(div4);

            var p1 = document.createElement("P");
            p1.setAttribute("class","modal-tittle");
            p1.setAttribute("style","display: block");

            var textop1 = document.createTextNode("EDITAR CAMPOS");       
            p1.appendChild(textop1);

            div4.appendChild(p1);

            var div5 = document.createElement("DIV");
            div5.setAttribute("class","modal-body");                   

            var label1 = document.createElement("LABEL");
            label1.setAttribute("style","text-align: justify;padding-top: 0px;");
            label1.setAttribute("class","login-box-msg");
            var textolabel1 = document.createTextNode("Llena los campos a editar la información requerida");       
            label1.appendChild(textolabel1);

            div5.appendChild(label1);

            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));

            var div6 = document.createElement("DIV");
            div6.setAttribute("class","row"); 
            
            var div7 = document.createElement("DIV");
            div7.setAttribute("class","col-xs-12 col-sm-8 col-sm-offset-2"); 

            var div8 = document.createElement("DIV");
            div8.setAttribute("class","group-material"); 

            var input1 = document.createElement("INPUT");
            input1.setAttribute("class","material-control tooltips-general"); 
            input1.setAttribute("id","txtnombre"+Codigo); 
            input1.setAttribute("type","text"); 
            input1.setAttribute("name","nombre"); 
            input1.setAttribute("placeholder","Nombre del docente"); 
            input1.setAttribute("data-toggle","tooltip");
            input1.setAttribute("value",Nombre);
            
            div8.appendChild(input1);

            var span1 = document.createElement("SPAN");
            span1.setAttribute("class","highlight"); 

            div8.appendChild(span1);

            var span2 = document.createElement("SPAN");
            span2.setAttribute("class","bar"); 

            div8.appendChild(span2);

            var label2 = document.createElement("LABEL");
            label2.setAttribute("style","text-align: justify;padding-top: 0px;");
            label2.setAttribute("class","login-box-msg");
            var textolabel2 = document.createTextNode("Nombre del docente");       
            label2.appendChild(textolabel2);

            div8.appendChild(label2);

            div7.appendChild(div8);

            var p2 = document.createElement("P");
            p2.setAttribute("class","text-center");

            var button1 = document.createElement("BUTTON");
            button1.setAttribute("class","btn btn-danger");
            //button1.setAttribute("type","submit");
            button1.setAttribute("onclick","actualizarDocente("+json[i].codigo+")");

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");

            button1.appendChild(i1);

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");


            var textobutton1 = document.createTextNode("Guardar");       
            button1.appendChild(textobutton1);

            p2.appendChild(button1);

            var inputhidden = document.createElement("INPUT");
            inputhidden.setAttribute("type","hidden");             
            inputhidden.setAttribute("name","solicitud");
            inputhidden.setAttribute("value","updateDocente");              
            
            p2.appendChild(inputhidden);

            div7.appendChild(p2);

            div6.appendChild(div7);

            div5.appendChild(div6);

            div3.appendChild(div5);

            div2.appendChild(div3);

            div1.appendChild(div2);


            modals.appendChild(div1);

        }
                
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                alert("Ha ocurrido un error al listar los docentes");
            }
        }
    });

    modifyTable('dataTables-example');

}

function modifyTable(tableId){
    $('#'+tableId+' tr').removeAttr('class');
    $('#'+tableId+' tr').removeAttr('role');
    $('#'+tableId+' tbody tr td:first-child').removeAttr('class');
    $('#'+tableId+' tbody tr td').addClass('text-center');

    $('#'+tableId+' thead tr').addClass('danger');
    $('#'+tableId+' thead tr th').removeAttr('class');
    $('#'+tableId+' thead tr th').removeAttr('tabindex');
    $('#'+tableId+' thead tr th').removeAttr('aria-controls');
    $('#'+tableId+' thead tr th').removeAttr('rowspan');
    $('#'+tableId+' thead tr th').removeAttr('colspan');
    $('#'+tableId+' thead tr th').removeAttr('aria-label');
    $('#'+tableId+' thead tr th').removeAttr('aria-sort');
    $('#'+tableId+' thead tr th').removeAttr('style');
    $('#'+tableId+' thead tr th').addClass('text-center');
    $('#'+tableId+' thead tr th:last-child').removeAttr('class');
    $('#'+tableId+' thead tr th:last-child').attr('style', 'width: 26%');
    $('#'+tableId+' tbody tr td:last-child').removeAttr('class');
    $('#'+tableId+'').removeAttr('class');
    $('#'+tableId+'').addClass('table table-striped text-center');
    $('#'+tableId+'').removeAttr('role');
    $('#'+tableId+'').removeAttr('aria-describedby');
}

function habilitarDocente(codigo){
    
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateTeacher', estado: "Activo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success disabled"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function desHabilitarDocente(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateTeacher', estado: "Inactivo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger disabled"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function actualizarDocente(codigo){

    var nombre = document.getElementById("txtnombre"+codigo).value;
    console.log("nombre --> "+nombre);

    $.ajax({
        url:"../../include.php",
        data:{solicitud:'updateTeacherName', nombre: nombre, codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            location.reload();
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

var accion6 = document.querySelector("#subject_list");
if(accion6!=null) {
    
    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listMateria'},
        type: "post",
        //dataType: "Array",
        success: function (response) {
            var json = JSON.parse(response);
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";
            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombre;
                    var Codigo = json[i].codigo;

                    respuesta3 += ' <a class="btn btn-default" data-toggle="modal" data-target="#myModal'+Codigo+'"> ';
                    respuesta3 += 'Editar';
                    respuesta3 += '</a> \n' ;
                    respuesta3 += '<button id="hab'+Codigo+'" class="btn btn-success '+((json[i].estado == "Activo")?"disabled":"")+' " onclick="habilitarAsignatura(\''+Codigo+'\')">';
                    respuesta3 += 'Habilitar';
                    respuesta3 += '</button>  \n';
                    respuesta3 += '<button id="deshab'+Codigo+'" class="btn btn-danger '+((json[i].estado == "Inactivo")?"disabled":"")+'" onclick="desHabilitarAsignatura(\''+Codigo+'\')">';
                    respuesta3 += 'Deshabilitar';
                    respuesta3 += '</button>';
                    
                    t.row.add([Nombre, Codigo, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";

                    var modals = document.getElementById("modals");


            var div1 = document.createElement("DIV");
            div1.setAttribute("id","myModal"+json[i].codigo);
            div1.setAttribute("class","modal fade myModal");
            div1.setAttribute("tabindex","-1");
            div1.setAttribute("role","dialog");
            div1.setAttribute("aria-labelledby","myModalLabel");
            div1.setAttribute("aria-hidden","true");


            var div2 = document.createElement("DIV");
            div2.setAttribute("class","modal-dialog modal-dialog-centered");
            
            var div3 = document.createElement("DIV");
            div3.setAttribute("class","modal-content");

            var div4 = document.createElement("DIV");
            div4.setAttribute("class","modal-header");
            div4.setAttribute("style","display: block");
            
            div3.appendChild(div4);

            var p1 = document.createElement("P");
            p1.setAttribute("class","modal-tittle");
            p1.setAttribute("style","display: block");

            var textop1 = document.createTextNode("EDITAR CAMPOS");       
            p1.appendChild(textop1);

            div4.appendChild(p1);

            var div5 = document.createElement("DIV");
            div5.setAttribute("class","modal-body");                   

            var label1 = document.createElement("LABEL");
            label1.setAttribute("style","text-align: justify;padding-top: 0px;");
            label1.setAttribute("class","login-box-msg");
            var textolabel1 = document.createTextNode("Llena los campos a editar la información requerida");       
            label1.appendChild(textolabel1);

            div5.appendChild(label1);

            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));

            var div6 = document.createElement("DIV");
            div6.setAttribute("class","row"); 
            
            var div7 = document.createElement("DIV");
            div7.setAttribute("class","col-xs-12 col-sm-8 col-sm-offset-2"); 

            var div8 = document.createElement("DIV");
            div8.setAttribute("class","group-material"); 

            var input1 = document.createElement("INPUT");
            input1.setAttribute("class","material-control tooltips-general"); 
            input1.setAttribute("id","txtnombre"+Codigo); 
            input1.setAttribute("type","text"); 
            input1.setAttribute("name","nombre"); 
            input1.setAttribute("placeholder","Nombre del docente"); 
            input1.setAttribute("data-toggle","tooltip");
            input1.setAttribute("value",Nombre);
            
            div8.appendChild(input1);

            var span1 = document.createElement("SPAN");
            span1.setAttribute("class","highlight"); 

            div8.appendChild(span1);

            var span2 = document.createElement("SPAN");
            span2.setAttribute("class","bar"); 

            div8.appendChild(span2);

            var label2 = document.createElement("LABEL");
            label2.setAttribute("style","text-align: justify;padding-top: 0px;");
            label2.setAttribute("class","login-box-msg");
            var textolabel2 = document.createTextNode("Nombre del docente");       
            label2.appendChild(textolabel2);

            div8.appendChild(label2);

            var div12 = document.createElement("DIV");
            div12.setAttribute("class","group-material"); 

            var input2 = document.createElement("INPUT");
            input2.setAttribute("class","material-control tooltips-general"); 
            input2.setAttribute("id","txtcodigo"+Codigo); 
            input2.setAttribute("type","number"); 
            input2.setAttribute("name","codigo");             
            input2.setAttribute("data-toggle","tooltip");
            input2.setAttribute("value",Codigo);
            
            div12.appendChild(input2);

            var span3 = document.createElement("SPAN");
            span3.setAttribute("class","highlight"); 

            div12.appendChild(span3);

            var span4 = document.createElement("SPAN");
            span4.setAttribute("class","bar"); 

            div12.appendChild(span4);

            var label3 = document.createElement("LABEL");
            label3.setAttribute("style","text-align: justify;padding-top: 0px;");
            label3.setAttribute("class","login-box-msg");
            var textolabel3 = document.createTextNode("Codigo de la asignatura");       
            label3.appendChild(textolabel3);

            div12.appendChild(label3);

            div7.appendChild(div12);

            div7.appendChild(div8);

            var p2 = document.createElement("P");
            p2.setAttribute("class","text-center");

            var button1 = document.createElement("BUTTON");
            button1.setAttribute("class","btn btn-danger");
            //button1.setAttribute("type","submit");
            button1.setAttribute("onclick","actualizarAsignatura("+Codigo+")");

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");

            button1.appendChild(i1);

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");


            var textobutton1 = document.createTextNode("Guardar");       
            button1.appendChild(textobutton1);

            p2.appendChild(button1);

            var inputhidden = document.createElement("INPUT");
            inputhidden.setAttribute("type","hidden");             
            inputhidden.setAttribute("name","solicitud");
            inputhidden.setAttribute("value","updateAsignatura");              
            
            p2.appendChild(inputhidden);

            div7.appendChild(p2);

            div6.appendChild(div7);

            div5.appendChild(div6);

            div3.appendChild(div5);

            div2.appendChild(div3);

            div1.appendChild(div2);


            modals.appendChild(div1);
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                alert("Ha ocurrido un error al listar las asignaturas");
            }
        }
    });

    modifyTable('dataTables-example');
}

function habilitarAsignatura(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateAsignatura', estado: "Activo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success disabled"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function desHabilitarAsignatura(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateAsignatura', estado: "Inactivo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger disabled"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function actualizarAsignatura(codigo){

    var nombre = document.getElementById("txtnombre"+codigo).value;
    var codigoNuevo = document.getElementById("txtcodigo"+codigo).value;
    console.log("nombre --> "+nombre);
    console.log("codigo --> "+codigo);

    $.ajax({
        url:"../../include.php",
        data:{solicitud:'updateAsignatura', nombre: nombre, codigo: codigo, codigoNuevo:codigoNuevo },
        type:"post",
        dataType:"json",
        success:function(data){
            location.reload();
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

var accion7 = document.querySelector("#period_list");
if(accion7!=null) {
    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listPeriodo'},
        type: "post",
        //dataType: "Array",
        success: function (response) {
            var json = JSON.parse(response);
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";

            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Descripcion = json[i].descripcion;
                    var FechaI = json[i].fechaI;
                    var FechaF = json[i].fechaF;

                    respuesta2 += '<button type="reset" class="btn btn-danger" style="margin-right: 20px" data-toggle="tooltip" data-placement="top" title="Pulsa el botón para editar la informacion del docente"><i class="zmdi zmdi-edit" onclick="accion"></i>';
                    respuesta2 += '&nbsp Editar';
                    respuesta2 += '</button>';
                    respuesta2 += '<button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Pulsa el botón para guardar la informacion del docente"><i class="zmdi zmdi-save" onclick="accion"></i>';
                    respuesta2 += '&nbsp Guardar';
                    respuesta2 += '</button>';

                    respuesta3 += '<button class="btn btn-sm btn-default">';
                    respuesta3 += 'ON';
                    respuesta3 += '</button>';
                    respuesta3 += '<button class="btn btn-sm btn-danger active">';
                    respuesta3 += 'OFF';
                    respuesta3 += '</button>';

                    t.row.add([Descripcion, FechaI, FechaF, respuesta2, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";
                }
            }else{
                alert("Ha ocurrido un error al listar los periodos");
            }
        }
    });
}

var accion8 = document.querySelector("#info");
if(accion8!=null) {
    var date = new Date();
    var mes = date.getMonth()+1;
    var newDate = date.getDate() +" - "+ mes +" - "+ date.getFullYear();

    var t = $('#dataTables-example1').DataTable({select: true, lengthChange: false, searching: false, bInfo: false, bPaginate: false});
    t.clear().draw();
    t.row.add([newDate]).draw(false);
}

var accion9 = document.querySelector("#list_teacher");
if(accion9!=null) {
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
                var t = $('#dataTables-example').DataTable({select: true});
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombres + " " + ((json[i].apellidos == 'null')?"":json[i].apellidos);
                    var Codigo = json[i].codigo;

                    respuesta2 += '<a href="teacherEvaluation.php?id='+Codigo+'" class="btn btn-danger"><i class="zmdi zmdi-check"></i>';
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

var accion10 = document.querySelector("#list_pair");
if(accion10!=null) {
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
                var t = $('#dataTables-example').DataTable({select: true});
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombres + " " + json[i].apellidos;
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

var accion11 = document.querySelector("#docente_director");
var accion12 = document.querySelector("#pair");
if(accion11!=null || accion11!=null){
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
                    var Nombre = json[i].nombres + " " + ((json[i].apellidos == "null")?"":json[i].apellidos);
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

var accion13 = document.querySelector("#progress");
if(accion13!=null) {
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
                var t = $('#dataTables-example').DataTable({select: true});
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var Nombre = json[i].nombres + " " + json[i].apellidos;
                    var Codigo = json[i].codigo;

                    t.row.add([Nombre, Codigo, 'Incompleto']).draw(false);
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                alert("Ha ocurrido un error al listar los docentes");
            }
        }
    });
}

var accion50 = document.querySelector("#criterios");
if(accion50!=null) {
    
    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listCriterios'},
        type: "post",        
        success: function (response) {
            console.log("--> "+JSON.parse((response)));
            var json = JSON.parse((response));
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";
            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    var tipoEvaluacion = json[i].nombre;
                    var Nombre = json[i].nombreCriterio;
                    var Codigo = json[i].id;
                    var tipoEvaluacionId = json[i].tipoEvaluacion;

                    respuesta3 += ' <a class="btn btn-default" data-toggle="modal" data-target="#myModal'+Codigo+'"> ';
                    respuesta3 += 'Editar';
                    respuesta3 += '</a> \n' ;
                    respuesta3 += '<button id="hab'+Codigo+'" class="btn btn-success '+((json[i].estado == "Activo")?"disabled":"")+' " onclick="habilitarCriterio(\''+Codigo+'\')">';
                    respuesta3 += 'Habilitar';
                    respuesta3 += '</button>  \n';
                    respuesta3 += '<button id="deshab'+Codigo+'" class="btn btn-danger '+((json[i].estado == "Inactivo")?"disabled":"")+'" onclick="desHabilitarCriterio(\''+Codigo+'\')">';
                    respuesta3 += 'Deshabilitar';
                    respuesta3 += '</button>';
                    
                    t.row.add([tipoEvaluacion, Nombre, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";

                    var modals = document.getElementById("modals");


            var div1 = document.createElement("DIV");
            div1.setAttribute("id","myModal"+Codigo);
            div1.setAttribute("class","modal fade myModal");
            div1.setAttribute("tabindex","-1");
            div1.setAttribute("role","dialog");
            div1.setAttribute("aria-labelledby","myModalLabel");
            div1.setAttribute("aria-hidden","true");


            var div2 = document.createElement("DIV");
            div2.setAttribute("class","modal-dialog modal-dialog-centered");
            
            var div3 = document.createElement("DIV");
            div3.setAttribute("class","modal-content");

            var div4 = document.createElement("DIV");
            div4.setAttribute("class","modal-header");
            div4.setAttribute("style","display: block");
            
            div3.appendChild(div4);

            var p1 = document.createElement("P");
            p1.setAttribute("class","modal-tittle");
            p1.setAttribute("style","display: block");

            var textop1 = document.createTextNode("EDITAR CAMPOS");       
            p1.appendChild(textop1);

            div4.appendChild(p1);

            var div5 = document.createElement("DIV");
            div5.setAttribute("class","modal-body");                   

            var label1 = document.createElement("LABEL");
            label1.setAttribute("style","text-align: justify;padding-top: 0px;");
            label1.setAttribute("class","login-box-msg");
            var textolabel1 = document.createTextNode("Llena los campos a editar la información requerida");       
            label1.appendChild(textolabel1);

            div5.appendChild(label1);

            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));

            var div6 = document.createElement("DIV");
            div6.setAttribute("class","row"); 
            
            var div7 = document.createElement("DIV");
            div7.setAttribute("class","col-xs-12 col-sm-8 col-sm-offset-2"); 

            var div8 = document.createElement("DIV");
            div8.setAttribute("class","group-material"); 

            var input1 = document.createElement("INPUT");
            input1.setAttribute("class","material-control tooltips-general"); 
            input1.setAttribute("id","txtTipoEvaluacionx"+Codigo); 
            input1.setAttribute("type","hidden"); 
            input1.setAttribute("name","nombrex"); 
            input1.setAttribute("placeholder","Tipo de evaluacion"); 
            input1.setAttribute("data-toggle","tooltip");
            input1.setAttribute("value",Nombre);
            
            div8.appendChild(input1);

            var span1 = document.createElement("SPAN");
            span1.setAttribute("class","highlight"); 

            div8.appendChild(span1);

            var span2 = document.createElement("SPAN");
            span2.setAttribute("class","bar"); 

            div8.appendChild(span2);

            var label2 = document.createElement("LABEL");
            label2.setAttribute("style","text-align: justify;padding-top: 0px;");
            label2.setAttribute("class","login-box-msg");
            var textolabel2 = document.createTextNode("Tipo de evaluacion");       
            label2.appendChild(textolabel2);

            div8.appendChild(label2);

            var div50 = document.createElement("DIV");
            div50.setAttribute("class","group-material"); 

            var select = document.createElement("SELECT");
            select.setAttribute("class","form-control"); 
            select.setAttribute("name","tipoEvaluacion"); 
            select.setAttribute("id","txttipoEvaluacion"+Codigo); 

            var option1 = document.createElement("OPTION");
            option1.setAttribute("value","1"); 

            var textooption1 = document.createTextNode("Director-profesor");       
            option1.appendChild(textooption1);

            select.appendChild(option1);
            

            var option2 = document.createElement("OPTION");
            option2.setAttribute("value","2"); 

            var textooption2 = document.createTextNode("Profesor-profesor");       
            option2.appendChild(textooption2);

            select.appendChild(option2);



            var option3 = document.createElement("OPTION");
            option3.setAttribute("value","3"); 

            var textooption3 = document.createTextNode("Autoevalucion profesor");       
            option3.appendChild(textooption3);

            select.appendChild(option3);



            var option4 = document.createElement("OPTION");
            option4.setAttribute("value","4"); 

            var textooption4 = document.createTextNode("Autoevaluacion director");       
            option4.appendChild(textooption4);

            select.appendChild(option4);

            div50.appendChild(select);

            

            var div12 = document.createElement("DIV");
            div12.setAttribute("class","group-material"); 

            var input2 = document.createElement("INPUT");
            input2.setAttribute("class","material-control tooltips-general"); 
            input2.setAttribute("id","txtnombre"+Codigo); 
            input2.setAttribute("type","text"); 
            input2.setAttribute("name","nombre");             
            input2.setAttribute("data-toggle","tooltip");
            input2.setAttribute("value",Nombre);
            
            div12.appendChild(input2);

            var span3 = document.createElement("SPAN");
            span3.setAttribute("class","highlight"); 

            div12.appendChild(span3);

            var span4 = document.createElement("SPAN");
            span4.setAttribute("class","bar"); 

            div12.appendChild(span4);

            var label3 = document.createElement("LABEL");
            label3.setAttribute("style","text-align: justify;padding-top: 0px;");
            label3.setAttribute("class","login-box-msg");
            var textolabel3 = document.createTextNode("Nombre del criterio");       
            label3.appendChild(textolabel3);

            div12.appendChild(label3);

            div7.appendChild(div12);

            div7.appendChild(div8);
            div7.appendChild(div50);

            var p2 = document.createElement("P");
            p2.setAttribute("class","text-center");

            var button1 = document.createElement("BUTTON");
            button1.setAttribute("class","btn btn-danger");
            //button1.setAttribute("type","submit");
            button1.setAttribute("onclick","actualizarCriterio("+Codigo+")");

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");

            button1.appendChild(i1);

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");


            var textobutton1 = document.createTextNode("Guardar");       
            button1.appendChild(textobutton1);

            p2.appendChild(button1);

            var inputhidden = document.createElement("INPUT");
            inputhidden.setAttribute("type","hidden");             
            inputhidden.setAttribute("name","solicitud");
            inputhidden.setAttribute("value","updateCriterio");              
            
            p2.appendChild(inputhidden);

            div7.appendChild(p2);

            div6.appendChild(div7);

            div5.appendChild(div6);

            div3.appendChild(div5);

            div2.appendChild(div3);

            div1.appendChild(div2);


            modals.appendChild(div1);

            
            document.getElementById("txttipoEvaluacion"+Codigo).selectedIndex = tipoEvaluacionId-1 ; 
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                alert("Ha ocurrido un error al listar las asignaturas");
            }
        },
        error: function(xhr, status, error) {            
            //var err = eval("(" + xhr.responseText + ")");
            console.log(xhr.responseText);
                    console.log(xhr.statusText);
                    console.log(status);
                    console.log(error);

        }  
    });

    modifyTable('dataTables-example');
}

function habilitarCriterio(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateCriterio', estado: "Activo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success disabled"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function desHabilitarCriterio(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStateCriterio', estado: "Inactivo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger disabled"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function actualizarCriterio(codigo){

    var nombre = document.getElementById("txtnombre"+codigo).value;
    var e = document.getElementById("txttipoEvaluacion"+codigo);
    var tipoevaluacion = e.options[e.selectedIndex].value;
    console.log("nombre --> "+nombre);
    console.log("codigo --> "+codigo);

    $.ajax({
        url:"../../include.php",
        data:{solicitud:'updateCriterio', nombre: nombre, tipoevaluacion: tipoevaluacion,codigo:codigo },
        type:"post",
        dataType:"json",
        success:function(data){
            location.reload();
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}


/*************************************************
 *  AUTOEVALACION DIRECTOR
 ************************************************/

var accion60 = document.querySelector("#administrar");
if(accion60!=null) {
    
    cargarPreguntasDirector();
    //cargarPreguntasDocente();

    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listPreguntasDirector'},
        type: "post",     
   
        success: function (response) {
   
            var json = JSON.parse((response));
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";
            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    console.log(json[i]);
                    var criterio = json[i].nombreCriterio;
                    var Nombre = json[i].nombrePregunta;
                    var Codigo = json[i].id;
                    var tipoCriterioId = json[i].criterio;

                    respuesta3 += ' <a class="btn btn-default" data-toggle="modal" data-target="#myModal'+Codigo+'"> ';
                    respuesta3 += 'Editar';
                    respuesta3 += '</a> \n' ;
                    respuesta3 += '<button id="hab'+Codigo+'" class="btn btn-success '+((json[i].estado == "Activo")?"disabled":"")+' " onclick="habilitarPreguntaDirector(\''+Codigo+'\')">';
                    respuesta3 += 'Habilitar';
                    respuesta3 += '</button>  \n';
                    respuesta3 += '<button id="deshab'+Codigo+'" class="btn btn-danger '+((json[i].estado == "Inactivo")?"disabled":"")+'" onclick="desHabilitarPreguntaDirector(\''+Codigo+'\')">';
                    respuesta3 += 'Deshabilitar';
                    respuesta3 += '</button>';
                    
                    t.row.add([criterio, Nombre, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";

                    var modals = document.getElementById("modals");


            var div1 = document.createElement("DIV");
            div1.setAttribute("id","myModal"+Codigo);
            div1.setAttribute("class","modal fade myModal");
            div1.setAttribute("tabindex","-1");
            div1.setAttribute("role","dialog");
            div1.setAttribute("aria-labelledby","myModalLabel");
            div1.setAttribute("aria-hidden","true");


            var div2 = document.createElement("DIV");
            div2.setAttribute("class","modal-dialog modal-dialog-centered");
            
            var div3 = document.createElement("DIV");
            div3.setAttribute("class","modal-content");

            var div4 = document.createElement("DIV");
            div4.setAttribute("class","modal-header");
            div4.setAttribute("style","display: block");
            
            div3.appendChild(div4);

            var p1 = document.createElement("P");
            p1.setAttribute("class","modal-tittle");
            p1.setAttribute("style","display: block");

            var textop1 = document.createTextNode("EDITAR CAMPOS");       
            p1.appendChild(textop1);

            div4.appendChild(p1);

            var div5 = document.createElement("DIV");
            div5.setAttribute("class","modal-body");                   

            var label1 = document.createElement("LABEL");
            label1.setAttribute("style","text-align: justify;padding-top: 0px;");
            label1.setAttribute("class","login-box-msg");
            var textolabel1 = document.createTextNode("Llena los campos a editar la información requerida");       
            label1.appendChild(textolabel1);

            div5.appendChild(label1);

            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));

            var div6 = document.createElement("DIV");
            div6.setAttribute("class","row"); 
            
            var div7 = document.createElement("DIV");
            div7.setAttribute("class","col-xs-12 col-sm-8 col-sm-offset-2"); 

            var div8 = document.createElement("DIV");
            div8.setAttribute("class","group-material"); 

            var input1 = document.createElement("INPUT");
            input1.setAttribute("class","material-control tooltips-general"); 
            input1.setAttribute("id","txtTipoEvaluacionx"+Codigo); 
            input1.setAttribute("type","hidden"); 
            input1.setAttribute("name","nombrex"); 
            input1.setAttribute("placeholder","Tipo de evaluacion"); 
            input1.setAttribute("data-toggle","tooltip");
            input1.setAttribute("value",Nombre);
            
            div8.appendChild(input1);

            var span1 = document.createElement("SPAN");
            span1.setAttribute("class","highlight"); 

            div8.appendChild(span1);

            var span2 = document.createElement("SPAN");
            span2.setAttribute("class","bar"); 

            div8.appendChild(span2);

            var label2 = document.createElement("LABEL");
            label2.setAttribute("style","text-align: justify;padding-top: 0px;");
            label2.setAttribute("class","login-box-msg");
            var textolabel2 = document.createTextNode("Tipo de evaluacion");       
            label2.appendChild(textolabel2);

            div8.appendChild(label2);

            var div50 = document.createElement("DIV");
            div50.setAttribute("class","group-material"); 

            var select = document.createElement("SELECT");
            select.setAttribute("class","form-control"); 
            select.setAttribute("name","txtCriterio"); 
            select.setAttribute("id","txtCriterio"+Codigo); 


            var arrayLength = preguntasDirector.length;
            for (var j = 0; j < arrayLength; j++) {
 
                var option = document.createElement("OPTION");
                option.setAttribute("value",preguntasDirector[j].codigo); 
    
                var textooption = document.createTextNode(preguntasDirector[j].criterio);       
                option.appendChild(textooption);
    
                select.appendChild(option);
            }

            div50.appendChild(select);

            

            var div12 = document.createElement("DIV");
            div12.setAttribute("class","group-material"); 

            var input2 = document.createElement("INPUT");
            input2.setAttribute("class","material-control tooltips-general"); 
            input2.setAttribute("id","txtnombre"+Codigo); 
            input2.setAttribute("type","text"); 
            input2.setAttribute("name","nombre");             
            input2.setAttribute("data-toggle","tooltip");
            input2.setAttribute("value",Nombre);
            
            div12.appendChild(input2);

            var span3 = document.createElement("SPAN");
            span3.setAttribute("class","highlight"); 

            div12.appendChild(span3);

            var span4 = document.createElement("SPAN");
            span4.setAttribute("class","bar"); 

            div12.appendChild(span4);

            var label3 = document.createElement("LABEL");
            label3.setAttribute("style","text-align: justify;padding-top: 0px;");
            label3.setAttribute("class","login-box-msg");
            var textolabel3 = document.createTextNode("Nombre del criterio");       
            label3.appendChild(textolabel3);

            div12.appendChild(label3);

            div7.appendChild(div12);

            div7.appendChild(div8);
            div7.appendChild(div50);

            var p2 = document.createElement("P");
            p2.setAttribute("class","text-center");

            var button1 = document.createElement("BUTTON");
            button1.setAttribute("class","btn btn-danger");
            //button1.setAttribute("type","submit");
            button1.setAttribute("onclick","actualizarPreguntaDirector("+Codigo+")");

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");

            button1.appendChild(i1);

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");


            var textobutton1 = document.createTextNode("Guardar");       
            button1.appendChild(textobutton1);

            p2.appendChild(button1);

            var inputhidden = document.createElement("INPUT");
            inputhidden.setAttribute("type","hidden");             
            inputhidden.setAttribute("name","solicitud");
            inputhidden.setAttribute("value","updatePreguntaDirector");              
            
            p2.appendChild(inputhidden);

            div7.appendChild(p2);

            div6.appendChild(div7);

            div5.appendChild(div6);

            div3.appendChild(div5);

            div2.appendChild(div3);

            div1.appendChild(div2);


            modals.appendChild(div1);

            document.getElementById("txtCriterio"+Codigo).selectedIndex = $("#txtCriterio"+ Codigo+" > option:contains("+criterio+")").index() ; 
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
            }
        },
        error: function(xhr, status, error) {            
            //var err = eval("(" + xhr.responseText + ")");
            console.log(xhr.responseText);
                    console.log(xhr.statusText);
                    console.log(status);
                    console.log(error);

        }  
    });

    modifyTable('dataTables-example');
}

function habilitarPreguntaDirector(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStatePreguntaDirector', estado: "Activo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success disabled"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function desHabilitarPreguntaDirector(codigo){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'changeStatePreguntaDirector', estado: "Inactivo", codigo: codigo},
        type:"post",
        dataType:"json",
        success:function(data){
            var buttonHab = document.getElementById("hab"+codigo);
            buttonHab.setAttribute("class","btn btn-success"); 

            var buttonDesHab = document.getElementById("deshab"+codigo);
            buttonDesHab.setAttribute("class","btn btn-danger disabled"); 

        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function actualizarPreguntaDirector(codigo){

    var nombre = document.getElementById("txtnombre"+codigo).value;
    var e = document.getElementById("txtCriterio"+codigo);
    var criterio = e.options[e.selectedIndex].value;
    console.log("nombre --> "+nombre);
    console.log("codigo --> "+codigo);

    $.ajax({
        url:"../../include.php",
        data:{solicitud:'updatePreguntaDirector', nombre: nombre, criterio: criterio,codigo:codigo },
        type:"post",
        dataType:"json",
        success:function(data){
            location.reload();
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}


function cargarPreguntasDirector(){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'consultarPreguntasDirector'},
        type:"post",
        dataType:"json",
 
        success:function(response){
        
            var json = JSON.parse(JSON.stringify(response));
            if (json.length != 0) {
                for (var i = 0; i < json.length; i++) {
                    var criterio = json[i].nombreCriterio;
                    var Codigo = json[i].id;
                    

                    var preguntaDirector = {codigo:Codigo, criterio:criterio};
                    preguntasDirector.push(preguntaDirector);
                
                    var option = document.createElement("OPTION");
                    option.setAttribute("value",Codigo); 
        
                    var textooption = document.createTextNode(criterio);       
                    option.appendChild(textooption);
                    var select = document.getElementById("criterioOptions");
                    select.appendChild(option);

                    //var preguntasDocente = [];

                }
            }
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

function cargarPreguntasDocente(){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'consultarPreguntasDocente'},
        type:"post",
        dataType:"json",
 
        success:function(response){
        
            var json = JSON.parse(JSON.stringify(response));
            if (json.length != 0) {
                for (var i = 0; i < json.length; i++) {
                    var criterio = json[i].nombreCriterio;
                    var Codigo = json[i].id;
                    

                    var preguntaDirector = {codigo:Codigo, criterio:criterio};
                    preguntasDirector.push(preguntaDirector);
                
                    var option = document.createElement("OPTION");
                    option.setAttribute("value",Codigo); 
        
                    var textooption = document.createTextNode(criterio);       
                    option.appendChild(textooption);
                    var select = document.getElementById("criterioOptions");
                    select.appendChild(option);

                    //var preguntasDocente = [];

                }
            }
        },
        error: function(xhr, status, error) {            
            var err = eval("(" + xhr.responseText + ")");
            alert(xhr.responseText);

        }      
    });
}

/*************************************************
 *  AUTOEVALACION DOCENTE
 ************************************************/

var accion70 = document.querySelector("#administrarT");
if(accion70!=null) {
    
    //cargarPreguntasDirector();
    cargarPreguntasDocente();

    $.ajax({
        url: "../../include.php",
        data: {solicitud: 'listPreguntasDocente'},
        type: "post",     
   
        success: function (response) {
   
            var json = JSON.parse((response));
            var respuesta = "";
            var respuesta2 = "";
            var respuesta3 = "";
            if (json.length != 0) {
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
                for (var i = 0; i < json.length; i++) {
                    console.log(json[i]);
                    var criterio = json[i].nombreCriterio;
                    var Nombre = json[i].nombrePregunta;
                    var Codigo = json[i].id;
                    var tipoCriterioId = json[i].criterio;

                    respuesta3 += ' <a class="btn btn-default" data-toggle="modal" data-target="#myModal'+Codigo+'"> ';
                    respuesta3 += 'Editar';
                    respuesta3 += '</a> \n' ;
                    respuesta3 += '<button id="hab'+Codigo+'" class="btn btn-success '+((json[i].estado == "Activo")?"disabled":"")+' " onclick="habilitarPreguntaDirector(\''+Codigo+'\')">';
                    respuesta3 += 'Habilitar';
                    respuesta3 += '</button>  \n';
                    respuesta3 += '<button id="deshab'+Codigo+'" class="btn btn-danger '+((json[i].estado == "Inactivo")?"disabled":"")+'" onclick="desHabilitarPreguntaDirector(\''+Codigo+'\')">';
                    respuesta3 += 'Deshabilitar';
                    respuesta3 += '</button>';
                    
                    t.row.add([criterio, Nombre, respuesta3]).draw(false);
                    respuesta2 = "";
                    respuesta3 = "";
                    respuesta = "";

                    var modals = document.getElementById("modals");


            var div1 = document.createElement("DIV");
            div1.setAttribute("id","myModal"+Codigo);
            div1.setAttribute("class","modal fade myModal");
            div1.setAttribute("tabindex","-1");
            div1.setAttribute("role","dialog");
            div1.setAttribute("aria-labelledby","myModalLabel");
            div1.setAttribute("aria-hidden","true");


            var div2 = document.createElement("DIV");
            div2.setAttribute("class","modal-dialog modal-dialog-centered");
            
            var div3 = document.createElement("DIV");
            div3.setAttribute("class","modal-content");

            var div4 = document.createElement("DIV");
            div4.setAttribute("class","modal-header");
            div4.setAttribute("style","display: block");
            
            div3.appendChild(div4);

            var p1 = document.createElement("P");
            p1.setAttribute("class","modal-tittle");
            p1.setAttribute("style","display: block");

            var textop1 = document.createTextNode("EDITAR CAMPOS");       
            p1.appendChild(textop1);

            div4.appendChild(p1);

            var div5 = document.createElement("DIV");
            div5.setAttribute("class","modal-body");                   

            var label1 = document.createElement("LABEL");
            label1.setAttribute("style","text-align: justify;padding-top: 0px;");
            label1.setAttribute("class","login-box-msg");
            var textolabel1 = document.createTextNode("Llena los campos a editar la información requerida");       
            label1.appendChild(textolabel1);

            div5.appendChild(label1);

            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));
            div5.appendChild(document.createElement("BR"));

            var div6 = document.createElement("DIV");
            div6.setAttribute("class","row"); 
            
            var div7 = document.createElement("DIV");
            div7.setAttribute("class","col-xs-12 col-sm-8 col-sm-offset-2"); 

            var div8 = document.createElement("DIV");
            div8.setAttribute("class","group-material"); 

            var input1 = document.createElement("INPUT");
            input1.setAttribute("class","material-control tooltips-general"); 
            input1.setAttribute("id","txtTipoEvaluacionx"+Codigo); 
            input1.setAttribute("type","hidden"); 
            input1.setAttribute("name","nombrex"); 
            input1.setAttribute("placeholder","Tipo de evaluacion"); 
            input1.setAttribute("data-toggle","tooltip");
            input1.setAttribute("value",Nombre);
            
            div8.appendChild(input1);

            var span1 = document.createElement("SPAN");
            span1.setAttribute("class","highlight"); 

            div8.appendChild(span1);

            var span2 = document.createElement("SPAN");
            span2.setAttribute("class","bar"); 

            div8.appendChild(span2);

            var label2 = document.createElement("LABEL");
            label2.setAttribute("style","text-align: justify;padding-top: 0px;");
            label2.setAttribute("class","login-box-msg");
            var textolabel2 = document.createTextNode("Tipo de evaluacion");       
            label2.appendChild(textolabel2);

            div8.appendChild(label2);

            var div50 = document.createElement("DIV");
            div50.setAttribute("class","group-material"); 

            var select = document.createElement("SELECT");
            select.setAttribute("class","form-control"); 
            select.setAttribute("name","txtCriterio"); 
            select.setAttribute("id","txtCriterio"+Codigo); 


            var arrayLength = preguntasDirector.length;
            for (var j = 0; j < arrayLength; j++) {
 
                var option = document.createElement("OPTION");
                option.setAttribute("value",preguntasDirector[j].codigo); 
    
                var textooption = document.createTextNode(preguntasDirector[j].criterio);       
                option.appendChild(textooption);
    
                select.appendChild(option);
            }

            div50.appendChild(select);

            

            var div12 = document.createElement("DIV");
            div12.setAttribute("class","group-material"); 

            var input2 = document.createElement("INPUT");
            input2.setAttribute("class","material-control tooltips-general"); 
            input2.setAttribute("id","txtnombre"+Codigo); 
            input2.setAttribute("type","text"); 
            input2.setAttribute("name","nombre");             
            input2.setAttribute("data-toggle","tooltip");
            input2.setAttribute("value",Nombre);
            
            div12.appendChild(input2);

            var span3 = document.createElement("SPAN");
            span3.setAttribute("class","highlight"); 

            div12.appendChild(span3);

            var span4 = document.createElement("SPAN");
            span4.setAttribute("class","bar"); 

            div12.appendChild(span4);

            var label3 = document.createElement("LABEL");
            label3.setAttribute("style","text-align: justify;padding-top: 0px;");
            label3.setAttribute("class","login-box-msg");
            var textolabel3 = document.createTextNode("Nombre del criterio");       
            label3.appendChild(textolabel3);

            div12.appendChild(label3);

            div7.appendChild(div12);

            div7.appendChild(div8);
            div7.appendChild(div50);

            var p2 = document.createElement("P");
            p2.setAttribute("class","text-center");

            var button1 = document.createElement("BUTTON");
            button1.setAttribute("class","btn btn-danger");
            //button1.setAttribute("type","submit");
            button1.setAttribute("onclick","actualizarPreguntaDirector("+Codigo+")");

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");

            button1.appendChild(i1);

            var i1 = document.createElement("i");
            i1.setAttribute("class","zmdi zmdi-floppy");


            var textobutton1 = document.createTextNode("Guardar");       
            button1.appendChild(textobutton1);

            p2.appendChild(button1);

            var inputhidden = document.createElement("INPUT");
            inputhidden.setAttribute("type","hidden");             
            inputhidden.setAttribute("name","solicitud");
            inputhidden.setAttribute("value","updatePreguntaDirector");              
            
            p2.appendChild(inputhidden);

            div7.appendChild(p2);

            div6.appendChild(div7);

            div5.appendChild(div6);

            div3.appendChild(div5);

            div2.appendChild(div3);

            div1.appendChild(div2);


            modals.appendChild(div1);

            document.getElementById("txtCriterio"+Codigo).selectedIndex = $("#txtCriterio"+ Codigo+" > option:contains("+criterio+")").index() ; 
                }
            }else{
                var t = $('#dataTables-example').DataTable();
                t.clear().draw();
            }
        },
        error: function(xhr, status, error) {            
            //var err = eval("(" + xhr.responseText + ")");
            console.log(xhr.responseText);
                    console.log(xhr.statusText);
                    console.log(status);
                    console.log(error);

        }  
    });

    modifyTable('dataTables-example');
}