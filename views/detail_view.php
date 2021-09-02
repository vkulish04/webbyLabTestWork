<div class="row">
    <h1>
        Films
    </h1>
</div>

<div class="row">
    <div class="col-4">
        <table class="table table-striped">
            <tbody>
            <tr>
                <th scope="row">Название</th>
                <td><?= $data->name?></td>

            </tr>
            <tr>
                <th scope="row">Год выпуска</th>
                <td><?= $data->graduation_year?></td>
            </tr>
            <tr>
                <th scope="row">Формат</th>
                <td><?= $data->format?></td>
            </tr>
            <tr>
                <th scope="row">Список актеров</th>
                <td><?= $data->list_authors?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>