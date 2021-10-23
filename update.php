<?php 
    include('connect.php');
    include('model.php');

    if(isset($_POST['submit'])){
        $field['id']               = $_GET['id'];
        $add_stock                 = $_POST['remaining_stocks'] - $_POST['current_remaining_stocks'];
        $field['stock']            = $_POST['current_stocks'] + $add_stock;
        $field['remaining_stocks'] = $_POST['remaining_stocks'];
        $field['price']            = $_POST['price'];

        $data = array('id', 'stock', 'price');

        if(!array_key_exists('error', $data)){   

            $return   = model::update($field);
            echo  "<script>
                    alert('Product details has been updated.'); 
                    window.location.href='index.php';
                  </script>";   
        }   
    }
    
?>
<form method="POST">
    <div class="form-row">
        <?php
        $id             = $_GET['id'];
        $data['update'] = model::getDetailsById($id);
                
        if(is_array($data['update'])){
            foreach($data['update'] as $key => $value){
                echo '  <table border="1">
                            <tr>
                                <th>Stocks</th>
                                <th>Price</th>
                            <tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="current_stocks" value="'.$value['stock'].'">
                                    <input type="hidden" class="form-control" name="current_remaining_stocks" value="'.$value['remaining_stocks'].'">
                                    <input type="text" class="form-control" name="remaining_stocks" value="'.$value['remaining_stocks'].'">
                                </td>
                                <td><input type="text" class="form-control" name="price" value="'.$value['price'].'"></td>
                            </tr>
                        </table>
                        <a href="index.php">Cancel</a></button>
                        <button name="submit" type="submit" style="margin-left: 5px;">Submit</button>
                     ';
            }
        }
        ?>
    </div>
</form>
                   