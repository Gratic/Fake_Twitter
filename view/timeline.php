<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Timeline</title>
    <link rel="stylesheet" type="text/css" href="<?php urlr("../lib/bootstrap-5.1.3-dist/css/bootstrap.min.css")?>">
    <link rel="stylesheet" type="text/css" href="<?php urlr("../lib/bootstrap-icons-1.8.1/bootstrap-icons.css")?>">
    <link rel="stylesheet" type="text/css" href="<?php urlr("../style/style.css")?>">
</head>

<body class="min-vh-100 bg-dark">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container text-white">
            <a href="<?php url('timeline'); ?>" class="navbar-brand">Timeline</a>
            <div class="me-auto d-flex">
                <?php if(!Auth::check()): ?>
                <div class="nav-item">
                    <a href="<?php url('connexion') ?>" class="nav-link text-white">Log in</a>
                </div>
                <div class="nav-item">
                    <a href="<?php url('inscription') ?>" class="nav-link text-white">Sign up</a>
                </div>
                <?php else : ?>
                <div class="nav-item">
                    <a href="<?php url('deconnexion') ?>" class="nav-link text-white">Log out</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container dark bg-dark min-vh-100 text-white">
        <div class="row mb-3">
            <div class="offset-3 col-6">
                <?php if(Auth::check()): ?>
                <h1>Welcome back <?php echo User::load(Auth::id())->user_name; ?> !</h1>
                <?php else: ?>
                <h1>Welcome back to Timeline !</h1>
                <?php endif; ?>
            </div>
        </div>

        <?php if(Auth::check()): ?>
        <div class="row mt-3">
            <div class="offset-3 col-6">
                <div class="card bg-dark border border-secondary">
                    <div class="card-body">
                        <form method="post" action="<?php url('post-form-post') ?>">
                            <h5>Share your idea with internet !</h3>
                                <textarea id="post-area" class="form-control bg-dark text-white" name="post_content"
                                    rows="3"></textarea>
                                <div class="text-end mt-1">
                                    <button class="btn btn-dark text-end border" type="submit">Send</button>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php endif; ?>


        <div class="row">
            <div class="offset-3 col-6">
                <?php foreach ($posts as $post): ?>

                <div class="card bg-dark border border-secondary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title"><?php echo $post->user()->user_name ?></h5>
                                <?php if(Auth::check() && Auth::id() == $post->post_user_id): ?>

                                <a class="btn btn-danger"
                                    href="<?php url('post-delete', ['post_id' => $post->post_id]); ?>">Delete</a>
                                <?php endif; ?>
                        </div>
                        <p class="card-text"><?php echo $post->post_content ?></p>
                        <p class="text-end text-muted"><?php echo $post->post_date ?></p>
                        <div class="d-flex">
                            <?php if(Auth::check() && Postlike::userHasLikedPost(Auth::id(), $post->post_id)) : ?>
                            <form action="<?php url('postlike-delete') ?>" method="post">
                                <button type="submit" name="delete" class="btn btn-dark border">
                                    <i class="bi bi-heart-fill text-danger"></i>
                                    Stop liking ?
                                    <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>" />
                                </button>
                            </form>

                            <?php elseif(Auth::check()) : ?>
                            <form action="<?php url('postlike-create') ?>" method="post">
                                <button type="submit" name="create" class="btn btn-dark border">
                                    <i class="bi bi-heart me-2"></i>
                                    Like
                                    <input type="hidden" name="post_id" value="<?php echo $post->post_id; ?>" />
                                </button>
                            </form>
                            <?php else : ?>
                            <i class="bi bi-heart me-2"></i>
                            <?php endif; ?>
                            <span
                                class="text-secondary mx-2"><?php echo implode(", ", Postlike::getAllUsersWhoLikedPost($post->post_id)) ?></span>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>