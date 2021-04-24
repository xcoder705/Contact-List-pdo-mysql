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

    if (isset($_POST["editarContacte"])) {
        
        $nom = $_POST["nom"];
        $cognoms = $_POST["cognoms"];
        $prefix = $_POST["prefix"];
        $telefon = $_POST["telefon"];
        $email = $_POST["email"];

        if (empty($nom) || empty($cognoms) || empty($prefix) || empty($telefon) || empty($email)) {
            $error = "S'han d'omplir tots els camps.";
            header('Location: editar_contacte.php?error=' . $error);
        }else{           
            $query = "UPDATE contactes set nom = :nom, cognoms = :cognoms, prefix = :prefix, telefon = :telefon, email = :email  WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
            $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
            $stmt->bindParam(":prefix", $prefix, PDO::PARAM_STR);
            $stmt->bindParam(":telefon", $telefon, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":id", $idContacte, PDO::PARAM_INT);

            $resultat = $stmt->execute();
            
            if ($resultat) {
               $missatge = "Contacte editat correctament.";
               header('Location: contactes.php?missatge=' . $missatge);
               exit();
            }else{
                $error = "Error a l'editar el registre. Hi han camps per omplir o l'email ja existeix a l'agenda.";
                header('Location: editar_contacte.php?error=' . $error); 
                exit();
            }
        }
    }
?>

<div class="d-flex">

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
    <div class="col-sm-12">
        <h3 class="font-weight-bold"><img src="img/gtk-edit.svg" alt="" class="me-1 mb-3">Editar contacte</h3>
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control" name="nom" value="<?php if($contacte) echo $contacte->nom; ?>" required>               
            </div>
            <div class="mb-3">
                <label for="cognomss" class="form-label">Cognoms:</label>
                <input type="text" class="form-control" name="cognoms" value="<?php if($contacte) echo $contacte->cognoms; ?>" required>               
            </div>
            <div class="row">
            <div class="col-2 mb-3">
                <label for="prefix" class="form-label">Prefix:</label>
                <input type="text" class="form-control" name="prefix" value="<?php if($contacte) echo $contacte->prefix; ?>" required>               
            </div>
            <div class="col-10 mb-3">
                <label for="telefon" class="form-label">Mòbil:</label>
                <input type="text" class="form-control" name="telefon" value="<?php if($contacte) echo $contacte->telefon; ?>"  required>               
            </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" value="<?php if($contacte) echo $contacte->email; ?>" required>               
            </div>

            <button type="submit" name="editarContacte" class="mt-3 btn w-100 btn-yellow">Editar Contacte</button>
        </form>
        </div>
    </div>
</div>  

</div>


<?php require_once("includes/footer.php") ?>