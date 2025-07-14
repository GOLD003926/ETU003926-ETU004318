<?php
require("connection.php");
date_default_timezone_set('Africa/Nairobi');

function getAllDepartements()
{
    $conn = dbconnect();

    $sql = "SELECT dept_no, dept_name FROM departments";
    $result = mysqli_query($conn, $sql);

    $departements = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departements[] = $row; // ajoute chaque département au tableau
        }
    } else {
        // En cas d'erreur SQL, tu peux gérer comme tu veux
        die("Erreur SQL : " . mysqli_error($conn));
    }

    return $departements;
}
function getDepartement($no)
{
    $conn = dbconnect();

    $sql = "SELECT dept_no, dept_name FROM departments WHERE dept_no='$no' ";
    $result = mysqli_query($conn, $sql);

    $departements = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $departements[] = $row; // ajoute département au tableau
        }
    } else {
        // En cas d'erreur SQL, tu peux gérer comme tu veux
        die("Erreur SQL : " . mysqli_error($conn));
    }

    return $departements;
}
function getDepartmentsWithManagers()
{
    $conn = dbconnect();
    $sql = "
        SELECT d.dept_no, d.dept_name,
               e.emp_no, e.first_name, e.last_name, e.gender,
               dm.from_date, dm.to_date, e.hire_date
        FROM departments d
        JOIN dept_manager dm ON d.dept_no = dm.dept_no
        JOIN employees e ON dm.emp_no = e.emp_no
        WHERE dm.to_date > CURRENT_DATE
    ";

    $result = mysqli_query($conn, $sql);
    $departments = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $row['manager_name'] = $row['first_name'] . ' ' . $row['last_name'];
        $departments[] = $row;
    }

    return $departments;
}
function getNombreEmployesActifsParDepartement($dept_no, $sexe)
{
    $conn = dbconnect();
    $dept_no = mysqli_real_escape_string($conn, $dept_no); // sécurité
    $sql = "
        SELECT COUNT(*) AS total
        FROM dept_emp de
        JOIN employees e ON de.emp_no = e.emp_no
        WHERE de.dept_no = '$dept_no'
          AND de.to_date > CURRENT_DATE
    ";
    if ($sexe != "all") {
        $sql = "
            SELECT COUNT(*) AS total
            FROM dept_emp de
            JOIN employees e ON de.emp_no = e.emp_no
            WHERE de.dept_no = '$dept_no'
              AND de.to_date > CURRENT_DATE
              AND e.gender = '$sexe'
        ";
    }

    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    return (int)$data['total'];
}
function getEmployesActifsParDepartement($dept_no)
{
    $conn = dbconnect();
    $dept_no = mysqli_real_escape_string($conn, $dept_no);
    $sql = "
        SELECT *
        FROM dept_emp de
        JOIN employees e ON de.emp_no = e.emp_no
        WHERE de.dept_no = '$dept_no'
          AND de.to_date > CURRENT_DATE
    ";
    $result = mysqli_query($conn, $sql);
    $data = [];
    if ($result) {
        while ($ligne = mysqli_fetch_assoc($result)) {
            $data[] = $ligne;
        }
    }
    return $data;
}

function getEmployeeDetails($emp_no)
{
    $conn = dbconnect();

    $emp_no = intval($emp_no);

    $sql = "
        SELECT 
            e.last_name, 
            e.first_name, 
            e.gender, 
            e.birth_date,
            t.title
        FROM employees  e
        LEFT JOIN titles t ON e.emp_no = t.emp_no
        WHERE e.emp_no = $emp_no
        ORDER BY t.to_date DESC
        LIMIT 1
    ";

    $resultat = mysqli_query($conn, $sql);

    if (!$resultat) {
        die("Erreur SQL : " . mysqli_error($conn));
    }

    return mysqli_fetch_assoc($resultat);
}
function getEmployeeSalaryHistory($emp_no)
{
    $conn = dbconnect();

    // Sécurisation minimale : s'assurer que c’est un entier
    $emp_no = intval($emp_no);

    $sql = "
        SELECT salary, from_date, to_date
        FROM salaries
        WHERE emp_no = $emp_no
        ORDER BY from_date DESC
    ";

    $resultat = mysqli_query($conn, $sql);

    $salaires = [];

    if ($resultat) {
        while ($ligne = mysqli_fetch_assoc($resultat)) {
            $salaires[] = $ligne;
        }
    }

    return $salaires;
}

function getInitiales($prenom, $nom)
{
    return strtoupper($prenom[0] . $nom[0]);
}
function rechercherEmployes($dept_no, $nom, $age_min, $age_max, $page = 1)
{
    $conn = dbconnect();

    // Sécurisation
    $dept_no = mysqli_real_escape_string($conn, $dept_no);
    $nom = mysqli_real_escape_string($conn, $nom);
    $age_min = intval($age_min);
    $age_max = intval($age_max);
    $page = max(1, intval($page)); // page minimum = 1

    // Calcul pagination
    $limite_par_page = 20;
    $offset = ($page - 1) * $limite_par_page;

    // Calcul des dates de naissance
    $today = date('Y-m-d');
    $date_max_naissance = date('Y-m-d', strtotime("-$age_min years", strtotime($today)));
    $date_min_naissance = date('Y-m-d', strtotime("-$age_max years", strtotime($today)));

    // Requête avec LIMIT
    $sql = "
        SELECT e.emp_no, e.first_name, e.last_name
        FROM dept_emp de
        JOIN employees e ON de.emp_no = e.emp_no
        WHERE de.dept_no = '$dept_no'
          AND de.to_date > CURRENT_DATE
          AND (e.first_name LIKE '%$nom%' OR e.last_name LIKE '%$nom%')
          AND e.birth_date BETWEEN '$date_min_naissance' AND '$date_max_naissance'
        LIMIT $limite_par_page OFFSET $offset
    ";

    $resultat = mysqli_query($conn, $sql);
    $employes = [];

    if ($resultat) {
        while ($ligne = mysqli_fetch_assoc($resultat)) {
            $employes[] = $ligne;
        }
    } else {
        die("Erreur SQL : " . mysqli_error($conn));
    }

    return $employes;
}
function getDetailsNombreEmployeesDepartment($dept_no)
{
    $conn = dbconnect();

    $dept_no = mysqli_real_escape_string($conn, $dept_no);

    $sql = "
       SELECT 
    SUM(CASE WHEN e.gender = 'M' THEN 1 ELSE 0 END) AS nb_emp_Masc,
    SUM(CASE WHEN e.gender = 'F' THEN 1 ELSE 0 END) AS nb_emp_Femin,
    dep.dept_no,
    t.title AS titre,
    dep.dept_name
FROM departments dep 
JOIN dept_emp dep_e ON dep.dept_no = dep_e.dept_no
JOIN employees e ON dep_e.emp_no = e.emp_no 
JOIN titles t ON t.emp_no = e.emp_no 
WHERE dep.dept_no = '$dept_no'
AND t.to_date='9999-01-01'
GROUP BY t.title, dep.dept_name;
    ";

    $resultat = mysqli_query($conn, $sql);
    $val = [];

    if ($resultat) {
        while ($ligne = mysqli_fetch_assoc($resultat)) {
            $val[] = $ligne;
        }
    } else {
        die("Erreur SQL : " . mysqli_error($conn));
    }

    return $val;
}
