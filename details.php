<?php
require_once "conn.php";

if (!isset($_GET['id_etudiant'])) {
    header("Location: accueil.php");
    exit;
}

$id = $_GET['id_etudiant'];
$sql = "SELECT * FROM etudiants WHERE id_etudiant = :id";
$stmt = $connection->prepare($sql);
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
  <title>Détails Étudiant</title>
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
    }

    .header-box{
      padding: 18px 22px;
      border-radius: var(--radius);
      background: linear-gradient(180deg, rgba(13,110,253,.08), rgba(13,110,253,0));
      border: 1px solid rgba(13,110,253,.12);
    }

    .section-title{
      font-weight: 800;
      letter-spacing: .2px;
    }

    .info-row{
      padding: 12px 0;
      border-bottom: 1px dashed #e5e7eb;
    }
    .info-row:last-child{
      border-bottom: 0;
    }

    .label{
      color: var(--muted);
      font-weight: 600;
    }

    .value{
      font-weight: 700;
      color: var(--text);
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
  </style>
</head>

<body>

<div class="container page-wrap">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <!-- HEADER -->
      <div class="header-box d-flex align-items-center justify-content-between mb-4 shadow-soft">
        <div>
          <h1 class="h3 mb-1 section-title">Détails de l’étudiant</h1>
          <div class="text-muted">Informations complètes</div>
        </div>
        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
          Fiche
        </span>
      </div>

      <!-- DETAILS CARD -->
      <div class="card shadow-soft">
        <div class="card-body p-4 p-md-5">

          <div class="info-row">
            <span class="label">ID :</span>
            <span class="value"><?= $etudiant['id_etudiant']; ?></span>
          </div>

          <div class="info-row">
            <span class="label">CIN :</span>
            <span class="value"><?= $etudiant['cin_etudiant']; ?></span>
          </div>

          <div class="info-row">
            <span class="label">Nom :</span>
            <span class="value"><?= $etudiant['nom_etudiant']; ?></span>
          </div>

          <div class="info-row">
            <span class="label">Prénom :</span>
            <span class="value"><?= $etudiant['prenom_etudiant']; ?></span>
          </div>

          <div class="info-row">
            <span class="label">Filière :</span>
            <span class="value"><?= $etudiant['filiere']; ?></span>
          </div>

          <div class="mt-4">
            <a href="accueil.php" class="btn btn-outline-secondary px-4">
              ← Retour
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
