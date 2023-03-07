<?php
  require_once 'config.php';

  $columns = ['nam_pro', 'size', 'mark', 'price', 'expiration', 'amount'];
  $table = 'product';
  $campo = isset($_POST['campo']) ? $conn->real_escape_string($_POST['campo']) : null;

  $where = '';

  if($campo != null){
    $where = " WHERE ( ";
    $cont = count($columns);
    for($i = 0; $i < $cont; $i++){
      $where .= $columns[$i] . " LIKE '%". $campo ."%' OR ";
    }
    $where = substr_replace($where, "", -3);
    $where .= " )";
  }

  $sql = "SELECT " . implode(", ",$columns) . " FROM $table $where";
  //echo($sql);
  //exit;
  $resultado = $conn->query($sql);
  $num_rows = $resultado->num_rows;
  
  $html='';
  $cont=0;
  if($num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        $cont++;
        $html .='<tr>';
        $html .='<td>' . $cont . '</td>';
        $html .='<td>' . $row['nam_pro'] . '</td>';
        $html .='<td>' . $row['size'] . '</td>';
        $html .='<td>' . $row['mark'] . '</td>';
        $html .='<td>' . $row['price'] . '</td>';
        $html .='<td>' . $row['expiration'] . '</td>';
        $html .='<td>' . $row['amount'] . '</td>';
        $html .='</tr>';

    }
  }else{
      $html .= '<tr>';
      $html .= '<td colspan="7">Sin resultados</td>';
      $html .= '</tr>';
  }
  echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>

