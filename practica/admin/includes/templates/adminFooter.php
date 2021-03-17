<?php

$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);
$activarTabla = false;
$activarGrafico = false;

if ($pagina == 'lista-usuarios' || $pagina == 'lista-tickets') {
  $activarTabla = true;
}

if ($pagina == 'dashboardAdmin') {
  $activarGrafico = true;

  try {
    //Enero
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-01-00' AND '2020-02-00'";
    $resultado = $conn->query($sql);
    $enero = $resultado->num_rows;

    //Febrero
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-02-00' AND '2020-03-00'";
    $resultado = $conn->query($sql);
    $febrero = $resultado->num_rows;

    //Marzo
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-03-00' AND '2020-04-00'";
    $resultado = $conn->query($sql);
    $marzo = $resultado->num_rows;

    //Abril
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-04-00' AND '2020-05-00'";
    $resultado = $conn->query($sql);
    $abril = $resultado->num_rows;

    //Mayo
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-05-00' AND '2020-06-00'";
    $resultado = $conn->query($sql);
    $mayo = $resultado->num_rows;

    //Junio
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-06-00' AND '2020-07-00'";
    $resultado = $conn->query($sql);
    $junio = $resultado->num_rows;

    //Julio
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-07-00' AND '2020-08-00'";
    $resultado = $conn->query($sql);
    $julio = $resultado->num_rows;

    //Agosto
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-08-00' AND '2020-09-00'";
    $resultado = $conn->query($sql);
    $agosto = $resultado->num_rows;

    //Septiembre
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-09-00' AND '2020-10-00'";
    $resultado = $conn->query($sql);
    $septiembre = $resultado->num_rows;

    //Octubre
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-10-00' AND '2020-11-00'";
    $resultado = $conn->query($sql);
    $octubre = $resultado->num_rows;

    //Noviembre
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-11-00' AND '2020-12-00'";
    $resultado = $conn->query($sql);
    $noviembre = $resultado->num_rows;

    //Diciembre
    $sql = "SELECT id FROM tickets WHERE DATE(fecha) BETWEEN '2020-12-00' AND '2021-01-00'";
    $resultado = $conn->query($sql);
    $diciembre = $resultado->num_rows;

  } catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
  }
}

?>

<!-- Footer -->
<footer class="page-footer pt-0 mt-5 rgba-stylish-light <?php echo $fixedBottom; ?>">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3 elegant-color">
    <div class="container-fluid white-text">
      © 2020 Copyright: Lisandro Rocha Tau
    </div>
  </div>
</footer>
<!-- Footer -->

<!-- SCRIPTS -->
<!-- JQuery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="js/addons/datatables.min.js"></script>
<!-- For exporting tables  -->
<script type="text/javascript" src="js/tableHTMLExport.js"></script>
<script type="text/javascript" src="http://www.cloudformatter.com/Resources/Pages/CSS2Pdf/Script/xepOnline.jqPlugin.js"></script>

<script>
  $('#json').on('click',function(){
    $("#tabladedatos").tableHTMLExport({type:'json',filename:'tabla.json'});
  })
  $('#csv').on('click',function(){
    $("#tabladedatos").tableHTMLExport({type:'csv',filename:'tabla.csv'});
  })
</script>

<!-- Initializations -->
<script>
// SideNav Initialization
$(".button-collapse").sideNav();

// Material Select Initialization
$(document).ready(function () {
  $('.mdb-select').materialSelect();
});

// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<?php if ($activarGrafico) { ?>
<!-- Charts -->
<script>
// Main chart
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
    datasets: [{
      label: "Tickets",
      fillColor: "#fff",
      backgroundColor: 'rgba(255, 255, 255, .3)',
      borderColor: 'rgba(255, 255, 255)',
      data: [<?php echo $enero; ?>, <?php echo $febrero; ?>, <?php echo $marzo; ?>, <?php echo $abril; ?>, <?php echo $mayo; ?>, <?php echo $junio; ?>, <?php echo $julio; ?>,
            <?php echo $agosto; ?>, <?php echo $septiembre; ?>, <?php echo $octubre; ?>, <?php echo $noviembre; ?>, <?php echo $diciembre; ?>],
    }]
  },
  options: {
    legend: {
      labels: {
        fontColor: "#fff",
      }
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: true,
          color: "rgba(255,255,255,.25)"
        },
        ticks: {
          fontColor: "#fff",
        },
      }],
      yAxes: [{
        display: true,
        gridLines: {
          display: true,
          color: "rgba(255,255,255,.25)"
        },
        ticks: {
          fontColor: "#fff",
        },
      }],
    }
  }
});
</script>
<?php } ?>

<?php if ($activarTabla) { ?>
  <script type="text/javascript">
  $(document).ready(function () {
    $('#tabladedatos').DataTable({
      "language": {
        "infoEmpty":      "Mostrando de 0 a 0 de 0 resultados",
        "infoFiltered":   "(filtrando de _MAX_ resultados totales)",
        "info":           "Mostrando de _START_ a _END_ de _TOTAL_ resultados",
        "lengthMenu":     "Mostrar _MENU_ resultados",
        "search":         "Buscar:",
        "zeroRecords":    "No se han encontrado resultados que coincidan con la búsqueda",
        "paginate": {
          "first":      "Primero",
          "last":       "Último",
          "next":       "Siguiente",
          "previous":   "Anterior"
        }
      }
    });
    $('.dataTables_length').addClass('bs-select');
  });
</script>
<?php } ?>

</body>

</html>
