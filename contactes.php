<?php require_once("includes/header.php") ?> 
<?php 

    $query = "SELECT * FROM contactes";
    $stmt = $conn->query($query);

    $contactes = $stmt->fetchAll(PDO::FETCH_OBJ);

?>


<div class="d-flex">

    <a href="index.php"><img class="icon-back" src="img/go-previous.svg" alt=""></a>

<div class="container-lg container-table align-items-center">

<!--------------------------- MESSAGE OK ------------------------------->
<div class="row">
    <div class="col-sm-12">
        <?php if(isset($_GET["missatge"])) : ?>
            <div class="alert message alert-dismissible fade show p-2" role="alert">
            <img src="img/emblem-ok.svg" class="icon-missatge me-2" alt="">
                <strong><?php echo $_GET["missatge"]; ?></strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif; ?>
    </div>  
</div>
<!------------------------------------------------------------------------>

<div class="row">
    <div class="col-md-7 col-sm-12">
        <h2><img src="img/contact-2.svg" class="me-1 pb-1" alt="">Contactes</h>
    </div> 
    <div class="col-md-1 pe-md-0 mt-2">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <button type="submit" class="button-search">
            <img src="img/edit-find.svg" class="icon-search mt-1" alt="">
            </button>
        </div>
        <div class="col-md-4 col-sm-12 col-search mt-2">
            <input type="text" class="input-search form-control" id="myInput" placeholder="Buscar contacte...">  
        </div> 
        </form>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th class="pc-table-title">Mòbil</th>
                        <th class="pc-table-title">Email</th> 
                    </tr>
                </thead>
            <tbody id="myTable">

                <?php foreach($contactes as $i) : ?>

                    <tr class="tr-table">
                        <td><a href="info_contacte.php?id=<?php echo $i->id; ?>">
                            <img src="img/gtk-info.svg" alt="" class="icon-form only-mobile"></a>
                            <a href="editar_contacte.php?id=<?php echo $i->id; ?>">
                            <img src="img/gtk-edit.svg" alt="" class="icon-form no-mobile"></a>
                            <a href="borrar_contacte.php?id=<?php echo $i->id; ?>">
                            <img src="img/erase-red.svg" alt="" class="icon-form no-mobile"></a>
                        </td>
                        <td><?php echo $i->nom; ?></td>
                        <td><?php echo $i->cognoms; ?></td>
                        <td class="pc-table">
                            <a href="tel:+<?php echo "+" . $i->prefix; ?><?php echo $i->telefon; ?>">
                            <img src="img/watsap.svg" alt="" class="icon-form">
                            <?php echo "+" . $i->prefix. " "; ?><?php echo $i->telefon; ?></a>
                        </td>
                        <td class="pc-table">
                            <a href="mailto:<?php echo $i->email; ?>">
                            <img src="img/ICON_Contact-agenda.svg" alt="" class="icon-mail">
                            <?php echo $i->email; ?></a>
                        </td>
                    </tr> 
                    
                <?php endforeach; ?>       

            </tbody>       
        </table>
    </div>
</div>

<?php require_once("includes/footer.php") ?>


<!------------------------- JQUERY SEARCH TABLE ---------------------------------->

<script>

    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

</script>




