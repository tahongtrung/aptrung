<div class="sidebar">
    <h3 class="title-search"><i class="fa fa-folder-open-o"></i>Tìm kiếm</h3>
    <div class="search-content">
        <form action="<?=base_url('tim-kiem')?>" method="get">
            <input type="search" value="" name="key" class="form-control input-sm">
            <select onchange="show_cat_by_brand($(this))" name="brand" id="brand" class="form-control input-sm">
                <option value="">--Thương hiệu--</option>
                <?php foreach($users as $user){
                    echo '<option value="'.$user->alias.'">'.$user->fullname.'</option>';
                }?>
            </select>
            <select name="cat" id="cat" class="form-control input-sm">
                <option value="">--Loại đồ uống--</option>
            </select>

            <button type="submit" class="btn btn-default btn-sm">Tìm kiếm</button>
        </form>
    </div>
</div>
