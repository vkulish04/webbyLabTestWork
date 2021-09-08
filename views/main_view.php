<?php
//echo "<pre>";
//print_r($data);
//echo "<pre>";
//die();
//?>
<div class="row">
    <h1>
        Films
    </h1>
</div>
<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    <?php foreach ($data['film'] as $el) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="/main/detail?id=<?= $el->id_film ?>"><?= $el->name ?></a>
                            <a href="/main/film_deleted?id=<?= $el->id_film ?>" class="btn btn-danger btn-del" data-toggle="modal" data-target="#confirm-delete"  onclick="return confirm('Вы  уверены?')">x</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php if(!$data['pagination_disable']){ ?>
            <div class="row col-12 ">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php if($data['active_page'] > 1){?>
                        <li class="page-item">
                            <a class="page-link" href="/main/index?page_id=<?= $data['active_page'] - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php }?>

                        <?php for ($i = 1; $i <= $data['count_page']; $i++) { ?>
                                <?php if($i == $data['active_page']){?>
                                <li class="page-item active"><a class="page-link" href="/main/index?page_id=<?= $i?>"><?= $i?></a></li>
                                        <?php }
                                        else{?>
                            <li class="page-item"><a class="page-link" href="/main/index?page_id=<?= $i?>"><?= $i?></a></li>
                    <?php }?>
                        <?php } ?>
                        <?php if($data['active_page'] <= $data['count_page'] - 1){?>
                        <li class="page-item">
                            <a class="page-link" href="/main/index?page_id=<?= $data['active_page'] + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php }?>
                    </ul>
                </nav>

            </div>
            <?php }?>
        </div>
    </div>

    <div class="col-6">
        <form action="/main/index" method="get">
            <div class="form-group col-md-6">
                <label for="inputState">Тып поиска</label>
                <select id="inputState" class="form-control" name="search_id">
                    <?php foreach ($data['selected'] as $key => $value) { ?>
                        <option <?= $value['atr'] ?> value="<?= $key ?>"><?= $value['value'] ?></option>
                    <?php } ?>
                    <!--                    <option value="name">По названию</option>-->
                    <!--                    <option selected value="list_authors">По имени актера</option>-->
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="exampleFormControlInput1">Названия фильма</label>
                <input type="text" class="form-control" name="search_data" value="<?= $data['search_data'] ?>">
            </div>
            <button type="submit" class="btn btn-success">Поиск</button>
        </form>
    </div>
</div>