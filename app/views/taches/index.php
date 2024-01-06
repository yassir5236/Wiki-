<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/projets" class="bg-red-500 text-white py-2 px-4 mt-10 inline-flex items-center"><i class="fa fa-backward mr-2"></i> Retour</a>
<?php flash('tache_message'); ?>

<div class="container mt-5">
    <div class=" row m-1 p-4  ">
   
        <div class="col">
            <!-- Search Form -->
            <form action="<?php echo URLROOT; ?>/taches/search" method="post" class="flex items-center">
                <div class="mr-2">
                    <input type="text" name="search_query" class="border border-gray-300 rounded py-2 px-4" placeholder="Search tasks">
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Search</button>
            </form>
        </div>

    </div>

    <div class="row m-1 p-4">
        <div class="col">
            <div class="p-1 text-primary text-center mx-auto inline-block flex  justify-center">
                <i class=" bg-primary text-white  p-2"></i>
                <u class="font-bold text-4xl    ">My Todo list</u>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach (['To Do', 'Doing', 'Done'] as $status): ?>
            <div class="col">
                <h4 class="text-center"><?php echo $status; ?></h4>
                <ul class="list-group <?php echo strtolower(str_replace(' ', '-', $status)); ?>-list">
                    <?php foreach ($data['taches'] as $tache): ?>
                        <?php if ($tache->statut == strtolower(str_replace(' ', '_', $status))): ?>
                            <li class="list-group-item todo-item">
                                <div class="flex justify-between items-center todo-item-content rounded py-2 px-4">
                                    <div class="flex-1">
                                        <span class="font-bold block">
                                            <?php echo isset($tache->Nome_Tache) ? $tache->Nome_Tache : 'Nom de la tâche non défini'; ?>
                                        </span>
                                        <span class="text-muted block">Deadline:
                                            <?php echo isset($tache->Date_fin) ? $tache->Date_fin : 'Pas de date limite'; ?>
                                        </span>
                                    </div>
                                    <div class="flex items-center todo-actions">
                                        <form action="<?php echo URLROOT; ?>/taches/edit/<?php echo $tache->id_tache; ?>" method="post" class="delete-form mr-2">
                                            <button type="submit" class="fa fa-pencil text-blue-500"></button>
                                        </form>

                                        <form class="delete-form" action="<?php echo URLROOT; ?>/taches/delete/<?php echo $tache->id_tache; ?>" method="post">
                                            <button type="submit" class="fa fa-trash text-red-500"></button>
                                        </form>
                                    </div>
                                </div>
                                <form action="<?php echo URLROOT; ?>/taches/changeStatus/<?php echo $tache->id_tache; ?>" method="post" class="mt-2">
                                    <div class="form-group">
                                        <input type="hidden" name="tache_id" value="<?php echo $tache->id_tache; ?>">
                                        <select name="new_status" class="border border-gray-300 rounded py-2 px-4">
                                            <option   value="to_do" <?php echo ($tache->statut == 'to_do') ? 'selected' : ''; ?>>To Do</option>
                                            <option value="doing" <?php echo ($tache->statut == 'doing') ? 'selected' : ''; ?>>Doing</option>
                                            <option value="done" <?php echo ($tache->statut == 'done') ? 'selected' : ''; ?>>Done</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Changer le statut</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row m-1 p-3">
        <div class="col col-11 mx-auto">
            <form action="<?php echo URLROOT; ?>/taches/add" method="post">
                <input type="submit" value="Ajouter la Tâche" class="bg-green-500 text-white py-2 px-4 mt-3 rounded">
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
