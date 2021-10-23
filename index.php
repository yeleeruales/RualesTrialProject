<?php
include('connect.php');
include('model.php');
?>
<title>Ruales Trial Project</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
	<h1>Ruales Trial Project</h1>
	<h2>1.</h2>
	<table class="table table-bordered">
	   <thead>
	        <tr>
	            <th>Products</th>
	            <th>Stock</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
	            $data['details'] = model::getDetailsUpToC();
	            
	            if(is_array($data['details'])){
	                foreach($data['details'] as $key => $value){
	                    echo '  <tr>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['product'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['stock'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['price'].'</td>
	                            </tr>';
	                }
	            }else{
	                echo '  <tr>
	                            <td colspan="3" class="border border-l-0 border-r-0 px-4 py-2">No data yet.</td>
	                        </tr>';
	            }
	        ?>
	    </tbody>
	</table>
	<hr>
	<h2>2.</h2>
	<table class="table table-bordered">
	   <thead>
	        <tr>
	            <th>Products</th>
	            <th>Stock</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
	            $data['details'] = model::getDetailsUpToC();
	            
	            if(is_array($data['details'])){
	                foreach($data['details'] as $key => $value){ 
	                    echo '  <tr>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['product'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['remaining_stocks'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['price'].'</td>
	                            </tr>';
	                }
	            }else{
	                echo '  <tr>
	                            <td colspan="3" class="border border-l-0 border-r-0 px-4 py-2">No data yet.</td>
	                        </tr>';
	            }
	        ?>
	    </tbody>
	</table>
	<hr>
	<h2>3.</h2>
	<table class="table table-bordered">
	   	<thead>
	        <tr>
	            <th>Products</th>
	            <th>Stock</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
	        	$total_price   = array();
	            $data['details'] = model::getDetailsUpToC();
	            
	            if(is_array($data['details'])){
	                foreach($data['details'] as $key => $value){ 
	                	$total_sold    = model::countDetailsSumUpToC();
	                	$price         = $value['sold_items'] * $value['price'];
	                	
	                	$total_price[] = $price;
	                    echo '  <tr>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['product'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['remaining_stocks'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['price'].'</td>
	                                
	                            </tr>';
	                }

	                echo 	'<tr>
					        	<th></th>
					        	<th>Sold items: '.$total_sold.'</th>
					        	<th>Total Price: '.array_sum($total_price).'</th>
					        </tr>';
	            }else{
	                echo '  <tr>
	                            <td colspan="3" class="border border-l-0 border-r-0 px-4 py-2">No data yet.</td>
	                        </tr>';
	            }
	        ?>
	    </tbody>
	</table>
	<hr>
	<h2>4.</h2>
	<table class="table table-bordered">
	   	<thead>
	        <tr>
	        	<th>Action</th>
	            <th>Products</th>
	            <th>Stock</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
	        	$total_price   = array();
	            $data['details'] = model::getDetails();
	            
	            if(is_array($data['details'])){
	                foreach($data['details'] as $key => $value){ 
	                	$total_sold    = model::countDetailsSum();

	                	$value['remaining_stocks'] == 0 ? $total_stock = 0 : $total_stock = $value['remaining_stocks'];

	                	$price         = $value['sold_items'] * $value['price'];
	                	
	                	$total_price[] = $price;
	                    echo '  <tr>';
	                    			if($total_stock == 0){
	                    				echo "	<td>No stocks available</td>";
	                    			}else{
	                    				echo '	<td>
	                    							<form method="POST">
                                           				<a href="sell.php?id='.$value['id'].'" title="Sell">Sell</a>
                                        			</form></td>';
	                    			}
	                          echo '<td class="border border-l-0 border-r-0 px-4 py-2">'.$value['product'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['remaining_stocks'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['price'].'</td>
	                                
	                            </tr>';
	                }

	                echo 	'<tr>
					        	<th></th>
					        	<th></th>
					        	<th>Sold items: '.$total_sold.'</th>
					        	<th>Total Price: '.array_sum($total_price).'</th>
					        </tr>';
	            }else{
	                echo '  <tr>
	                            <td colspan="3" class="border border-l-0 border-r-0 px-4 py-2">No data yet.</td>
	                        </tr>';
	            }
	        ?>
	    </tbody>
	</table>
	<hr>
	<h2>5.</h2>
	<table class="table table-bordered">
	   	<thead>
	        <tr>
	        	<th>Action</th>
	            <th>Products</th>
	            <th>Stocks</th>
	            <th>Price</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
	        	$total_price   = array();
	            $data['details'] = model::getDetails();
	            
	            if(is_array($data['details'])){
	                foreach($data['details'] as $key => $value){ 
	                	$total_sold    = model::countDetailsSum();

	                	// $value['stock'] == 0 ? $total_stock = 0 : $total_stock = $value['stock'] - $value['sold_items'];

	                	$price         = $value['sold_items'] * $value['price'];
	                	
	                	$total_price[] = $price;
	                    echo '  <tr>
	                    			<td class="border border-l-0 border-r-0 px-4 py-2">
	                    				<form method="POST">
                                           	<a href="update.php?id='.$value['id'].'" title="Edit">Edit</a>
                                        </form>
                                    </td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['product'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['remaining_stocks'].'</td>
	                                <td class="border border-l-0 border-r-0 px-4 py-2">'.$value['price'].'</td>
	                                
	                            </tr>';
	                }

	                echo 	'<tr>
					        	<th></th>
					        	<th></th>
					        	<th>Sold items: '.$total_sold.'</th>
					        	<th>Total Price: '.array_sum($total_price).'</th>
					        </tr>';
	            }else{
	                echo '  <tr>
	                            <td colspan="3" class="border border-l-0 border-r-0 px-4 py-2">No data yet.</td>
	                        </tr>';
	            }
	        ?>
	    </tbody>
	</table>
</div>