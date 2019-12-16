<?php 
    $retVal = (isset($_SESSION['success'])) ? $_SESSION['success'] : '' ;
    ?>
      <div class="alert alert-success">
      <?php echo $retVal; unset($_SESSION['success']); ?>
      </div>
    <?php 
?>

<?php 
    $retVal = (isset($_SESSION['error'])) ? $_SESSION['error'] : '' ;
    ?>
      <div class="alert alert-danger">
      <?php echo $retVal; unset($_SESSION['error']); ?>
      </div>
    <?php 
?>