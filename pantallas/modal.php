<?php  
   echo<<<"EL"

  <div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Aviso</h4>
      </div>
      <div class="modal-body">
        <p>Operacion Completada Correctamente</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <link rel="stylesheet" href="css/bootstrap.css"></link>
   <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
      function cambiarTextoMensaje(message)
      {
        $(".modal-body p").html(message);
      }
        $(".modal").modal('show');  
    </script>

EL;
?>
