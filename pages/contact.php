<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link href="../css/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php require_once("../includes/header.php") ?>
    <?php require_once("../includes/db.php") ?>

   <table class="mx-auto    border-gray-300 ">
   <caption class="caption-top">Liste des contacts</caption>  
   <thead>
        <tr class="bg-gray-100">
          <th class="px-4 py-2 border">Nom</th>
          <th class="px-4 py-2 border">Téléphone</th>
          <th class="px-4 py-2 border">Email</th>
          <th class="px-4 py-2 border">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php afficherContact($connectDB); ?>
      </tbody>
   </table>
</body>
<?php require_once("../includes/footer.php") ?>
</html>