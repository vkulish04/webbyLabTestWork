<div class="row">
    <h1>
        Добавить фільм
    </h1>
</div>
<?php if ($data['check'] == false){ ?>
<div class="row">
   <span style="color: red"> <?= $data['text']?></span>
</div>
<?php } else{?>
    <div class="row">
        <?= $data['text']?>
    </div>
<?php }?>
<div class="row">
    <div class="col-4">
        <form action="/main/add_film/" method="post">
            <div class="form-group">
                <label>Названия фильма</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label>Год выпуска</label>
                <input type="text" class="form-control" name="graduation_year">
            </div>
            <div class="form-group">
                <label>Формат</label>
                <select class="form-control" name="format">
                    <option value="VHS">VHS</option>
                    <option value="DVD">DVD</option>
                    <option value="Blu-Ray">Blu-Ray</option>
                </select>
            </div>
            <div class="form-group">
                <label>Список актеров </label>
                <textarea class="form-control" name="list_authors"  rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
</div>