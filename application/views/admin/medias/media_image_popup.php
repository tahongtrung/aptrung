<form action="<?= base_url('adminvn/media/images/' . $id) ?>" method="post"
      class="validate"
      accept-charset="utf-8" enctype="multipart/form-data">
    <div class="col-xs-12" style="margin-bottom: 10px">
        <input name="title" id="userfile" type="text" placeholder="Tiêu đề"
               value="<?=@$item->title;?>"  class="  form-control input-sm"/>
        <input name="edit"  type="hidden" value="<?=@$id;?>"/>
    </div>
    <div class="col-md-12" style="margin-bottom: 10px">
        <input name="userfile[]" id="userfile" type="file" class="validate[required]  "/>
        <div class="image">
            <!--<img src="<?/*=base_url(@$item->link)*/?>">-->
        </div>
    </div>
    <div class="col-md-12" style="margin-bottom: 10px">
        <!--<textarea id="ckeditor" name="content"><?/*=@$item->content*/?></textarea>
        --><?php /*echo display_ckeditor($ckeditor); */?>
       <!-- <input name="content" id="content" type="text"
               placeholder="Link Vide Youtube" value="<?/*=@$item->content*/?>"
               class="  form-control input-sm"/>-->
    </div>
    <div class="col-md-12" style="margin-bottom: 10px">
        <!--<input name="name" id="userfile" type="text" placeholder="Thông tin khác"
               value="<?/*=@$item->name;*/?>"   class="form-control input-sm"/>-->
    </div>
    <div class="form-group">
        <label class="col-md-12">Vị trí :</label>
        <div class="col-md-12" style="margin-bottom: 10px">
            <input name="sort" id="sort" type="text" value="<?=@$item->sort;?>"
                   class="form-control input-sm" placeholder="Vị trí"/>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <input name ="Upload"  type="submit" value="Upload" class="btn btn-success btn-xs"/>
    </div>
</form>
<style>
    .image{max-width: 100px}
    .image img{width: 100%;margin-top: 10px;border: 1px solid #ddd;padding:2px;}
</style>