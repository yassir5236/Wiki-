<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/projets" class="bg-red-500 hover:bg-blue-700 text-white  font-bold py-2 px-4 rounded"><i class="fa fa-backward mt-10 "></i> Back</a>
<div class="card bg-gray-100 mt-5 p-5">

    <h2 class="text-3xl font-bold mb-4">ADD PROJECT</h2>

    <form action="<?php echo URLROOT; ?>/projets/add" method="post">
        <div class="mb-4">
            <label for="nom_projet" class="block text-gray-700 text-sm font-bold mb-2">Project Name: <sup>*</sup></label>
            <input type="text" name="nom_projet" class="w-full p-2 border rounded <?php echo (!empty($data['title_err'])) ? 'border-red-500' : 'border-gray-300'; ?>" value="<?php echo $data['nom_projet']; ?>">
            <?php if (!empty($data['title_err'])) : ?>
                <p class="text-red-500 text-xs italic"><?php echo $data['title_err']; ?></p>
            <?php endif; ?>
        </div>

        <input type="submit" value="Create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
