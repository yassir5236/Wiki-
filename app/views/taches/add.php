<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/taches" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
    <i class="fa fa-backward"></i> Back
</a>
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 mt-5">

    <h2 class="text-2xl mb-4">ADD TASK</h2>

    <form action="<?php echo URLROOT; ?>/taches/add" method="post">
        <div class="mb-4">
            <label for="Nom_Tache" class="block text-gray-700 text-sm font-bold mb-2">Task Name: <sup>*</sup></label>
            <input type="text" name="Nom_Tache" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['Nom_Tache_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['Nom_Tache']; ?>">
            <p class="text-red-500 text-xs italic"><?php echo $data['Nom_Tache_err']; ?></p>
        </div>

        <div class="mb-4">
            <label for="Date_debut" class="block text-gray-700 text-sm font-bold mb-2">Start Date: <sup>*</sup></label>
            <input type="date" name="Date_debut" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['date_debut_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['date_debut']; ?>">
            <p class="text-red-500 text-xs italic"><?php echo $data['date_debut_err']; ?></p>
        </div>

        <div class="mb-4">
            <label for="Date_fin" class="block text-gray-700 text-sm font-bold mb-2">End Date: <sup>*</sup></label>
            <input type="date" name="Date_fin" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['date_fin_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['date_fin']; ?>">
            <p class="text-red-500 text-xs italic"><?php echo $data['date_fin_err']; ?></p>
        </div>

        <div class="mb-4">
            <label for="Project_ID" class="block text-gray-700 text-sm font-bold mb-2">Project: <sup>*</sup></label>
            <select name="Project_ID" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline <?php echo (!empty($data['project_err'])) ? 'border-red-500' : ''; ?>">
                <option value="" selected disabled>Select Project</option>
                <?php foreach ($data['projets'] as $projet) : ?>
                    <option value="<?php echo $projet->id_Project; ?>"><?php echo $projet->nom_projet; ?></option>
                <?php endforeach; ?>
            </select>
            <p class="text-red-500 text-xs italic"><?php echo $data['project_err']; ?></p>
        </div>

        <input type="submit" value="Create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
