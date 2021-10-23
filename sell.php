<?php 
    include('connect.php');
    include('model.php');

    if(isset($_POST['submit'])){
        $field['id']               = $_GET['id'];
        $field['remaining_stocks'] = $_POST['current_remaining_stocks'] - $_POST['remaining_stocks'];
        $field['sold_items']       = $_POST['current_sold_items'] + $_POST['remaining_stocks'];

        $data = array('id', 'stock');

        if(!array_key_exists('error', $data)){   

            $return   = model::update($field);
            echo  "<script>alert('".$_POST['remaining_stocks']." product/s sold.'); window.location.href='index.php';</script>";   
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
                echo '  <h2>Sell</h2>
                        <table border="1">
                            <tr>
                                <th>Stocks</th>
                            <tr>
                            <tr>
                                <td>
                                    <input type="hidden" class="form-control" name="current_remaining_stocks" value="'.$value['remaining_stocks'].'">
                                    <input type="hidden" class="form-control" name="current_sold_items" value="'.$value['sold_items'].'">
                                    <input type="number" min="0" max="'.$value['remaining_stocks'].'" oninput="this.value = Math.abs(this.value)" name="remaining_stocks" value="'.$value['remaining_stocks'].'">
                                </td>
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
                   