<style type="text/css">
h1.sub{
  font-size: 80px;

}
</style>

<!-- Add this script before </body> -->

<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!--main content start-->
<section id="main-content">
  <section class="wrapper">
    <!-- page start-->
    <div class="row">
     <!-- <div class="col-md-4">
      <section class="panel">
        <div class="panel-body">
          <div class="top-stats-panel">
            <div class="daily-visit">
              <h4 class="widget-h">वेबसाइट अबलोकन  संख्या</h4>

              <h1 class="sub" id="count"> <a href="javascript:voiv(0);" target="_blank"><img src="http://www.cutercounter.com/hits.php?id=grppcnq&nd=9&style=10" border="0" alt="visitor counter"></a></h1>


            </div>
          </div>
        </div>
      </section> -->
    </div>
<?php  if($layercount): 
foreach ($layercount as $key => $value) {
?>
    <div class="col-md-6">
      <section class="panel">
        <div class="panel-body">
          <div class="top-stats-panel">
            <div class="daily-visit">
              <h4 class="widget-h"><?php echo $value['category_type'] ?> Total Objects</h4>

              <h1 class="sub" id="count1"><?php echo $value['total']  ?></h1>

            </div>
          </div>
        </div>
      </section>
    </div>
  <?php } endif; ?>
  <!--  <div class="col-md-4">
      <section class="panel">
        <div class="panel-body">
          <div class="top-stats-panel">

            <h4 class="widget-h"><?php echo $this->lang->line('data'); ?></h4>
            <h1 class="sub text-center" id="count2"><?php echo $map_data ?></h1>

          </div>
        </div>
      </section>
    </div> -->

  </div>

  <div class="row">
    <div class="col-md-3">
      <!--earning graph start-->
      <!-- <section class="panel">
        <header class="panel-heading">
          <?php echo $this->lang->line('graph'); ?><span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
          </span>
        </header>
        <div class="panel-body">

          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </div>
      </section> -->
    </div>
    <div class="col-md-12">
      <!--widget graph start-->
      <header class="panel-heading">
         Mayor's Message<span class="tools pull-right">
            <a href="javascript:;" class="fa fa-chevron-down"></a>
          </span>
        </header>
      <section class="panel">
        <div class="panel-body">
            <video width="100%" height="348" controls>
              <source src=" <?php echo $mayermessage[0]['video'] ?>" type="video/mp4">
              <source src="<?php echo $mayermessage[0]['video'] ?>" type="video/ogg">
              Your browser does not support HTML5 video.
            </video>
       </div>

     </section>



     <!-- page end-->

</section>
</section>


<!--main content end-->
<script>
var home=parseInt("<?php echo $home ?>");
var map=parseInt("<?php echo $map ?>");
var report=parseInt("<?php echo $reports ?>");
//var about=parseInt("<?php echo $about ?>");


window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "<?php echo $this->lang->line('page_visited'); ?>"
  },
  axisY: {
    title: ""
  },
  data: [{
    type: "column",
    showInLegend: true,
    legendMarkerColor: "grey",
    legendText: "<?php echo $this->lang->line('pages'); ?>",
    dataPoints: [
      { y: home, label: "<?php echo $this->lang->line('home'); ?>" },
      { y: map,  label: "<?php echo $this->lang->line('map'); ?>" },
      { y: report,  label: "<?php echo $this->lang->line('reports'); ?>" },
      // { y: about,  label: "About" },

    ]
  }]
});
chart.render();

}
</script>


    <!--counter-->

<script type="text/javascript">
  $('#count,#count1,#count2').each(function () {

    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
      </script>
