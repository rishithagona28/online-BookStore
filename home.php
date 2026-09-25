<?php
include 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="home.css">
</head>

<body>

<?php include 'user_header.php'; ?>

<section class="home_cont">
    <div class="main_descrip">
        <h1>The Bookshelf</h1>
        <p>Explore, Discover, and Buy Your Favorite Books</p>
    </div>
</section>

<?php include 'best-seller.php'; ?>

<section class="best_sellers_cont">
    <div class="main_descrip" style="background-color: #003049;">
        <h1 style="color: white;">Few Products...</h1>
    </div>
</section>

<section class="products_cont">
    <div class="pro_box_cont">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('Query failed');

        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
                <div class="pro_box">
                    <img src="./uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                    <h3><?php echo $fetch_products['name']; ?></h3>
                    <p>Rs. <?php echo $fetch_products['price']; ?>/-</p>
                    
                    <?php if (!empty($fetch_products['genre'])) { ?>
                        <p><strong>Genre:</strong> <?php echo $fetch_products['genre']; ?></p>
                    <?php } ?>

                    <?php if (!empty($fetch_products['description'])) { ?>
                        <p><strong>Description:</strong> <?php echo $fetch_products['description']; ?></p>
                    <?php } ?>
                </div>
        <?php
            }
        } else {
            echo '<p class="empty">No Products Added Yet!</p>';
        }
        ?>
    </div>
</section>

<section class="about_cont">
    <img src="about.jpg" alt="">
    <div class="about_descript">
        <h2>Discover Our Story</h2>
        <p>At Bookiee, we are passionate about connecting readers with captivating stories, inspiring ideas, and a world of knowledge. Our bookstore is more than just a place to buy books; it's a haven for book enthusiasts, where the love for literature thrives.</p>
        <button class="product_btn" onclick="window.location.href='about.php';">Read More</button>
    </div>
</section>

<section class="questions_cont">
    <div class="questions">
        <h2>Have Any Queries?</h2>
        <p>At Bookiee, your satisfaction is our top priority. Whether you have a question, concern, or need assistance, our friendly support team is always ready to help. Don’t hesitate to reach out — we’re here for you every step of the way.</p>
        <a href="contact.php" class="product_btn">Contact Us</a>
    </div>
</section>

<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="script.js"></script>

</body>
</html>
