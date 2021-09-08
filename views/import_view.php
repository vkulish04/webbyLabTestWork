<div class="row">
    <h1>
       Import films
    </h1>
</div>
<div class="row">
    <div class="col-4">
        <form action="/main/import/" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">Названия фильма</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file_import">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
    <div class="col-4">
        <span>Добавлено нових записей: <?= $data['executed']?></span><br>
        <span>Недобавлено записей: <?= $data['notexecude']?></span><br>

    </div>
</div>
