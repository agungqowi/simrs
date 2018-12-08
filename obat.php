<?php
$con=mysqli_connect("localhost","root","","simrsb");
$row = 1;
if (($handle = fopen("obat.csv", "r")) !== FALSE) {
	$before 	= "";
    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
        $num = count($data);
        $row++;
        $flag  	= 1;
        $dat 	= "";
        $harga	= 0;
        $kelas  = 0;

        $skip   = false;
        for ($c=0; $c < $num; $c++) {
        	$data[$c] 	= trim($data[$c]);
        	if($c == 0){
        		for($k=99;$k>=1;$k--){
        			$data[$c] = str_replace($k.'. ', '', $data[$c]);
        		}

        		if($data[$c] == '')
        			$flag = 0;

        		$dat 	= $data[0];
        	}
        }

        if($data[2] == '' && $data[1] == ''){
            if($data[0] == ''){
                $skip == true;
            }
            else{
                $skip  = true;
                $kodejenis  = str_replace(' ', '', $data[0]);
                $namajenis  = $data[0];

                $sql    = "SELECT * FROM apo_jenisobat WHERE kodejenis = '$kodejenis'";
                $query  = mysqli_query($con,$sql);
                if( mysqli_num_rows($query) > 0 ){
                    $id     = 0;
                    while ($row = $query->fetch_assoc()) {
                        $id     = $row['id'];
                    }
                    echo "Data $kodejenis sudah ada <br />";
                }
                else{
                    $insert = "INSERT INTO apo_jenisobat(kodejenis,namajenis) VALUES('$kodejenis' ,'$namajenis')";
                    mysqli_query($con,$insert);
                    $id     = mysqli_insert_id($con);
                    echo "Input ".$kodejenis.' == '.$namajenis;
                    echo "<br /> \n";
                }
            }
        }
        else{
            $namaobat   = $data[1];
            $satuan     = $data[2];
            $harga      = $data[3];
            $stok       = $data[8];
            $stok_apotek= 1000;
            $expires    = '';
			
			if( !empty($data[17]) ){
				$harga      = $data[17];
			}
			else if( !empty($data[16]) ){
				$harga      = $data[16];
			}
			else if( !empty($data[15]) ){
				$harga      = $data[15];
			}
			else if( !empty($data[14]) ){
				$harga      = $data[14];
			}
			else if( !empty($data[13]) ){
				$harga      = $data[13];
			}
			else{
				$harga      = $data[17];
			}

            if( $expires == '-' || $expires == '' ){
                $expire     = '2030-12-31';
            }
            else{
                $ex     = explode('-',$expires);
                $bul    = '01';
                switch( $ex[0] ){
                    case 'Jan' :
                        $bul = '01';
                        break;
                    case 'Feb' :
                        $bul = '02';
                        break;
                    case 'Mar' :
                        $bul = '03';
                        break;
                    case 'Apr' :
                        $bul = '04';
                        break;
                    case 'May' :
                        $bul = '05';
                        break;
                    case 'Jun' :
                        $bul = '06';
                        break;
                    case 'Jul' :
                        $bul = '07';
                        break;
                    case 'Aug' :
                        $bul = '08';
                        break;
                    case 'Sep' :
                        $bul = '09';
                        break;
                    case 'Oct' :
                        $bul = '10';
                        break;
                    case 'Nov' :
                        $bul = '11';
                        break;
                    case 'Dec' :
                        $bul = '12';
                        break;
                    default :
                        $bul = '01';
                        break;
                    
                    
                }
                $expire = '20'.$ex[1].'-'.$bul.'-'.'29';
                    
            }
        }

        if(!$skip){
            if($flag){
                $sql    = "SELECT * FROM apo_obat WHERE namaobat = '$namaobat'";
                $query  = mysqli_query($con,$sql);
                if( mysqli_num_rows($query) > 0 ){
                    echo "Data Obat $namaobat sudah ada <br />";
                }
                else{
                    $insert = "INSERT INTO apo_obat(namaobat,kodejenis,satuan,hargabeli,stok, stok_apotek1 , masa) 
                                VALUES('$namaobat' ,'$id' , '$satuan' , '$harga','$stok' , '$stok_apotek' ,'$expire')";
                    mysqli_query($con,$insert);

                    echo "Input ".$namaobat.'--'.$satuan.' == '.$harga.'##'.$stok;
                    echo "<br /> \n";
                }
                
            }
        }
        
        
    }
    fclose($handle);
}