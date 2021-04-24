<?php require_once("includes/header.php") ?> 

<?php

    if (isset($_GET['id'])) {
        $idContacte = $_GET['id'];
    }

    $query = "SELECT * FROM contactes WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);
    $stmt->execute();

    $contacte = $stmt->fetch(PDO::FETCH_OBJ);

?>


<div class="container-lg container-table"> 

<a href="contactes.php"><img class="icon-back" src="img/go-previous.svg" alt=""></a>
                    
    <div class="row">
        <div class="col-sm-12">
                <h3 class="mb-4"><img src="img/gtk-info.svg" alt="" class="me-2">Informació de contacte</h3>       
                <p><?php echo "<strong>Nom: </strong>" . $contacte->nom; ?></p>
                <p><?php echo "<strong>Cognoms: </strong>" . $contacte->cognoms; ?></p>

                <p><a href="tel:+<?php echo "+" . $contacte->prefix; ?><?php echo $contacte->telefon; ?>">
                <img src="img/watsap.svg" alt="" class="icon-form">
                <?php echo "+" . $contacte->prefix . " "; ?><?php echo $contacte->telefon; ?></p></a>

                <p><a href="mailto :<?php echo $contacte->email; ?>"><img src="img/ICON_Contact-agenda.svg" alt="" class="icon-form me-2"><?php echo $contacte->email; ?></a></p>
        </div>
        <div class="col-sm-6">
                <a href="editar_contacte.php?id=<?php echo $contacte->id; ?>">
                <img src="img/gtk-edit.svg" alt="" class="me-2"></a>
                <a href="borrar_contacte.php?id=<?php echo $contacte->id; ?>">
                <img src="img/erase-red.svg" alt=""></a>
        </div>
        </div>
    </div>


<?php require_once("includes/footer.php") ?>
       