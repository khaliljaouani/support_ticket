<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
  .home-content .overview-boxes .box_topic{
  font-size: 20px;
  font-weight: 500;
  
  }
  .home-content .overview-boxes .number{
  font-size: 35px;
  font-weight: 500;
  margin-top: -5px;
  display: inline-block;
  }
  .home-content .overview-boxes .box{
    margin-top: 45px;
    width: calc(100% / 4 - 15px);
    display: flex;
    align-items: center;
    
    justify-content: center;
    padding: 15px 14px;
    background: #adb5bd;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  }
  .overview-boxes .indicator{
   display: flex;
   align-items: center;
  }
  .overview-boxes .indicator i{
    height: 20px;
    width: 20px;
    background: #8FDACB;
    color: #fff;
    border-radius: 50%;
    font-size: 20px;
    margin-right: 5px;
  }
  .overview-boxes .indicator .text{
   font-size: 12px;
  }
  .overview-boxes .box .cart{
    font-size: 32px;
    font-weight: 500;
    height: 50px;
    width: 50px;
    background: #cce5ff;
    color: #66b0ff;
    line-height: 50px;
    text-align: center;
    border-radius: 12px;
  }
  .overview-boxes .box .cart.two{
    background: #C0F2DB;
    color: #2BD47D;
  }
  .overview-boxes .box .cart.three{
    background: #ffe8b3;
    color: #ffc233;
  }
  .overview-boxes .box .cart.four{
    background: #f7d4d7;
    color: #e05260;
  }
  .home-content .overview-boxes{
      display: flex;
      width: 100%;
      justify-content: space-between;
      padding: 0 20px;
      flex-wrap: wrap;
  }
  @media (max-width: 1018px) {
    .home-content .overview-boxes .box{
    width: calc(100% / 2 - 15px);
    margin-bottom: 15px;
   
      
  }}
  .home-content .overview-boxes .box1{
      margin-top: 45px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 14px;
    background: #fff;
    
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  }
 
</style>
<div class="home-content">
        <div class="overview-boxes">
            <div class="box">
                <div class="left-side">
                    <div class="box_topic">Support</div>
                    <div class="number"><?php echo $data['support']->nbr_support; ?></div>
                    <div class="indicator">
                        <span class="text">Nombre du support</span>
                    </div>
                </div>
                <i class="bi bi-people-fill cart"></i>
            </div>
            <div class="box">
                <div class="left-side">
                    <div class="box_topic">Collaborateur</div>
                    <div class="number"><?php echo $data['collaborateur']->nbr_collaborateur; ?></div>
                    <div class="indicator">
                        <span class="text">Nombre du collaborateur</span>
                    </div>
                </div>
                <i class="bi bi-person-lines-fill cart two"></i>
            </div>
            <div class="box">
                <div class="left-side">
                    <div class="box_topic">Dmenade</div>
                    <div class="number"><?php if($_SESSION['user_type'] === 'user') { 
                                                echo $data['demande']->nbr_demande; 
                                                 } elseif  ($_SESSION['user_type'] === 'support') {
                                                echo $data['demande_resolu']->nbr_demande_resolu;
                                                 } ?></div>
                    <div class="indicator">
                        <span class="text"><?php if($_SESSION['user_type'] === 'user') {?>
                            Mes demandes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <?php } elseif($_SESSION['user_type'] === 'support')  { ?>
                                demandes resodre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php } ?>
                    </div>
                </div>
                <i class="bi bi-calendar2-week cart three"></i>
            </div>
            
            <div class="box">
                <div class="left-side">
                    <div class="box_topic">Incident</div>
                    <div class="number"><?php if($_SESSION['user_type'] === 'user') { 
                                                echo $data['incident']->nbr_incident; 
                                                  } elseif  ($_SESSION['user_type'] === 'support') {
                                                echo $data['incident_resolu']->nbr_incident_resolu;
                                                  } 
                                                ?></div>
                    <div class="indicator">
                        <span class="text"><?php if($_SESSION['user_type'] === 'user') {?>
                            Mes incidents&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <?php } elseif($_SESSION['user_type'] === 'support')  { ?>
                                incidents resodre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <?php } ?>
                    </div>
                </div>
                <i class="bi bi-calendar2-week cart four"></i>
            </div>
        </div>
    </div>    

    <!-- Support Section -->
<?php if($_SESSION['user_type'] === 'support') { ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <hr>
                <h3 style="text-align: center;">Tickets en attente</h3>
            </div>
        </div>
        <?php foreach($data['tickets'] as $ticket) { ?>
            <div class="card card-body mb-3">
                <div class="row mb-2">    
                    <p class="d-flex flex-row col-md-10"><?php echo $ticket->ticketType; ?> - <?php echo $ticket->category; ?></p> 
                    <div class="d-flex flex-row col-md-10 mt-1">
                        <h4 class="card-title"><?php echo $ticket->ticketId; ?># <?php echo $ticket->subject; ?></h4>
                        <div class="col-md-5">
                            <p class="badge badge-pill badge-warning pull-left mr-1 mt-2 align-baseline" style="cursor: default;">Statut : <?php echo $ticket->status ?></p>
                            <p class="badge badge-pill badge-info pull-left mt-2" style="cursor: default;">Priorité : <?php echo $ticket->levelName ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo URLROOT; ?>/tickets/show/<?php echo $ticket->ticketId; ?>" class="btn btn-primary pull-right">Vue</a>
                    </div>
                </div>
                <div class="bg-light p-2 mb-2">
                Proposé par <b><?php echo $ticket->firstname . ' ' . $ticket->lastname; ?></b> on <?php echo date("d M Y - H:i", strtotime($ticket->ticketDate)); ?>
                </div>
            </div>
        <?php }; ?>
    <?php }; ?>

 <!--chart user-->
  <!-- content -->
  <?php if($_SESSION['user_type'] === 'user') { ?>
  <div class="home-content">
        <div class="overview-boxes">
             <div class="box1">
                <div class="left-side"> 
                <div id="curve_chart" style="width: 1000px; height: 400px"></div>
            </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>  
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Days', 'demande', 'incident'],
          ['27',  4,      7],
          ['28',  9,      10],
          ['29',  13,       19],
          ['30',  12,       3],
          ['1',  16,      8]
        ]);

        var options = {
          title: 'Nombre',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>   

<?php }; ?>

<?php require APPROOT . '/views/inc/footer.php' ?>