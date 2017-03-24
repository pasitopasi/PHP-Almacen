function clickEstanteria(){
    document.getElementById("u1").style.display="inline";
    document.getElementById("c1").style.display="none";
    document.getElementById("a1").style.display="none";
    document.getElementById("a2").style.display="none";
    document.getElementById("a3").style.display="none";
    document.getElementById("u2").style.display="none";
    document.getElementById("u3").style.display="none";
}

function clickCajas(){
    document.getElementById("u1").style.display="none";
    document.getElementById("u2").style.display="none";
    document.getElementById("c1").style.display="inline";
    document.getElementById("a1").style.display="none";
    document.getElementById("a2").style.display="none";
    document.getElementById("a3").style.display="none";
    document.getElementById("u3").style.display="none";
}

function clickAlmacen(){
    document.getElementById("u1").style.display="none";
    document.getElementById("u2").style.display="none";
    document.getElementById("c1").style.display="none";
    document.getElementById("a1").style.display="inline";
    document.getElementById("a2").style.display="inline";
    document.getElementById("a3").style.display="inline";
    document.getElementById("u2").style.display="inline";
    document.getElementById("u3").style.display="inline";
}

function ocultacion(){
    document.getElementById("c_sorpresa").style.visibility="hidden";
    document.getElementById("c_sorpresa1").style.visibility="hidden";
    document.getElementById("c_sorpresa2").style.visibility="hidden";
    document.getElementById("c_fuerte").style.visibility="hidden";
    document.getElementById("c_negra").style.visibility="hidden";
}

function cambio(){
    var indice = document.getElementById("tipoc").selectedIndex;
    if( indice == 0 ){
        document.getElementById("c_sorpresa").style.visibility="hidden";
        document.getElementById("c_sorpresa1").style.visibility="hidden";
        document.getElementById("c_sorpresa2").style.visibility="hidden";
        document.getElementById("c_fuerte").style.visibility="hidden";
        document.getElementById("c_negra").style.visibility="hidden";
    }
    if( indice == 3) {
        document.getElementById("c_sorpresa").style.visibility="hidden";
        document.getElementById("c_sorpresa1").style.visibility="hidden";
        document.getElementById("c_sorpresa2").style.visibility="hidden";
        document.getElementById("c_fuerte").style.visibility="hidden";
        document.getElementById("c_negra").style.visibility="visible";
    }
    if( indice == 1) {
        document.getElementById("c_sorpresa").style.visibility="visible";
        document.getElementById("c_sorpresa1").style.visibility="visible";
        document.getElementById("c_sorpresa2").style.visibility="visible";
        document.getElementById("c_fuerte").style.visibility="hidden";
        document.getElementById("c_negra").style.visibility="hidden";
    }
    if( indice == 2) {
        document.getElementById("c_sorpresa").style.visibility="hidden";
        document.getElementById("c_sorpresa1").style.visibility="hidden";
        document.getElementById("c_sorpresa2").style.visibility="hidden";
        document.getElementById("c_fuerte").style.visibility="visible";
        document.getElementById("c_negra").style.visibility="hidden";
    }
}

function muestraLejas(str){
	var xmlhttp;
  if (str=="null")  {
 	document.getElementById("lejas_libres").innerHTML="<option value='null' selected='selected'>- Elije Leja -</option>";
  	return;
  }
if (window.XMLHttpRequest)  {// code for IE7+, Firefox, Chrome, Opera, Safari
  	xmlhttp=new XMLHttpRequest();
	/* Creamos el objeto request para conexiones http,
	compatible con los navegadores descritos*/
  }
else  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	/*Como el explorer va por su cuenta, el objeto es un ActiveX */
  }
/*Propiedades del objeto xmlhttp de la clase  XMLHttpRequest */
xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("lejas_libres").innerHTML=xmlhttp.responseText;
   /*Seleccionamos el elemento que recibirá el flujo de datos*/
    }
  }
	xmlhttp.open("GET","ConseguirLejas.php?selectEstanteria="+str,true);
	/*Mandamos al PHP encargado de traer los datos, el valor de referencia */
	xmlhttp.send();
}

function muestraLejasDevolucion(str){
	var xmlhttp;
  if (str=="null")  {
 	document.getElementById("lejas_libres").innerHTML="<option value='null' selected='selected'>- Elije Leja -</option>";
  	return;
  }
if (window.XMLHttpRequest)  {// code for IE7+, Firefox, Chrome, Opera, Safari
  	xmlhttp=new XMLHttpRequest();
	/* Creamos el objeto request para conexiones http,
	compatible con los navegadores descritos*/
  }
else  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	/*Como el explorer va por su cuenta, el objeto es un ActiveX */
  }
/*Propiedades del objeto xmlhttp de la clase  XMLHttpRequest */
xmlhttp.onreadystatechange=function()  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    document.getElementById("lejas_libres").innerHTML=xmlhttp.responseText;
   /*Seleccionamos el elemento que recibirá el flujo de datos*/
    }
  }
	xmlhttp.open("GET","ConseguirLejasDevolucion.php?selectEstanteria="+str,true);
	/*Mandamos al PHP encargado de traer los datos, el valor de referencia */
	xmlhttp.send();
}

function accesosistema(){
    if(document.getElementById("usuario").value==""){
        alert("Usuario no introducido.");
        return false;
    }
    if(document.getElementById("contrasena").value==""){
        alert("Contraseña no introducida.");
        return false;
    }
    document.getElementById("accesoSistema").submit();
}

function crearusuario(){
    if(document.getElementById("nombre").value==""){
        alert("Nombre no introducido.");
        document.getElementById("salida").innerHTML="";
        return false;
    }
    if(document.getElementById("apellido").value==""){
        alert("Apellido no introducido.");
        document.getElementById("salida").innerHTML="";
        return false;
    }
    if(document.getElementById("usuario").value==""){
        alert("Usuario no introducido.");
        document.getElementById("salida").innerHTML="";
        return false;
    }
    pass=document.getElementById("contrasena").value;
    if( !(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,15}[^'\s]/.test(pass)) ){
        document.getElementById("salida").style.display="inline";
        document.getElementById("salida").innerHTML="Contraseña ha de tener estos elementos.\n\
            <ul>\n\
                <li>Minimo 8 caracteres.</li>\n\
                <li>Maximo 15.</li>\n\
                <li>Al menos una letra mayúscula.</li>\n\
                <li>Al menos una letra minucula.</li>\n\
                <li>Al menos un dígito numérico.</li>\n\
                <li>Al menos 1 caracter especial (@, $, !, %, *, ?, &).</li>\n\
            </ul>";
        alert("Contraseña no introducida correctamente.");
        return false;
    }
    document.getElementById("crearUsuario").submit();
}

function aceptarEstanteria(){
    if(document.getElementById("codigo").value==""){
        alert("Código no introducido.");
        return false;
    }
    if(document.getElementById("material").value==""){
        alert("Material no introducido.");
        return false;
    }
    lejas = document.getElementById("l_ocupadas").value;
    if(!Number(lejas) || lejas=="" || lejas<0){
        alert("Número de lejas no introducido correctamente, ha de ser mayor que 0 y numérico.");
        return false;
    }
    if(document.getElementById("pasillo").value==""){
        alert("Pasillo no introducido.");
        return false;
    }
    num = document.getElementById("numero_p").value;
    if(!Number(num) || num=="" || num<0){
        alert("Número del pasillo no introducido correctamente, ha de ser mayor que 0 y numérico.");
        return false;
    }
    document.getElementById("anadirEstante").submit();
}

function cajita(){
    indice = document.getElementById("tipoc").selectedIndex;
    if( indice == null || indice == 0 ) {
        alert("No hay seleccionado un tipo de caja.");
      return false;
    }
    if(document.getElementById("codigo").value==""){
        alert("Código no introducido.");
        return false;
    }
    altura = document.getElementById("altura").value;
    if(!Number(altura) || altura=="" || altura<0 || altura>150){
        alert("Altura no introducida correctamente, ha de ser mayor que 0, menor que 150 y numérico.");
        return false;
    }
    anchura = document.getElementById("anchura").value;
    if(!Number(anchura) || anchura=="" || anchura<0 || anchura>150){
        alert("Anchura no introducida correctamente, ha de ser mayor que 0, menor que 150 y numérico.");
        return false;
    }
    profundidad = document.getElementById("profundidad").value;
    if(!Number(profundidad) || profundidad=="" || profundidad<0 || profundidad>150){
        alert("Profundidad no introducida correctamente, ha de ser mayor que 0, menor que 150 y numérico.");
        return false;
    }
    if(document.getElementById("sor").value=="" && document.getElementById("fuer").value=="" && document.getElementById("neg").value==""){
        alert("Caracteristica no introducida.");
        return false;
    }
    indice = document.getElementById("selectEstanteria").selectedIndex;
    if( indice == null || indice == 0 ) {
        alert("No hay seleccionada una estanteria.");
      return false;
    }
    document.getElementById("crearCaja").submit();
}

function eliminarC(){
    indice = document.getElementById("tipoc").selectedIndex;
    if( indice == null || indice == 0 ) {
        alert("No hay seleccionado un tipo de caja.");
      return false;
    }
    if(document.getElementById("codigo").value==""){
        alert("Código no introducido.");
        return false;
    }
    document.getElementById("eliminarCaja").submit();
}

function devolverC(){
    indice = document.getElementById("tipoc").selectedIndex;
    if( indice == null || indice == 0 ) {
        alert("No hay seleccionado un tipo de caja.");
      return false;
    }
    if(document.getElementById("codigo").value==""){
        alert("Código no introducido.");
        return false;
    }
    document.getElementById("devolverCaja").submit();
}

function devolucion(){
    indice = document.getElementById("selectEstanteria").selectedIndex;
    if( indice == null || indice == 0 ) {
        alert("No hay seleccionada una estanteria.");
      return false;
    }
    document.getElementById("form4").submit();
}
function nobackbutton(){	
   window.location.hash="no-back-button";	
   window.location.hash="Again-No-back-button"; //chrome	
   window.onhashchange=function(){window.location.hash="no-back-button";}	
}