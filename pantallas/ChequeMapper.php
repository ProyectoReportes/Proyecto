<?php 
    class ChequeMapper extends MapperBD{
        function __construct()
        {
            parent::__construct(); 

        }
        
        function imprimeFila($cheknum,$filaid){
            
            $result = $this->mostrarCheque($cheknum,"","","","","");
            
            $cabecera = mssql_fetch_assoc($result); 

            mssql_data_seek($result, 0);

            while($row = mssql_fetch_assoc($result)) {
                $num = $row["# CHEQUE"];
                 
                foreach ($row as $indice => $valor) {
                    echo " <td>{$valor}</td>\n ";
                    if($indice == "ENTREGADO")
                    {   $num = $row["# CHEQUE"];
                        if($row["CONCILIADO"] == "NO" && $row["RETENIDO"] == "NO" && $row["ENTREGADO"] == "NO")
                        {
                            ?> <td><button type="button" 
                                        onClick="entregarCheque('<?php echo $num; ?>',1,'<?php echo $filaid; ?>')" 
                                        class="btn btn-success">Entregar</button></td> <?php
                        }
                        elseif ($row["CONCILIADO"] == "SI")
                        {
                            echo "<td>Conciliado</td>";
                        }
                        elseif($row["RETENIDO"] == "SI")
                        {
                            echo "<td>Retenido</td>"; 
                        }
                        elseif ($row["ENTREGADO"] == "SI") 
                        {
                            ?> <td><button type="button" 
                                        onClick="entregarCheque('<?php echo $num; ?>',0,'<?php echo $filaid; ?>')"
                                        class="btn btn-warning" >Revertir Entrega</button></td> <?php
                        }

                    }
                } 
            }
            
        }
        
        function actualizarCheque()
        {
            $result = mssql_query("exec sp_chk_actualizar", $this->conexion);
        }

        function entregarCheque($noCheque, $estado)
        {

            $consulta = mssql_init("sp_chk_entregar", $this->conexion);
            mssql_bind($consulta,"@num",$noCheque,SQLVARCHAR);
            mssql_bind($consulta,"@entr",$estado,SQLVARCHAR);	

            return mssql_execute($consulta);

        }
        
        function mostrarCheque($chknum,$prov,$banco,$conc,$rete,$entr)
        {
            if(!isset($chknum)){$chknum='';}
            if(!isset($prov)){$prov='';}
            if(!isset($banco)){$banco='';}
            if(!isset($conc)){$conc=0;}
            if(!isset($rete)){$rete=0;}
            if(!isset($entr)){$entr='';}
            
            $consulta = mssql_init("sp_chk_mostrar", $this->conexion);
            mssql_bind($consulta,"@chknum",$chknum,SQLVARCHAR);
            mssql_bind($consulta,"@proveedor",$prov,SQLVARCHAR);
            mssql_bind($consulta,"@banco",$banco,SQLVARCHAR);
            mssql_bind($consulta,"@conciliado",$conc,SQLINT2);
            mssql_bind($consulta,"@retenido",$rete,SQLINT2);
            mssql_bind($consulta,"@entregado",$entr,SQLVARCHAR);

            return mssql_execute($consulta);
        }
        
        function insertaMonto($cantidad,$descripcion){
            try{
                $consulta = mssql_init("sp_chk_montoCuenta", $this->conexion);
                mssql_bind($consulta,"@monto",$cantidad,SQLVARCHAR);
                mssql_bind($consulta,"@desc",$descripcion,SQLVARCHAR);
                mssql_execute($consulta);
                
                return "Exito";
            }catch(Exception $ex){
                return "Error al insertar nuevo monto";
            }
            
        }
        
        function getMontoActual(){
            $consulta = mssql_init("sp_chk_mostrarMonto", $this->conexion);

            return mssql_execute($consulta);
            
        }
        
        function getDisponible(){
            $consulta = mssql_init("sp_chk_calculaDisponible", $this->conexion);

            return mssql_execute($consulta);
        }
    }

?>