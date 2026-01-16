<?php 
require_once "conn.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


if (!isset($_GET["id_etudiant"])) {
    header("Location: accueil.php");
    exit;
}

$id = $_GET["id_etudiant"];

if (isset($_POST["modifier"])) {
    $cin     = $_POST["cin_etudiant"];
    $nom     = $_POST["nom_etudiant"];
    $prenom  = $_POST["prenom_etudiant"];
    $filiere = $_POST["filiere"];

    $sql = "UPDATE etudiants SET
            cin_etudiant = :cin,
            nom_etudiant = :nom,
            prenom_etudiant = :prenom,
            filiere = :filiere
            WHERE id_etudiant = :id";

    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ":cin" => $cin,
        ":nom" => $nom,
        ":prenom" => $prenom,
        ":filiere" => $filiere,
        ":id" => $id
    ]);

    header("Location: accueil.php?modif=1");
    exit;
}

// SELECT
$stmt = $connection->prepare("SELECT * FROM etudiants WHERE id_etudiant = :id");
$stmt->execute([":id" => $id]);
$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$etudiant) {
    die("Étudiant introuvable");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier Étudiant</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      --bg1:#f6f7fb;
      --bg2:#eef2ff;
      --card:#ffffff;
      --text:#0f172a;
      --muted:#64748b;
      --ring: rgba(13,110,253,.15);
      --shadow: 0 12px 35px rgba(15, 23, 42, .08);
      --radius: 18px;
    }

    body{
      background: radial-gradient(1200px 500px at 10% 0%, var(--bg2), transparent 60%),
                  radial-gradient(900px 400px at 95% 10%, #e0f2fe, transparent 55%),
                  var(--bg1);
      color: var(--text);
    }

    .page-wrap{
      padding: 28px 0 40px;
    }

    .shadow-soft{
      box-shadow: var(--shadow);
    }

    .card{
      border: 0;
      border-radius: var(--radius);
      background: var(--card);
      overflow: hidden;
    }

    .form-label{
      font-weight: 700;
      color: #334155;
    }

    .form-control, .form-select{
      border-radius: 14px;
      border: 1px solid #e5e7eb;
      padding: .65rem .85rem;
    }
    .form-control:focus, .form-select:focus{
      border-color: #86b7fe;
      box-shadow: 0 0 0 .25rem var(--ring);
    }

    .header-box{
      padding: 18px 22px;
      border-radius: var(--radius);
      background: linear-gradient(180deg, rgba(13,110,253,.08), rgba(13,110,253,0));
      border: 1px solid rgba(13,110,253,.12);
    }

    .badge-soft{
      background: rgba(13,110,253,.10);
      color: #0d6efd;
      border: 1px solid rgba(13,110,253,.18);
      font-weight: 700;
      letter-spacing: .2px;
    }

    .btn{
      border-radius: 12px;
      font-weight: 600;
    }

    .btn-outline-secondary{
      border-color: #e5e7eb;
      color: #334155;
    }
    .btn-outline-secondary:hover{
      background:#f1f5f9;
      border-color:#e2e8f0;
      color:#0f172a;
    }

    .section-title{
      font-weight: 800;
      letter-spacing: .2px;
    }

    .hint{
      color: var(--muted);
    }
  </style>
</head>

<body>

<div class="container page-wrap">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <!-- HEADER -->
      <div class="header-box d-flex align-items-center justify-content-between mb-4 shadow-soft">
        <div>
          <h1 class="h3 mb-1 section-title">Modifier un étudiant</h1>
          <div class="text-muted">Mettre à jour les informations</div>
        </div>
        <span class="badge badge-soft rounded-pill px-3 py-2">Modification</span>
      </div>

      <!-- FORM CARD -->
      <div class="card shadow-soft">
        <div class="card-body p-4 p-md-5">

          <form method="POST">
            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label">CIN</label>
                <input type="text" name="cin_etudiant" class="form-control"
                       value="<?= $etudiant["cin_etudiant"] ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Filière</label>
                <select name="filiere" class="form-select" required>
                  <option value="Développement Digital" <?= ($etudiant["filiere"]=="Développement Digital")?"selected":"" ?>>
                    Développement Digital
                  </option>
                  <option value="Digital Design" <?= ($etudiant["filiere"]=="Digital Design")?"selected":"" ?>>
                    Digital Design
                  </option>
                  <option value="Réseaux & Sécurité" <?= ($etudiant["filiere"]=="Réseaux & Sécurité")?"selected":"" ?>>
                    Réseaux & Sécurité
                  </option>
                  <option value="Management Hôtelier" <?= ($etudiant["filiere"]=="Management Hôtelier")?"selected":"" ?>>
                    Management Hôtelier
                  </option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Nom</label>
                <input type="text" name="nom_etudiant" class="form-control"
                       value="<?= $etudiant["nom_etudiant"] ?>" required>
              </div>

              <div class="col-md-6">
                <label class="form-label">Prénom</label>
                <input type="text" name="prenom_etudiant" class="form-control"
                       value="<?= $etudiant["prenom_etudiant"] ?>" required>
              </div>

            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
              <button type="submit" name="modifier" class="btn btn-primary px-4">
                Enregistrer
              </button>
              <a href="accueil.php" class="btn btn-outline-secondary px-4">
                Annuler
              </a>
            </div>

            <div class="small mt-3 hint">
              Astuce : cliquez sur "Enregistrer" pour appliquer la modification.
            </div>

          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
