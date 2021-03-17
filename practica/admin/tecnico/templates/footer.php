<?php

$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);
$activarTabla = false;

if ($pagina == 'dashboardTecnico') {
  $activarTabla = true;
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
<script src="../js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../js/bootstrap.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="../js/addons/datatables.min.js"></script>
<!-- For exporting tables  -->
<script type="text/javascript" src="../js/tableHTMLExport.js"></script>
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
