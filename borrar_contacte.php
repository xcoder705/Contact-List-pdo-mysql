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

    if (isset($_POST["eliminarContacte"])) {        
       
        $query = "DELETE FROM contactes WHERE id = :id";
        $stmt = $conn->prepare($query);       
        $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);

        $resultat = $stmt->execute();

        if ($resultat) {
           $missatge = "Contacte eliminat correctament.";
           header('Location: contactes.php?missatge=' . $missatge);
           exit();
        }else{
            $error = "Error, no s'ha pogut eliminar el contacte.";
            header('Location: borrar_contacte.php?error=' . $error); 
            exit();
        }
    }

?>


<div class="agenda-main-container d-flex">

    <a href="contactes.php"><img class="icon-back" src="img/go-previous.svg" alt=""></a>

<div class="container-lg container-table align-items-center"> 

<!---------------------------- ALERT ERROR ----------------------------------->
<div class="row">
    <div class="col-sm-12">
        <?php if(isset($_GET["error"])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo $_GET["error"]; ?></strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif; ?>
    </div>  
</div>
<!----------------------------------------------------------------------------->
 
<div class="row">
        <h3><img src="img/erase-red.svg" alt="" class="me-1 mb-3">Esborrar contacte</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control form-control-none" name="nom" value="<?php if($contacte) echo $contacte->nom; ?>" readonly>               
            </div>
            <div class="mb-3">
                <label for="cognoms" class="form-label">Cognoms:</label>
                <input type="text" class="form-control form-control-none" name="cognoms" value="<?php if($contacte) echo $contacte->cognoms; ?>" readonly>               
            </div>
            <div class="row">
            <div class="col-2 mb-3">
                <label for="prefix" class="form-label">Prefix:</label>
                <input type="text" class="form-control" name="prefix" value="<?php if($contacte) echo $contacte->prefix; ?>" readonly>               
            </div>
            <div class="col-10 mb-3">
                <label for="telefon" class="form-label">Mòbil:</label>
                <input type="text" class="form-control" name="telefon" value="<?php if($contacte) echo $contacte->telefon; ?>" readonly>               
            </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control form-control-none" name="email" value="<?php if($contacte) echo $contacte->email; ?>" readonly>               
            </div>

            <button type="submit" name="eliminarContacte" class="mt-3 btn btn-red w-100">Eliminar contacte</button>
        </form>
    </div>
</div>

</div>


<?php require_once("includes/footer.php") ?>
       