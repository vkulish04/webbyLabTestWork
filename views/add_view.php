<div class="row">
    <h1>
        Добавить фільм
    </h1>
</div>
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
                <input type="text" class="form-control" name="format">
            </div>
            <div class="form-group">
                <label>Список актеров </label>
                <textarea class="form-control" name="list_authors"  rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
</div>