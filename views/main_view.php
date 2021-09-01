<div class="row">
    <h1>
        Films
    </h1>
</div>
<div class="row">
    <div class="col-6">
        <ul class="list-group">
            <?php foreach ($data as $el){?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $el->name?>
                <a href="/main/film_deleted?id=<?= $el->id_film?>" class="btn btn-danger">x</a>
            </li>
            <?php }?>
        </ul>
    </div>
</div>