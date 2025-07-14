  <div class="dropdown m-2 ms-4">
      <button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
          Recherche
      </button>
      <form class="dropdown-menu p-4 wide-dropdown bg-sombre-table" method="post" action="index.php">
          <select required name="categorie" class="form-select form-select-sm" aria-label=".form-select-lg example">
              <?php
                $choix = getAllCategories();
                foreach ($choix as $c) {
                ?>
                  <option value="<?= $c['id_categorie'] ?>"><?= $c['nom_categorie'] ?></option>
              <?php
                }
                ?>
          </select>
          <input required class="form-control mt-1 form-control-sm" type="text" name="nom" placeholder="nom objet" aria-label="nom objet example">
          <label for="" class="col-12 mt-4">
          <input type="checkbox" name="disponible" id=""><span class="badge bg-secondary ms-2">Disponible</span>
          </label>
          <button type="submit" class="btn btn-primary mt-2">GO</button>
      </form>
  </div>