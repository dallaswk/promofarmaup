


<?php
$archivo_csv = fopen('Datos\datos.csv', 'w');
$serverName = "SERVER";
$connectionInfo = array( "Database"=>"database", "UID"=>"user", "PWD"=>"password");
$conn = sqlsrv_connect( $serverName, $connectionInfo );



if($archivo_csv)
{
    fputs($archivo_csv, "EAN;CN;Laboratorio;Descripcion;IVA;Precio;Stock".PHP_EOL);  


$sql = "SELECT dbo.sinonimo.sinonimo AS EAN, dbo.Articu.IdArticu as CN,dbo.Laboratorio.Nombre AS Laboratorio,dbo.Articu.Descripcion,dbo.vRG_GruposIVA.pctoIVA AS IVA,Pvp AS Precio,StockActual AS Stock 
FROM dbo.Articu LEFT JOIN dbo.vRG_GruposIVA ON dbo.Articu.XGrup_IdGrupoIva = IdGrupoIVA
LEFT JOIN dbo.Laboratorio ON dbo.Articu.Laboratorio = Codigo 
LEFT JOIN dbo.Sinonimo ON dbo.Articu.IdArticu = dbo.Sinonimo.IdArticu
WHERE dbo.Articu.IdArticu <= '599999'
ORDER BY dbo.Articu.IdArticu ASC";
$stmt = sqlsrv_query( $conn, $sql ) or die( print_r( sqlsrv_errors(), true));
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        {
           fputs($archivo_csv, implode($row, ';').PHP_EOL);
        }
    }

    fclose($archivo_csv);
}else{

    echo "El archivo no existe o no se pudo crear";

}





?>
