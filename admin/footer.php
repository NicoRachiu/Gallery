  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="<?php enqueueAsset('js/jquery.js'); ?>"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php enqueueAsset('js/bootstrap.min.js'); ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

  <script src="<?php enqueueAsset('js/scripts.js'); ?>"></script>
  <script type="text/javascript">
      google.charts.load('current', {
          'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

          var data = google.visualization.arrayToDataTable([
              ['Task', 'Hours per Day'],
              ['Views', <?php echo $session->count; ?>],
              ['Photo', <?php $photo = new Photos;
                        echo $photo->number_photo(); ?>],
              ['Users', <?php $user = new Users;
                        echo $users->number_photo(); ?>],
              ['Comments', <?php $comment = new Comment;
                            echo $comment->number_photo(); ?>],

          ]);

          var options = {
              //legend: 'none',
              pieSliceText: 'label',
              title: 'Info',
              backgroundColor: 'transparent'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
      }
  </script>
  </body>

  </html>