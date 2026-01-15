<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestion Étudiants</title>

  <!-- Bootstrap CSS -->
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

    .card-body{
      border-radius: var(--radius);
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

    .table{
      margin-bottom: 0;
    }
    .table thead th{
      white-space: nowrap;
      font-size: .9rem;
      color:#334155;
      background: #f8fafc !important;
      border-bottom: 1px solid #e5e7eb !important;
    }
    .table tbody td{
      vertical-align: middle;
      border-color: #edf2f7;
      color: #0f172a;
    }
    .table-hover tbody tr:hover{
      background: #f8fafc;
    }

    .input-group .input-group-text{
      border-radius: 12px 0 0 12px;
      border: 1px solid #e5e7eb;
      background: #fff;
    }
    .input-group .form-control{
      border-radius: 0 12px 12px 0;
      border-left: 0;
    }

    .section-title{
      font-weight: 800;
      letter-spacing: .2px;
    }

    .hint{
      color: var(--muted);
    }

    .actions .btn{
      padding: .35rem .6rem;
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="container page-wrap">

    <div class="row justify-content-center">
      <div class="col-lg-10">

        <!-- HEADER -->
        <div class="header-box d-flex align-items-center justify-content-between mb-4 shadow-soft">
          <div>
            <h1 class="h3 mb-1 section-title">Gestion des Étudiants</h1>
            <div class="text-muted">Ajouter un étudiant puis afficher la liste</div>
          </div>
          <span class="badge badge-soft rounded-pill px-3 py-2">Formulaire + Tableau</span>
        </div>

        <!-- FORM CARD -->
        <div class="card shadow-soft mb-4">
          <div class="card-body p-4 p-md-5">
            <h2 class="h5 mb-3 section-title">Ajouter un étudiant</h2>

            <form action="insert.php" method="POST" class="needs-validation" novalidate>
              <div class="row g-3">
                <div class="col-md-4">
                  <label class="form-label" for="cin_etudiant">CIN</label>
                  <input
                    type="text"
                    class="form-control"
                    id="cin_etudiant"
                    name="cin_etudiant"
                    maxlength="10"
                    placeholder="Ex: AB123456"
                    required
                  />
                  <div class="invalid-feedback">Veuillez saisir le CIN.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label" for="nom_etudiant">Nom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nom_etudiant"
                    name="nom_etudiant"
                    placeholder="Nom"
                    required
                  />
                  <div class="invalid-feedback">Veuillez saisir le nom.</div>
                </div>

                <div class="col-md-4">
                  <label class="form-label" for="prenom_etudiant">Prénom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="prenom_etudiant"
                    name="prenom_etudiant"
                    placeholder="Prénom"
                    required
                  />
                  <div class="invalid-feedback">Veuillez saisir le prénom.</div>
                </div>

                <div class="col-md-12">
                  <label class="form-label" for="filiere">Filière</label>
                  <select class="form-select" id="filiere" name="filiere" required>
                    <option value="" selected disabled>Choisir une filière...</option>
                    <option value="Développement Digital">Développement Digital</option>
                    <option value="Digital Design">Digital Design</option>
                    <option value="Réseaux & Sécurité">Réseaux & Sécurité</option>
                    <option value="Management Hôtelier">Management Hôtelier</option>
                  </select>
                  <div class="invalid-feedback">Veuillez sélectionner une filière.</div>
                </div>
              </div>

              <div class="d-flex flex-wrap gap-2 mt-4 align-items-center">
                <button type="submit" class="btn btn-primary px-4">
                  Enregistrer
                </button>
                <button type="reset" class="btn btn-outline-secondary px-4">
                  Vider
                </button>

                <?php 
                  if(isset($_GET["success"])){                            
                      echo "<p style='color:green; margin:0; padding-top:8px;'>Insertion réussie</p>";
                  }
                  if(isset($_GET["del"])){                            
                      echo "<p style='color:green; margin:0; padding-top:8px;'>Suppression réussie</p>";
                  }
                  if(isset($_GET["modif"])){                            
                      echo "<p style='color:green; margin:0; padding-top:8px;'>Modification réussie</p>";
                  }
                  if(isset($_GET["error"])){                            
                      echo "<p style='color:red; margin:0; padding-top:8px;'>Tous les champs sont obligatoires</p>";
                  }
                ?>
              </div>
            </form>
          </div>
        </div>

        <!-- TABLE CARD -->
        <div class="card shadow-soft">
          <div class="card-body p-4 p-md-5">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
              <h2 class="h5 mb-0 section-title">Liste des étudiants</h2>

              <div class="input-group" style="max-width: 320px;">
                <span class="input-group-text">🔎</span>
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-middle mb-0" id="studentsTable">
                <thead class="table-light">
                  <tr>
                    <th>CIN</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th class="text-end">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  require_once "conn.php";

                  $stm = $connection->prepare("SELECT * FROM etudiants ORDER BY id_etudiant DESC");
                  $stm->setFetchMode(PDO::FETCH_ASSOC);
                  $stm->execute();

                  while($ligne = $stm->fetch()){
                    echo '
                    <tr>
                      <td>' . $ligne["cin_etudiant"] . '</td>
                      <td>' . $ligne["nom_etudiant"] . '</td>
                      <td>' . $ligne["prenom_etudiant"] . '</td>
                      <td><span class="badge text-bg-primary">' . $ligne["filiere"] . '</span></td>
                      <td class="text-end actions">

                        <a href="details.php?id_etudiant=' . $ligne["id_etudiant"] . '" class="btn btn-sm btn-outline-primary">
                          Détails
                        </a>

                        <a href="modifier.php?id_etudiant=' . $ligne["id_etudiant"] . '" class="btn btn-sm btn-outline-secondary">
                          Modifier
                        </a>

                        <a href="delete.php?id_etudiant=' . $ligne["id_etudiant"] . '" class="btn btn-sm btn-outline-danger"
                           onclick="return confirm(\'Supprimer cet étudiant ?\')">
                          Supprimer
                        </a>

                      </td>
                    </tr>';
                  }
                  ?>
                </tbody>
              </table>
            </div>

            <div class="small mt-3 hint">
              Astuce : vous pouvez chercher avec la barre 🔎.
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    (() => {
      const forms = document.querySelectorAll('.needs-validation');
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    })();

    const searchInput = document.getElementById('searchInput');
    const table = document.getElementById('studentsTable');
    searchInput?.addEventListener('input', () => {
      const q = searchInput.value.toLowerCase().trim();
      const rows = table.querySelectorAll('tbody tr');
      rows.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  </script>
</body>
</html>
