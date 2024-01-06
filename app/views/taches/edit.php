<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/taches" class="bg-red-500 mt-10 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-10 ">
    <i class=" mt-10 "></i> Retour
</a>

<div class="bg-gray-200 mt-5 p-4">
    <h2 class="text-2xl font-bold">EDIT TASK</h2>
    <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $data['id']; ?>" method="post">
        <!-- Task Name -->
        <div class="mb-4">
            <label for="Nom_Tache" class="block text-gray-700 text-sm font-bold mb-2">Task Name: <sup>*</sup></label>
            <input type="text" name="Nom_Tache" class="w-full p-2 border rounded <?php echo (!empty($data['Nom_Tache_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['Nom_Tache']; ?>">
            <span class="text-red-500"><?php echo $data['Nom_Tache_err']; ?></span>
        </div>
        <!-- Start Date -->
        <div class="mb-4">
            <label for="Date_debut" class="block text-gray-700 text-sm font-bold mb-2">Start Date: <sup>*</sup></label>
            <input type="date" name="Date_debut" class="w-full p-2 border rounded <?php echo (!empty($data['date_debut_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['date_debut']; ?>">
            <span class="text-red-500"><?php echo $data['date_debut_err']; ?></span>
        </div>
        <!-- End Date -->
        <div class="mb-4">
            <label for="Date_fin" class="block text-gray-700 text-sm font-bold mb-2">End Date: <sup>*</sup></label>
            <input type="date" name="Date_fin" class="w-full p-2 border rounded <?php echo (!empty($data['date_fin_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['date_fin']; ?>">
            <span class="text-red-500"><?php echo $data['date_fin_err']; ?></span>
        </div>
        <!-- Submit Button -->
        <input type="submit" value="Update Task" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
