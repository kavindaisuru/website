<?php include('partials/menu.php'); ?>

<div class ="main-content">
    <div class ="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
        
            //check id is set or not
            if (isset($_GET['id'])) 
            {
                //get the order
                $id = $_GET['id'];

                //get all other detils based on this id
                //sql query
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //execute query
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);

                if($count == 1)
                {
                    //details availbale
                    $row=mysqli_fetch_assoc($res);

                    $product = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //retails not availbale
                    //redirect to manage order
                    header('location:'.$siteurl.'admin/manage-order.php');
                }
            }
            else
            {
                //redirect to manage order
                header('location:'.$siteurl.'admin/manage-order.php');
            }

        ?>

        <form action="" method="POST">
            <table class ="tbl-30">
            <tr>
                <td>Product Name</td>
                <td><?php echo $product; ?></td>
            </tr>

            <tr>
                <td>Price</td>
                <td>$<?php echo $price; ?></td>
            </tr>

            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status" id="">
                        <option <?php if($status=="ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Deliverd"){echo "selected";} ?> value="Deliverd">Deliverd</option>
                        <option <?php if($status=="Canceled"){echo "selected";} ?> value="Canceled">Canceled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Customer Name:</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Contact:</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Email:</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>

            <tr>
                <td>Customer Address:</td>
                <td>
                    <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="submit" name="submit" value="Update Order" class ="btn-secondary">
                </td>
            </tr>

            </table>
        </form>

            <?php 
            //check  update button is clicked
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //get all value from form
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];
                
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //update the value
                $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id=$id
                ";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //check update or not
                //redirect to manage order
                if($res2==true)
                {
                    //updated
                    $_SESSION['update'] = "Order Updated";
                    header('location:'.$siteurl.'admin/manage-order.php');
                }
                else
                {
                    //failed
                    $_SESSION['update'] = "Faield updated order";
                    header('location:'.$siteurl.'admin/manage-order.php');
                }

                //redirct to manag order with msg
            }
            ?>

    </div>
    
</div>


<?php include('partials/footer.php'); ?>