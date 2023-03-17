<?php require APPROOT . '/views/inc/header.php'; ?>

    <?php /* Support Section */ ?>
    <?php if($_SESSION['user_type'] === 'support') { ?>
        <a href="<?php echo URLROOT; ?>/tickets" class="btn btn-light"><i class="fa fa-backward" aria-hidden="true"></i> Active Tickets</a>
        <div class="row mb-3 mt-2">
            <div class="col-md-6">
                <h1>Closed Tickets</h1>
            </div>
        </div>
        <?php foreach($data['closedTicketsBySupport'] as $ticket) { ?>
            <div class="card card-body mb-3">
                <div class="row mb-2">
                    <p class="d-flex flex-row col-md-10"><?php echo $ticket->ticketType; ?> - <?php echo $ticket->category; ?></p>    
                    <div class="d-flex flex-row col-md-10 mt-1">
                        <h4 class="card-title"><?php echo $ticket->ticketId; ?># <?php echo $ticket->subject; ?></h4>
                        <div class="col-md-5">
                            <p class="badge badge-pill badge-warning pull-left mr-1 mt-2" style="cursor: default;">Statut : <?php echo $ticket->status ?></p>
                            <p class="badge badge-pill badge-info pull-left mt-2" style="cursor: default;">Priorité : <?php echo $ticket->levelName ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo URLROOT; ?>/tickets/show/<?php echo $ticket->ticketId; ?>" class="btn btn-primary pull-right">Vue</a>
                    </div>
                </div>
                <div class="bg-light p-2 mb-2">
                    Submitted by <b><?php echo $ticket->firstname . ' ' . $ticket->lastname; ?></b> on <?php echo date("d M Y - H:i", strtotime($ticket->ticketDate)); ?>
                </div>
            </div>
    <?php }; ?>

    <?php /* User Section */ ?>
    <?php } else { ?>
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>Closed Tickets</h1>
            </div>
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/tickets/add" class="btn btn-primary pull-right">
                    <i class="fa fa-pencil"></i> CREATE A TICKET
                </a>
            </div>
        </div>
        <?php foreach($data['closedTicketsByUser'] as $ticket) { ?>
            <div class="card card-body mb-3">
                <div class="row mb-2">    
                    <p class="d-flex flex-row col-md-10"><?php echo $ticket->ticketType; ?> - <?php echo $ticket->category; ?></p>    
                    <div class="d-flex flex-row col-md-10 mt-1">
                        <h4 class="card-title"><?php echo $ticket->ticketId; ?># <?php echo $ticket->subject; ?></h4>
                        <div class="col-md-5">
                            <p class="badge badge-pill badge-warning pull-left mr-1 mt-2" style="cursor: default;">Statut : <?php echo $ticket->status ?></p>
                            <p class="badge badge-pill badge-info pull-left mt-2" style="cursor: default;">Priorité : <?php echo $ticket->levelName ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo URLROOT; ?>/tickets/show/<?php echo $ticket->ticketId; ?>" class="btn btn-primary pull-right">Vue</a>
                    </div>
                </div>
                <div class="bg-light p-2 mb-2">
                Soumis le <?php echo date("d M Y - H:i", strtotime($ticket->ticketDate)); ?>
                </div>
            </div>
        <?php }; ?>
    <?php }; ?>

<?php require APPROOT . '/views/inc/footer.php' ?>