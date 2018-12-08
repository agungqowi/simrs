<?php
	$con=mysqli_connect("localhost","root","b4r0k4h18","sirs");

	$sql    = "SELECT * FROM apo_detailobat WHERE stok = '0'";
    $query  = mysqli_query($con,$sql);

    $id     = 0;

    if( mysqli_num_rows($query) > 0 ){
	    while ($row = $query->fetch_assoc()) {
	    	$kodobat    = $row['kodobat'];
	    	$namaobat 	= $row['namaobat'];
	    	$sql2    	= "SELECT * FROM apo_obat WHERE kodobat = '$kodobat'";
	        $query2  	= mysqli_query($con,$sql2);

	        if( mysqli_num_rows($query2) > 0 ){
	        	$stok  = "";
	    		while ($row2 = $query2->fetch_assoc()) {
	    			$stok 	= $row2['stok_apotek1'];
	    		}

	    		if( $stok != "" ){
	    			$update 	= "UPDATE apo_detailobat SET stok = '$stok' WHERE kodobat = '$kodobat'";
	    			mysqli_query($con,$update);

	    			echo "Update stok obat $kodobat -- $namaobat \n";
	    		}
	    		
	    	}
	    }
	}