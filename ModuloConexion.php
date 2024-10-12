<?php
 $conn = mysqli_connect('localhost', 'root', '', 'bd_proyecto');
 if (!$conn) {
    ?>
    <script>
        Swal.fire({
            icon:'error',
            title:'Error',
            html:'Error de conexion con la BDD "bd_proyecto"'

        })
    </script>
    <?php
 }
?>