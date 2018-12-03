var accion = document.querySelector("#close_sesion");
if(accion!=null){
    $.ajax({
        url:"../../include.php",
        data:{solicitud:'homeDoc'},
        type:"post",
        dataType: "json",
        success:function(data){
            document.getElementById("name").innerText = data.persona.nombres + " " + data.persona.apellidos;
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
            document.getElementById("apellidos").innerText = data.persona.apellidos;
            document.getElementById("cedula").innerText = data.persona.dni;
            document.getElementById("celular").innerText = data.persona.celular;
            document.getElementById("direccion").innerText = data.persona.direccion;
            document.getElementById("correo").innerText = data.persona.correo;
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
            document.querySelector("#cel").value = data.persona.celular;
            document.querySelector("#dir").value = data.persona.direccion;
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