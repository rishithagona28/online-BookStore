<?php
include 'config.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:login.php');
}

if (isset($_POST['add_products_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $description = !empty($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : NULL;

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = "uploaded_img/" . $image;

    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name='$name'");

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'The given product is already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products` (name, price, genre, description, image) 
            VALUES ('$name', '$price', '$genre', '$description', '$image')");

        if ($add_product_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = "Product added successfully!";
            }
        } else {
            $message[] = "Product failed to be added!";
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_img_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id='$delete_id'");
    if ($delete_img_query) {
        $fetch_del_img = mysqli_fetch_assoc($delete_img_query);
        if (!empty($fetch_del_img['image'])) {
            unlink('uploaded_img/' . $fetch_del_img['image']);
        }
    }

    mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id'");
    header('location:admin_products.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products</title>
    <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'admin_header.php' ?>

<section class="admin_add_products">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Add Product</h3>
        <input type="text" name="name" placeholder="Enter Product Name" required>
        <input type="number" min="0" name="price" placeholder="Enter Product Price" required>

        <select name="genre" required>
            <option value="" disabled selected>Select Genre</option>
            <option value="Fiction">Fiction</option>
            <option value="Non-Fiction">Non-Fiction</option>
            <option value="Science">Science</option>
            <option value="History">History</option>
            <option value="Biography">Biography</option>
        </select>

        <textarea name="description" placeholder="Enter Product Description (Optional)"></textarea>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" required>
        <input type="submit" name="add_products_btn" value="Add Product">
    </form>
</section>

<section class="show_products">
    <div class="product_box_cont">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`");
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                <div class="product_box">
                    <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                    <div class="product_name"><?php echo $fetch_products['name']; ?></div>
                    <div class="product_genre">Genre: <?php echo $fetch_products['genre']; ?></div>
                    <div class="product_price">Rs. <?php echo $fetch_products['price']; ?> /-</div>
                    <?php if (!empty($fetch_products['description'])) { ?>
                        <div class="product_description"><?php echo $fetch_products['description']; ?></div>
                    <?php } ?>
                    
                    <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="product_btn product_del_btn"
                       onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No Product added yet!</p>';
        }
        ?>
    </div>
</section>

</body>
</html>
