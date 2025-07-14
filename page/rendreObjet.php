  <div class="dropdown m-2 ms-4">
      <button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
          Rendre Objet
      </button>
      <form class="dropdown-menu p-4 wide-dropdown bg-sombre-table" method="post" action="traitement_rendre.php">
          <label for="" class="col-12 mt-4">
          Etat de l'objet
          </label>
          <select required name="categorie" class="form-select form-select-sm" aria-label=".form-select-lg example">
                  <option value="0">OK</option>
                  <option value="1">ABIME</option>
          </select>
          <button type="submit" class="btn btn-primary mt-2">Soumettre</button>
      </form>
  </div>