    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="title">Title <span class="astrik">*</span></label>
                <input id="title" type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="slug">Slug <span class="astrik">*</span></label>
                <input id="slug" type="text" name="slug" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="parent_id">Parent Category<span class="astrik">*</span></label>
                <select id="parent_id" name="parent_id" class="form-control">
                    <option value="0">Select Parent Category</option>
                    <?php 
                  $CategoriesModel = App\Category::get();
                    if (count($CategoriesModel)>0) {
                      foreach ($CategoriesModel as $key => $value) {
                        ?>
                    <option value="<?= $value->category_id ?>"><?= $value->title ?></option>
                    <?php
                      }
                    }
                   ?>
                    <!-- <option value="1" selected="selected">SHOW ROOM</option> -->
                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input value="save" id="action" type="hidden">
                <input type="submit" value="{{ $page_name }}" class='btn btn-success save'>
            </div>
        </div>
    </div>
