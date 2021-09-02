<div class="row">
    <h1>
        Films
    </h1>
</div>
<div class="row">
    <div class="col-6">
        <ul class="list-group">
            <?php foreach ($data as $el) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $el->name ?>
                    <a href="/main/film_deleted?id=<?= $el->id_film ?>" class="btn btn-danger">x</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-6">
        <form action="/main/search/" method="post">
            <div class="form-group col-md-6">
                <label for="inputState">Тып поиска</label>
                <select id="inputState" class="form-control">
                    <option>По названию</option>
                    <option>По имени актера</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Названия фильма</label>
                <input type="text" class="form-control" name="name">
            </div>
            <button type="submit" class="btn btn-success">Поиск</button>
        </form>
    </div>
</div>