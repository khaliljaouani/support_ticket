<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('close_message'); ?>
<?php flash('attribute_message'); ?>
<?php flash('reply_message'); ?>
<a href="<?php echo URLROOT; ?>/tickets" class="btn btn-light"><i class="fa fa-backward" aria-hidden="true"></i> Retour</a>
<?php if(!$data['ticket']->support_id && $_SESSION['user_type'] === 'support' && $data['ticket']->status != 'Closed') { ?>
    <form class="pull-right" action="<?php echo URLROOT; ?>/tickets/attribute/<?php echo $data['ticket']->ticketId; ?>" method="post">
        <input type="submit" class="btn btn-success" value="Se présenter">
    </form>
<?php } elseif($data['ticket']->status != 'Closed') { ?>
    <form class="pull-right" action="<?php echo URLROOT; ?>/tickets/close/<?php echo $data['ticket']->ticketId; ?>" method="post">
      <input type="submit" class="btn btn-danger" value="Ferme la Ticket">
    </form>
<?php }; ?>
<br>

<?php /* Ticket Access */ ?>
<?php if($data['ticket']->user_id === $_SESSION['user_id'] || $data['ticket']->support_id === $_SESSION['user_id'] || $data['ticket']->support_id === null) { ?>

    <div class="row mb-3 mt-4">
        <p class="d-flex flex-row col-md-10"><?php echo $data['ticket']->type; ?> - <?php echo $data['ticket']->category; ?></p> 
        <div class="col-md-8">
            <h1 class="card-title"><?php echo $data['ticket']->ticketId ?># <?php echo $data['ticket']->subject ?></h1>
        </div>
        <div class="col-md-4">
            <p class="badge badge-pill badge-info pull-right mt-4" style="cursor: default;">Priorité : <?php echo $data['ticket']->levelName ?></p>
            <p class="badge badge-pill badge-warning pull-right mr-1 mt-4" style="cursor: default;">Statut : <?php echo $data['ticket']->status ?></p>
        </div>
    </div>

    <div class="card mb-3">
        <h5 class="card-header"><b><?php echo $data['user']->firstname .' '. $data['user']->lastname; ?></b> on <?php echo date("d M Y - H:i", strtotime($data['ticket']->created_at)); ?></h5>
        <div class="card-body">
            <p class="card-text"><?php echo nl2br($data['ticket']->description) ?></p>
            <i class="fa fa-paperclip" aria-hidden="true"></i><a class="card-text" href="<?php echo URLROOT; ?>/uploads/<?php  echo $data['ticket']->attachment ?>" download> <?php echo $data['ticket']->attachment ?></a>
        </div>
    </div>

    <?php foreach($data['comment'] as $comment) { ?>
        <hr>
        <div class="card mb-3">
            <h5 class="card-header"><b><?php echo $comment->firstname .' '. $comment->lastname; ?></b> on <?php echo date("d M Y - H:i", strtotime($comment->commentDate)); ?></h5>
            <div class="card-body">
                <p class="card-text"><?php echo nl2br($comment->description) ?></p>
            </div>
        </div>
    <?php }; ?>

    <?php if($data['ticket']->status != 'Closed' && $data['ticket']->support_id != null) { ?>
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Répondre
            </a>
        </p>
    <?php }; ?>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form action="<?php echo URLROOT; ?>/tickets/reply/<?php echo $data['ticket']->ticketId; ?>" method="post">
            <div class="form-group">
                <fieldset disabled class="mb-2">
                    <input type="text" name="username" class="form-control form-control-lg" value="" placeholder="<?php echo $_SESSION['user_firstname']; echo ' '; echo $_SESSION['user_lastname'];  ?>">
                </fieldset>                
                <textarea name="description" class="form-control form-control-lg <?php echo (!empty($data['description_err'])) ? 'is-invalid' : ''; ?>" placeholder="Add a reply..." style="min-height: 250px !important;"><?php echo $data['description']; ?></textarea>
                <span class="invalid-feedback"><?php echo $data['description_err']; ?></span>
                <?php if($_SESSION['user_type'] === 'support') { ?>
                    <input type="hidden" name="status" value="Waiting for user">
                <?php } else { ?>
                    <input type="hidden" name="status" value="Waiting for support">
                <?php }; ?>
            </div>
            <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
    
<?php } else { ?>
    <h1>Accès non autorisé</h1>
<?php }; ?>



<?php require APPROOT . '/views/inc/footer.php' ?>