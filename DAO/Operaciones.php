<?php
include '../DAO/ControladorConectorBDD.php';
include_once '../Modelo/CajaSorpresa.php';
include_once '../Modelo/CajaFuerte.php';
include_once '../Modelo/CajaNegra.php';
include_once '../Modelo/BackupSorpresa.php';
include_once '../Modelo/BackupNegra.php';
include_once '../Modelo/BackupFuerte.php';
include_once '../Modelo/Almacen.php';
include_once '../Modelo/Usuario.php';

/**
 * Clase que contiene todas las funciones que hacen funcionar al sistema, aqui hacemos las 
 * conexiones a la Base de Datos.
 *
 * @author Alejandro
 */

class Operaciones {
    /**
     * Esta función introducirá una estanteria en la Base de Datos (BDD)
     * en la tabla ESTANTERIA, para ello usará un objeto estanteria pasada 
     * por parametro.
     * Se devolverán mensajes para tratarlos en el controlador en caso de que 
     * se produzca un error.
     * 
     * @global type $conexion
     * @param Estanteria $estanteria
     * @return String
     */
    public function anadirEstanteria($estanteria) {
        /**
         * Descomprimiremos este objeto en variables para introducir ese objeto en la BDD.
         */
        $codigo = $estanteria->getCodigo();
        $material = $estanteria->getMaterial();
        $n_lejas = $estanteria->getNLejas();
        $lejas_ocupadas = $estanteria->getOLejas();
        $pasillo = $estanteria->getPasillo();
        $numero_p = $estanteria->getNumeroP();
        $ordenSQL="INSERT INTO estanteria VALUES(null, '$codigo', '$material', '$n_lejas', '$lejas_ocupadas', '$pasillo', '$numero_p')";
        global $conexion;
        // Ejecutaremos la sentencia.
        $resultado=$conexion->query($ordenSQL);
        if ($resultado){
            /**
             * En caso de que nos de positivo la sentencia, devolveremos un mensaje el
             * cual es tratado en el controlador para mostrarlo por un php-web, el cual 
             * nos informa si se ha realizado correctamente la introducción de datos en la BDD.
             */
            return true;
        }
        else{
            /**
             * Se devolverán mensajes para tratarlos en el controlador en caso de que 
             * se produzca un erros.
             */
            if ($conexion->errno == 1062){
                return "No ha podido añadirse el registro, ya existe una estantería con ese código.";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                return "Se ha producido un error nº $numerror que corresponde a: $descrerror.";
            }
        }
    }
    /**
     * Esta función nos devolverá un array con las estanterias del almacen.
     * 
     * @global type $conexion
     * @return Estanteria
     */
    public function listadoEstanterias(){
        $arrayEstantes=array();
        $ordenSQL="SELECT * FROM estanteria";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila=$resultado->fetch_array();
            while($fila){
                /**
                 * Crearemos un objeto estanteria por cada linea leida en la tabla ESTANTERIA
                 * y la introduciremos en un array que es el que devolveremos.
                 */
                $arrayEstantes[]= new Estanteria($fila['Código'], $fila['Material'], $fila['Numero_Lejas'], $fila['Lejas_Ocupadas'], $fila['Pasillo'], $fila['Número']);
                $fila=$resultado->fetch_array();
            }
        }
        return $arrayEstantes;
    }
    /**
     * Esta función nos devolvera un array con las lejas disponibles de la estanteria.
     * Para ello usaremos la función creada 'lejasOcupadas()' la cual esta explicada abajo de esta función.
     * 
     * @global type $conexion
     * @param int $idEstanteria
     * @return int
     */
    function verlejasEstanteria($idEstanteria) {
        $lejasO = Operaciones::lejasOcupadas($idEstanteria);
        $libre = array();
        $ordenSQL="SELECT * FROM estanteria WHERE ID = '$idEstanteria'";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            $tam=$fila['Numero_Lejas'];
            /**
             * Este bucle dará tantas vueltas como lejas tenga la estanteria
             * dará como resultado un array() con las lejas libres.
             * Comprobará uno por uno el valor del for($j) que serán los valores
             * a introducir en el array de libres().
             */
            for($f=0;$f<$tam;$f++){
                $x=true;
                /**
                 * Este bucle dará tantas vueltas como valores de ocupadas() tenga,
                 * quiero decir, iremos comprobando valor por valor para insertar si esta
                 * dentro del array de ocupadas(), en caso de que ese valor a introducir
                 * este dentro de ocupadas() pondremos una varible de control a FALSE
                 * y saldremos del bucle.
                 */
                for($j=0; $j<count($lejasO); $j++){
                    if($f==$lejasO[$j]){
                        $x=false;
                        break;
                    }
                }
                /**
                 * Si la variable de control no se modifica se añadirá el valor de $f
                 * en caso negativo iremos al ELSE.
                 */
                if($x){
                    $libre[]=$f;
                }else{
                    /**
                     * En caso negativo será porque el valor del for($j) en ese momento
                     * esta dentro del vector de ocupadas.
                     */
                    unset($lejasO[0]);
                    /**
                     * A pesar de eliminar el valor el indice sigue apuntando al siguiente,
                     * para estos lo mejor reindexar con array_values() y así empieza desde cero.
                     */
                    $lejasO =  array_values($lejasO);
                }
            }
        }
        return $libre;
    }
    /**
     * Esta funcion la usaremos para devolver un vector con las lejas ocupadas
     * de la estanteria seleccionada.
     * Cuyo ID es pasado por parametro, obtendremos dichas lejas por orden
     * debido a que en la sentencia SQL lo ponemos.
     * 
     * @global type $conexion
     * @param int $idEstanteria
     * @return int
     */
    private function lejasOcupadas($idEstanteria) {
        $arrayOcupada=array();
        $ordenSQL="SELECT * FROM ocupación WHERE ID_estanteria = '$idEstanteria' ORDER BY LEJA ASC";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            /**
             * Tras ejecutar la sentencia en caso de dar positivo, iremos leyendo
             * leja por leja e introducir dicho valor en un array para devolverlo
             * y asi tener un array ordenado con las lejas ocupadas.
             */
            $fila = $resultado->fetch_array();
            while($fila){
                $arrayOcupada[]=$fila['Leja'];
                $fila = $resultado->fetch_array();
            }
        }else{
            /**
             * En caso de no tener datos dicha estanteria, devolveremos el array null
             * tenemos controlado en la funcion donde llamamos a dicho metodo.
             */
            $arrayOcupada=null;
        }
        return $arrayOcupada;
    }
    /**
     * Esta función insertará en la tabla SORPRESA los datos del objeto,
     * insertará su ocupación en la tabla OCUPACIÓN y actualizará las lejas
     * ocupadas en la tabla ESTANTERIA de la estanteria.
     * Para ello usará la caja pasada por parametro y el objeto ocupación pasado
     * por parametro.
     * Devido a que esta parte vamos a usar transacciones usaremos una variable 
     * booleana para comprobar si se va haciendo poco a poco todo correctamente.
     * En caso de que se haga todo correcto haremos un commit() en caso de que no 
     * haremos un rollback().
     * 
     * @global type $conexion
     * @param CajaSorpresa $cajaSorpresa
     * @param Ocupacion $ocupacion
     * @return string
     */
    function anadirSorpresa($cajaSorpresa, $ocupacion) {
        $devolver="";
        /**
         * Usaremos esta varaible $salida_correcta para la comprobación de las transacciones.
         * La inicializaremos a true, para que en caso de que se modifique a negativo sea por 
         * algun error y no modifiquemos su valor por error humano.
         */
        $salida_correcta=true;
        /**
         * Dividiremos el objeto caja sorpresa en variables para insertarlas en la tabla SORPRESA.
         */
        $codigo = $cajaSorpresa->getCodigo();
        $altura = $cajaSorpresa->getAltura();
        $anchura = $cajaSorpresa->getAnchura();
        $profundidad = $cajaSorpresa->getProfundidad();
        $color = $cajaSorpresa->getColor();
        $contenido = $cajaSorpresa->getContenido();
        $devolucion = $cajaSorpresa->getDevolucion();
        /*
         * La funcion CURDATE() de SQL nos da la fecha actual
         * por lo que es justo lo necesario para nuestro proposito
         * nos creará la Caja con la fecha de cuando se crea.
         */
        $ordenSQL="INSERT INTO sorpresa VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$contenido', CURDATE(), null,'$devolucion')";
        global $conexion;
        /**
         * Debemos quitar el commit para poder deshacer todas las operaciones en caso de que haya algun
         * error, ya que en MySQL realiza automaticamente el commit después de cada sentencia.
         */
        $conexion->autocommit(false);
        // Esta es la primera transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            /**
             * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
             * la variable de control y desharemos las operaciones realizadas.
             */
            if ($conexion->errno == 1062){
                $devolver = $devolver. "No ha podido añadirse el registro, ya existe una Caja Sorpresa con ese código. ";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver."Se ha producido un error nº $numerror que corresponde a: $descrerror. ";
            }
            $salida_correcta=false;
        }
        /**
         * Desglosamos los valores del objeto ocupación para insertarlo en la tabla OCUPACIÓN
         * nos faltará el ID pero para ello tenemos un metodo del propio MySQL en php.
         */
        $id_estanteria = $ocupacion->getID_Estanteria();
        $leja = $ocupacion->getLeja();
        $tipo_caja = $ocupacion->getTipo_Caja();
        // Aquí obtenemos el ultimo ID isertado, el cual nos hace falta para meterlo en nuestra tabla OCUPACIÓN en relación con la caja.
        $ultimo_ID = $conexion->insert_id;
        // Insertamos en la tabla OCUPACIÓN.
        $ordenSQL="INSERT INTO ocupación VALUES(null, '$id_estanteria', '$leja', '$ultimo_ID', '$tipo_caja')";
        // Esta es la segunda transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            if ($conexion->errno == 1062){
                $devolver = $devolver."No ha podido añadirse el registro, ya existe una ocupación con ese código. ";
            }else{ 
                /**
                 * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
                 * la variable de control y desharemos las operaciones realizadas.
                 */
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver."Se ha producido un error nº $numerror que corresponde a: $descrerror . ";
            }
            $salida_correcta=false;
        }
        
        $ordenSQL="UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='$id_estanteria'";
        // Esta es la tercera transacción.
        $resultado=$conexion->query($ordenSQL);
        
        if(!$resultado){
            /**
             * Aqui trataremos directamente si no se ha actualizado las lejas en la tabla 
             * ESTANTERIA modificando la variable de control.
             */
            $devolver = $devolver."No se ha podido actualizar la estantería. ";
            $salida_correcta=false;
        }
        /**
         * Tras realizar todas las comprobaciones comprobamos que se hayan realizado correctamente
         * lo conseguimos si la variable de control sigue siendo TRUE, si es así
         * realizaremos el commit().
         */
        if($salida_correcta){
             $devolver = true;
             $conexion->commit();
        }
        else{
            /**
             * En caso contrario, si la varibla ha sido modificada es debido a que ha habido
             * algun problema y por tanto haremos un rollback().
             */
            $devolver = $devolver."Ha salido algo mal, desharemos todas las operaciones realizadas.";
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función insertará en la tabla FUERTE los datos del objeto,
     * insertará su ocupación en la tabla OCUPACIÓN y actualizará las lejas
     * ocupadas en la tabla ESTANTERIA de la estanteria.
     * Para ello usará la caja pasada por parametro y el objeto ocupación pasado
     * por parametro.
     * Devido a que esta parte vamos a usar transacciones usaremos una variable 
     * booleana para comprobar si se va haciendo poco a poco todo correctamente.
     * En caso de que se haga todo correcto haremos un commit() en caso de que no 
     * haremos un rollback().
     * 
     * @global type $conexion
     * @param CajaFuerte $cajaFuerte
     * @param Ocupacion $ocupacion
     * @return string
     */
    function anadirFuerte($cajaFuerte, $ocupacion) {
        $devolver="";
        /**
         * Usaremos esta varaible $salida_correcta para la comprobación de las transacciones.
         * La inicializaremos a TRUE, para que en caso de que se modifique a negativo sea por 
         * algun error y no modifiquemos su valor por error humano.
         */
        $salida_correcta=true;
        /**
         * Dividiremos el objeto caja fuerte en variables para insertarlas en la tabla FUERTE.
         */
        $codigo = $cajaFuerte->getCodigo();
        $altura = $cajaFuerte->getAltura();
        $anchura = $cajaFuerte->getAnchura();
        $profundidad = $cajaFuerte->getProfundidad();
        $color = $cajaFuerte->getColor();
        $contenido = $cajaFuerte->getSeguridad();
        $ordenSQL="INSERT INTO fuerte VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$contenido', CURDATE(), null)";
        global $conexion;
        /**
         * Debemos quitar el commit para poder deshacer todas las operaciones en caso de que haya algun
         * error, ya que en MySQL realiza automaticamente el commit después de cada sentencia.
         */
        $conexion->autocommit(false);
        // Esta es la primera transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            /**
             * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
             * la variable de control y desharemos las operaciones realizadas.
             */
            if ($conexion->errno == 1062){
               $devolver = $devolver. "No ha podido añadirse el registro, ya existe una Caja Fuerte con ese código. ";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. ";
            }
            $salida_correcta=false;
        }
        /**
         * Desglosamos los valores del objeto ocupación para insertarlo en la tabla OCUPACIÓN
         * nos faltará el ID pero para ello tenemos un metodo del propio MySQL en php.
         */
        $id_estanteria = $ocupacion->getID_Estanteria();
        $leja = $ocupacion->getLeja();
        $tipo_caja = $ocupacion->getTipo_Caja();
        // Aquí obtenemos el ultimo ID isertado, el cual nos hace falta para meterlo en nuestra tabla OCUPACIÓN en relación con la caja.
        $ultimo_ID = $conexion->insert_id;
        // Insertamos en la tabla OCUPACIÓN.
        $ordenSQL="INSERT INTO ocupación VALUES(null, '$id_estanteria', '$leja', '$ultimo_ID', '$tipo_caja')";
        // Esta es la segunda transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            /**
             * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
             * la variable de control y desharemos las operaciones realizadas.
             */
            if ($conexion->errno == 1062){
                $devolver = $devolver. "No ha podido añadirse el registro, ya existe una ocupación con ese código. ";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. ";
            }
            $salida_correcta=false;
        }
        $ordenSQL="UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='$id_estanteria'";
        // Esta es la tercera transacción.
        $resultado=$conexion->query($ordenSQL);
        if(!$resultado){
            /**
             * Aqui trataremos directamente si no se ha actualizado las lejas en la tabla 
             * ESTANTERIA modificando la variable de control.
             */
            $devolver = $devolver. "No se ha podido actualizar la estantería. ";
            $salida_correcta=false;
        }
        /**
         * Tras realizar todas las comprobaciones comprobamos que se hayan realizado correctamente
         * lo conseguimos si la variable de control sigue siendo TRUE, si es así
         * realizaremos el commit().
         */
        if($salida_correcta){
             $devolver = true;
             $conexion->commit();
        }
        else{
            /**
             * En caso contrario, si la varibla ha sido modificada es debido a que ha habido
             * algun problema y por tanto haremos un rollback().
             */
            $devolver = $devolver. "Ha salido algo mal, desharemos todas las operaciones reaizadas. ";
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función insertará en la tabla NEGRA los datos del objeto,
     * insertará su ocupación en la tabla OCUPACIÓN y actualizará las lejas
     * ocupadas en la tabla ESTANTERIA de la estanteria.
     * Para ello usará la caja pasada por parametro y el objeto ocupación pasado
     * por parametro.
     * Devido a que esta parte vamos a usar transacciones usaremos una variable 
     * booleana para comprobar si se va haciendo poco a poco todo correctamente.
     * En caso de que se haga todo correcto haremos un commit() en caso de que no 
     * haremos un rollback().
     * 
     * @global type $conexion
     * @param CajaNegra $cajaNegra
     * @param Ocupacion $ocupacion
     * @return string
     */
    function anadirNegra($cajaNegra, $ocupacion) {
        $devolver="";
        /**
         * Usaremos esta varaible $salida_correcta para la comprobación de las transacciones.
         * La inicializaremos a true, para que en caso de que se modifique a negativo sea por 
         * algun error y no modifiquemos su valor por error humano.
         */
        $salida_correcta=true;
        /**
         * Dividiremos el objeto caja negra en variables para insertarlas en la tabla NEGRA.
         */
        $codigo = $cajaNegra->getCodigo();
        $altura = $cajaNegra->getAltura();
        $anchura = $cajaNegra->getAnchura();
        $profundidad = $cajaNegra->getProfundidad();
        $color = $cajaNegra->getColor();
        $contenido = $cajaNegra->getPlaca_base();
        $ordenSQL="INSERT INTO negra VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$contenido', CURDATE(), null)";
        global $conexion;
        /**
         * Debemos quitar el commit para poder deshacer todas las operaciones en caso de que haya algun
         * error, ya que en MySQL realiza automaticamente el commit después de cada sentencia.
         */
        $conexion->autocommit(false);
        // Esta es la primera transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            /**
             * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
             * la variable de control y desharemos las operaciones realizadas.
             */
            if ($conexion->errno == 1062){
                $devolver = $devolver. "No ha podido añadirse el registro, ya existe una Caja Negra con ese código. ";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. ";
            }
            $salida_correcta=false;
        }
        /**
         * Desglosamos los valores del objeto ocupación para insertarlo en la tabla OCUPACIÓN
         * nos faltará el ID pero para ello tenemos un metodo del propio MySQL en php.
         */
        $id_estanteria = $ocupacion->getID_Estanteria();
        $leja = $ocupacion->getLeja();
        $tipo_caja = $ocupacion->getTipo_Caja();
        // Aquí obtenemos el ultimo ID isertado, el cual nos hace falta para meterlo en nuestra tabla OCUPACIÓN en relación con la caja.
        $ultimo_ID = $conexion->insert_id;
        // Insertamos en la tabla OCUPACIÓN.
        $ordenSQL="INSERT INTO ocupación VALUES(null, '$id_estanteria', '$leja', '$ultimo_ID', '$tipo_caja')";
        // Esta es la segunda transacción.
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si este $resultado da positivo no se modificará el valor de la variable de transacción
         * y podremos proseguir sin ningun inconveniente.
         */
        if(!$resultado){
            /**
             * En caso de que haya algun error al introducir la caja, saltara este ELSE y por lo tanto modificaremos
             * la variable de control y desharemos las operaciones realizadas.
             */
            if ($conexion->errno == 1062){
                $devolver = $devolver. "No ha podido añadirse el registro, ya existe una ocupación con ese código. ";
            }else{ 
                $numerror=$conexion->errno;
                $descrerror=$conexion->error;
                $devolver = $devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. ";
            }
            $salida_correcta=false;
        }
        
        $ordenSQL="UPDATE estanteria SET Lejas_Ocupadas=Lejas_Ocupadas+1 WHERE ID='$id_estanteria'";
        // Esta es la tercera transacción.
        $resultado=$conexion->query($ordenSQL);
        
        if(!$resultado){
            /**
             * Aqui trataremos directamente si no se ha actualizado las lejas en la tabla 
             * ESTANTERIA modificando la variable de control.
             */
            $devolver = $devolver. "No se ha podido actualizar la estantería. ";
            $salida_correcta=false;
        }
        /**
         * Tras realizar todas las comprobaciones comprobamos que se hayan realizado correctamente
         * lo conseguimos si la variable de control sigue siendo TRUE, si es así
         * realizaremos el commit().
         */
        if($salida_correcta){
             $devolver = true;
             $conexion->commit();
        }
        else{
            /**
             * En caso contrario, si la varibla ha sido modificada es debido a que ha habido
             * algun problema y por tanto haremos un rollback().
             */
            $devolver = $devolver. "Ha salido algo mal, daremos vuelta atrás a todas las operaciones realizadas.";
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función nos devuelve el inventario del almacen, el cuál esta ordenado
     * por pasillo de estanteria, número y las cajas por leja, con un objeto almacen.
     * La sentencia en esta función obtiene el ID de las estanterias que tienen
     * cajas el ID de las cajas y el tipo de dichas cajas.
     * Con esto haremos lo siguiente: mientras el ID de la estanteria sea el mismo
     * seguiremos leyendo cajas, las cuales se iran introduciendo en un array
     * de cajas, y cuando cambie el ID de estanteria, cambiaremos el ID de la 
     * estanteria de referencia por el nuevo, y así hasta acabar con las estanterias.
     * Lo intentaré explicar un poco mas adelante.
     * 
     * @global type $conexion
     * @return Almacen
     */
    function MostrarEstanteriasOrden(){
        $inventario = array();
        $caja = array();
        $ordenSQL="select estanteria.id id_estanteria, ocupación.ID_caja id_caja, ocupación.TipoCaja tipocaja, ocupación.Leja leja from estanteria, ocupación  where estanteria.id=ocupación.ID_estanteria order by pasillo asc, número asc, leja asc";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            /**
             * Si da positivo el $resultado tendremos acceso a los datos referidos anteriormente.
             * Lo primero que haremos será almacenar el primer ID de las estanterias para tener una referencia.
             */
            $fila = $resultado->fetch_array();
            /**
             * Lo hacemos aqui.
             */
            $comprueba=$fila[0];
            while($fila){
                /**
                 * Haremos la comprobación de si es la misma estanteria que la anterior
                 * si es afirmativo proseguirá en leer mas cajas en caso negativo
                 * saltará el else.
                 */
                if($comprueba==$fila["id_estanteria"]){
                    $id_estanteria=$fila["id_estanteria"];
                    /**
                     * Con el ID de esta estanteria, iremos a la tabla ESTANTERIA y extraeremos
                     * los datos de esta estanteria y montaremos un objeto estanteria.
                     * Hay que decir que se crearán tantas estanterias como cajas tenga,
                     * pero debido a que la almacenamos en la misma variable siempre lo
                     * vamos a machar y tener siempre la estanteria que necesitamos.
                     */
                    $ordenSQL="select * from estanteria where id=$id_estanteria";
                    $resultado1=$conexion->query($ordenSQL);
                    if($resultado1){
                        $fila1 = $resultado1->fetch_array();
                        // Aquí montamos la estanteria.
                        $estante=new Estanteria($fila1['Código'], $fila1['Material'], $fila1['Numero_Lejas'], $fila1['Lejas_Ocupadas'], $fila1['Pasillo'], $fila1['Número']);
                    }
                    /**
                     * Ahora obtendremos el ID y el tipo de la caja, junto con su leja
                     * para buscarala en su correspondiente tabla y crear el objeto cajaX, 
                     * donde tambien meteremos su leja para poder mostrarla en el inventario.
                     */
                    $id_caja=$fila["id_caja"];
                    $tipocaja=$fila["tipocaja"];
                    $leja=$fila["leja"];
                    /**
                     * Ahora dependiendo de que tipo sea se accederá a una o a otra tabla de caja
                     * para montar el objeto correctamente.
                     */
                    if($tipocaja=="caja_sorpresa"){
                        $ordenSQL="select * from sorpresa where ID='$id_caja'";
                        $resultado1=$conexion->query($ordenSQL);
                        if($resultado1){
                            $fila = $resultado1->fetch_array();
                            $cajas = new CajaSorpresa($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Contenido'], $fila['Especial']);
                            $cajas->setLeja($leja);
                        }
                    }
                    if($tipocaja=="caja_negra"){
                        $ordenSQL="select * from negra where ID='$id_caja'";
                        $resultado1=$conexion->query($ordenSQL);
                        if($resultado1){
                            $fila = $resultado1->fetch_array();
                            $cajas = new CajaNegra($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['PlacaBase']);
                            $cajas->setLeja($leja);
                        }
                    }
                    if($tipocaja=="caja_fuerte"){
                        $ordenSQL="select * from fuerte where ID='$id_caja'";
                        $resultado1=$conexion->query($ordenSQL);
                        if($resultado1){
                            $fila = $resultado1->fetch_array();
                            $cajas = new CajaFuerte($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Seguridad']);
                            $cajas->setLeja($leja);
                        }
                    }
                    // Tras crear la caja la introducimos en el array de cajas que tendra asociada esa estanteria.
                    $caja[]=$cajas;
                    // Ahora pasamos a leer la siguiente linea y comprobamos en el inicio si es el mismo ID.
                    $fila = $resultado->fetch_array();
                }else{
                    /**
                     * Aquí crearemos el objeto inventario el cual es por asi decirlo el objeto "estanteria-cajas",
                     * dicho objeto tendra una estanteria y un array de cajas.
                     */
                    $inventario[]=new Inventario($estante, $caja);
                    /**
                     * Como al final del IF damos un nuevo ID, que es el que hace saltar este ELSE,
                     * cambiamos el valor a la variable que comprueba si son de la misma estanteria
                     * las cajas.
                     */
                    $comprueba=$fila["id_estanteria"];
                    /**
                     * Tras cambiar la variable que comprueba, eliminaremos el contenido de la variable $caja
                     * que es el array que metemos a la clase inventario.
                     * Con 'UNSET' eliminamos la variable y por tanto debemos volver a crearla para poder seguir usandola.
                     */
                    unset($caja);
                    $caja=array();
                }
            }
            /*
             * Este nuevo objeto inventario que esta a fuera del bucle, corresponde siempre
             * con el ultimo objeto creado, que debido a que no entra en el ELSE, porque da 
             * error al hacer el FETCH, debido a que no hay mas. 
             * Con esto, la última estanteria entra dentro del array, y no hay mas problemas. :)
             */
            $inventario[]=new Inventario($estante, $caja);
        }
        /**
         * Tras tener el array lleno con las clases inventario, crearemos el objeto almacen
         * el cuál sera el devuelto para el controlador.
         */
        $almacen=new Almacen($inventario);
        return $almacen;
    }
    /**
     * Esta función nos devolverá a través del código pasado por parámetro un
     * objeto backupnegra.
     * Lo primero que se hará es buscar en la tabla SORPRESA la caja sorpresa, extraeremos
     * sus datos y crearemos una caja, luego iremos con el ID de dicha caja 
     * a buscar su ocupación en la tabla OCUPACIÓN, y extrearemos sus datos.
     * Después montaremos un objeto backupsorpresa, el cuál tiene una caja y dos parametros más
     * el ID de la estanteria y la leja donde esta ubicada.
     * 
     * @global type $conexion
     * @param String $codigo
     * @return BackupSorpresa
     */
    function datosSorpresa($codigo){
        global $conexion;
        $ordenSQL = "select * from sorpresa where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si el resultado es positivo en la busqueda de la caja en su correspondiente tabla
         * iremos a la tabla OCUPACIÓN y sacaremos los datos.
         */
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            // Montamos la caja sorpresa.
            $caja = new CajaSorpresa($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Contenido'], $fila['Especial']);
            $codigoCaja = $fila[0];
            $caja->setID($fila[0]);
            $ordenSQL="select * from ocupación where ID_caja=$codigoCaja";
            $resultado1=$conexion->query($ordenSQL);
            if($resultado1){
                /**
                 * Si nos da positiva la busqueda de la ocupación extraeremos los datos
                 * y montaremos el objeto backupnegra y lo devolveremos.
                 */
                $fila1 = $resultado1->fetch_array();
                $backup = new BackupSorpresa($caja, $fila1['ID_estanteria'], $fila1['Leja']);
                return $backup;
            }
        }else{
            /**
             * En caso de no obtener la caja para obtener el backup retornaremos -1,
             * este dato estará recogido en el controlador y evitaremos errores mayusculos.
             */
            return -1;
        }
    }
    /**
     * Esta función nos devolverá a través del código pasado por parámetro un
     * objeto backupfuerte.
     * Lo primero que se hará es buscar en la tabla FUERTE la caja fuerte, extraeremos
     * sus datos y crearemos una caja, luego iremos con el ID de dicha caja 
     * a buscar su ocupación en la tabla OCUPACIÓN, y extrearemos sus datos.
     * Después montaremos un objeto backupfuerte, el cuál tiene una caja y dos parametros más
     * el ID de la estanteria y la leja donde esta ubicada.
     
     * @global type $conexion
     * @param String $codigo
     * @return BackupFuerte
     */
    function datosFuerte($codigo){
        global $conexion;
        $ordenSQL = "select * from fuerte where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si el resultado es positivo en la busqueda de la caja en su correspondiente tabla
         * iremos a la tabla OCUPACIÓN y sacaremos los datos.
         */
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            // Montamos la caja fuerte.
            $caja = new CajaFuerte($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Seguridad']);
            $codigoCaja = $fila[0];
            $caja->setID($fila[0]);
            $ordenSQL="select * from ocupación where ID_caja=$codigoCaja";
            $resultado1=$conexion->query($ordenSQL);
            if($resultado1){
                /**
                 * Si nos da positiva la busqueda de la ocupación extraeremos los datos
                 * y montaremos el objeto backupnegra y lo devolveremos.
                 */
                $fila1 = $resultado1->fetch_array();
                $backup = new BackupFuerte($caja, $fila1['ID_estanteria'], $fila1['Leja']);
                return $backup;
            }
        }
        else{
            /**
             * En caso de no obtener la caja para obtener el backup retornaremos -1,
             * este dato estará recogido en el controlador y evitaremos errores mayusculos.
             */
            return -1;
        }
    }
    /**
     * Esta función nos devolverá a través del código pasado por parámetro un
     * objeto backupnegra.
     * Lo primero que se hará es buscar en la tabla NEGRA la caja negra, extraeremos
     * sus datos y crearemos una caja, luego iremos con el ID de dicha caja 
     * a buscar su ocupación en la tabla OCUPACIÓN, y extrearemos sus datos.
     * Después montaremos un objeto backupnegra, el cuál tiene una caja y dos parametros más
     * el ID de la estanteria y la leja donde esta ubicada.
     *
     * @global type $conexion
     * @param String $codigo
     * @return BackupNegra
     */
    function datosNegra($codigo){
        global $conexion;
        $ordenSQL = "select * from negra where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Si el resultado es positivo en la busqueda de la caja en su correspondiente tabla
         * iremos a la tabla OCUPACIÓN y sacaremos los datos.
         */
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            // Montaremos la caja negra.
            $caja = new CajaNegra($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['PlacaBase']);
            $codigoCaja = $fila[0];
            $caja->setID($fila[0]);
            $ordenSQL="select * from ocupación where ID_caja=$codigoCaja";
            $resultado1=$conexion->query($ordenSQL);
            if($resultado1){
                /**
                 * Si nos da positiva la busqueda de la ocupación extraeremos los datos
                 * y montaremos el objeto backupnegra y lo devolveremos.
                 */
                $fila1 = $resultado1->fetch_array();
                $backup = new BackupNegra($caja, $fila1['ID_estanteria'], $fila1['Leja']);
                return $backup;
            }
        }
        else{
            /**
             * En caso de no obtener la caja para obtener el backup retornaremos -1,
             * este dato estará recogido en el controlador y evitaremos errores mayusculos.
             */
            return -1;
        }
    }
    /**
     * Esta función realizará la inserción de datos en la tabla BACKUPSORPRESA,
     * a su vez como pedía la tarea, saltará un disparador el cuál borrará la 
     * caja SORPRESA asociada al objeto backup pasado por parametro a esta función,
     * además de borrar en la tabla OCUPACIÓN la fila relacionada con dicha caja.
     * Para poder hacer dicha inserción primero deberemos descomprimir el objeto
     * pasado por parametro en los valores a insertar.
     * El trigger será explicado en la memoria del proyecto.
     *
     * @global type $conexion
     * @param BackupSorpresa $backup
     * @return string
     */
    function insertarSorpresaBackup($backup){
        $devolver="";
        $cajaSorpresa = $backup->getSorpresa();
        $estanteria = $backup->getEstanteria();
        $leja = $backup->getLeja();
        $codigo = $cajaSorpresa->getCodigo();
        $altura = $cajaSorpresa->getAltura();
        $anchura = $cajaSorpresa->getAnchura();
        $profundidad = $cajaSorpresa->getProfundidad();
        $color = $cajaSorpresa->getColor();
        $contenido = $cajaSorpresa->getContenido();
        /**
         * Tras descomprimir el objeto en todos los valores, los metemos dentro 
         * de la sentencia SQL a ejecutar.
         */
        $ordenSQL="INSERT INTO backupsorpresa VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$contenido', CURDATE(), $estanteria, $leja)";
        global $conexion;
        /**
         * Deshabilitamos el commit() ya que deberemos estar seguros de que se ha 
         * ejecutado correctamente el trigger.
         * En dicho trigger controlamos los posibles errores, ya que dentro de él
         * manejamos la posibilidad de errores, y lanzarán un error interno de MySQL
         * en caso de encontrarse algun error.
         */
        $conexion->autocommit(false);
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $devolver = true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            $numerror=$conexion->errno;
            $descrerror=$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones reaizadas. ";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función realizará la inserción de datos en la tabla BACKUPFUERTE,
     * a su vez como pedía la tarea, saltará un disparador el cuál borrará la 
     * caja FUERTE asociada al objeto backup pasado por parametro a esta función,
     * además de borrar en la tabla OCUPACIÓN la fila relacionada con dicha caja.
     * Para poder hacer dicha inserción primero deberemos descomprimir el objeto
     * pasado por parametro en los valores a insertar.
     * El trigger será explicado en la memoria del proyecto.
     * 
     * @global type $conexion
     * @param BackupFuerte $backup
     * @return string
     */
    function insertarFuerteBackup($backup){

        $devolver="";
        $cajaFuerte = $backup->getFuerte();
        $estanteria = $backup->getEstanteria();
        $leja = $backup->getLeja();
        $codigo = $cajaFuerte->getCodigo();
        $altura = $cajaFuerte->getAltura();
        $anchura = $cajaFuerte->getAnchura();
        $profundidad = $cajaFuerte->getProfundidad();
        $color = $cajaFuerte->getColor();
        $seguridad = $cajaFuerte->getSeguridad();
        /**
         * Tras descomprimir el objeto en todos los valores, los metemos dentro 
         * de la sentencia SQL a ejecutar.
         */
        $ordenSQL="INSERT INTO backupfuerte VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$seguridad', CURDATE(), $estanteria, $leja)";
        global $conexion;
        /**
         * Deshabilitamos el commit() ya que deberemos estar seguros de que se ha 
         * ejecutado correctamente el trigger.
         * En dicho trigger controlamos los posibles errores, ya que dentro de él
         * manejamos la posibilidad de errores, y lanzarán un error interno de MySQL
         * en caso de encontrarse algun error.
         */
        $conexion->autocommit(false);
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $devolver = true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            $numerror=$conexion->errno;
            $descrerror=$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones reaizadas. ";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función realizará la inserción de datos en la tabla BACKUPNEGRA,
     * a su vez como pedía la tarea, saltará un disparador el cuál borrará la 
     * caja NEGRA asociada al objeto backup pasado por parametro a esta función,
     * además de borrar en la tabla OCUPACIÓN la fila relacionada con dicha caja.
     * Para poder hacer dicha inserción primero deberemos descomprimir el objeto
     * pasado por parametro en los valores a insertar.
     * El trigger será explicado en la memoria del proyecto.
     *
     * @global type $conexion
     * @param BackupNegra $backup
     * @return string
     */
    function insertarNegraBackup($backup){
        $devolver="";
        $cajaNegra = $backup->getNegra();
        $estanteria = $backup->getEstanteria();
        $leja = $backup->getLeja();
        $codigo = $cajaNegra->getCodigo();
        $altura = $cajaNegra->getAltura();
        $anchura = $cajaNegra->getAnchura();
        $profundidad = $cajaNegra->getProfundidad();
        $color = $cajaNegra->getColor();
        $placa_base = $cajaNegra->getPlaca_base();
        /**
         * Tras descomprimir el objeto en todos los valores, los metemos dentro 
         * de la sentencia SQL a ejecutar.
         */
        $ordenSQL="INSERT INTO backupnegra VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$placa_base', CURDATE(), $estanteria, $leja)";
        global $conexion;
        /**
         * Deshabilitamos el commit() ya que deberemos estar seguros de que se ha 
         * ejecutado correctamente el trigger.
         * En dicho trigger controlamos los posibles errores, ya que dentro de él
         * manejamos la posibilidad de errores, y lanzarán un error interno de MySQL
         * en caso de encontrarse algun error.
         */
        $conexion->autocommit(false);
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $devolver = true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            $numerror=$conexion->errno;
            $descrerror=$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones realizadas.";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función nos devolverá un objeto tipo backupsorpresa de la tabla 
     * BACKUPSORPRESA. Desglosaremos el resultado obtenido del SELECT en dicha tabla
     * y lo iremos insertando en el objeto backupsorpresa.
     *
     * @global type $conexion
     * @param String $codigo
     * @return BackupSorpresa
     */
    public function sacarBackupSorpresa($codigo) {
        global $conexion;
        $ordenSQL = "select * from backupsorpresa where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            $caja = new CajaSorpresa($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Contenido'],1);
            $backup = new BackupSorpresa($caja, $fila['Estanteria'], $fila['Leja']);
            /**
             * Si todo ha salido correctamente devolveremos el objeto al controlador
             * que llamó a esta función.
             */
            return $backup;
        }else{
            /**
             * En caso de error devolveremos -1, para poder tratar este error en el
             * controlador.
             */ 
            return -1;
        }
    }
    /**
     * Esta función nos devolverá un objeto tipo backupnegra de la tabla 
     * BACKUPNEGRA. Desglosaremos el resultado obtenido del SELECT en dicha tabla
     * y lo iremos insertando en el objeto backupnegra.
     *
     * @global type $conexion
     * @param String $codigo
     * @return BackupNegra
     */
    public function sacarBackupNegra($codigo) {

        global $conexion;
        $ordenSQL = "select * from backupnegra where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            $caja = new CajaNegra($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Placa_base']);
            $backup = new BackupNegra($caja, $fila['Estanteria'], $fila['Leja']);
            /**
             * Si todo ha salido correctamente devolveremos el objeto al controlador
             * que llamó a esta función.
             */
            return $backup;
        }else{
            /**
             * En caso de error devolveremos -1, para poder tratar este error en el
             * controlador.
             */ 
            return -1;
        }
    }
    /**
     * Esta función nos devolverá un objeto tipo backupfuerte de la tabla 
     * BACKUPFUERTE. Desglosaremos el resultado obtenido del SELECT en dicha tabla
     * y lo iremos insertando en el objeto backupfuerte.
     *
     * @global type $conexion
     * @param String $codigo
     * @return BackupFuerte
     */
    public function sacarBackupFuerte($codigo) {
        global $conexion;
        $ordenSQL = "select * from backupfuerte where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            $caja = new CajaFuerte($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Seguridad']);
            $backup = new BackupFuerte($caja, $fila['Estanteria'], $fila['Leja']);
            /**
             * Si todo ha salido correctamente devolveremos el objeto al controlador
             * que llamó a esta función.
             */
            return $backup;
        }else{
            /**
             * En caso de error devolveremos -1, para poder tratar este error en el
             * controlador.
             */            
            return -1;
        }
    }
    /**
     * Esta función borrará la Caja Sorpresa de la tabla BACKUPSORPRESA, recibiendo
     * como parametro el objeto backupsorpresa que vamos a borrar.
     * Tenemos un trigger, el cuál insertará la caja Sorpresa devuelta a la BDD,
     * junto con la actualización de lejas de la estanteria y la inserción en
     * la tabla OCUPACIÓN.
     * Debido que en el trigger ya controlamos los posibles errores, en estas transacciones
     * no comprobamos su ejecucion, ya que no dejará ejecutar el DELETE de la tabla
     * BACKUPSORPRESA saltando un error interno de MySQL creado por mi.
     *
     * @global type $conexion
     * @param BackupSorpresa $backup
     * @return string
     */
    public function borrarBackupSorpresa($backup){
        $devolver="";
        global $conexion;
        $conexion->autocommit(false);
        $estan=$backup->getEstanteria();
        $lejita=$backup->getLeja();
        include_once '../Modelo/TriggerCajaSorpresa.php';
        $ordenSQL = "DELETE FROM backupsorpresa where Código='".$backup->getSorpresa()->getCodigo()."'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Ejecutaremos el DELETE, si es correcto comprobaremos que también se ha
         * ejecutado correctamente el borrado del trigger antes de crearlo, ya que
         * en MySQL no hay 'CREATE OR REPLACE TRIGGER' y por lo tanto debemos borrarlo
         * antes de crearlo.
         * Como he dicho anteriormente, si el DELETE se ejuta correctamente es que
         * el trigger también se ha ejecutado correctamente, si no fuese así, saltaría
         * un error interno de MySQL creado por mi.
         */
        if($resultado && $resultado3){
            $devolver= true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            /**
             * Guardamos el código del error junto con su mensaje, para almacenarlo
             * en la variable a devolver.
             */
            $numerror   =$conexion->errno;
            $descrerror =$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones realizadas.";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función borrará la Caja Negra de la tabla BACKUPNEGRA, recibiendo
     * como parametro el objeto backupnegra que vamos a borrar.
     * Tenemos un trigger, el cuál insertará la caja Negra devuelta a la BDD,
     * junto con la actualización de lejas de la estanteria y la inserción en
     * la tabla OCUPACIÓN.
     * Debido que en el trigger ya controlamos los posibles errores, en estas transacciones
     * no comprobamos su ejecucion, ya que no dejará ejecutar el DELETE de la tabla
     * BACKUPNEGRA saltando un error interno de MySQL creado por mi.
     *
     * @global type $conexion
     * @param BackupNegra $backup
     * @return string
     */
    public function borrarBackupNegra($backup){

        $devolver="";
        global $conexion;
        $conexion->autocommit(false);
        echo "<br>";
        print_r($backup->getEstanteria());
        echo "<br>";
        print_r($backup->getLeja());
        include_once '../Modelo/TriggerCajaNegra.php';
        $ordenSQL = "DELETE FROM backupnegra where Código='".$backup->getNegra()->getCodigo()."'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Ejecutaremos el DELETE, si es correcto comprobaremos que también se ha
         * ejecutado correctamente el borrado del trigger antes de crearlo, ya que
         * en MySQL no hay 'CREATE OR REPLACE TRIGGER' y por lo tanto debemos borrarlo
         * antes de crearlo.
         * Como he dicho anteriormente, si el DELETE se ejuta correctamente es que
         * el trigger también se ha ejecutado correctamente, si no fuese así, saltaría
         * un error interno de MySQL creado por mi.
         */
        if($resultado && $resultado3){
            $devolver= true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            /**
             * Guardamos el código del error junto con su mensaje, para almacenarlo
             * en la variable a devolver.
             */
            $numerror   =$conexion->errno;
            $descrerror =$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones realizadas.";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * Esta función borrará la Caja Fuerte de la tabla BACKUPFUERTE, recibiendo
     * como parametro el objeto backupfuerte que vamos a borrar.
     * Tenemos un trigger, el cuál insertará la caja Fuerte devuelta a la BDD,
     * junto con la actualización de lejas de la estanteria y la inserción en
     * la tabla OCUPACIÓN.
     * Debido que en el trigger ya controlamos los posibles errores, en estas transacciones
     * no comprobamos su ejecucion, ya que no dejará ejecutar el DELETE de la tabla
     * BACKUPFUERTE saltando un error interno de MySQL creado por mi.
     *
     * @global type $conexion
     * @param BackupFuerte $backup
     * @return string
     */
    public function borrarBackupFuerte($backup){
        $devolver="";
        global $conexion;
        $conexion->autocommit(false);
        include_once '../Modelo/TriggerCajaFuerte.php';
        $ordenSQL = "DELETE FROM backupfuerte where Código='".$backup->getFuerte()->getCodigo()."'";
        $resultado=$conexion->query($ordenSQL);
        /**
         * Ejecutaremos el DELETE, si es correcto comprobaremos que también se ha
         * ejecutado correctamente el borrado del trigger antes de crearlo, ya que
         * en MySQL no hay 'CREATE OR REPLACE TRIGGER' y por lo tanto debemos borrarlo
         * antes de crearlo.
         * Como he dicho anteriormente, si el DELETE se ejuta correctamente es que
         * el trigger también se ha ejecutado correctamente, si no fuese así, saltaría
         * un error interno de MySQL creado por mi.
         */
        if($resultado && $resultado3){
            $devolver=true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            /**
             * Guardamos el código del error junto con su mensaje, para almacenarlo
             * en la variable a devolver.
             */
            $numerror   =$conexion->errno;
            $descrerror =$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, daremos vuelta atrás a todas las operaciones realizadas.";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }
    /**
     * En esta función comprobaremos la existencia de un usuario dentro de la
     * BDD, y ¿como haremos eso? Iremos a la base de datos de USUARIO, haremos
     * un count() de toda la tabla, si ese count() nos da 0, es que no hay usuario
     * y si es distinto a 0 es que si lo hay, lo hacemos asi debido a que en el 
     * sistema solo va a haber un usuario.
     *
     * Retornaremos TRUE sí hay una fila, trataremos este valor en el controlador
     * que llama a esta función, como el resto de posibles soluciones.
     *
     * @global type $conexion
     * @return boolean
     */
    public function ComprobacioUsuario(){
        $ordenSQL="select count(*) from usuario";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            if($fila[0]!=0){
                /**
                 * Aquí devolvemos TRUE debido a que existe un usuario, ya que el
                 * count() nos ha devuelto un número mayor que 0.
                 */
                return true;
            }
            else{
                /**
                 * Aquí devolvemos FALSE debido a que no existe ninguna fila en la
                 * tabla USUARIO, porque el count() ha devuelto 0.
                 */
                return false;
            }
        }else{
            /**
             * Aquí devolveremos FALSE ya que no se ha realizado correctamente 
             * la sentencia SQL.
             */
            return false;
        }
    }
    /**
     * Recogeremos los datos del objeto usuario, los desglosaremos en datos para introducirlo en 
     * la sentencia SQL para crear el usuario en la Base de Datos.
     *
     * @global type $conexion
     * @param Usuario $personal
     * @return boolean
     */
    public function anadirUsuario($personal) {

        $nombre=$personal->getNombre();
        $apellido=$personal->getApellido();
        $usuario=$personal->getUsuario();
        $contrasena=$personal->getContrasena();
        $ordenSQL="INSERT INTO usuario VALUES(null, '$nombre', '$apellido', '$usuario', '$contrasena' )";
        global $conexion;
        /**
         * Ejecutaremos dicha sentencia y retornaremos true en caso de crear el usuario.
         * Tratamos en el controlador donde es llamada esta función, el caso de que no se cree
         * el usuario.
         */
        $resultado=$conexion->query($ordenSQL);
        if ($resultado){
            return true;
        }
        return false;
    }
    /** 
     * Aquí volveremos a crear con el mismo nivel de seguridad de la contraseña
     * para poder realizar la comprobación de contraseña para el acceso al sistema.
     * El metodo de encriptación será explicado en la memoria del proyecto.
     *
     * @global type $conexion
     * @param String $usuario
     * @param String $contrasena
     * @return boolean
     */
    public function accesoSistema($usuario, $contrasena){

        $salt = '$bgr$/';
        $password = md5($salt . sha1($contrasena));
        /**
         * Seleccionaremos la fila con el usuario y con la contraseña dadas, 
         * en caso de que se encuentre devolveremos 'true'
         * y trataremos ese valor en el controlador que llamó a esta función.
         * Tratamos la opción en caso de que no se encuentre el usuario con la contraseña dicha.
         */
        $ordenSQL="select * from usuario";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if ($resultado){
            $fila = $resultado->fetch_array();
            if($fila['Usuario']==$usuario && $fila['Contraseña']==$password){
                return true;
            }return false;
        }
        return false;
    }
    function listadoCajasEspeciales(){
        $arrayCajas=array();
        $ordenSQL="SELECT * FROM sorpresa where Especial=0";
        $ordenSQL="SELECT sorpresa.*, ocupación.Leja, estanteria.Código 'si' FROM sorpresa, ocupación, estanteria where Especial=0 and sorpresa.ID=ocupación.ID_caja and ocupación.ID_estanteria=estanteria.ID";
        global $conexion;
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila=$resultado->fetch_array();
            while($fila){
                $caja= new CajaSorpresa($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Contenido'], $fila['Especial']);
                $caja->setLeja($fila['Leja']);
                $caja->setEstanteria($fila['si']);
                $arrayCajas[] = $caja;
                $fila=$resultado->fetch_array();
            }
        }
        return $arrayCajas;
    }
    /**
     * Esta función realizará la inserción de datos en la tabla BACKUPSORPRESAESPECIAL,
     * a su vez como pedía la tarea, saltará un disparador el cuál borrará la 
     * caja SORPRESA asociada al objeto backup pasado por parametro a esta función,
     * además de borrar en la tabla OCUPACIÓN la fila relacionada con dicha caja.
     * Para poder hacer dicha inserción primero deberemos descomprimir el objeto
     * pasado por parametro en los valores a insertar.
     * El trigger será explicado en la memoria del proyecto.
     *
     * @global type $conexion
     * @param BackupSorpresa $backup
     * @return string
     */
    function insertarSorpresaBackupEspecial($backup){
        $devolver="";
        $cajaSorpresa = $backup->getSorpresa();
        $estanteria = $backup->getEstanteria();
        $leja = $backup->getLeja();
        $codigo = $cajaSorpresa->getCodigo();
        $altura = $cajaSorpresa->getAltura();
        $anchura = $cajaSorpresa->getAnchura();
        $profundidad = $cajaSorpresa->getProfundidad();
        $color = $cajaSorpresa->getColor();
        $contenido = $cajaSorpresa->getContenido();
        /**
         * Tras descomprimir el objeto en todos los valores, los metemos dentro 
         * de la sentencia SQL a ejecutar.
         */
        $ordenSQL="INSERT INTO backupsorpresaespecial VALUES(null, '$codigo', '$altura', '$anchura', '$profundidad', '$color', '$contenido', CURDATE(), $estanteria, $leja)";
        global $conexion;
        /**
         * Deshabilitamos el commit() ya que deberemos estar seguros de que se ha 
         * ejecutado correctamente el trigger.
         * En dicho trigger controlamos los posibles errores, ya que dentro de él
         * manejamos la posibilidad de errores, y lanzarán un error interno de MySQL
         * en caso de encontrarse algun error.
         */
        $conexion->autocommit(false);
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $devolver = true;
            /**
             * En caso de que la ejecución sea correcta haremos un commit() dentro
             * de MySQL para guardar los resultados obtenidos, tanto por la sentencia
             * como por el trigger.
             */
            $conexion->commit();
        }else{
            $numerror=$conexion->errno;
            $descrerror=$conexion->error;
            $devolver =$devolver. "Se ha producido un error nº $numerror que corresponde a: $descrerror. "
                                . "Ha salido algo mal, desharemos vuelta atrás a todas las operaciones reaizadas. ";
            /**
             * En caso de que la ejecución sea incorrecta haremos un rollback() dentro
             * de MySQL para deshacer los resultados, tanto por la sentencia como
             * por el trigger.
             */
            $conexion->rollback();
        }
        /**
         * Podemos ver que devolvemos un String, ya que he optado por esta opción para
         * mostrar los posibles resultados de las funciones.
         * Podremos ver el resultado en un php-web.
         */
        return $devolver;
    }

    public function sacarBackupSorpresaEspecial($codigo) {
        global $conexion;
        $ordenSQL = "select * from backupsorpresaespecial where Código='$codigo'";
        $resultado=$conexion->query($ordenSQL);
        if($resultado){
            $fila = $resultado->fetch_array();
            /**
             * Como el select no lanza un error a la hora de buscar, trataremos el error 
             * si no hay datos y eso se consigue con lo que hemos puesto debajo.
             */
            if($fila==null){
                return -1;
            }
            $caja = new CajaSorpresa($fila['Código'], $fila['Anchura'], $fila['Altura'], $fila['Profundidad'], $fila['Color'], $fila['Contenido'],0);
            $backup = new BackupSorpresa($caja, $fila['Estanteria'], $fila['Leja']);
            /**
             * Si todo ha salido correctamente devolveremos el objeto al controlador
             * que llamó a esta función.
             */
            return $backup;
        }else{
            /**
             * En caso de error devolveremos -1, para poder tratar este error en el
             * controlador.
             */ 
            return -1;
        }
    }
}
