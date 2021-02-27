<!DOCTYPE html>
<?php
        include('functions/functions.php');
?> 
<html lang="en">
<head>
    <script src="https://cdn.tiny.cloud/1/adkkh5sgxgaxfll9bneogfx6219qjzr7gsv8n91whzqrocve/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserting Products</title>

    <link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body bgcolor="skyblue">

    <form action="insert_product.php" method="post" enctype="multipart/form-data">

        <table align="center" width ='750' border="2" bgcolor="orange">

            <tr align="center">
                <td colspan="8"><h2>
                    Insert new Product
                </h2></td>
            </tr>

            <tr align="center">
                <td><b>Product name:</b></td>
                <td><input type="text" name="product_name" size="40" required/></td>
            </tr>

            <tr align="center">
                <td><b>Product category:</b></td>
                <td>
                    <select name="product_cat">
                        <option>Select a category</option>
                        <?php

                            getCats();

                        ?>
                    </select>
                </td>
            </tr>

            <tr align="center">
                <td><b>Product Brand:</b></td>
                <td>
                    <select name="product_brand">
                        <option>Select a Brand</option>
                        <?php

                            getBrand();

                        ?>
                    </select>
                </td>
            </tr>


            <tr align="center">
                <td><b>Price:</b></td>
                <td><input type="text" name="product_price" size="40" required/></td>
            </tr>

            <tr align="center">
                <td><b>Quantity:</b></td>
                <td><input type="text" name="product_quantity" size="40" required/></td>
            </tr>

            <tr align="center">
                <td><b>Description:</b></td>
                <td><textarea name="product_description" cols="30", rows="10"></textarea></td>
            </tr>

            <tr align="center">
                <td><b>Image:</b></td>
                <td><input type="file" name="product_image" size="40" required/></td>
            </tr>

            <tr align="center">
                <td><b>Keywords:</b></td>
                <td><input type="text" name="product_keywords" size="40" required/></td>
            </tr>

            <tr align="center">
                <td><b>Specification:</b></td>
                <td><textarea name="product_specification" cols="30", rows="10"></textarea></td>
            </tr>

            <tr align="center">
                <td colspan="8"><input type="submit" name="insert_product" value="Insert"/></td>
            </tr>

        </table>

    </form>


</body>
</html> 

<?php
    insertProd();
?>