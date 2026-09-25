<?php
// Check if session is already started, if not, then start it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include 'config.php';

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Best Sellers</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="home.css">

  <style>
    /* Best sellers section */
    .best_sellers_cont .pro_box_cont {
      display: grid;
      grid-template-columns: repeat(4, 1fr); /* 4 items per row */
      gap: 20px;
      padding: 20px;
      justify-items: center; /* Align items in the center */
    }

    .pro_box {
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      padding: 10px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
    }

    .pro_box:hover {
      transform: scale(1.05); /* Slightly enlarge the box on hover */
    }

    .product-img {
      width: 100%;
      height: 200px; /* Adjust the height for a compact display */
      object-fit: cover;
      border-radius: 8px;
    }

    .pro_box h3 {
      font-size: 16px;
      margin: 10px 0;
    }

    .pro_box p {
      font-size: 14px;
      color: #333;
      margin-bottom: 10px;
    }

    /* Product Button */
    .product_btn {
      background-color:rgb(247, 140, 147);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      border: none;
      cursor: pointer;
    }

    .product_btn:hover {
      opacity: 0.9;
      box-shadow: 2px 2px 2px gray;
    }

    .empty {
      text-align: center;
      font-size: 18px;
      color: #333;
    }

    /* Responsiveness for smaller screens */
    @media (max-width: 1200px) {
      .best_sellers_cont .pro_box_cont {
        grid-template-columns: repeat(3, 1fr); /* 3 items per row on medium screens */
      }
    }

    @media (max-width: 900px) {
      .best_sellers_cont .pro_box_cont {
        grid-template-columns: repeat(2, 1fr); /* 2 items per row on smaller screens */
      }
    }

    @media (max-width: 600px) {
      .best_sellers_cont .pro_box_cont {
        grid-template-columns: 1fr; /* 1 item per row on mobile */
      }
    }
  </style>
</head>

<body>

  <section class="best_sellers_cont"> 
    <div class="main_descrip">
    <div class="main_descrip" style="background-color:rgb(188, 224, 247);">
  <h1 style="color: white;">Best Sellers</h1>
  <p style="color: white;">Explore Our Most Popular Books</p>
</div>


    <div class="pro_box_cont">
      <?php
      // Query to get the top 6 products based on total price spent in orders (this is a workaround based on total price)
      $select_best_sellers = mysqli_query($conn, "
        SELECT p.*, SUM(o.total_price) AS total_revenue
        FROM products p
        LEFT JOIN orders o ON o.total_products LIKE CONCAT('%', p.name, '%')
        GROUP BY p.id
        ORDER BY total_revenue DESC
        LIMIT 6
      ") or die('query failed');

      if (mysqli_num_rows($select_best_sellers) > 0) {
        while ($fetch_best_seller = mysqli_fetch_assoc($select_best_sellers)) {
      ?>
          <form action="" method="post" class="pro_box">
            <img src="./uploaded_img/<?php echo $fetch_best_seller['image']; ?>" alt="" class="product-img">
            <h3><?php echo $fetch_best_seller['name']; ?></h3>
            <p>Rs. <?php echo $fetch_best_seller['price']; ?>/-</p>

            <input type="hidden" name="product_name" value="<?php echo $fetch_best_seller['name'] ?>">
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="hidden" name="product_price" value="<?php echo $fetch_best_seller['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_best_seller['image']; ?>">
          </form>
      <?php
        }
      } else {
        echo '<p class="empty">No Best Sellers Available!</p>';
      }
      ?>
    </div>
  </section>

  <script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
  <script src="script.js"></script>

</body>

</html>
