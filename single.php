<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");

$post = selectOne('posts', ['id' => $_GET['id']]);

$posts = selectAll('posts', ['published' => 1]);

$topics = selectAll('topics');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Candal&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title><?php echo $post["title"]; ?></title>
</head>

<body>
    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <!-- page-wrapper -->
    <div class="page-wrapper">
        <div class="content clearfix">
            <div class="main-content-wrapper">
                <div class="main-content single">
                    <h1 class="post-title">
                        <?php echo $post["title"]; ?>
                    </h1>
                    <dic class="post-content">
                        <?php echo html_entity_decode($post["body"]); ?>
                    </dic>
                </div>
            </div>

            <div class="sidebar single">
                <div class="section popular">
                    <h2 class="section title">Popular</h2>

                    <?php foreach ($posts as $p) : ?>
                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL  . '/assets/images/' . $p['image']; ?>" alt="" />
                            <a href="">
                                <h4><?php echo $p['title']; ?></h4>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
                <div class="section topics">
                    <h2 class="section-title">Topics</h2>
                    <ul>
                        <?php foreach ($topics as $topic) : ?>
                            <li><a href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>"><?php echo $topic['name']; ?></a></li> <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- page-wrapper -->

    <!-- Footer -->
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
    <!-- /footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="assets/js/scripts.js"></script>
</body>

</html>